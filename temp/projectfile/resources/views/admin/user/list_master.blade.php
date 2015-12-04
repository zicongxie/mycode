@extends('admin.layouts.base')
@section('title', '施工中')
@section('panel-title', '达人管理')
@section('sidebar')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel ">
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
                <div class="panel xpanel">
                   <ul class="nav nav-tabs">
                      <li class="active"><a href="list_master">达人列表</a></li>
                      <li class=""><a href="list_master_cate">达人分类</a></li>
                   </ul>

                    <div class="panel-body">
                        <div class="btn-group">
                            <a href="#" class="btn btn-info">全部</a>
                            <a href="#" class="btn btn-default">申请</a>
                        </div>
                        <div class="btn-group pull-right">
                            <a href="#" class="btn btn-success" data-toggle="modal" data-target="#addModal" >添加</a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped table-bordered table-hover text-center table-vam">
                            <thead>
                                <tr>
                                    <th class="text-center">用户名</th>
                                    <th class="text-center">称号</th>
                                    <th class="text-center">时间</th>
                                    <th class="text-center">操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>solo</td>
                                    <td>美食达人</td>
                                    <td>2015-10-10 至 2016-10-10</td>
                                    <td>
                                        <a herf="#" class="btn btn-danger btn-xs">删除</a>
                                        <a herf="#" class="btn btn-success btn-xs">查看信息</a>
                                        <a herf="#" class="btn btn-success btn-xs">查看评论</a>
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
    <!-- 模态框（Modal） -->
    <div class="modal fade hmodal-info" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       <div class="modal-dialog">
            <form class="modal-content form-horizontal html5Form" action="">
                <div class="color-line"></div>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">添加达人用户</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">用户名</label>
                        <div class="col-sm-10">
                            <input type="text" required class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">达人分类</label>
                        <div class="col-sm-10">
                            <select name="" id="" class="form-control">
                                <option value="">美食达人</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">到期时间</label>
                        <div class=" col-sm-10">
                            <div class="input-group date">
                                <input type="text" required readonly style="cursor:pointer" class="form-control"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-info js-submit">提交更改</button>
                </div>
          </form><!-- /.modal-content -->
    </div><!-- /.modal -->
@stop
@section('page-js')
<script>
    $('.input-group.date').datepicker({
        format: 'yyyy-mm-dd',
        todayHighlight:true,
        language:'zh-CN'
    });
</script>
@stop


