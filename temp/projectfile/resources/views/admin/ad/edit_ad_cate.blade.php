@extends('admin.layouts.base')
@section('title', '广告管理')
@section('panel-title', '添加（编辑）广告位')
@section('sidebar')
@section('content')
    <div class="content" >
        <div class="row">
            <div class="col-lg-12">
                <div class="hpanel">
                    <div class="panel-body">
                       <form class="form-horizontal" method="post">
                          <div class="form-group">
                             <label class="col-sm-2 control-label">广告位标志</label>
                             <div class="col-sm-10"><input type="text" required class="form-control" name=""></div>
                          </div>

                          <div class="form-group">
                             <label class="col-sm-2 control-label">广告位名</label>
                             <div class="col-sm-10"><input type="text" required class="form-control" name=""></div>
                          </div>

                          <div class="form-group">
                             <label class="col-sm-2 control-label">最大允许广告数</label>
                             <div class="col-sm-10"><input type="number" required class="form-control" name=""></div>
                          </div>

                          <div class="hr-line-dashed"></div>
                          <div class="form-group">
                             <label class="col-sm-2 control-label">自定义数据</label>
                             <div class="col-sm-10"><button type="button" id="add-data" class="btn btn-sm btn-success">添加</button></div>
                          </div>
                          <table class="table table-striped table-bordered table-hover table-vam">
                            <thead>
                              <tr>
                                <th class="col-sm-2">字段名</th>
                                <th class="col-sm-2">类型</th>
                                <th class="col-sm-3">说明</th>
                                <th class="col-sm-3">默认值</th>
                                <th class="col-sm-1">操作</th>
                              </tr>
                            </thead>
                            <tbody>
                              <!-- <tr class="no-data">
                                <td colspan="5" class="text-center">暂无数据</td>
                              </tr> -->
                              <tr>
                                <td><input name="name[]" type="text" class="form-control"></td>
                                <td>
                                    <select name="type[]"  class="form-control">
                                      <option value="0">文本框</option>
                                      <option value="1">文本域</option>
                                      <option value="2">单选框</option>
                                      <option value="3">复选框</option>
                                      <option value="4">下拉框</option>
                                    </select>
                                </td>
                                <td><input name="label[]" type="text" class="form-control"></td>
                                <td><input name="value[]" type="text" class="form-control"></td>
                                <td><button type="button" class="btn btn-warning js-del">删除</button></td>
                              </tr>
                            </tbody>
                            <tfoot>
                              <tr>
                                <td colspan="5">操作帮助：选择下拉框、单选框、复选框时，选项名填写至默认值，如有多组选项，填写时用“ | ”隔开。如：“男|女”</td>
                              </tr>
                            </tfoot>
                          </table>
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

  //添加自定义数据
  $('#add-data').on('click',function(){
    var $tbody=$('.table tbody');
    if($tbody.find('tr').eq(0).hasClass('no-data')){
      $tbody.html('');
    }
    var html=''
      +'<tr>'
      +'  <td><input name="name[]" type="text" class="form-control"></td>'
      +'  <td>'
      +'      <select name="type[]"  class="form-control">'
      +'        <option value="0">文本框</option>'
      +'        <option value="1">文本域</option>'
      +'        <option value="2">单选框</option>'
      +'        <option value="3">复选框</option>'
      +'        <option value="4">下拉框</option>'
      +'      </select>'
      +'  </td>'
      +'  <td><input name="label[]" type="text" class="form-control"></td>'
      +'  <td><input name="value[]" type="text" class="form-control"></td>'
      +'  <td><button type="button" class="btn btn-warning js-del">删除</button></td>'
      +'</tr>';
    $('.table tbody').append(html);
  })

  //删除自定义数据
  $('.table').on('click','.js-del',function(){
    var tr=$(this).closest('tr')[0];
    $('.table tbody')[0].removeChild(tr);
    var $tbody=$('.table tbody');
    if(!$tbody.find('tr').length){
      var html='<tr class="no-data"><td colspan="5" class="text-center">暂无数据</td></tr>';
      $tbody.append(html);
    }
  })
</script>
@stop
