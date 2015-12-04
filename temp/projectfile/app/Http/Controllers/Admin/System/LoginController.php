<?php

namespace App\Http\Controllers\Admin\System;

use App\Http\Controllers\Admin\AdminBaseController;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends AdminBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $systemMessage = Session::get('message');
        if(Auth::check()){
            return redirect('admin/topic/manage');
        }
        return view('admin.system.login',['systemMessage'=>$systemMessage]);
    }

    public function doLogin(Request $request){
        if($request->getMethod() == 'POST'){
            $name = $request->input('name','');
            $password = $request->input('password','');
            if(!$name || !$password){
                return redirect('admin/login/index')->with('message', '用户名和密码不能为空');
            }
            $remember = $request->input('remember',false);
            $t = $request->input('t','');
            $t = $t ? $t : 'admin/topic/manage';
            $is_login = Auth::attempt(['name' => $name, 'password' => $password],$remember);
            if ($is_login) {
                return redirect($t);
            }else{
                return redirect('admin/login')->with('message', '登录失败，用户名或者密码错误');
            }
        }else{
            return redirect('admin/login')->with('message', '请求方式错误');
        }
    }
}
