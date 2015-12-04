<?php

namespace App\Http\Controllers\Admin\Topic;

use App\Http\Controllers\Admin\AdminBaseController;
use App\Model\Topics;
use Illuminate\Http\Request;

use App\Http\Requests;

class ManageController extends AdminBaseController
{
    public function getIndex(Request $request){
        //备用（读取地狱[域]），整合时候要用到 add by yqh 2015-11-18 18:17:30
        /*$abc = Topics::find(1);
        foreach($abc->show()->groupby('city_code')->get() as $come){
            var_dump($come->location()->where(['level_type'=>2,'city_code'=>$come->city_code])->first()->merger_name);
        }*/
        $cid = intval($request->input('cid',0));
        $type = intval($request->input('type',0));
        $data = Topics::orderby('is_recommend','DESC')->orderby('created_at','DESC');
        switch($type){
            case 1:
                $list = $data->where('is_recommend','>','0')->paginate(3);
                break;
            default:
                $list = $data->paginate(3);
                break;
        }
        return view('admin.topic.list_manage',['list'=>$list,'type'=>$type]);
    }

    public function getEdit(Request $request){
        $id = intval($request->input('id',0));
        $info = Topics::find($id);
        if(!$info){
            return redirect('admin/topic/manage/list')->with('message', '此话题不存在');
        }
        return view('admin.topic.EditAuditing',['info'=>$info]);
    }

    public function postEdit(){
        return redirect('admin/topic/manage/list')->with('message', '保存成功');
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
}
