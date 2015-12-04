@extends('admin.layouts.base')
@section('title', '')
@section('panel-title', '开机广告列表')
@section('sidebar')
@section('content')
    <div class="content" >
        <div class="row">
            <div class="col-lg-12">
                <div class="panel">
                    <div class="panel-body">
                       <form class="" method="post">
                           <div class="input-group col-md-6 pull-left">
                               <input type="text" class="form-control" placeholder="输入关键词">
                               <span class="input-group-btn"><button type="button" class="btn btn-success">搜索</button></span>
                           </div>
                           <div class="input-group pull-right">
                               <a href="edit_ad" class="btn btn-success">添加广告</a>
                           </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel">
                    <div class="panel-body">
                        <table class="table table-striped table-bordered table-hover text-center table-vam">
                            <thead>
                                <tr>
                                    <th class="text-center">标题</th>
                                    <th class="text-center">描述</th>
                                    <th class="text-center">推送类别</th>
                                    <th class="text-center">类型</th>
                                    <th class="text-center">出现位置</th>
                                    <th class="text-center">到期时间</th>
                                    <th class="text-center">额外数据</th>
                                    <th class="text-center">PV</th>
                                    <th class="text-center">操作</th>
                                </tr>
                            </thead>
                            <tbody>
                               <tr>
                                  <td> 1 </td>
                                  <td> 开机画面 </td>
                                  <td>  </td>
                                  <td> 1 </td>
                                  <td></td>
                                  <td> 2015-12-12 </td>
                                  <td></td>
                                  <td></td>
                                  <td>
                                     <a href="edit_ad" class="btn btn-info btn-xs">编辑</a>
                                     <a href="javascript:;" class="btn btn-danger btn-xs js-del">删除</a>
                                  </td>
                               </tr>
                            </tbody>
                        </table>
                        <ul class="pagination">
                            <li class="paginate_button previous disabled">
                                <a href="#">上一页</a>
                            </li>
                            <li class="paginate_button active">
                                <a href="#">1</a>
                            </li>
                            <li class="paginate_button">
                                <a href="#">2</a>
                            </li>
                            <li class="paginate_button">
                                <a href="#">3</a>
                            </li>
                            <li class="paginate_button">
                                <a href="#">4</a>
                            </li>
                            <li class="paginate_button">
                                <a href="#">5</a>
                            </li>
                            <li class="paginate_button next">
                                <a href="#">下一页</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('page-js')
<script>
  Do('toastr',function(){
    //删除用户
    $('.js-del').confirmation({
        title:'确定删除这条广告么？',
        btnOkLabel:'确定',
        btnCancelLabel:'取消',
        placement:'left',
        onConfirm:function(e,o){
            var id=$(o).data('id');
            $.ajax({
                url:'{{-- action("Admin\User\UserController@getDelete") --}}',
                type:'get',
                dataType:'json',
                data:{
                    uid:id
                },
                success:function(data){
                    if(data.result==100){
                        toastr.success(data.text);
                        window.location.reload();
                    }else{
                        toastr.error(data.text);
                    }
                },
                error:function(data){
                     toastr.error('未知错误，稍后重试');
                }
            });
        }
    })
    
  })
</script>
@stop