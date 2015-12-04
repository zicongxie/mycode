@extends('admin.layouts.base')
@section('title', '施工中')
@section('panel-title', '用户列表')
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
                        <table class="table table-striped table-bordered table-hover text-center table-vam">
                            @if (count($users)==0)
                                <span>暂无数据</span>
                            @else
                                <thead>
                                    <tr>
                                        <th class="text-center">UID</th>
                                        <th class="text-center">用户名</th>
                                        <th class="text-center">昵称</th>
                                        <th class="text-center">头像</th>
                                        <th class="text-center">注册时间</th>
                                        <th class="text-center">状态</th>
                                        <th class="text-center">关注大类</th>
                                        <th class="text-center">积分</th>
                                        <th class="text-center">个性签名</th>
                                        <th class="text-center">身份</th>
                                        <th class="text-center">操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->uid }}</td>
                                            <td>{{ $user->username }}</td>
                                            <td>{{ $user->nickname }}</td>
                                            <td><img class="img-circle" width="50" height="50" src="{{ $user->avatar }}" alt=""></td>
                                            <td title="{{ $user->reg_time }}">{{ $user->reg_time->diffForHumans() }}</td>
                                            @if ($user->is_lock == 1)
                                                <td class="text-danger">禁言</td>
                                            @elseif ($user->is_lock == -1)
                                                <td class="text-danger">永久禁言</td>
                                            @else
                                                <td class="text-success">普通用户</td>
                                            @endif
                                            <td>运动，生活，美食</td>
                                            <td>10000</td>
                                            <td>生活如此多娇</td>
                                            <td>逗比达人</td>
                                            <td class="text-left">
                                                <button class="btn btn-default btn-xs m-t-xs" data-toggle="modal" data-target="#editModal" data-id="{{ $user->uid }}">编辑</button>
                                                <button class="btn btn-default btn-xs m-t-xs js-reset-pass" data-id="{{ $user->uid }}">重置密码</button>
                                                <button class="btn btn-warning btn-xs m-t-xs js-ban" data-toggle="modal" data-target="#banModal" data-id="{{ $user->uid }}">禁言</button>
                                                <button class="btn btn-danger btn-xs m-t-xs js-del" data-id="{{ $user->uid }}">删除</button>
                                                <button class="btn btn-success btn-xs m-t-xs js-white" data-toggle="modal" data-target="#whiteModal" data-username="{{ $user->username }}">设为白名单</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            @endif
                        </table>
                        {!! $users->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 模态框（Modal）禁言 -->
    <div class="modal fade hmodal-info" id="banModal" tabindex="-1" role="dialog" aria-labelledby="banModalLabel" aria-hidden="true">
       <div class="modal-dialog">
            <form class="modal-content" action="{{ url('users/lock') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="banModalLabel">禁言</h4>
                </div>
                <div class="modal-body">
                    <input type="number" class="form-control m-b" placeholder="禁言时间（天）" name="time">
                    <textarea class="p-xs" placeholder="禁言原因" style="width:100%;height:100px" name="description"></textarea>
                    <input type="hidden" name="uid">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="submit" class="btn btn-info">提交更改</button>
                </div>
            </form>
        </div><!-- /.modal -->
    </div>

    <!-- 模态框（Modal）edit -->
    <div class="modal fade hmodal-info" id="editModal" tabindex="-1" role="dialog" aria-labelledby="banModalLabel" aria-hidden="true">
       <div class="modal-dialog">
            <form class="modal-content form-horizontal html5Form" action="{{ url('users/lock') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">编辑</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">用户状态</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="account">
                                <option>普通用户</option>
                                <option>推荐用户</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">积分</label>
                        <div class="col-sm-10">
                        <input type="num" class="form-control" required placeholder="积分" name="time">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">个性签名</label>
                        <div class="col-sm-10">
                            <textarea class="p-xs" placeholder="个性签名" required style="width:100%;height:100px" name="description"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">头像</label>
                        <div class="col-sm-10 uploader-container">
                            <div id="picker">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="uid">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-info js-submit">提交更改</button>
                </div>
            </form><!-- /.modal-content -->
        </div><!-- /.modal -->
    </div>

    <!-- 模态框（Modal） 白名单-->
    <div class="modal fade hmodal-info" id="whiteModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
       <div class="modal-dialog">
            <form class="modal-content form-horizontal html5Form" action="{{ url('admin/user/lock') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">添加白名单</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">用户名</label>
                        <div class="col-sm-10"><input type="text" required readonly class="form-control m-b" placeholder="用户名" name="username"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">添加原因</label>
                        <div class="col-sm-10">
                            <textarea class="p-xs" required placeholder="添加原因" style="width:100%;height:100px" name="description"></textarea>
                        </div>
                    </div>
                    <input type="hidden" name="id">
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
    Do('editable','toastr','xz_uploader',function(){
        var uploader = xz_uploader.init({
            selector:'#picker',
            thumb_width: 300,
            thumb_height: 150
        });

        //禁言
        $('body').on('click','.js-ban',function(){
            var id=$(this).data('id');
            $('#banModal input[name="uid"]').val(id);
        })
        $('#banModal form').on('submit',function(){
            var $this=$(this);
            $.ajax({
                url:'{{ action("Admin\User\UserController@getLockUser") }}',
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



        //重置密码
        $('.js-reset-pass').confirmation({
            title:'确定要重置密码么？',
            btnOkLabel:'确定',
            btnCancelLabel:'取消',
            placement:'left',
            onConfirm:function(e,o){
                var id=$(o).data('id');
                $.ajax({
                    url:'{{ action("Admin\User\UserController@getResetPassword") }}',
                    type:'get',
                    dataType:'json',
                    data:{
                        uid:id
                    },
                    success:function(data){
                        if(data.result==100){
                            toastr.success(data.text);
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

        //删除用户
        $('.js-del').confirmation({
            title:'删除相当于永久禁言，确定删除该用户么？',
            btnOkLabel:'确定',
            btnCancelLabel:'取消',
            placement:'left',
            onConfirm:function(e,o){
                var id=$(o).data('id');
                $.ajax({
                    url:'{{ action("Admin\User\UserController@getDelete") }}',
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

        $(document).on('click','.js-white',function(){
            //$('#whiteModal input[name=id]').val($(this).data('id'));
            $('#whiteModal input[name=username]').val($(this).data('username'));
        })
         //添加白名单
        $('#whiteModal form').on('submit',function(){
            var $this=$(this);
            $.ajax({
                url:'{{ action("Admin\User\UserController@postWhiteUser") }}',
                type:'post',
                dataType:'json',
                data:$this.serializeArray(),
                success:function(data){
                    if(data.code==100){
                        toastr.success(data.text);
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
    });
</script>
@stop
