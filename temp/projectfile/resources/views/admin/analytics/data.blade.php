@extends('admin.layouts.base')
@section('title', '数据统计')
@section('panel-title', '数据统计')
@section('sidebar')
@section('content')

<div class="content">
    <div class="row">
        <div class="col-sm-2">
            <div class="panel">
               <div class="panel-body">
                  <div class="list-group">
                     <a href="#" class="list-group-item active">
                        社区管理
                     </a>
                     <a href="#" class="list-group-item">本地圈管理</a>
                     <a href="#" class="list-group-item">活动管理</a>
                     <a href="#" class="list-group-item">数据统计</a>
                     <a href="#" class="list-group-item">应用模块</a>
                     <a href="#" class="list-group-item">通用管理</a>
                  </div>
               </div>
            </div>
        </div>
        <div class="col-sm-10">
           <div class="panel">
              <div class="panel-body">
                  <form action="" class="form-horizontal">
                      <div class="">
                          <label class="col-sm-1 pull-left control-label">时间范围</label>
                          <div class="col-sm-2">
                             <input type="text" class="form-control" name="daterange" value="2015-01-11 - 2015-01-21" />
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
            <div class="panel">
                <div class="panel-body">
                    <table id="example2" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>时间</th>
                                <th>独立用户</th>
                                <th>帖子发布数</th>
                                <th>帖子回复数</th>
                                <th>关注数</th>
                                <th>信息发布数</th>
                                <th>信息评论数</th>
                                <th>信息赞数</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>2015-03-01</td>
                                <td>37323</td>
                                <td>307030</td>
                                <td>6713</td>
                                <td>50703</td>
                                <td>33732</td>
                                <td>307030</td>
                                <td>6373</td>
                            </tr>
                            <tr>
                                <td>2015-03-02</td>
                                <td>33623</td>
                                <td>306030</td>
                                <td>6163</td>
                                <td>50603</td>
                                <td>36332</td>
                                <td>360030</td>
                                <td>6633</td>
                            </tr>
                            <tr>
                                <td>2015-03-03（周六）</td>
                                <td>35323</td>
                                <td>350030</td>
                                <td>6513</td>
                                <td>50503</td>
                                <td>33532</td>
                                <td>305030</td>
                                <td>6353</td>
                            </tr>
                            <tr>
                                <td>2015-03-04（周日）</td>
                                <td>33423</td>
                                <td>340030</td>
                                <td>6413</td>
                                <td>54003</td>
                                <td>33432</td>
                                <td>30030</td>
                                <td>6433</td>
                            </tr>
                            <tr>
                                <td>2015-03-05</td>
                                <td>33323</td>
                                <td>330030</td>
                                <td>6313</td>
                                <td>53003</td>
                                <td>33332</td>
                                <td>303030</td>
                                <td>6333</td>
                            </tr>
                            <tr>
                                <td>2015-03-06</td>
                                <td>33123</td>
                                <td>310030</td>
                                <td>6113</td>
                                <td>50103</td>
                                <td>31332</td>
                                <td>301030</td>
                                <td>6133</td>
                            </tr>
                            <tr>
                                <td>2015-03-05</td>
                                <td>33223</td>
                                <td>302030</td>
                                <td>6123</td>
                                <td>50203</td>
                                <td>33232</td>
                                <td>302030</td>
                                <td>6332</td>
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
