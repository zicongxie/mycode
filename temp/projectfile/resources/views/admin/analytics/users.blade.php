@extends('admin.layouts.base')
@section('title', '用户数据')
@section('panel-title', '用户数据')
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
                       <div class="col-sm-1">
                           <div class="input-group">
                               <!-- <select class="form-control m-b" name="">
                                   <option>option 1</option>
                                   <option>option 2</option>
                                   <option>option 3</option>
                                   <option>option 4</option>
                               </select> -->
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
                                <th>时间</th>
                                <th>新增用户</th>
                                <th>独立发帖</th>
                                <th>独立回复数</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>2015-03-01</td>
                                <td>332</td>
                                <td>3000</td>
                                <td>61</td>
                            </tr>
                            <tr>
                                <td>2015-03-02</td>
                                <td>223</td>
                                <td>32432</td>
                                <td>63</td>
                            </tr>
                            <tr>
                                <td>2015-03-03（周六）</td>
                                <td>556</td>
                                <td>5555</td>
                                <td>66</td>
                            </tr>
                            <tr>
                                <td>2015-03-04（周日）</td>
                                <td>5562</td>
                                <td>55255</td>
                                <td>662</td>
                            </tr>
                            <tr>
                                <td>2015-03-05</td>
                                <td>232</td>
                                <td>2000</td>
                                <td>612</td>
                            </tr>
                            <tr>
                                <td>2015-03-06</td>
                                <td>233</td>
                                <td>4332</td>
                                <td>623</td>
                            </tr>
                            <tr>
                                <td>2015-03-05</td>
                                <td>232</td>
                                <td>2000</td>
                                <td>612</td>
                            </tr>
                            <tr>
                                <td>2015-03-06</td>
                                <td>233</td>
                                <td>4332</td>
                                <td>623</td>
                            </tr>
                            <tr>
                                <td>2015-03-05</td>
                                <td>232</td>
                                <td>2000</td>
                                <td>612</td>
                            </tr>
                            <tr>
                                <td>2015-03-06</td>
                                <td>233</td>
                                <td>4332</td>
                                <td>623</td>
                            </tr>
                            <tr>
                                <td>2015-03-05</td>
                                <td>232</td>
                                <td>2000</td>
                                <td>612</td>
                            </tr>
                            <tr>
                                <td>2015-03-06</td>
                                <td>233</td>
                                <td>4332</td>
                                <td>623</td>
                            </tr>
                            <tr>
                                <td>2015-03-05</td>
                                <td>232</td>
                                <td>2000</td>
                                <td>612</td>
                            </tr>
                            <tr>
                                <td>2015-03-06</td>
                                <td>233</td>
                                <td>4332</td>
                                <td>623</td>
                            </tr>
                            <tr>
                                <td>2015-03-05</td>
                                <td>232</td>
                                <td>2000</td>
                                <td>612</td>
                            </tr>

                        </tbody>
                    </table>

            </div>
         </div><!--END .panel-->

         <div class="panel">
             <div class="panel-body">
                 <div class="flot-chart">
                     <div class="flot-chart-content" id="flot-sin-chart"></div>
                 </div>
             </div>
         </div><!--END .panel-->

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
