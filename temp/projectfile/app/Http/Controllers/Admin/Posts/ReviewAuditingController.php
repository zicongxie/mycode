<?php

namespace App\Http\Controllers\Admin\Posts;

use App\Http\Controllers\Admin\AdminBaseController;
use App\Model\Recycle;
use App\Model\Reviews;
use Illuminate\Http\Request;

use App\Http\Requests;

class ReviewAuditingController extends AdminBaseController
{
    public function getIndex(Request $request)
    {
        $type = intval($request->input('type',0));
        $starttime = strtotime($request->input('starttime',''));
        $endtime = strtotime($request->input('endtime',''));
        switch($type){
            case 1:
                $data = Reviews::where('is_checked',-1);
                break;
            case 2:
                $data = Reviews::where('is_checked',-2);
                break;
            case 3:
                $data = Reviews::where('is_checked',-3);
                break;
            case 4:
                $data = Recycle::where('type',2);
                break;
            default:
                $data = Reviews::select('*');
                break;
        }
        if($starttime){
            $data = $data->where('created_at','>',$starttime);
        }
        if($endtime){
            $data = $data->where('created_at','<',$endtime);
        }

        $infos = $data->paginate(10);
        return view('admin.posts.list_reply',['infos'=>$infos,'type'=>$type,'starttime'=>$starttime,'endtime'=>$endtime]);
    }

    public function getShield(Request $request){
        $id = $request->input('id',0);
        $return_data = 0;
        if(is_array($id)){
            $re = Reviews::whereIn('id',$id)->update(['is_checked'=>-1]);
        }else{
            if($id = intval($id)){
                $exist = Reviews::find($id);
                $return_data = $is_checked = $exist->is_checked == -1 ? 0 : -1;
                $re = Reviews::where('id',$id)->update(['is_checked'=>$return_data]);
            }
        }

        if($re){
            return response()->json(['text'=>'修改成功','result'=>100,'data'=>$return_data]);
        }else{
            return response()->json(['text'=>'修改失败','result'=>-100]);
        }
    }

    public function getUpdate(Request $request){
        $id = intval($request->input('id',0));
        $act = $request->input('act','NotAcross');
        $re = false;
        $exist = Reviews::find($id);
        if(!$id || !$exist){
            return response()->json(['text'=>'不存在此内容','result'=>-101]);
        }

        $return_data = 0;

        if($act == 'NotAcross'){
            $return_data = $exist->is_checked = $exist->is_checked == -2 ? 1 : -2;
            $re = $exist->save();
        }

        if($re){
            return response()->json(['text'=>'保存成功','result'=>100,'data'=>$return_data]);
        }else{
            return response()->json(['text'=>'保存失败','result'=>-100]);
        }
    }
}
