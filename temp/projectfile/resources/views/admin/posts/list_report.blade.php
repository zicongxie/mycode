@extends('admin.layouts.base')
@section('title', '内容举报')
@section('panel-title', '内容举报')
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
                        <table class="table table-striped table-bordered table-hover text-center table-vam">
                            <thead>
                                <tr>
                                    <th class="text-center">标题</th>
                                    <th class="text-center">举报人</th>
                                    <th class="text-center">时间</th>
                                    <th class="text-center">操作</th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php $FAKE_API = 'http://192.168.0.97:3000/foobar'; ?>
                               <tr>
                                  <td> 双十一特价 </td>
                                  <td> Modafinil </td>
                                  <td> 17小时前 </td>
                                  <td>
                                     <a href="javascript:;" data-toggle="ajax_update" data-href="{{ $FAKE_API }}" data-status="1" data-text="已审核,未审核" data-classes="btn-success btn-warning" class="btn btn-success btn-xs">已审核</a>
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
