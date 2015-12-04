<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Admin\AdminBaseController;
use App\Model\User;
// use App\Model\UserBanLog;
use Illuminate\Support\Facades\Auth;
//use App\Http\Requests\Admin\User\LockUserRequest;
use Request;
use App\Model\UserBanLog;
use App\Model\UserWhiteList;
use App\Model\UserRecommend;
use App\Helper\UserHelper;
use App\Http\Requests;

/**
 * TODO: 所有list 电话/用户名搜索
 */
 class UserController extends AdminBaseController
{

    /**
     * 用户列表
     * @author yaodan
     * @version  1.0
     * @datetime 2015-11-20T11:02:00+0800
     * @return   列表页面
     */
    public function getLists() {
        $users = User::latest('reg_time')->paginate(30);
        return view('admin.user.list', compact('users'));
    }

    /**
     * 删除用户
     * @author yaodan
     * @version  1.0
     * @datetime 2015-11-20T11:04:31+0800
     * @param    int $uid 用户ID
     * @return
     */
    public function getDelete() {
        $user_helper = new UserHelper();
        $id = intval(Request::get('uid'));
        $return = $user_helper->banUser($id, -1);
        return response()->json($return);
    }

    /**
     * 重置用户密码
     * @author yaodan
     * @version  1.0
     * @datetime 2015-11-20T11:05:24+0800
     * @return
     */
    public function getResetPassword() {
        $uid = intval(Request::get('uid'));
        $password = Request::get('password');
        $final_password = md5(md5($password).md5($password));
        $return = array();
        $return['result'] = -100;
        $return['text'] = '该用户不存在';
        if($user = User::find($uid, ['uid'])) {
            if($user->update(['password' => $final_password])){
                $return['result'] = 100;
                $return['text'] = '重置成功';
            }
            else
                $return['text'] = '重置失败';
        }
        return response()->json($return);
    }

    /**
     * 禁言用户列表
     * @author yaodan
     * @version  1.0
     * @datetime 2015-11-20T11:06:27+0800
     * @return
     */
    public function getLockUserLists() {
        $lock_users = User::with([
                            'banLogs'=> function ($query) {
                                $query->orderBy('created_at', 'desc')
                                      ->take(1);
                            }])
                          ->locked()
                          ->paginate(30);
        return view('admin.user.list_ban', compact('lock_users'));
    }

    /**
     * 禁言用户
     * @author yaodan
     * @version  1.0
     * @datetime 2015-11-20T11:18:18+0800
     * @return
     */
    public function getLockUser() {
        $user_helper = new UserHelper();
        $id = intval(Request::get('uid'));
        $ban_time = intval(Request::get('time'));
        $return = $user_helper->banUser($id, $ban_time, Request::get('description'));
        return response()->json($return);
    }

    /**
     * 解禁用户
     * @author yaodan
     * @version  1.0
     * @datetime 2015-11-20T11:21:19+0800
     * @return
     */
    public function getUnLockUser() {
        $uid = intval(Request::get('uid'));
        $return = array();
        $return['result'] = -100;
        $return['text'] = '该用户不存在';
        if($user = User::find($uid, ['uid', 'is_lock'])) {
            if($user->is_lock){
                if($user->update(['is_lock'=>0])){
                    $return['result'] = 100;
                    $return['text'] = '解禁成功';
                }
                else
                    $return['text'] = '解禁失败';
            }
            else
                $return['text'] = '该用户非禁言状态';
        }
        return response()->json($return);
    }

    /**
     * 白名单用户列表
     * @author yaodan
     * @version  1.0
     * @datetime 2015-11-20T11:21:55+0800
     * @param string $search
     * @return
     */
    public function getWhiteUserLists($search = null) {
        $white_users = UserWhiteList::latest()->paginate(30);
        return view('admin.user.list_white', compact('white_users'));
    }

