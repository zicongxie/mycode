@extends('admin.layouts.base')
@section('panel-title', '全局设置')
@section('sidebar')
@section('content')
        <div class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="hpanel">
<!--                         <div class="panel-heading">
                            全局配置
                        </div> -->
                        <div class="panel-body">
                            <form class="form-horizontal" method="post">


                                <div class="form-group">
                                    <label class="col-sm-2 control-label">话题推荐阀值</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="">
                                            <option value="1">选择区域</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                      <p class="form-control-static"></p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">话题推荐阀值</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="col-sm-2">
                                      <p class="form-control-static">发布数</p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">信息热度阀值</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="col-sm-2">
                                      <p class="form-control-static">点赞数</p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">热度时间</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="col-sm-2">
                                      <p class="form-control-static">小时</p>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">话题审核</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="col-sm-2">
                                      <p class="form-control-static">0先发后审，1先审后发</p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">内容审核</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="col-sm-2">
                                      <p class="form-control-static">0先发后审，1先审后发</p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-8 col-sm-offset-2">
                                        <button class="btn btn-primary" type="submit">提交</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@stop
