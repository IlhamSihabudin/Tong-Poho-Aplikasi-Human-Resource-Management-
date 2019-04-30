@extends('manager::layouts.master')
@section('title','Manager | Notification')
@section('content')
    <div class="row">
        <div class="col-md-3 col-sm-6 col-12 mt-2">
            <a href="{{ url(route('applied_manager')) }}" style="color: #000;">
                <div class="card hover mask waves-effect waves-light rgba-white-slight">
                    <div class="card-header bg-primary">
                        <h1 class="h1-responsive white-text" style="font-size: 20pt;"><strong><i class="fa fa-bell-o" aria-hidden="true"></i> Applied</strong></h1>
                    </div>
                    <div class="card-body text-center" style="padding: 0">
                        <span style="font-size: 80px">{{ $applied }}</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-6 col-12 mt-2">
            <a href="{{ url(route('approved_manager')) }}" style="color: #000;">
                <div class="card hover mask waves-effect waves-light rgba-white-slight">
                    <div class="card-header bg-success">
                        <h1 class="h1-responsive white-text" style="font-size: 20pt;"><strong><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Approved</strong></h1>
                    </div>
                    <div class="card-body text-center" style="padding: 0">
                        <span style="font-size: 80px">{{ $approved }}</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-6 col-12 mt-2">
            <a href="{{ url(route('rejected_manager')) }}" style="color: #000;">
                <div class="card hover mask waves-effect waves-light rgba-white-slight">
                    <div class="card-header bg-danger">
                        <h1 class="h1-responsive white-text" style="font-size: 20pt;"><strong><i class="fa fa-thumbs-o-down" aria-hidden="true"></i> Rejected</strong></h1>
                    </div>
                    <div class="card-body text-center" style="padding: 0">
                        <span style="font-size: 80px">{{ $rejected }}</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-6 col-12 mt-2">
            <a href="{{ url(route('notifikasi_manager')) }}" style="color: #000;">
                <div class="card hover mask waves-effect waves-light rgba-white-slight">
                    <div class="card-header bg-warning">
                        <h1 class="h1-responsive white-text" style="font-size: 20pt;"><strong><i class="fa fa-hourglass-2" aria-hidden="true"></i> Pending</strong></h1>
                    </div>
                    <div class="card-body text-center" style="padding: 0">
                        <span style="font-size: 80px">{{ $pending }}</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-12 mt-3">
            <div class="card">
                <div class="card-header bg-danger" style="padding: 2px;"></div>
                <div class="card-header white">
                    <div class="row align-items-center justify-content-between">
                        <div style="padding-left: 10px">
                            <h1 class="h1-responsive" style="font-size: 20pt;">Rejected List</h1>
                        </div>
                    </div>
                </div>
                <div class="card-body" style="padding: 0">
                    <div class="table-responsive col-12">
                        <table id="dtMaterialDesignExample" class="table table-striped table-borderless" cellspacing="0" width="100%">
                            <thead>
                            <tr align="center">
                                <th class="th-sm" style="width: 20px" data-priority="1">#
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
                                <th class="th-sm" data-priority="2">Employee Name
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
                                <th class="th-sm">Type
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
                                <th class="th-sm">Period
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
                                <th>Status
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
                                <th class="th-lg" width="200px">Information
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
                                <th class="th-sm" data-priority="3">
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody align="center">
                            @foreach($data_rejected as $item)
                                <tr>
                                    <td>{{ $loop->index+1 }}.</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->leave_type }}</td>
                                    <td>{{ date('d F Y', strtotime($item->date_begin)) . ' - ' . date('d F Y', strtotime($item->date_end)) }}</td>
                                    <td>
                                        <span class="badge badge-danger">{{ $item->confirm_status }}</span>
                                    </td>
                                    <td>{{ $item->statement }}</td>
                                    <td>
                                        <a class="btn-floating btn-default" disabled><i class="fa fa-ban"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>

    </div>
    </div>
@stop