    /**
     * 设置白名单用户
     * @author yaodan
     * @version  1.0
     * @datetime 2015-11-20T11:22:05+0800
     * @return
     */
    public function postWhiteUser() {
        $return = array();
        $return['result'] = -100;
        $return['text'] = '该用户不存在';
        if($user = User::select('uid')->where('username', Request::get('username'))->first()) {
            if(is_null(UserWhiteList::find($user->uid, ['uid']))) {
                $insert = array();
                $insert['uid'] = $user->uid;
                // $insert['admin_uid'] = Auth::user()['id'];
                $insert['admin_uid'] = 1;
                $insert['description'] = Request::get('description');
                if(UserWhiteList::create($insert)){
                    $return['result'] = 100;
                    $return['text'] = '添加成功';
                }
                else
                    $return['text'] = '添加失败';
            }
            else
                $return['text'] = '该用户已在白名单中';
        }
        return response()->json($return);
    }

    /**
     * 取消白名单用户
     * @author yaodan
     * @version  1.0
     * @datetime 2015-11-20T11:22:10+0800
     * @return
     */
    public function getUnWhiteUser() {
        $uid = intval(Request::get('uid'));
        $return = array();
        $return['result'] = -100;
        $return['text'] = '该用户不在白名单里';
        if($user = UserWhiteList::find($uid, ['uid'])) {
            if($user->delete()){
                $return['result'] = 100;
                $return['text'] = '删除成功';
            }
            else
                $return['text'] = '删除失败';
        }
        return response()->json($return);
    }

    /**
     * 推荐用户列表
     * @author yaodan
     * @version  1.0
     * @datetime 2015-11-20T11:22:15+0800
     * @return
     */
    public function getRecommendUserLists() {
        //TODO: 按用户/称号/排序分组
        $recommend_users = UserRecommend::latest()->paginate(30);
        return view('admin.user.list_recommend', compact('recommend_users'));
    }

    /**
     * 推荐用户
     * @author yaodan
     * @version  1.0
     * @datetime 2015-11-20T11:22:30+0800
     * @param    [type]                   $uid [description]
     * @return
     */
    public function getRecommendUser() {
        $return = array();
        $return['result'] = -100;
        $return['text'] = '该用户不存在';
        $sort = intval(Request::get('sort'));
        $type = intval(Request::get('type'));
        $user = User::select('uid')->where('username', Request::get('username'))->first();
        if(count($user) > 0) {
            if(is_null(UserRecommend::where('type', $type)->find($user->uid, ['uid']))) {
                $insert = array();
                $insert['uid'] = $user->uid;
                // $insert['admin_uid'] = Auth::user()['id'];
                $insert['admin_uid'] = 1;
                $insert['sort'] = $sort;
                $insert['type'] = $type;
                if(UserRecommend::create($insert)){
                    $return['result'] = 100;
                    $return['text'] = '推荐成功';
                }
                else
                    $return['text'] = '推荐失败';
            }
            else
                $return['text'] = '该用户已是该类别推荐用户';
        }
        return response()->json($return);
    }

    /**
     * 取消推荐用户
     * @author yaodan
     * @version  1.0
     * @datetime 2015-11-20T11:22:35+0800
     * @param    [type]                   $uid [description]
     * @return
     */
    public function getUnRecommendUser() {
        $id = intval(Request::get('id'));
        $return = array();
        $return['result'] = -100;
        $return['text'] = '该条记录不存在';
        if($recommend = UserRecommend::find($id, ['id'])) {
            if($recommend->delete()){
                $return['result'] = 100;
                $return['text'] = '取消推荐成功';
            }
            else
                $return['text'] = '取消推荐失败';
        }
        return response()->json($return);
    }

    /**
     * 达人列表
     * @author yaodan
     * @version  1.0
     * @datetime 2015-11-20T11:22:39+0800
     * @return
     */
    public function getDoyenLists() {
        return view('admin.user.list_master');
    }

    /**
     * 申请达人列表
     * @author yaodan
     * @version  1.0
     * @datetime 2015-11-20T11:22:44+0800
     * @return
     */
    public function getApplyDoyenLists() {

    }

    /**
     * 设置用户为达人
     * @author yaodan
     * @version  1.0
     * @datetime 2015-11-20T11:22:54+0800
     * @param    [type]                   $uid [description]
     * @return
     */
    public function getDoyenUser() {

    }

    /**
     * 取消用户达人资格
     * @author yaodan
     * @version  1.0
     * @datetime 2015-11-20T11:22:58+0800
     * @param    [type]                   $uid [description]
     * @return
     */
    public function getUnDoyenUser() {

    }
}