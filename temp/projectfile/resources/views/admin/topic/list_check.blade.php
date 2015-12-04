@extends('admin.layouts.base')
@section('title', '施工中')
@section('panel-title', '话题审核')
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
                            <span>话题审核</span>
                        </li>
                    </ol>
                </div>
                <h2 class="font-light m-b-xs">
                    话题审核
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
                        <div class="btn-group">
                            <a href="#" class="btn btn-info">全部</a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped table-bordered table-hover text-center">
                            <thead>
                                <tr>
                                    <th class="text-center">话题名称</th>
                                    <th class="text-center">描述</th>
                                    <th class="text-center">封面</th>
                                    <th class="text-center">分类</th>
                                    <th class="text-center">创建人</th>
                                    <th class="text-center">创建时间</th>
                                    <th class="text-center">操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($list as $info)
                                    <tr>
                                        <td>
                                            <span>{{$info->title}}</span>
                                        </td>
                                        <td>{{$info->description}}</td>
                                        <td><img width="100" height="100" src="{{$info->cover_img}}" alt="{{$info->title}}"></td>
                                        <!-- <td>{{isset($info->cate->title) ? $info->cate->title : '-'}}</td> -->
                                        <td><a href="#" data-type="select" data-pk="{{$info->id}}" data-value="{{$info->cid}}" data-title="选择分类" class="editable editable-click js-cate" style="color: gray;">{{isset($info->cate->title) ? $info->cate->title : '-'}}</a></td>
                                        <td>{{isset($info->user->username) ? $info->user->username : '-'}}</td>
                                        <td>{{$info->created_at}}</td>
                                        <td>
                                            <a data-id="{{$info->id}}" class="btn btn-{{$info->is_checked ? 'success' : 'default'}} btn-xs js-check">{{$info->is_checked ? '已通过' : '未通过'}}</a>
                                            <a data-id="{{$info->id}}" class="btn btn-{{$info->is_recommend ? 'warning' : 'default'}} btn-xs js-recommend">{{$info->is_recommend ? '已推荐' : '未推荐'}}</a>
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
    $('body').on('click','.js-check',function(){
        var $this=$(this);
        $.ajax({
            url:"/admin/topic/auditing/update?id="+$this.data('id')+"&act=check",
            type:"get",
            dataType:"json",
            success:function(data){
                if(data.result=="100"){
                    $this.toggleText('已通过','未通过').toggleClass('btn-default').toggleClass('btn-success');
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
            url:"/admin/topic/auditing/update?id="+$this.data('id')+"&act=recommend",
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
        source: source,
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
            if(response.result==100){
                toastr.success('提交成功');
            }else{
                toastr.error('提交失败');
            }
        },
        error: function(response, newValue) {
             toastr.error('提交失败');
        }
    });
}

});
</script>
@stop
