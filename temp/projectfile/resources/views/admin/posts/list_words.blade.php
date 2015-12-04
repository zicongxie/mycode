@extends('admin.layouts.base')
@section('title', '内容管理')
@section('panel-title', '敏感词管理')
@section('sidebar')
@section('content')
    <div class="content" >
        <div class="row">
            <div class="col-lg-12">
                <div class="panel">
                    <div class="panel-body">
                        <div class="input-group col-md-6">
                            <input type="text" class="form-control" placeholder="输入关键词">
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
                       <div class="">
                            <button class="btn btn-success" data-toggle="modal" data-target="#addModal">
                               <i class="fa fa-plus-square-o"></i>
                               <span class="bold"> 添加敏感词 </span>
                            </button>
                            <a href="#" class="btn btn-info">
                               <i class="fa fa-refresh"></i>
                               <span class="bold"> 更新缓存 </span>
                            </a>
                        </div>
                   </div>
                    <div class="panel-body">
                        <table class="table table-striped table-bordered table-hover text-center table-vam">
                            <thead>
                                <tr>
                                    <th class="text-center">关键词</th>
                                    <th class="text-center">分类</th>
                                    <th class="text-center">操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($infos)
                                    @foreach($infos as $info)
                                        <tr>
                                            <td> {{$info->words}} </td>
                                            <td> {{$info->type == 1 ? '禁发' : '替换'}} </td>
                                            <td>
                                                <button class="btn btn-info btn-xs js-edit" data-toggle="modal" data-target="#editModal" data-id="{{ $info->id }}" data-type="{{ $info->type }}" data-keyword="{{ $info->words }}">编辑</button>
                                                <a href="javascript:;" class="btn btn-danger btn-xs js-del" data-id="{{$info->id}}">删除</a>
                                            </td>
                                       </tr>
                                    @endforeach
                                @else
                                    <tr><td colspan="3">抱歉，暂无数据</td></tr>
                                @endif
                            </tbody>
                        </table>
                        <?php echo $infos->render();?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 模态框（Modal）edit -->
    <div class="modal fade hmodal-info" id="editModal" tabindex="-1" role="dialog" aria-labelledby="banModalLabel" aria-hidden="true">
       <div class="modal-dialog">
            <form class="modal-content form-horizontal">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">编辑</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">关键词</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control m-b js-keyword" required placeholder="输入关键词" name="words">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">分类</label>
                        <div class="col-sm-10">
                            <select class="form-control m-b type-select" name="type">
                                <option value="1">禁发</option>
                                <option value="2">替换</option>
                            </select>
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
    <!-- 模态框（Modal）add -->
    <div class="modal fade hmodal-info" id="addModal" tabindex="-1" role="dialog" aria-labelledby="banModalLabel" aria-hidden="true">
       <div class="modal-dialog">
            <form class="modal-content form-horizontal">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">添加敏感词</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">关键词</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control m-b js-keyword" required placeholder="输入关键词" name="words">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">分类</label>
                        <div class="col-sm-10">
                            <select class="form-control m-b type-select" name="type">
                                <option value="1">禁发</option>
                                <option value="2">替换</option>
                            </select>
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
@stop
@section('page-js')
<script>
    Do('toastr',function(){
        $('.js-del').confirmation({
            title:'确定删除该敏感词么？',
            btnOkLabel:'确定',
            btnCancelLabel:'取消',
            placement:'left',
            onConfirm:function(e,o){
                //alert($(o).data('id'));
                var id=$(o).data('id');
                $.ajax({
                    url:'/admin/posts/sensitive/update',
                    type:'get',
                    dataType:'json',
                    data:{
                        id:id,
                        act:'del'
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
        
        $(document).on('click','.js-edit',function(){
            $('#editModal').find('.js-keyword').val($(this).data('keyword'));
            $('#editModal').find('input[name=id]').val($(this).data('id'));
            var $ops=$('#editModal').find('.type-select option');
            for(var i=0;i<$ops.length;i++){
                $ops[i].selected=false;
                if(i+1==$(this).data('type')){
                    $ops[i].selected=true;
                }
            }
        })

        $('#editModal form').on('submit',function(){
            var $this=$(this);
            var data=$this.serialize();
            console.log(data);
            $.ajax({
                url:'/admin/posts/sensitive/save',
                type:'get',
                dataType:'json',
                data:data,
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
            return false;
        })

        $('#addModal form').on('submit',function(){
            var $this=$(this);
            var data=$this.serialize();
            console.log(data);
            $.ajax({
                url:'/admin/posts/sensitive/save',
                type:'get',
                dataType:'json',
                data:data,
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
            return false;
        })


    });
</script>
@stop