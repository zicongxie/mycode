@extends('admin.layouts.base')
@section('title', '话题数据')
@section('panel-title', '话题数据')
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
                          <!-- <span class="help-block">共 1480 个主题， 4437 个回复， 5274个赞</span> -->
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
                                <th>标签</th>
                                <th>用户数</th>
                                <th>发布数</th>
                                <th>评论数</th>
                                <th>赞数</th>
                                <th>图片</th>
                                <th>感兴趣</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>萌妹纸</td>
                                <td>332</td>
                                <td>3000</td>
                                <td>61</td>
                                <td>500</td>
                                <td>5300</td>
                                <td>5300</td>
                            </tr>
                            <tr>
                                <td>双11</td>
                                <td>223</td>
                                <td>32432</td>
                                <td>63</td>
                                <td>200</td>
                                <td>63</td>
                                <td>200</td>
                            </tr>
                            <tr>
                                <td>京东</td>
                                <td>556</td>
                                <td>5555</td>
                                <td>66</td>
                                <td>1000</td>
                                <td>6d6</td>
                                <td>10300</td>
                            </tr>
                            <tr>
                                <td>西子湖畔</td>
                                <td>5562</td>
                                <td>55255</td>
                                <td>662</td>
                                <td>10200</td>
                                <td>662d</td>
                                <td>102400</td>
                            </tr>
                            <tr>
                                <td>长走节</td>
                                <td>232</td>
                                <td>2000</td>
                                <td>612</td>
                                <td>530</td>
                                <td>6362</td>
                                <td>310200</td>
                            </tr>
                            <tr>
                                <td>光棍节</td>
                                <td>233</td>
                                <td>4332</td>
                                <td>623</td>
                                <td>2200</td>
                                <td>63462</td>
                                <td>102300</td>
                            </tr>
                            <tr>
                                <td>入冬失败</td>
                                <td>232</td>
                                <td>2000</td>
                                <td>612</td>
                                <td>530</td>
                                <td>6622</td>
                                <td>102200</td>
                            </tr>
                            <tr>
                                <td>小西</td>
                                <td>233</td>
                                <td>4332</td>
                                <td>623</td>
                                <td>2200</td>
                                <td>6632</td>
                                <td>102200</td>
                            </tr>
                            <tr>
                                <td>萌妹纸</td>
                                <td>332</td>
                                <td>3000</td>
                                <td>61</td>
                                <td>500</td>
                                <td>6462</td>
                                <td>104200</td>
                            </tr>
                            <tr>
                                <td>双11</td>
                                <td>223</td>
                                <td>32432</td>
                                <td>63</td>
                                <td>200</td>
                                <td>6623</td>
                                <td>102030</td>
                            </tr>
                            <tr>
                                <td>京东</td>
                                <td>556</td>
                                <td>5555</td>
                                <td>66</td>
                                <td>1000</td>
                                <td>6623</td>
                                <td>102300</td>
                            </tr>
                            <tr>
                                <td>西子湖畔</td>
                                <td>5562</td>
                                <td>55255</td>
                                <td>662</td>
                                <td>10200</td>
                                <td>662</td>
                                <td>10200</td>
                            </tr>
                            <tr>
                                <td>长走节</td>
                                <td>232</td>
                                <td>2000</td>
                                <td>612</td>
                                <td>530</td>
                                <td>612</td>
                                <td>530</td>
                            </tr>
                            <tr>
                                <td>光棍节</td>
                                <td>233</td>
                                <td>4332</td>
                                <td>623</td>
                                <td>2200</td>
                                <td>612</td>
                                <td>530</td>
                            </tr>
                            <tr>
                                <td>入冬失败</td>
                                <td>232</td>
                                <td>2000</td>
                                <td>612</td>
                                <td>530</td>
                                <td>612</td>
                                <td>530</td>
                            </tr>
                            <tr>
                                <td>小西</td>
                                <td>233</td>
                                <td>4332</td>
                                <td>623</td>
                                <td>2200</td>
                                <td>612</td>
                                <td>530</td>
                            </tr>
                            <tr>
                                <td>萌妹纸</td>
                                <td>332</td>
                                <td>3000</td>
                                <td>61</td>
                                <td>500</td>
                                <td>612</td>
                                <td>530</td>
                            </tr>
                        </tbody>
                    </table>
            </div><!--END .panel-body -->
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
