@extends('admin.layouts.base')
@section('title', '施工中')
@section('panel-title', '用户推荐')
@section('sidebar')
@section('content')
    <div class="content animate-panel" data-effect="fadeInUp">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel">
                    <div class="panel-body">
                        <div class="input-group col-md-6 pull-left">
                            <input type="text" class="form-control" placeholder="输入用户名或手机号码">
                            <span class="input-group-btn"><button type="button" class="btn btn-success">搜索</button></span>
                        </div>
                        <div class="btn-group pull-right">
                            <button class="btn btn-success" data-toggle="modal" data-target="#addModal">添加</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel">
                    <div class="panel-body">
                        <table class="table table-striped table-bordered table-hover text-center">
                            @if (count($recommend_users)==0)
                                <span>暂无数据</span>
                            @else
                                <thead>
                                    <tr>
                                        <th class="text-center">用户名</th>
                                        <th class="text-center">称号</th>
                                        <th class="text-center">排名</th>
                                        <th class="text-center">推荐时间</th>
                                        <th class="text-center">操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recommend_users as $user)
                                        <tr>
                                            <td>{{ $user->uid }}</td>
                                            <td>{{ $user->type }}</td>
                                            <td>{{ $user->sort }}</td>
                                            <td title="{{ $user->created_at }}">{{ $user->created_at->diffForHumans() }}</td>
                                            <td>
                                                <button class="btn btn-warning btn-xs js-del" data-id="{{$user->id}}">取消推荐</button>
                                                <a herf="#" class="btn btn-success btn-xs">查看信息</a>
                                                <a herf="#" class="btn btn-success btn-xs">查看评论</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            @endif
                        </table>
                        {!! $recommend_users->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 模态框（Modal） 白名单-->
    <div class="modal fade hmodal-info" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
       <div class="modal-dialog">
            <form class="modal-content form-horizontal html5Form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">添加推荐</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">用户名</label>
                        <div class="col-sm-10"><input type="text" required class="form-control" placeholder="用户名" name="username"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">推荐类型</label>
                        <div class="col-sm-10">
                            <select name="type" id="" class="form-control">
                                <option value="1">美食达人</option>
                                <option value="2">随便</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">推荐排名</label>
                        <div class="col-sm-10"><input type="num" required class="form-control"  name="sort"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-info js-submit">提交更改</button>
                </div>
            </form><!-- /.modal-content -->
        </div><!-- /.modal -->
    </div>
@stop

@section('page-js')
<script>
    Do('editable','toastr',function(){
        //添加推荐
        $('#addModal form').on('submit',function(){
            var $this=$(this);
            $.ajax({
                url:'{{ action("Admin\User\UserController@getRecommendUser") }}',
                type:'get',
                dataType:'json',
                data:$this.serializeArray(),
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
            })
            return false;
        })

        $('.js-del').confirmation({
            title:'确定取消该用户该推荐么？',
            btnOkLabel:'确定',
            btnCancelLabel:'取消',
            placement:'left',
            onConfirm:function(e,o){
                //alert($(o).data('id'));
                var id=$(o).data('id');
                $.ajax({
                    url:'{{ action("Admin\User\UserController@getUnRecommendUser") }}',
                    type:'get',
                    dataType:'json',
                    data:{
                        id:id
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
    });
</script>
@stop
