<?php

namespace App\Http\Controllers\Admin\Systemsetting;

use App\Http\Controllers\Admin\AdminBaseController;
use Illuminate\Support\Facades\Auth;
use Request;
use App\Model\LocationData;
use App\Model\TopicCategories;
use App\Helper\UserHelper;
use App\Http\Requests;

 class SystemsettingController extends AdminBaseController
{

    /**
     * citycode 列表
     * @author yaodan
     * @version  [version]
     * @datetime 2015-11-27T10:31:44+0800
     * @return
     */
    public function getLocationLists(){
        $citys = LocationData::select(['id', 'name', 'merger_name'])->paginate(30);
        return view('admin.settings.city', compact('citys'));
    }

    /**
     * 分类列表
     * @author yaodan
     * @version  [version]
     * @datetime 2015-11-27T12:03:20+0800
     * @return
     */
    public function getCategories(){
        $categories = TopicCategories::paginate(30);
        foreach ($categories as $key=>$value) {
            if($value->parent_id != 0)
                $categories[$key]->parent_id = TopicCategories::find($value->parent_id, ['title'])->title;
            else
                $categories[$key]->parent_id = "无";
        }
        return view('admin.settings.category', compact('categories'));
    }

    /**
     * 删除分类
     * @author yaodan
     * @version  [version]
     * @datetime 2015-11-27T12:03:39+0800
     * @return   json
     */
    public function getDeleteCategory(){
        $id = intval(Request::get('id'));
        $return = array();
        $return['result'] = -100;
        $return['text'] = '该分类不存在';
        if($category = TopicCategories::find($id, ['id'])) {
            if(TopicCategories::where('parent_id', $category->id)->count('id') == 0){
                if($category->delete()){
                    $return['result'] = 100;
                    $return['text'] = '删除成功';
                }
                else
                    $return['text'] = '删除失败';
            }
            else
                $return['text'] = '该大类存在子分类，不允许删除';
        }
        return response()->json($return);
    }

    /**
     * 添加分类
     * @author yaodan
     * @version  [version]
     * @datetime 2015-11-27T12:10:03+0800
     * @return   [type]                   [description]
     */
    public function getAddCategory(){
        $title = Request::get('title');
        $parent_id = intval(Request::get('parent_id'));
        $description = Request::get('description');
        $return = array();
        $return['result'] = -100;
        $return['text'] = '所选父类不存在';
        if($parent_id==0 || $category = TopicCategories::find($parent_id, ['id'])) {
            if(TopicCategories::create(['title'=>$title, 'parent_id'=>$parent_id, 'description'=>$description])){
                $return['result'] = 100;
                $return['text'] = '添加成功';
            }
            else
                $return['text'] = '添加失败';
        }
        return response()->json($return);
    }

    public function getEditCategory(){
        //TODO: 修改已经有子分类的分类的父类ID的情况
        $id = intval(Request::get('id'));
        $title = Request::get('title');
        $parent_id = intval(Request::get('parent_id'));
        $description = Request::get('description');
        $return = array();
        $return['result'] = -100;
        $return['text'] = '该分类不存在';
        if($category = TopicCategories::find($id)){
            if($parent_id==0 || $father_category = TopicCategories::find($parent_id, ['id'])) {
                if($category->update(['title'=>$title, 'parent_id'=>$parent_id, 'description'=>$description])){
                    $return['result'] = 100;
                    $return['text'] = '修改成功';
                }
                else
                    $return['text'] = '修改失败';
            }
            else
                $return['text'] = '所选父类不存在';
        }
        return response()->json($return);
    }

    public function getParentCategories(){

    }

    public function getGlobalSettings(){
        return view('admin.settings.global');
    }
}