<?php

namespace App\Http\Controllers\Admin\Posts;

use App\Http\Controllers\Admin\AdminBaseController;
use Illuminate\Http\Request;

use App\Http\Requests;

class PostsReportController extends AdminBaseController
{
    public function getIndex()
    {
        //TODO：待工
        return view('admin.posts.list_report');
    }

}
