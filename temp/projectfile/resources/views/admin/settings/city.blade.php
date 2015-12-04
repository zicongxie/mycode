@extends('admin.layouts.base')
@section('panel-title', '区域')
@section('sidebar')
@section('content')
        <div class="content">
            <div class="hpanel">
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane active">
                        <div class="panel-body">
                            <div class="col-sm-6">
                                <table class="table table-striped table-bordered table-hover text-center table-vam">
                                    <thead>
                                        <tr>
                                            <th class="text-center">区域名称</th>
                                            <th class="text-center">全名</th>
                                            <th class="text-center">citycode</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($citys as $city)
                                            <tr>
                                                <td>{{ $city->name }}</td>
                                                <td>{{ $city->merger_name }}</td>
                                                <td>{{ $city->id }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {!! $citys->render() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@stop
