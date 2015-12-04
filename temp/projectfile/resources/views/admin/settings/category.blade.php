@extends('admin.layouts.base')
@section('panel-title', '全局设置')
@section('sidebar')
@section('content')
        <div class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel">
                        <div class="panel-body">
                            <div class="btn-group pull-right">
                                <button class="btn btn-success" data-toggle="modal" data-target="#addModal">添加</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hpanel">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="true"><strong>大类设置</strong></a></li>
                </ul>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane active">
                        <div class="panel-body">
                            <table class="table table-striped table-bordered table-hover text-center table-vam">
                                @if (count($categories)==0)
                                <span>暂无数据</span>
                                @else
                                    <thead>
                                        <tr>
                                            <th class="text-center">类别名称</th>
                                            <th class="text-center">上级分类</th>
                                            <th class="text-center">描述</th>
                                            <th class="text-center">图片</th>
                                            <th class="text-center">操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr>
                                                <td>{{ $category->title }}</td>
                                                <td>{{ $category->parent_id }}</td>
                                                <td>{{ $category->description }}</td>
                                                <td><img alt="" class="img-circle" src="{{ $category->cpver_img }}"></td>
                                                <td>
                                                    <a href="javascript:;" data-toggle="modal" data-target="#editModal" class="btn btn-info btn-xs js-edit" data-id="{{ $category->id }}" data-title="{{ $category->title }}" data-parent="{{ $category->parent_id }}" data-desc="{{ $category->description }}">编辑</a>
                                                    <a href="javascript:;" class="btn btn-danger btn-xs toDel js-del" data-id="{{ $category->id }}">删除</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                @endif
                            </table>
                            {!! $categories->render() !!}
                        </div>
                    </div>
                </div>

        </div>

    <!-- 模态框（Modal） 添加-->
    <div class="modal fade hmodal-info" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
       <div class="modal-dialog">
            <form class="modal-content form-horizontal" action="{{ url('admin/user/lock') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">添加分类</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">类别名称</label>
                        <div class="col-sm-10"><input type="text" required class="form-control m-b" placeholder="类别名称" name="title"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">上级分类</label>
                        <div class="col-sm-10">
                            <select name="parent_id" class="form-control">
                                <option value="">无</option>
                                <option value="1">嘿嘿</option>
                                <option value="3">testnew</option>
                                <option value="4">test</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">描述</label>
                        <div class="col-sm-10">
                            <textarea class="p-xs" required placeholder="描述" style="width:100%;height:100px" name="description"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="submit" class="btn btn-info">提交更改</button>
                </div>
            </form><!-- /.modal-content -->
        </div><!-- /.modal -->
    </div>

    <!-- 模态框（Modal） 编辑-->
    <div class="modal fade hmodal-info" id="editModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
       <div class="modal-dialog">
            <form class="modal-content form-horizontal" action="{{ url('admin/user/lock') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">编辑分类</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">类别名称</label>
                        <div class="col-sm-10"><input type="text" required class="form-control m-b" placeholder="类别名称" name="title"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">上级分类</label>
                        <div class="col-sm-10">
                            <select name="parent_id" class="form-control">
                                <option value="">无</option>
                                <option value="1">嘿嘿</option>
                                <option value="3">testnew</option>
                                <option value="4">test</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">描述</label>
                        <div class="col-sm-10">
                            <textarea class="p-xs" required placeholder="描述" style="width:100%;height:100px" name="description"></textarea>
                        </div>
                    </div>
                    <input type="hidden" name="id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="submit" class="btn btn-info">提交更改</button>
                </div>
            </form><!-- /.modal-content -->
        </div><!-- /.modal -->
    </div>
@stop
@section('page-js')
<script>
    Do('toastr','xz_uploader',function(){
        //删除分类
        $('.js-del').confirmation({
            title:'确定删除该类别么？',
            btnOkLabel:'确定',
            btnCancelLabel:'取消',
            placement:'left',
            onConfirm:function(e,o){
                var id=$(o).data('id');
                $.ajax({
                    url:'{{ action("Admin\Systemsetting\SystemsettingController@getDeleteCategory") }}',
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
        });

        //添加分类
        $('#addModal form').on('submit',function(){
            var $this=$(this);
            $.ajax({
                url:'{{ action("Admin\Systemsetting\SystemsettingController@getAddCategory") }}',
                type:'get',
                dataType:'json',
                data:$this.serialize(),
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
        });

        $('body').on('click','.js-edit',function(){
             $('#editModal input[name=id]').val($(this).data('id'));
             $('#editModal textarea[name=description]').val($(this).data('desc'));
             $('#editModal input[name=title]').val($(this).data('title'));
        })
        //编辑分类
        $('#editModal form').on('submit',function(){
            var $this=$(this);
            $.ajax({
                url:'{{ action("Admin\Systemsetting\SystemsettingController@getEditCategory") }}',
                type:'get',
                dataType:'json',
                data:$this.serialize(),
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
    })
</script>
@stop
