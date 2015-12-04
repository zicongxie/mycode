@extends('admin.layouts.base')
@section('title', '广告管理')
@section('panel-title', '添加（编辑）广告')
@section('sidebar')
@section('content')
    <div class="content" >
        <div class="row">
            <div class="col-lg-12">
                <div class="hpanel">
                    <div class="panel-body">
                       <form class="form-horizontal" method="post">

                          <div class="form-group">
                             <label class="col-sm-2 control-label">图片</label>
                             <div class="col-sm-10 uploader-container">
                                <div id="picker">
                                </div>
                             </div>
                          </div>

                          <div class="hr-line-dashed"></div>

                          <div class="form-group">
                             <label class="col-sm-2 control-label">标题</label>
                             <div class="col-sm-10"><input type="text" class="form-control" name="title"></div>
                          </div>

                          <div class="hr-line-dashed"></div>

                          <div class="form-group">
                             <label class="col-sm-2 control-label">描述</label>
                             <div class="col-sm-10"><input type="text" class="form-control" name="description"></div>
                          </div>

                          <div class="hr-line-dashed"></div>

                          <div class="form-group">
                             <label class="col-sm-2 control-label" name="push_cid">推送类别</label>
                             <div class="col-sm-10">
                                <select class="form-control" name="">
                                    <option value="1">运动</option>
                                    <option value="3">音乐</option>
                                    <option value="4">美食</option>
                                </select>
                             </div>
                          </div>

                          <div class="hr-line-dashed"></div>

                          <div class="form-group">
                             <label class="col-sm-2 control-label" name="type">类型</label>
                             <div class="col-sm-10">
                                <select class="form-control" name="">
                                    <option value="1">外链</option>
                                    <option value="2">话题</option>
                                    <option value="3">活动</option>
                                    <option value="4">内容</option>
                                </select>
                             </div>
                          </div>

                          <div class="hr-line-dashed"></div>

                          <div class="form-group">
                             <label class="col-sm-2 control-label">数据</label>
                             <div class="col-sm-10">
                                <input type="text" class="form-control">
                                <span class="help-block m-b-none">外链填写外链地址，话题填写话题id，内容填写内容ID，活动填写活动id</span>
                             </div>
                          </div>

                          <div class="hr-line-dashed"></div>
                          <div class="form-group">
                              <label class="col-sm-2 control-label">到期时间</label>
                              <div class=" col-sm-10">
                                  <div class="input-group date">
                                      <input type="text" name='start_at' required class="form-control"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                                  </div>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 control-label">到期时间</label>
                              <div class=" col-sm-10">
                                  <div class="input-group date">
                                      <input type="text" name='end_at' required class="form-control"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                                  </div>
                              </div>
                          </div>
                          <div class="form-group">
                             <label class="col-sm-2 control-label">出现位置</label>
                             <div class="col-sm-10">
                                <input type="text" class="form-control" name="sort">
                             </div>
                          </div>

                          <div class="form-group">
                             <div class="col-sm-8 col-sm-offset-2">
                                <button class="btn btn-default" type="button">取消</button>
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

@section('page-js')

<script>
    $('.input-group.date').datepicker({
        format: 'yyyy-mm-dd',
        todayHighlight:true,
        language:'zh-CN'
    });
</script>

<script>
    Do('xz_uploader', function(){
      var uploader = xz_uploader.init({
         selector:'#picker',
         thumb_width: 300,
         thumb_height: 150
      });
   });
</script>
@stop
