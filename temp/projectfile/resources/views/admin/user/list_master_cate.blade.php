@extends('admin.layouts.base')
@section('title', '施工中')
@section('panel-title', '达人管理')
@section('sidebar')
@section('content')
    <div class="content">
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
                <div class="panel xpanel">
                   <ul class="nav nav-tabs">
                      <li class=""><a href="list_master">达人列表</a></li>
                      <li class="active"><a href="list_master_cate">达人分类</a></li>
                   </ul>

                    <div class="panel-body">
                        <div class="btn-group">
                            <a href="#" class="btn btn-info">全部</a>
                        </div>
                        <div class="btn-group pull-right">
                            <a href="#" class="btn btn-success" data-toggle="modal" data-target="#addModal" >添加</a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped table-bordered table-hover text-center table-vam">
                            <thead>
                                <tr>
                                    <th class="text-center">名称</th>
                                    <th class="text-center">描述</th>
                                    <th class="text-center">条件</th>
                                    <th class="text-center">图标</th>
                                    <th class="text-center">操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>美食达人</td>
                                    <td>美食专家，发好多号多美食，能吃很多很多</td>
                                    <td>一顿吃5桶饭</td>
                                    <td><img src="http://temp.im/30x30" alt=""></td>
                                    <td>
                                        <a herf="#" class="btn btn-warning btn-xs">编辑</a>
                                        <a herf="#" class="btn btn-danger btn-xs">删除</a>
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
                    <h4 class="modal-title">创建新的达人分类</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">达人名称</label>
                        <div class="col-sm-10">
                            <input type="text" required class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">描述</label>
                        <div class="col-sm-10">
                            <input type="text" required class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">达成条件</label>
                        <div class="col-sm-10">
                            <input type="text" required class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">所属分类</label>
                        <div class="col-sm-10">
                            <select name="" id="" class="form-control">
                                <option value="">大类</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">达人图标</label>
                        <div class="col-sm-10 uploader-container">
                            <div id="picker">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="submit" class="btn btn-info js-submit">提交更改</button>
                </div>
          </form><!-- /.modal-content -->
    </div><!-- /.modal -->
@stop
@section('page-js')
<script>
    Do('xz_uploader',function(){
       var uploader = xz_uploader.init({
          selector:'#picker',
          thumb_width: 300,
          thumb_height: 150
       });
    });
</script>
@stop
