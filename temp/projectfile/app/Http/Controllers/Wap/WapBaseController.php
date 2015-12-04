<?php

namespace App\Http\Controllers\Wap;

use App\Helper\ApiUserSystem;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

abstract class WapBaseController extends Controller
{
    protected $user; // Wap已登录用户
    // Wap顶层注入
    public function __construct(Request $request)
    {
        $this->middleware('session');
        $this->middleware('shareerrors');
        $this->user = new ApiUserSystem($request->cookie('token',''));
    }
}
