@extends('admin.layouts.base')
@section('title', '施工中')
@section('panel-title', '话题管理')
@section('sidebar')
@endsection
@section('breadcrumb')
    <div class="normalheader">
        <div class="hpanel">
            <div class="panel-body">
                <a class="small-header-action" href="">
                    <div class="clip-header">
                        <i class="fa fa-arrow-up"></i>
                    </div>
                </a>

                <div id="hbreadcrumb" class="pull-right m-t-lg">
                    <ol class="hbreadcrumb breadcrumb">
                        <li>
                            <span>话题</span>
                        </li>
                        <li class="active">
                            <span>话题管理</span>
                        </li>
                    </ol>
                </div>
                <h2 class="font-light m-b-xs">
                    话题管理
                </h2>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="content animate-panel">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel">
                    <div class="panel-body">
                        <div style="width:100px;" class="pull-left m-r-xs">
                            <select class="form-control" name="account">
                                <option>分类</option>
                                <option>option 2</option>
                                <option>option 3</option>
                                <option>option 4</option>
                            </select>
                        </div>
                        <div style="width:100px;" class="pull-left m-r-xs">
                            <select class="form-control" name="account">
                                <option>类型</option>
                                <option>小编创建</option>
                                <option>用户创建</option>
                            </select>
                        </div>
                        <div style="width:100px;" class="pull-left m-r-xs">
                            <select class="form-control" name="account">
                                <option>区域</option>
                                <option>option 2</option>
                                <option>option 3</option>
                                <option>option 4</option>
                            </select>
                        </div>
                        <div class="input-group col-md-4">
                            <input type="text" class="form-control" placeholder="">
                            <span class="input-group-btn"><button type="button" class="btn btn-success">搜索</button></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel">
                    <div class="panel-body">
                        <div class="btn-group">
                            <a href="/admin/topic/manage/list" class="btn btn-{{$type ? 'default' : 'info'}}">全部</a>
                            <a href="/admin/topic/manage/list?type=1" class="btn btn-{{$type ? 'info' : 'default'}}">推荐</a>
                        </div>
                        <div class="btn-group pull-right">
                            <a href="#" class="btn btn-success m-r">话题条件</a>
                            <a href="#" class="btn btn-success">添加</a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped table-bordered table-hover text-center">
                            <thead>
                                <tr>
                                    <th class="text-center">话题</th>
                                    <th class="text-center">描述</th>
                                    <th class="text-center">封面</th>
                                    <th class="text-center">分类</th>
                                    <th class="text-center">类型</th>
                                    <th class="text-center">推荐</th>
                                    <th class="text-center">是否显示</th>
                                    <th class="text-center">区域</th>
                                    <th class="text-center">操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($list as $info)
                                    <tr>
                                        <td class="text-left">
                                            <input type="checkbox">
                                            <input class="text-center" type="text" style="width:30px;height:30px;" value="1">
                                            <span>{{$info->title}}</span>
                                        </td>
                                        <td>{{$info->description}}</td>
                                        <td><img width="100" height="100" src="{{$info->cover_img}}" alt="{{$info->title}}"></td>
                                        <td><a href="#" data-type="select" data-pk="{{$info->id}}" data-value="{{$info->cid}}" data-title="选择分类" class="editable editable-click js-cate" style="color: gray;">{{isset($info->cate->title) ? $info->cate->title : '-'}}</a></td>
                                        <td>{{isset($info->user->username) ? $info->user->username : '-'}}</td>
                                        <td><a data-id="{{$info->id}}" class="btn {{$info->is_recommend?'btn-warning':'btn-default'}} btn-xs js-recommend">{{$info->is_recommend ? '已推荐' : '未推荐'}}</a></td>
                                        <td><a data-id="{{$info->id}}" class="btn {{$info->is_check?'btn-success':'btn-default'}} btn-xs js-check">{{$info->is_check ? '是' : '否'}}</a></td>
                                        <td>
                                            @if($info->show()->groupby('city_code')->first())
                                                @foreach($info->show()->groupby('city_code')->get() as $city)
                                                    {{$city->location()->where(['level_type'=>2,'city_code'=>$city->city_code])->first()->merger_name}}<br>
                                                @endforeach
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            <a data-id="{{$info->id}}" class="btn btn-danger btn-xs">编辑</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <?php echo $list->render(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        td{
            vertical-align: middle !important;
        }
    </style>
@stop
@section('page-js')
<script>
Do('editable','toastr',function(){

    toastr.options = {
      "closeButton": true,
      "debug": false,
      "newestOnTop": false,
      "progressBar": false,
      "positionClass": "toast-top-center",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }

    $('body').on('click','.js-check',function(){
        var $this=$(this);
        $.ajax({
            url:"/admin/topic/manage/update?id="+$this.data('id')+"&act=check",
            type:"get",
            dataType:"json",
            success:function(data){
                if(data.result=="100"){
                    $this.toggleText('是','否').toggleClass('btn-default').toggleClass('btn-success');
                    toastr.success(data.text);
                }else{
                    toastr.error(data.text);
                }
            }
        });
    })

    $('body').on('click','.js-recommend',function(){
        var $this=$(this);
        $.ajax({
            url:"/admin/topic/manage/update?id="+$this.data('id')+"&act=recommend",
            type:"get",
            dataType:"json",
            success:function(data){
                if(data.result=="100"){
                    $this.toggleText('已推荐','未推荐').toggleClass('btn-default').toggleClass('btn-warning');
                    toastr.success(data.text);
                }else{
                    toastr.error(data.text);
                }
            }
        });
    })

    //获取分类
    $.ajax({
        url:"/admin/topic/auditing/cate",
        type:"get",
        dataType:"json",
        success:function(res){
            console.log(res)
            var source=[];
            if(res.result=="100"){
                for(var i=0,l=res.data.length;i<l;i++){
                    var o={
                        value:res.data[i].id,
                        text:res.data[i].title
                    }
                    source.push(o);
                }
            }
            console.log(source)
            cateInit(source);
        }
    });
    function cateInit(source){
      $('.js-cate').editable({
         // prepend: "not selected",
         source: source,
         // display: function(value, sourceData) {
         //     var colors = {"": "gray", 1: "green", 2: "blue"},
         //             elem = $.grep(sourceData, function(o){return o.value == value;});

         //     if(elem.length) {
         //         $(this).text(elem[0].text).css("color", colors[value]);
         //     } else {
         //         $(this).empty();
         //     }
         // },
         type: 'text',
         ajaxOptions: {
            type: 'get',
            dataType: 'json'
         },
         url:'/admin/topic/auditing/update?&act=cate',
         params:function(params){
            params.cid=params.value;
            params.id=params.pk;
            delete params.value;
            delete params.pk;
            delete params.name;
            return params;
         },
         success: function(response, newValue) {
            toastr.success('提交成功');
         },
         error: function(response, newValue) {
            toastr.error('提交失败');
         }
      });
   }

});
</script>
@stop
