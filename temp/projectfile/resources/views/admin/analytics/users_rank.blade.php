@extends('admin.layouts.base')
@section('title', '用户排行')
@section('panel-title', '用户排行')
@section('sidebar')
@section('content')
<div class="content">
   <div class="row">
      <div class="col-lg-12">
         <div class="panel">
            <div class="panel-body">
               <form action="" class="form-horizontal">
                  <div class="">
                       <label class="col-sm-1 pull-left control-label">时间范围</label>
                       <div class="col-sm-2">
                          <input type="text" class="form-control" name="daterange" />
                       </div>
                       <div class="col-sm-2">
                           <div class="input-group">
                               <select class="form-control m-b" name="">
                                   <option>option 1</option>
                                   <option>option 2</option>
                                   <option>option 3</option>
                                   <option>option 4</option>
                               </select>
                               <span class="input-group-btn"><button type="button" class="btn btn-success">搜索</button></span>
                           </div>
                       </div>
                       <!-- <label class="col-sm-4 control-label">共 1480 个主题， 4437 个回复， 5274个赞</label> -->
                  </div>
               </form>

            </div>
         </div>
      </div>
   </div> <!--END .row-->

   <div class="row">
      <div class="col-lg-12">
         <div class="panel">
            <div class="panel-body">
                       <table id="example2" class="table table-striped table-bordered table-hover">
                           <thead>
                               <tr>
                                   <th>序号</th>
                                   <th>用户名</th>
                                   <th>发布信息</th>
                                   <th>回复信息</th>
                                   <th>发出赞</th>
                                   <th>获得赞</th>
                                   <th>被浏览</th>
                               </tr>
                           </thead>
                           <tbody>
                               <tr>
                                   <td>1</td>
                                   <td>xxiao</td>
                                   <td>30300</td>
                                   <td>2232</td>
                                   <td>2322</td>
                                   <td>503340</td>
                                   <td>50230</td>
                               </tr>
                               <tr>
                                   <td>2</td>
                                   <td>iooxx</td>
                                   <td>3000</td>
                                   <td>234322</td>
                                   <td>224342</td>
                                   <td>5030</td>
                                   <td>504320</td>
                               </tr>
                               <tr>
                                   <td>3</td>
                                   <td>weight</td>
                                   <td>304300</td>
                                   <td>25322</td>
                                   <td>32222</td>
                                   <td>50330</td>
                                   <td>55020</td>
                               </tr>
                               <tr>
                                   <td>4</td>
                                   <td>小明</td>
                                   <td>312000</td>
                                   <td>22112</td>
                                   <td>221222</td>
                                   <td>5434030</td>
                                   <td>54020</td>
                               </tr>
                               <tr>
                                   <td>5</td>
                                   <td>小清</td>
                                   <td>312000</td>
                                   <td>2222</td>
                                   <td>22322</td>
                                   <td>501230</td>
                                   <td>501220</td>
                               </tr>
                               <tr>
                                   <td>6</td>
                                   <td>小猪</td>
                                   <td>301010</td>
                                   <td>2212</td>
                                   <td>2222</td>
                                   <td>52030</td>
                                   <td>50120</td>
                               </tr>
                           </tbody>
                       </table>
                   </div>
               </div>
            </div>
         </div>

         <div class="panel">
             <div class="panel-heading">
                 <div class="panel-tools">
                     <a class="showhide"><i class="fa fa-chevron-up"></i></a>
                     <a class="closebox"><i class="fa fa-times"></i></a>
                 </div>
                 本月数据分布
             </div>
             <div class="panel-body">
                 <div class="flot-chart">
                     <div class="flot-chart-content" id="flot-sin-chart"></div>
                 </div>
             </div>
         </div>
      </div>
   </div>
</div>


@stop

@section('page-js')
<script>
Do('dataTable','jquery-flot',function(){

        // Initialize Example 2
        $('#example2').dataTable();


        // 统计表
        var sin = [],
            cos = [];
        for (var i = 0; i < 14; i += 0.5) {
            sin.push([i, Math.sin(i)]);
            cos.push([i, Math.cos(i)]);
        }

        var data5 = [{
            data: sin,
            label: "sin(x)"
        }, {
            data: cos,
            label: "cos(x)"
        }];

        var chartUsersOptions5 = {
            series: {
                lines: {
                    show: true
                },
                points: {
                    show: true
                }
            },
            grid: {
                tickColor: "#e4e5e7",
                borderWidth: 1,
                borderColor: '#e4e5e7',
                color: '#6a6c6f'
            },
            yaxis: {
                min: -1.2,
                max: 1.2
            },
            colors: ["#62cb31", "#efefef"],
        };

        $.plot($("#flot-sin-chart"), data5, chartUsersOptions5);


});
</script>
@stop
