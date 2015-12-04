@extends('admin.layouts.base')
@section('title', '回复审核')
@section('panel-title', '回复审核')
@section('sidebar')
@section('content')
    <div class="content" >
        <div class="row">
            <div class="col-lg-12">
                <div class="panel">
                    <div class="panel-body">
                       <form class="form-horizontal" action="" method="post">
                          <div class="col-md-2 pad0">
                             <input type="text" class="form-control" placeholder="用户名">
                          </div>
                          <div class="col-md-3">
                             <div class="input-daterange input-group" id="datepicker">
                                <input type="text" class="form-control" name="start">
                                <span class="input-group-addon">至</span>
                                <input type="text" class="form-control" name="end">
                             </div>
                          </div>
                           <div class="input-group col-md-2">
                              <input type="text" class="form-control" placeholder="输入关键词">
                               <span class="input-group-btn"><button type="button" class="btn btn-success">搜索</button></span>
                           </div>
                       </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="panel">
                   <div class="panel-body">
                      <div class="btn-group">
                          <a href="/admin/posts/reviewauditing" class="btn btn-{{!$type || $type == '' ? 'info' : 'default'}}">全部</a>
                          <a href="/admin/posts/reviewauditing?type=1" class="btn btn-{{$type == 1 ? 'info' : 'default'}}">屏蔽</a>
                          <a href="/admin/posts/reviewauditing?type=2" class="btn btn-{{$type == 2 ? 'info' : 'default'}}"> 未通过 </a>
                          <a href="/admin/posts/reviewauditing?type=3" class="btn btn-{{$type == 3 ? 'info' : 'default'}}"> 敏感词 </a>
                          <a href="/admin/posts/reviewauditing?type=4" class="btn btn-{{$type == 4 ? 'info' : 'default'}}"> 用户删除 </a>
                      </div>
                   </div>
                    <div class="panel-body">
                        <table class="table table-striped table-bordered table-hover text-center table-vam">
                            <thead>
                                <tr>
                                    <th class="text-center"></th>
                                    <th class="text-center">回复内容</th>
                                    <th class="text-center">用户名</th>
                                    <th class="text-center">时间</th>
                                    <th class="text-center">操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($infos->first())
                                    @if($type == 4)
                                        @foreach($infos as $val)
                                        <?php $info = unserialize($val->data);?>
                                           <tr>
                                             <td>
                                                <input type="checkbox" name="id" value="{{$info['id']}}">
                                             </td>
                                              <td> {{$info['content']}} </td>
                                              <td> {{$info['nickname']}} </td>
                                              <td> {{date('Y-m-d H:i:s',$info['created_at'])}} </td>
                                              <td>
                                                 <a href="javascript:;" class="btn btn-info btn-xs">查看原信息</a>
                                                 <a href="javascript:;" class="btn btn-primary btn-xs">屏蔽</a>
                                                 <a href="javascript:;" class="btn btn-danger btn-xs">禁言</a>
                                              </td>
                                           </tr>
                                       @endforeach
                                    @else
                                        @foreach($infos as $info)
                                           <tr>
                                             <td>
                                                <input type="checkbox" name="id" value="{{$info->id}}">
                                             </td>
                                              <td> {{$info->content}} </td>
                                              <td> {{$info->user->nickname}} </td>
                                              <td> {{$info->transformTimes(strtotime($info->created_at))}} </td>
                                              <td>
                                                 <a href="javascript:;" class="btn btn-{{$info->is_checked == 1 ? 'info' : 'default'}} btn-xs js-pass" data-id="{{$info->id}}">{{$info->is_checked == 1 ? '已通过' : '未通过'}}</a>
                                                 <a href="javascript:;" class="btn btn-info btn-xs">查看原信息</a>
                                                 <a href="javascript:;" class="btn btn-primary btn-xs js-hide" data-id="{{$info->id}}">屏蔽</a>
                                                 <a href="javascript:;" class="btn btn-danger btn-xs">禁言</a>
                                              </td>
                                           </tr>
                                       @endforeach
                                    @endif
                                @else
                                    <tr>
                                        <td colspan="5">抱歉，暂无数据</td>
                                    </tr>
                                @endif
                            </tbody>
                            <tfoot>
                              <tr>
                                <td colspan="5" class="text-left">
                                  <button class="btn btn-default btn-xs js-select-all">全选/不选</button>
                                  <button class="btn btn-default btn-xs js-select-other">反选</button>
                                  <button class="btn btn-info btn-xs js-hide-all">屏蔽</button>
                                  {{--<button class="btn btn-info btn-xs js-pass-all">通过</button>--}}
                                </td>
                              </tr>
                            </tfoot>
                        </table>
                        <?php echo $infos->appends(['type' => $type,'starttime'=>$starttime,'endtime'=>$endtime])->render();?>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@section('page-js')
<script type="text/javascript">
  var $checkbox=$('.table input:checkbox');
  $('.js-select-all').on('click',function(){
      if(!this.isSelect){
        for(var i=0;i<$checkbox.length;i++){
          $checkbox[i].checked=true;
        }
        this.isSelect=1;
      }else{
        for(var i=0;i<$checkbox.length;i++){
          $checkbox[i].checked=false;
        }
        this.isSelect=0;
      }
  })

  $('.js-select-other').on('click',function(){
      for(var i=0;i<$checkbox.length;i++){
        if($checkbox[i].checked==true){
          $checkbox[i].checked=false;
        }else{
          $checkbox[i].checked=true
        }
      }
  })

  Do('toastr',function(){
    // $('body').on('click','.js-hide',function(){
    //     var $this=$(this);
    //     $.ajax({
    //         url:"/admin/posts/reviewauditing/shield?id="+$this.data('id'),
    //         type:"get",
    //         dataType:"json",
    //         success:function(data){
    //             if(data.result=="100"){
    //                 toastr.success(data.text);
    //             }else{
    //                 toastr.error(data.text);
    //             }
    //         }
    //     });
    // })

    //屏蔽
    $('body').on('click','.js-hide',function(){
        var $this=$(this);
        $.ajax({
            url:"/admin/posts/reviewauditing/shield?id="+$this.data('id'),
            type:"get",
            dataType:"json",
            success:function(data){
                if(data.result=="100"){
                    toastr.success(data.text);
                }else{
                    toastr.error(data.text);
                }
            }
        });
    })
    //通过
    $('body').on('click','.js-pass',function(){
        var $this=$(this);
        $.ajax({
            url:"/admin/posts/reviewauditing/update?act=NotAcross&id="+$this.data('id'),
            type:"get",
            dataType:"json",
            success:function(data){
                if(data.result=="100"){
                    toastr.success(data.text);
                    $this.hide();
                }else{
                    toastr.error(data.text);
                }
            }
        });
    })
    //屏蔽所选
    $('.js-hide-all').on('click',function(){
      var ids=[];
      for(var i=0;i<$checkbox.length;i++){
        if($checkbox[i].checked==true){
          ids.push($checkbox[i].value);
        }
      }
      if(ids.length){
        $.ajax({
            url:"/admin/posts/reviewauditing/shield",
            type:"get",
            dataType:"json",
            data:{id:ids},
            success:function(data){
                if(data.result=="100"){
                    toastr.success(data.text);
                }else{
                    toastr.error(data.text);
                }
            }
        });
      }
    })
  });
</script>
@stop
