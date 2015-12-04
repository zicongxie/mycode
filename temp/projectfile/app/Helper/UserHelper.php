<?php
/**
 * Created by PhpStorm.
 * User: lyt8384
 * Date: 2015/11/20
 * Time: 11:51
 */

namespace App\Helper;


use App\Model\UserBanLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use App\Model\User;
use Response;

class UserHelper {

    private $redis;
    private $user;

    public function __construct()
    {
        $this->user = Auth::user();
        $this->redis = Redis::connection();
    }

    /**
     * @param $uid 用户ID
     * @param int $banTime 禁言时间
     * @param string $reason 禁言原因
     * @return array
     */
    public function banUser($uid, $banTime = 1, $reason = '')
    {
        $return = array();
        $return['result'] = -100;
        $return['text'] = '该用户不存在';
        if($user = User::find($uid, ['uid'])) {
            if($banTime >0){
                $this->redis->setex('uBan:' . $uid, $banTime * 86400, time());
                $insert = array();
                $admin_user = Auth::user();
                $insert['uid'] = $uid;
                // $insert['admin_uid'] = $admin_user->uid;
                $insert['admin_uid'] = 1;
                $insert['description'] = $reason;
                $insert['time'] = $banTime * 86400;
                $insert['end_at'] = strtotime("+". $banTime . " day");
                if(UserBanLog::create($insert) && $user->update(['is_lock' => 1])){
                    $return['result'] = 100;
                    $return['text'] = '禁言成功';
                }
                else
                    $return['text'] = '禁言失败';
            }
            elseif($banTime == -1){
                if($user->update(['is_lock' => -1])){
                    $return['result'] = 100;
                    $return['text'] = '删除成功';
                }
                else
                    $return['text'] = '删除失败';
            }
        }
        return $return;
    }

    /**
     * 用户是否禁言
     * @author yaodan
     * @version  1.0
     * @datetime 2015-11-20T16:32:35+0800
     * @param    int                   $uid 用户ID
     * @return   array
     */
    public function isBan($uid)
    {
        $user = User::find($uid, ['uid', 'is_lock']);
        if($user->is_lock) {
            $ban_ttl = $this->resid->ttl('uBan:' . $user->uid);
            if($ban_ttl < 1 && $ban_ttl != -1) {
                $this->redis->del('uBan:' . $user->uid);
                $this->redis->hDel('TU:' . $user->uid, 'is_ban');
                User::where('uid', $user->uid)
                    ->update(['is_lock' => 0]);
                return false;
            }
        }
        return $user->is_lock ? true : false;
    }

    /**
     * 解禁用户
     * @author yaodan
     * @version  1.0
     * @datetime 2015-11-30T18:50:26+0800
     * @param    int    $uid 用户ID
     * @return   bool   接近是否成功
     */
    public function deBan($uid) {
        $user = User::find($uid, ['uid', 'is_lock']);
        if($user->is_lock) {
            $this->redis->del('uBan:' . $user->uid);
            $this->redis->hDel('TU:' . $user->uid, 'is_ban');
            if(User::where('uid', $user->uid)
                ->update(['is_lock' => 0]))
                return true;
            else
                return false;
        }
        return true;
    }
}