@extends('admin.layouts.base')
@section('title', '施工中')
@section('panel-title', '用户禁言')
@section('sidebar')
@section('content')
    <div class="content animate-panel" data-effect="fadeInUp">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel">
                    <div class="panel-body">
                        <div class="input-group col-md-6">
                            <input type="text" class="form-control" placeholder="输入用户名或手机号码">
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
                        <table class="table table-striped table-bordered table-hover text-center">
                            @if (count($lock_users)==0)
                                <span>暂无数据</span>
                            @else
                                <thead>
                                    <tr>
                                        <th class="text-center">用户名</th>
                                        <th class="text-center">原因</th>
                                        <th class="text-center">禁言时间</th>
                                        <th class="text-center">禁言周期</th>
                                        <th class="text-center">操作人</th>
                                        <th class="text-center">操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lock_users as $user)
                                        <tr>
                                            <td>{{ $user->username }}</td>
                                            <td>{{ $user->banLogs[0]['description'] }}</td>
                                            <td title="{{ $user->banLogs[0]['created_at'] }}">{{ $user->banLogs[0]['created_at']->diffForHumans() }}</td>
                                            <td class="text-danger">{{ $user->banLogs[0]['time']/86400 }}天</td>
                                            <td>{{ $user->banLogs[0]['admin_uid'] }}</td>
                                            <td>
                                                <a herf="#" class="btn btn-danger btn-xs js-del" data-id="{{$user->uid}}">解禁</a>
                                                <a herf="#" class="btn btn-success btn-xs">查看信息</a>
                                                <a herf="#" class="btn btn-success btn-xs">查看评论</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            @endif
                        </table>
                        {!! $lock_users->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('page-js')
<script>
    Do('editable','toastr',function(){
        $('.js-del').confirmation({
            title:'确定解禁该用户么？',
            btnOkLabel:'确定',
            btnCancelLabel:'取消',
            placement:'left',
            onConfirm:function(e,o){
                //alert($(o).data('id'));
                var id=$(o).data('id');
                $.ajax({
                    url:'{{ action("Admin\User\UserController@getUnLockUser") }}',
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
    });
</script>
@stop