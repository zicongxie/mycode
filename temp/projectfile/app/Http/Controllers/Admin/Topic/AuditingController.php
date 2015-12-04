<?php

namespace App\Http\Controllers\Admin\Topic;

use App\Http\Controllers\Admin\AdminBaseController;
use App\Model\TopicCategories;
use App\Model\Topics;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class AuditingController extends AdminBaseController
{
    public function getIndex(){
        $list = Topics::orderby('created_at','DESC')->paginate(10);
        return view('admin.topic.list_check',['list'=>$list]);
    }

    public function getUpdate(Request $request){
        $id = intval($request->input('id',0));
        $act = $request->input('act','cate');
        $cid = intval($request->input('cid',0));
        $re =false;
        if(!$id || ($act == 'cate' && !$cid)){
            return response()->json(['text'=>'缺少必要参数','result'=>-101]);
        }
        $exist = Topics::find($id);
        $status_data = 0;
        if($act == 'cate'){
            $re = Topics::where('id',$id)->update(['cid'=>$cid]);
        }elseif($act == 'recommend'){
            $status_data = $exist->is_recommend ? 0 : 1;
            $re = Topics::where('id',$id)->update(['is_recommend'=>$status_data]);
        }elseif($act == 'check'){
            $status_data = $exist->is_checked ? 0 : 1;
            $re = Topics::where('id',$id)->update(['is_checked'=>$status_data]);
        }
        if($re){
            return response()->json(['text'=>'保存成功','result'=>100,'data'=>$status_data]);
        }else{
            return response()->json(['text'=>'保存失败','result'=>-100]);
        }
    }

    public function getCate(){
        $list = TopicCategories::all()->toArray();
        if($list){
            return response()->json(['data'=>$list,'text'=>'读取成功','result'=>100]);
        }else{
            return response()->json(['data'=>'','text'=>'抱歉，没有数据','result'=>-100]);
        }
    }
}
