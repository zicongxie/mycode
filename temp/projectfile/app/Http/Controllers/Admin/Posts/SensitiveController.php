<?php

namespace App\Http\Controllers\Admin\Posts;

use App\Http\Controllers\Admin\AdminBaseController;
use App\Model\SensitiveWords;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class SensitiveController extends AdminBaseController
{
    public function getIndex()
    {
        $infos = SensitiveWords::orderby('id','DESC')->paginate(3);
        return view('admin.posts.list_words',['infos'=>$infos]);
    }

    public function getSave(Request $request){
        $id = intval($request->input('id',0));
        $type = intval($request->input('type',0));
        $words = trim($request->input('words',''));
        $insert_id = 0;
        if(!$type || empty($words)){
            return response()->json(['text'=>'请完善数据','result'=>-101]);
        }

        if($id){
            $exist = SensitiveWords::find($id);
            $exist->words = $words;
            $exist->type = $type;
            $re = $exist->save();
        }else{
            $exist = SensitiveWords::where('words',$words)->first();
            if($exist) return response()->json(['text'=>'该敏感词已存在','result'=>-102]);
            $admin_user = Auth::user();
            $re = SensitiveWords::create(['type'=>$type,'words'=>$words,'admin_uid'=>$admin_user->id]);
            $insert_id = $re->id;
        }

        if($re){
            return response()->json(['text'=>'保存成功','result'=>100,'data'=>$insert_id]);
        }else{
            return response()->json(['text'=>'保存失败','result'=>-100]);
        }
    }

    public function getUpdate(Request $request){
        $id = intval($request->input('id',0));
        $act = $request->input('act','');
        $re = false;
        $exist = SensitiveWords::find($id);
        if(!$id || !$exist){
            return response()->json(['text'=>'不存在此内容','result'=>-101]);
        }
        if($act == 'del'){
            $re = $exist->delete();
        }
        if($re){
            return response()->json(['text'=>'保存成功','result'=>100]);
        }else{
            return response()->json(['text'=>'保存失败','result'=>-100]);
        }
    }
}
