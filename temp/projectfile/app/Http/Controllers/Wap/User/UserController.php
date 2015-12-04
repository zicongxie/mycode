<?php

namespace App\Http\Controllers\Wap\User;

use App\Http\Controllers\Wap\WapBaseController;
use App\Model\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class UserController extends WapBaseController
{
    /**
     * @auth yqh
     * @param Request $request
     * @return mixed
     */
    public function getResetpasswordone(Request $request){
        return view('wap.user.reset_password');
    }

    /**
     * @author yqh
     * @param Request $request
     * @return json
     */
    public function postResetpasswordone(Request $request){
        $mobile = trim($request->input('mobile',''));

        //验证码块
        $mobile_random_code = intval($request->input('mobile_random_code',0));
        $cache_random_code = $this->user->cache('mobile_random_code');
        if(!$cache_random_code || !$mobile){
            return response()->json(['code'=>-100,'text'=>'验证码已失效']);
        }elseif($mobile_random_code != $cache_random_code || !$mobile_random_code){
            return response()->json(['code'=>-101,'text'=>'验证码错误']);
        }

        if(!$mobile){
            return $this->response()->json(['code'=>-102,'text'=>'请填写电话']);
        }

        if(13000000000 > $mobile || 20000000000 < $mobile){
            return response()->json(['code'=>-103,'text'=>'请填写有效的电话号码']);
        }

        return response()->json(['code'=>100,'text'=>'下一步']);
    }

    /**
     * @author yqh
     * @param Request $request
     * @return mixed
     */
    public function getResetpasswordtwo(Request $request){
        return view('wap.user.reset_password2');
    }

    /**
     * @author yqh
     * @param Request $request
     * @return json
     */
    public function postResetpasswordtwo(Request $request){
        $password = trim($request->input('password',''));
        $re_password = trim($request->input('re_password',''));
        $mobile = $this->user->cache('foud_password_mobile');

        if($password != $re_password){
            return response()->json(['code'=>-102,'text'=>'两次输入密码不一致']);
        }

        if(strlen($password) < 6){
            return response()->json(['code'=>-103,'text'=>'密码不能少于6位']);
        }

        $exist = User::where('mobile',$mobile)->first();

        if(!$exist){
            return response()->json(['code'=>-104,'text'=>'电话号码未注册']);
        }else{
            $exist->password = md5(md5($password).md5($password));
            $exist->save();
            return response()->json(['code'=>100,'text'=>'保存成功']);
        }

    }

    /**
     * @author yqh
     * @param Request $request
     * @return json
     */
    public function getSendmessage(Request $request){
        $mobile = trim($request->input('mobile',''));

        $cache_exist = $this->user->cache('is_send_message');
        if($cache_exist){
            return response()->api(['code'=>-100,'text'=>'请间隔60秒再发送']);
        }

        $db_exist = User::where('mobile',$mobile)->first();
        if(!$db_exist){
            return response()->json(['code'=>-101,'text'=>'电话号码未注册']);
        }

        if(!$cache_exist && $db_exist){
            $this->user->setCache('foud_password_mobile',$mobile,11);
            $this->user->setCache('is_send_message',$mobile,1);
            $mobile_random_code = mt_rand(10000,99999);
            $this->user->setCache('mobile_random_code',$mobile_random_code,10);
            //TODO：要写一个异步job来完成注册发短信功能
            return response()->json(['code'=>100,'text'=>'发送成功','data'=>'电话验证码'.$mobile_random_code]); //TODO：上线前去掉提示
        }
    }
}
