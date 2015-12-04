<?php

namespace App\Http\Controllers\Api;

use App\Helper\ApiUserSystem;
use App\Helper\SettingClass;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;



abstract class ApiBaseController extends Controller
{
    protected $user; // Api已登录用户
    protected $setting;
    // Api顶层注入
    public function __construct(Request $request)
    {
        $this->user = new ApiUserSystem($request->input('token',''));
        $this->setting = new SettingClass();
    }
}
