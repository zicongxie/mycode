<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Api\ApiBaseController;

use App\Model\UserConnect;
use Faker\Provider\UserAgent;
use Illuminate\Http\Request;
use App\Model\User;
use App\Model\UserLoginLog;
use App\Model\UserWhiteList;
use Carbon\Carbon;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class UserController extends ApiBaseController
{
    /**
     * @author yqh
     * @param username 用户名
     * @param password 密码
     * @return json
     */
    public function postLogin(Request $request){
        $mobile = $request->input('mobile','');
        $password = $request->input('password','');
        $user_agent = UserAgent::userAgent();
        $device_id = $this->user->device_id;
        if(!$mobile || !$password){
            return response()->api([],19001,'请完善手机号码或密码');
        }

        if(13000000000 > $mobile || 20000000000 < $mobile){
            return response()->api([],19002,'请填写有效的电话号码');
        }

        if(strlen($password) < 6){
            return response()->api([],19005,'至少填写6位以上密码');
        }

        $user_info = User::where('mobile',$mobile)->first()->toArray();
        $final_password = md5(md5($password).md5($password));
        if($final_password == $user_info['password']){
            $exist_white = UserWhiteList::where('uid',$user_info['uid'])->first();
            if($exist_white) $user_info['whiteUser'] = 1;
            $this->user->setLogin($user_info['uid'],$user_info);
            UserLoginLog::create(['uid'=>$user_info['uid'],'type'=>0,'ip'=>$request->getClientIp(),'user_agent'=>$user_agent,'device_id'=>$device_id]);
            return response()->api([$user_info]);
        }else{
            UserLoginLog::create(['uid'=>$user_info['uid'],'type'=>0,'ip'=>$request->getClientIp(),'is_succeed'=>0,'user_agent'=>$user_agent,'device_id'=>$device_id]);
            return response()->api([],19003,'密码错误');
        }
    }

    /**
     * @author yqh
     * @param avatar 头像
     * @param nickname 昵称
     * @param passowrd 密码
     * @param sex 性别
     * @return json
     */
    public function postRegister(Request $request){
        $avatar_special = $request->input('avatar_special');
        $avatar_normal = $request->input('avatar_normal');
        $avatar = $avatar_special ? base64_decode($avatar_special) : $avatar_normal;
        $nickname = $request->input('nickname','');
        $password = $request->input('password','');
        $sex = intval($request->input('sex',0));
        //电话号码从redis获取，获取方式待定
        $mobile = $this->user->cache('register_mobile');
        if(!$nickname || !$password || !$mobile){
            return response()->api([],19004,'请完善注册信息');
        }

        if(strlen($password) < 6){
            return response()->api([],19005,'至少填写6位以上密码');
        }

        $exist = User::where('mobile',$mobile)->first();
        if($exist){
            return response()->api([],19013,'抱歉，手机已被注册');
        }

        //验证码块
        $mobile_random_code = intval($request->input('mobile_random_code',0));
        $cache_random_code = $this->user->cache('mobile_random_code');
        if(!$cache_random_code){
            return response()->api([],19011,'验证码已失效');
        }elseif($mobile_random_code != $cache_random_code){
            return response()->api([],19012,'验证码错误');
        }

        $final_password = md5(md5($password).md5($password));
        $insert = User::create(['nickname'=>$nickname,'mobile'=>$mobile,'password'=>$final_password,'sex'=>$sex,'reg_ip'=>$request->getClientIp()]);
        if($insert){
            $upload_avatar = $this->_cutTheShit($insert->uid);
            $avatar_contents = $this->_curl($avatar);
            Storage::disk('qiniu')->put($upload_avatar, $avatar_contents);
            Storage::disk('local')->put($upload_avatar, $avatar_contents);
            User::find($insert->uid)->update(['avatar'=>$upload_avatar]);
            $this->user->setLogin($insert->uid,['avatar'=>$upload_avatar,'nickname'=>$nickname,'sex'=>$sex]);
            return response()->api(['uid'=>$insert->uid,'avatar'=>$upload_avatar,'nickname'=>$nickname,'sex'=>$sex]);
        }else{
            return response()->api([],19006,'注册失败');
        }
    }

    /**
     * @author yqh
     * @param nickname 昵称
     * @return json
     */
    public function postChecknickname(Request $request){
        $nickname = $request->input('nickname','');
        $len = strlen($nickname);
        //用户的昵称要求：长度2-8个中文字符，可用中文和英文、数字，下划线。不支持emoji、纯数字组合,数字下划线组合,纯下划线
        if(!preg_match('/^[a-z0-9_\x{4e00}-\x{9fa5}]{2,16}$/ui',$nickname) || preg_match('/^\d+$/',$nickname) || preg_match('/^[0-9_]+$/',$nickname) || preg_match('/^[_]+$/',$nickname)){
            return response()->api([],19007,'请填写正确的昵称');
        }
        if(!$nickname || $len < 3 || $len > 16){
            return response()->api([],19007,'请填写正确的昵称');
        }
        //TODO：还要判断用户名黑名单，例如（admin）
        $exist = User::where('nickname',$nickname)->first();
        if($exist){
            return response()->api([],19008,'昵称已被占用');
        }else{
            return response()->api([]);
        }
    }

    /**
     * @author yqh
     * @param mobile 电话
     * @return json
     */
    public function postSendmessage(Request $request){
        $mobile = $request->input('mobile','');
        if(13000000000 > $mobile || 20000000000 < $mobile){
            return response()->api([],19002,'请填写有效的电话号码');
        }

        $cache_exist = $this->user->cache('is_send_message');
        if($cache_exist){
            return response()->api([],19009,'请间隔60秒再发送');
        }

        $db_exist = User::where('mobile',$mobile)->first();
        if($db_exist){
            return response()->api([],19010,'电话号码已占用');
        }

        if(!$cache_exist && !$db_exist){
            $this->user->setCache('register_mobile',$mobile,11);
            $this->user->setCache('is_send_message',$mobile,1);
            $mobile_random_code = mt_rand(10000,99999);
            $this->user->setCache('mobile_random_code',$mobile_random_code,10);
            //TODO：要写一个异步job来完成注册发短信功能
            return response()->api([],0,'电话验证码'.$mobile_random_code); //TODO：上线前去掉提示
        }
    }
    
    public function postCheckmobilerandomcode(Request $request){
        $mobile_random_code = intval($request->input('mobile_random_code',0));
        $cache_random_code = $this->user->cache('mobile_random_code');
        if(!$cache_random_code){
            return response()->api([],19011,'验证码已失效');
        }elseif($mobile_random_code != $cache_random_code){
            return response()->api([],19012,'验证码错误');
        }else{
            return response()->api([]);
        }
    }

    public function postOtheregister(Request $request){
        $nickname = trim($request->input('nickname',''));
        $sex = intval($request->input('sex',0));
        $avatar_special = $request->input('avatar_special');
        $avatar_normal = $request->input('avatar_normal');
        $avatar = $avatar_special ? base64_decode($avatar_special) : $avatar_normal;

        $connect_id = $request->input('connect_id','');
        //站点1：微信  2：QQ   3：微博
        $site_id = intval($request->input('site_id',0));
        if(!$nickname || !$connect_id || !$site_id){
            return response()->api([],19004,'请完善注册信息');
        }

        $len = strlen($nickname);
        //用户的昵称要求：长度2-8个中文字符，可用中文和英文、数字，下划线。不支持emoji、纯数字组合,数字下划线组合,纯下划线
        if(!preg_match('/^[a-z0-9_\x{4e00}-\x{9fa5}]{2,16}$/ui',$nickname) || preg_match('/^\d+$/',$nickname) || preg_match('/^[0-9_]+$/',$nickname) || preg_match('/^[_]+$/',$nickname)){
            return response()->api([],19007,'请填写正确的昵称');
        }
        if(!$nickname || $len < 3 || $len > 16){
            return response()->api([],19007,'请填写正确的昵称');
        }
        //TODO：还要判断用户名黑名单，例如（admin）
        $exist = User::where('nickname',$nickname)->first();
        if($exist){
            return response()->api([],19008,'昵称已被占用');
        }

        $exist = UserConnect::where('connect_id',$connect_id)->first();
        if($exist){
            $user_info = User::find($exist->uid)->toArray();
            $this->user->setLogin($user_info['uid'],$user_info);
            return response()->api([$user_info]);
        }else{
            $final_password = md5(md5(microtime(true)));
            $insert_User = User::create(['nickname'=>$nickname,'password'=>$final_password,'sex'=>$sex,'reg_ip'=>$request->getClientIp()]);
            if($insert_User) $insert_UserConnect = UserConnect::create(['uid'=>$insert_User->uid,'connect_id'=>$connect_id,'site_id'=>$site_id]);
            if($insert_User && $insert_UserConnect){
                $upload_avatar = $this->_cutTheShit($insert_User->uid);
                $avatar_contents = $this->_curl($avatar);
                Storage::disk('qiniu')->put($upload_avatar, $avatar_contents);
                Storage::disk('local')->put($upload_avatar, $avatar_contents);
                User::find($insert_User->uid)->update(['avatar'=>$upload_avatar]);
                $this->user->setLogin($insert_User->uid,['nickname'=>$nickname,'sex'=>$sex,'avatar'=>$upload_avatar]);
                return response()->api(['uid'=>$insert_User->uid,'nickname'=>$nickname,'sex'=>$sex,'avatar'=>$upload_avatar]);
            }else{
                return response()->api([],19006,'注册失败');
            }
        }
    }

    public function postOtherlogin(Request $request){
        $connect_id = $request->input('connect_id','');
        $site_id = intval($request->input('site_id',0));

        $exist = UserConnect::where('connect_id',$connect_id)->first();
        if($exist){
            $user_info = User::find($exist->uid)->toArray();
            if($user_info){
                $this->user->setLogin($user_info['uid'],$user_info);
                return reponse()->api([]);
            }else{
                return response()->api(['connect_id'=>$connect_id,'site_id'=>$site_id],19014,'登录失败，不存在该用户');
            }
        }else{
            return response()->api(['connect_id'=>$connect_id,'site_id'=>$site_id],19014,'登录失败，不存在该用户');
        }
    }

    function _cutTheShit($str){
        $str = sprintf('%010d',$str);
        $one = 'avatar/'.substr($str,0,3).'/';
        $two = substr($str,3,2).'/';
        $three = substr($str,5,2).'/';
        $four = substr($str,7).'.jpg';
        return $str = $one.$two.$three.$four;
    }

    function _curl($url,$cookie = '',$post = ''){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        if($cookie){
            curl_setopt($ch, CURLOPT_COOKIE, $cookie);
        }
        if($post){
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        }
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }
}
