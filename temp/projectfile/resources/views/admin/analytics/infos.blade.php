@extends('admin.layouts.base')
@section('title', '信息统计')
@section('panel-title', '信息统计')
@section('sidebar')
@section('content')
<div class="content">
   <div class="row">
      <div class="col-lg-12">
         <div class="panel">
            <div class="panel-body">
               <!--TODO: 样式还需要调整 -->
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
                     <label class="col-sm-4 control-label">共 1480 个主题， 4437 个回复， 5274个赞</label>
                     <!-- <span class="help-block">共 1480 个主题， 4437 个回复， 5274个赞</span> -->
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div> <!--END .row-->

   <div class="row">
      <div class="penal">
                <div class="panel-body">
                    <table id="example2" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>时间</th>
                                <th>用户数</th>
                                <th>发布数</th>
                                <th>评论数</th>
                                <th>赞数</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>2015-03-01</td>
                                <td>332</td>
                                <td>3000</td>
                                <td>61</td>
                                <td>500</td>
                            </tr>
                            <tr>
                                <td>2015-03-02</td>
                                <td>223</td>
                                <td>32432</td>
                                <td>63</td>
                                <td>200</td>
                            </tr>
                            <tr>
                                <td>2015-03-03（周六）</td>
                                <td>556</td>
                                <td>5555</td>
                                <td>66</td>
                                <td>1000</td>
                            </tr>
                            <tr>
                                <td>2015-03-04（周日）</td>
                                <td>5562</td>
                                <td>55255</td>
                                <td>662</td>
                                <td>10200</td>
                            </tr>
                            <tr>
                                <td>2015-03-05</td>
                                <td>232</td>
                                <td>2000</td>
                                <td>612</td>
                                <td>530</td>
                            </tr>
                            <tr>
                                <td>2015-03-06</td>
                                <td>233</td>
                                <td>4332</td>
                                <td>623</td>
                                <td>2200</td>
                            </tr>
                            <tr>
                                <td>2015-03-05</td>
                                <td>232</td>
                                <td>2000</td>
                                <td>612</td>
                                <td>530</td>
                            </tr>
                            <tr>
                                <td>2015-03-06</td>
                                <td>233</td>
                                <td>4332</td>
                                <td>623</td>
                                <td>2200</td>
                            </tr>
                            <tr>
                                <td>2015-03-05</td>
                                <td>232</td>
                                <td>2000</td>
                                <td>612</td>
                                <td>530</td>
                            </tr>
                            <tr>
                                <td>2015-03-06</td>
                                <td>233</td>
                                <td>4332</td>
                                <td>623</td>
                                <td>2200</td>
                            </tr>
                            <tr>
                                <td>2015-03-05</td>
                                <td>232</td>
                                <td>2000</td>
                                <td>612</td>
                                <td>530</td>
                            </tr>
                            <tr>
                                <td>2015-03-06</td>
                                <td>233</td>
                                <td>4332</td>
                                <td>623</td>
                                <td>2200</td>
                            </tr>
                            <tr>
                                <td>2015-03-05</td>
                                <td>232</td>
                                <td>2000</td>
                                <td>612</td>
                                <td>530</td>
                            </tr>
                            <tr>
                                <td>2015-03-06</td>
                                <td>233</td>
                                <td>4332</td>
                                <td>623</td>
                                <td>2200</td>
                            </tr>
                            <tr>
                                <td>2015-03-05</td>
                                <td>232</td>
                                <td>2000</td>
                                <td>612</td>
                                <td>530</td>
                            </tr>
                            <tr>
                                <td>2015-03-06</td>
                                <td>233</td>
                                <td>4332</td>
                                <td>623</td>
                                <td>2200</td>
                            </tr>
                            <tr>
                                <td>2015-03-05</td>
                                <td>232</td>
                                <td>2000</td>
                                <td>612</td>
                                <td>530</td>
                            </tr>
                            <tr>
                                <td>2015-03-06</td>
                                <td>233</td>
                                <td>4332</td>
                                <td>623</td>
                                <td>2200</td>
                            </tr>
                            <tr>
                                <td>2015-03-05</td>
                                <td>232</td>
                                <td>2000</td>
                                <td>612</td>
                                <td>530</td>
                            </tr>
                            <tr>
                                <td>2015-03-06</td>
                                <td>233</td>
                                <td>4332</td>
                                <td>623</td>
                                <td>2200</td>
                            </tr>
                        </tbody>
                    </table>
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


@stop

@section('page-js')
<script>
Do('dataTable',function(){

   $('#example2').dataTable();
});

</script>
@stop
