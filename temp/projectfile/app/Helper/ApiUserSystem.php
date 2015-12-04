<?php
/**
 * 核心用户基类
 * User: lyt8384
 * Date: 2015/11/17
 * Time: 9:36
 */

namespace App\Helper;

use App\Model\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redis;

class ApiUserSystem {

    //全局token
    public $token;

    //全局设备码
    public $device_id;

    protected $token_ttl = 1296000; //15天
    protected $tmp_token_ttl = 86400; //1天

    protected $_user;
    protected $_uid = false;

    private $redis;

    public function __construct($token = '')
    {
        if(Request()->header('Device_id'))
            $this->device_id = Request()->header('Device_id');
        else
            $this->device_id = Request()->input('device_id');

        if( !$this->device_id ) {
            abort(403,'无效设备');
        }

        $this->redis = Redis::connection();
        if( !$this->redis ) {
            abort(500,'系统繁忙');
        }

        //加载用户资料
        $this->token = 'TK:' . $token;
        $this->readToken();
    }

    /**
     * 返回用户是否已登录
     * @return bool
     */
    public function isLogin()
    {
        return $this->redis->exists('TU:' . $this->_uid)
            ? true
            : false;
    }

    /**
     * 强制检测检查是否登录
     * @return bool
     */
    public function checkLogin()
    {
        if($this->_uid == false) {
            response()->api([],4003,"请先登录")->send();
            exit;
        }else{
            return true;
        }
    }

    /**
     * 设定登录
     * @param $uid 登录用户
     * @param array $data 附带数据
     * @return bool
     */
    public function setLogin($uid, $data = [])
    {
        $uid = (int)$uid;
        if($uid < 1) {
            return false;
        }
        $data['device_id'] = $this->device_id;
        $this->redis->hMset('TU:' . $uid, $data);
        $this->redis->expire('TU:' . $uid, $this->token_ttl);
        return $this->redis->hSet($this->token, 'uid', $uid);
    }

    /**
     * 注销登录
     * @return bool
     */
    public function setLogout()
    {
        $this->reflushToken();
        if($this->_uid !== false){
            $this->redis->Del('TU:' . $this->_uid);
            $this->_uid = false;
        }
        Cache::tags($this->token)->flush();
        return true;
    }

    /**
     * 返回是否被Ban
     * @return bool
     */
    public function is_ban()
    {
        //自动deban
        if($this->is_ban) {
            $ban_ttl = $this->redis->ttl('uBan:' . $this->_uid);
            if($ban_ttl < 1 && $ban_ttl != -1) {
                $this->redis->hDel('TU:' . $this->_uid, 'is_ban');
                User::where('uid', $this->_uid)
                    ->update(['is_lock'=>0]);
                return false;
            }
        }
        return $this->is_ban
            ? true
            : false;
    }

    /**
     * 返回是否白名单用户
     * @return bool
     */
    public function is_white()
    {
        return $this->is_white
            ? true
            : false;
    }

    /**
     * 缓存类
     * @return mixed
     */
    public function cache($key = '')
    {
        return (empty($key))
            ? Cache::tags($this->token)
            : Cache::tags($this->token)->get($key);
    }

    /**
     * 设定缓存
     * @param $key 键名
     * @param string $val 数据
     * @param int $ttl 过期时间
     * @return mixed 成功与否
     */
    public function setCache($key, $val = '', $ttl = 3600)
    {
        return $this->cache()->put($key, $val, $ttl);
    }

    /**
     * 加载token对应用户内容
     * @param $token
     */
    protected function readToken()
    {
        // 判断是否存在该设备
        if( empty($this->token) || $this->redis->exists($this->token) == false ){
            $this->token = 'TK:' . md5($this->device_id . config('app.key')) . ':' . microtime(true);
            $this->reflushToken();
            response()->api([
                'token' => ltrim($this->token, 'TK:'),
                'timestamp' => time()
            ],4001)->send();
            exit;

        }elseif($this->redis->hGet($this->token, 'device_id') != $this->device_id){
            //非法设备码强制退出
            if( $this->_uid = $this->redis->hGet($this->token, 'uid') ) {
                $this->setLogout();
            }else{
                $this->reflushToken();
            }
            response()->api([
                'token' => ltrim($this->token, 'TK:'),
                'timestamp' => time()
            ],4002)->send();
            exit;
        }else{
            $this->redis->expire($this->token, $this->token_ttl);
            $_uid = $this->redis->hGet($this->token, 'uid');
            if($_uid) {
                //判断是否需要强制登出该设备
                if($this->redis->hGet('TU:' . $_uid, 'device_id') != $this->device_id) {
                    $this->redis->hDel($this->token, 'uid');
                    response()->api([
                        'token' => ltrim($this->token, 'TK:'),
                        'timestamp' => time()
                    ],4002)->send();
                    exit;
                }else{
                    $this->_uid = $_uid;
                }
            }
        }
    }

    /**
     * 刷新token
     * @param bool $is_new
     */
    protected function reflushToken($is_new = true)
    {
        if($is_new) {
            $this->redis->Del($this->token);
            $this->redis->hSet($this->token, 'device_id',$this->device_id);
            $this->redis->expire($this->token, $this->tmp_token_ttl);
        }else{
            $this->redis->expire($this->token, $this->token_ttl);
            if($this->_uid !== false) {
                $this->redis->expire('TU:' . $this->_uid, $this->token_ttl);
            }
        }
    }

    public function __get($property)
    {
        if($property == 'cache') {
            return $this->cache();
        }

        if($this->_uid === false)
            return false;

        $val = $this->redis->hGet('TU:' . $this->_uid, $property);
        return $val
            ? $val
            : false;
    }
}