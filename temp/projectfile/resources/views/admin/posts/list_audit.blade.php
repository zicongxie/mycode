@extends('admin.layouts.base')
@section('title', '施工中')
@section('panel-title', '内容审核')
@section('sidebar')
@section('content')
    <div class="content animate-panel">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel">
                    <div class="panel-body">
                        <div class="input-group col-md-6">
                            <input type="text" class="form-control" placeholder="输入关键字">
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
                        <div class="btn-group">
                            <a href="/admin/posts/auditing" class="btn btn-{{(!$type || $type == '') ? 'info' : 'default'}}">全部</a>
                            <a href="/admin/posts/auditing?type=1" class="btn btn-{{$type == 1 ? 'info' : 'default'}}">热点</a>
                            <a href="/admin/posts/auditing?type=2" class="btn btn-{{$type == 2 ? 'info' : 'default'}}">回收站</a>
                        </div>
                        <div class="form-group form-horizontal pull-right">
                            <div class="btn-group"><label class="control-label" for="">排序：</label></div>
                            <div class="btn-group">
                                <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" aria-expanded="false">最新发布<span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">最新发布</a></li>
                                    <li><a href="#">最早发布</a></li>
                                    <li><a href="#">方式3</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        @if($type == 2)
                            @foreach($infos as $val)
                                <?php $info = unserialize($val->data);?>
                                <div class="panel">
                                    <section class="panel-body">
                                        <div>
                                            <a href="" class="text-info">{{$info['nickname']}}</a>
                                            <a href="#" class="btn btn-default js-ban" data-id="{{$info['id']}}" data-toggle="modal" data-target="#banModal">{{$info['ban'] ? '已禁言' : '未禁言'}}</a>
                                            <a href="#" class="text-warning">#{{$info['topicsTitle']}}#</a>
                                            <p class="m-t-sm">{{$info['content']}}</p>
                                        </div>
                                        <div>
                                            <ul class="pic-list">
                                                <?php $images = explode(',',$info['images']);?>
                                                @foreach($images as $image)
                                                <li class="active">
                                                    <div class="pic-box">
                                                        <a href="http://img4.duitang.com/uploads/blog/201306/06/20130606094132_dhBJR.jpeg" rel="lightbox-group">
                                                            <img width="100" height="100" src="http://temp.im/100x100" alt="">
                                                        </a>
                                                        <p>设为封面</p>
                                                    </div>
                                                    <a href="javascript" class="pe-7s-close-circle del"></a>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div>
                                            <div class="pull-right m-t">
                                                <?php $device_info = explode(',',$info['device_info']);?>
                                                <span class="m-r">赞({{$info['like_count']}})</span>
                                                <span class="m-r">评论({{$info['review_count']}})</span>
                                                <span class="m-r">{{$device_info[0]}}</span>
                                                <span class="m-r">{{$info['location_text']}}</span>
                                                <span class="m-r">{{$device_info[1]}}</span>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            @endforeach
                        @else
                            @foreach($infos as $info)
                                <div class="panel">
                                    <section class="panel-body">
                                        <div>
                                            <a href="" class="text-info">{{$info->user->nickname}}</a>
                                            <a href="#" class="btn btn-default js-ban" data-id="{{$info->id}}" data-toggle="modal" data-target="#banModal">{{$info->user->is_lock ? '已禁言' : '未禁言'}}</a>
                                            <a href="#" class="text-warning js-topic">#{{$info->topics->title}}#</a>
                                            <p class="m-t-sm js-content" data-pk="{{$info->id}}">{{$info->content}}</p>
                                        </div>
                                        <div>
                                            <ul class="pic-list">
                                                <?php $images = explode(',',$info->images);?>
                                                @foreach($images as $image)
                                                <li class="active">
                                                    <div class="pic-box">
                                                        <a href="http://img4.duitang.com/uploads/blog/201306/06/20130606094132_dhBJR.jpeg" rel="lightbox-group">
                                                            <img width="100" height="100" src="http://temp.im/100x100" alt="">
                                                        </a>
                                                        <p>设为封面</p>
                                                    </div>
                                                    <a href="javascript" class="pe-7s-close-circle del"></a>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div>
                                            <a data-id="{{$info->id}}" class="btn {{$info->is_check?'btn-success':'btn-default'}}  js-auditing">审核</a>
                                            <a data-id="{{$info->id}}" class="btn btn-default js-del" data-toggle="modal" data-target="#delModal">删除</a>
                                            <a data-id="{{$info->id}}" class="btn {{$info->is_check?'btn-warning':'btn-default'}} js-hot">热点</a>
                                            <a href="#" class="btn btn-default">区域</a>
                                            <div class="pull-right m-t">
                                                <?php $device_info = explode(',',$info->device_info);?>
                                                <span class="m-r">赞({{$info->like_count}})</span>
                                                <span class="m-r">评论({{$info->review_count}})</span>
                                                <span class="m-r">{{isset($device_info[0]) ? $device_info[0] : ''}}</span>
                                                <span class="m-r">{{$info->location_text}}</span>
                                                <span class="m-r">{{isset($device_info[1]) ? $device_info[1] : ''}}</span>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            @endforeach
                        @endif
                        <?php echo $infos->appends(['type'=>$type,'orderby'=>$orderby])->render();?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 模态框（Modal） 禁言-->
    <div class="modal fade hmodal-info" id="banModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       <div class="modal-dialog">
            <form class="modal-content" action="" method="post">
                <div class="color-line"></div>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">禁言</h4>
                </div>
                <div class="modal-body">
                    <input type="number" class="form-control m-b" required placeholder="禁言时间（天）" name="time">
                    <textarea class="p-xs" placeholder="禁言原因" required style="width:100%;height:100px" name="content"></textarea>
                    <input type="hidden" name="id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="submit" class="btn btn-info">提交更改</button>
                </div>
            </form><!-- /.modal-content -->
        </div><!-- /.modal -->
    </div>
    <!-- 模态框（Modal） 删除-->
    <div class="modal fade hmodal-info" id="delModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       <div class="modal-dialog">
            <form class="modal-content" action="" method="post">
                <div class="color-line"></div>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">删除内容</h4>
                </div>
                <div class="modal-body">
                    <textarea class="p-xs" required placeholder="删除原因" style="width:100%;height:100px" name="description"></textarea>
                    <input type="hidden" name="id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default"  data-dismiss="modal">关闭</button>
                    <button type="submit" class="btn btn-info">确定删除</button>
                </div>
            </form><!-- /.modal-content -->
        </div><!-- /.modal -->
    </div>
    <style>
        .pic-list{padding: 0;list-style: none;}
        .pic-list:after{
            content: '';
            display: block;
            clear: both;
        }
        .pic-list li{position: relative;float:left;margin-right: 20px;margin-bottom: 20px;border:2px solid #fff;}
        .pic-list .pic-box{
            position: relative;
            width: 100px;
            height: 100px;
            cursor: pointer;
        }
        .pic-list .pic-box img{
            border:0;
        }
        .pic-list li p{
            height: 30px;
            width: 100%;
            line-height: 30px;
            background: rgba(0,0,0,.4);
            font-size: 12px;
            color:#fff;
            text-align: center;
            position: absolute;
            bottom: 0;
            left: 0;
            margin: 0;
            display: none;
        }
        .pic-list li .del{
            position: absolute;
            top: -10px;
            right:-10px;
            font-size: 30px;
            color: red;
            background: #fff;
            border-radius: 50%;
            display: none;
        }

        .pic-list li:hover .del,
        .pic-list li:hover p{display: block;}

        .pic-list li.active,.pic-list li:hover{
            border-color:#74d348;
        }

        section{border-top: 1px solid #efefef;}
    </style>
@stop


@section("page-js")

<!-- picbox 用do.js方式引入失效 -->
<link rel="stylesheet" href="{{ url('/statics/vendor/picbox/css/picbox.css') }}" type="text/css" media="screen" />
<script type="text/javascript" src="{{ url('/statics/vendor/picbox/js/jquery-migrate-1.2.1.min.js') }}"></script>
<script type="text/javascript" src="{{ url('/statics/vendor/picbox/js/picbox.js') }}"></script>

<script>
Do('editable','toastr',function(){
         $('body').on('click','.js-auditing',function(){
             var $this=$(this);
             $.ajax({
                 url:"/admin/posts/auditing/update?id="+$this.data('id')+"&act=auditing",
                 type:"get",
                 dataType:"json",
                 success:function(data){
                     if(data.result=="100"){
                         if(data.data=="1"){
                             $this.html('审核').removeClass('btn-default').addClass('btn-success')
                         }else{
                              $this.html('审核').addClass('btn-default').removeClass('btn-success')
                         }
                         toastr.success(data.text);
                     }else{
                         toastr.error(data.text);
                     }
                 }
             });
         })

         $('body').on('click','.js-hot',function(){
             var $this=$(this);
             $.ajax({
                 url:"/admin/posts/auditing/update?id="+$this.data('id')+"&act=hot",
                 type:"get",
                 dataType:"json",
                 success:function(data){
                     if(data.result=="100"){
                         if(data.data=="1"){
                             $this.html('热点').removeClass('btn-default').addClass('btn-warning')
                         }else{
                              $this.html('热点').addClass('btn-default').removeClass('btn-warning')
                         }
                         toastr.success(data.text);
                     }else{
                         toastr.error(data.text);
                     }
                 }
             });
         })

         //删除内容
         $('body').on('click','.js-del',function(){
             var id=$(this).data('id');
             $('#delModal input[name="id"]').val(id);
             $('#delModal').data('floor',$(this).closest('.panel'));
         })

         $('#delModal form').on('submit',function(){
             var data=$(this).serialize();
             console.log(data);
              var $this=$(this);
             $.ajax({
                 url:"/admin/posts/auditing/update?&act=del",
                 data:data,
                 type:"get",
                 dataType:"json",
                 success:function(data){
                     if(data.result=="100"){
                         $('#banModal').data('floor').hide();
                         toastr.success(data.text);
                         $('#banModal').modal('hide');
                     }else{
                         toastr.error(data.text);
                     }
                 }
             });
             return false;
         })
         //------------------

          //禁言
         $('body').on('click','.js-ban',function(){
             var id=$(this).data('id');
             $('#banModal input[name="id"]').val(id);
             $('#banModal').data('floor',$(this).closest('.panel'));
         })

         $('#banModal form').on('submit',function(){
             var data=$(this).serialize();
             console.log(data);
             var $this=$(this);
             $.ajax({
                 url:"/admin/posts/auditing/update?&act=ban",
                 data:data,
                 type:"get",
                 dataType:"json",
                 success:function(data){
                     if(data.result=="100"){
                         $('#banModal').data('floor').hide();
                         toastr.success(data.text);
                         $('#banModal').modal('hide');
                     }else{
                         toastr.error(data.text);
                     }
                 }
             });
             return false;
         })
         //------------------


         //内容编辑
         $('.js-content').editable({
             type: 'textarea',
             ajaxOptions: {
                 type: 'get',
                 dataType: 'json'
             },
             url:'/admin/topic/auditing/update?&act=cate',
             params:function(params){
                 params.cid=params.value;
                 params.id=params.pk;
                 delete params.value;
                 delete params.pk;
                 delete params.name;
                 return params;
             },
             success: function(response, newValue) {
                 if(response.result==100){
                     toastr.success('提交成功');
                 }else{
                     toastr.error('提交失败');
                 }
             },
             error: function(response, newValue) {
                  toastr.error('提交失败');
             }
         });

});
</script>
@stop
