<?php

namespace App\Http\Controllers\Admin\Posts;

use App\Http\Controllers\Admin\AdminBaseController;
use App\Model\Posts;
use App\Model\Recycle;
use App\Model\Topics;
use App\Model\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class PostsAuditingController extends AdminBaseController
{
    public function getIndex(Request $request)
    {
        $type = intval($request->input('type',0));
        $orderby = $request->input('orderby','');
        switch($type){
            case 1:
                $data = Posts::where('is_hot',1);
                break;
            case 2:
                $data = Recycle::where('type',1);
                break;
            default:
                $data = Posts::select('*');
                break;
        }
        switch($orderby){
            case 1:
                //TODO: 排序方式待定
                break;
            default:
                $data = $data->orderby('created_at','DESC');
                break;
        }
        $infos = $data->paginate(10);
        return view('admin.posts.list_audit',['infos'=>$infos,'type'=>$type,'orderby'=>$orderby]);
    }

    public function getUpdate(Request $request){
        $id = intval($request->input('id',0));
        $act = $request->input('act','');
        $re = false;
        $exist = Posts::find($id);
        if(!$id || !$exist){
            return response()->json(['text'=>'不存在此内容','result'=>-101]);
        }
        $status_data = 0;
        if($act == 'auditing'){
            $status_data = $exist->is_checked ? 0 : 1;
            $update_posts = Posts::where('id',$id)->update(['is_checked'=>$status_data]);
            $update_topic = Topics::where('id',$exist->topic_id)->update(['is_checked'=>1]);
            $re = $update_posts && $update_topic ? true :false;
        }elseif($act == 'del'){
            $description = $request->input('description','');
            $admin_user = Auth::user();
            $exist_array = $exist->toArray();
            $exist_array['nickname'] = $exist->user->nickname;
            $exist_array['ban'] = $exist->user->is_lock;
            $exist_array['topicsTitle'] = $exist->topics->title;
            $InsertRecycle = Recycle::create(['type'=>1,'author_uid'=>$exist->author_uid,'admin_uid'=>$admin_user->id,'description'=>$description,'data'=>serialize($exist_array)]);
            $re = $InsertRecycle ? $exist->delete() : false;
        }elseif($act == 'hot'){
            $status_data = $exist->is_hot = $exist->is_hot ? 0 : 1;
            $re = $exist->save();
        }elseif($act == 'zone'){
            //TODO: 需求不明确，待定
        }elseif($act == 'topic'){
            //TODO：话题搜索待定
        }elseif($act == 'ban'){
            $re = User::where('uid',$exist->author_uid)->update(['is_lock'=>1]);
        }elseif($act == 'content'){
            $content = $request->input('content','');
            $exist->content = $content;
            $re = $exist->save();
        }
        if($re){
            return response()->json(['text'=>'保存成功','result'=>100,'data'=>$status_data]);
        }else{
            return response()->json(['text'=>'保存失败','result'=>-100]);
        }
    }
}
