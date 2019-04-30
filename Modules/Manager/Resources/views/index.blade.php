@extends('manager::layouts.master')
@section('title','Manager | Home')
@section('content')
    <div class="row">
        <div class="col-md-12">
            @if($only_time >= $jam_masuk && $only_time <= $max_clockin && $hari <= 5 && $date_now != $date_clockin)
            <div class="card mb-3">
                <div class="card-body">
                    <form id="val-form" action="{{ route('clockin_manager') }}" method="post">
                        <div class="row">
                            <div class="col-md-10">
                                <h4 class="blue-text"><strong>Welcome {{ Auth::user()->name }}</strong></h4>
                                <p>Please Clock In First</p>
                            </div>
                            @csrf
                                <div class="col-md-2">
                                    <button id="val-button" type="submit" class="btn blue-gradient btn-lg" name="clock_in">Clock In</button>
                                </div>
                        </div>
                    </form>
                </div>
            </div>
            @endif
            @if($only_time >= $jam_keluar && $date_now == $date_clockin && $only_time <= $max_clockout && $hari <= 5 && $date_clockout != $date_now)
                    <div class="card mb-3">
                        <div class="card-body">
                            <form id="val-form" action="{{ route('clockout_manager') }}" method="post">
                                {{ method_field('PATCH') }}
                                @csrf
                                <div class="row">
                                    <div class="col-md-9">
                                        <h4 class="blue-text"><strong>Hallo! {{ Auth::user()->name }}</strong></h4>
                                        <p>Working Hours Are Complete Please Do Clock Out</p>
                                    </div>
                                    @csrf
                                    <div class="col-md-3 text-right">
                                        <button id="val-button" type="submit" class="btn blue-gradient btn-lg" name="clock_out">Clock Out</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
             @endif
        </div>
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-header blue-gradient" style="padding: 2px;"></div>
                    <div class="card-header white">
                        <div class="row align-items-center justify-content-between">
                            <div style="padding-left: 10px">
                                <h1 class="h1-responsive" style="font-size: 20pt;">Today's Absent Diagram</h1>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" style="padding: 10px">
                        <p class="text-right">
                            Number of Employees : {{ $sum_employee }}
                        </p>
                        <canvas id="barChart" style="min-height: 300px"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header blue-gradient" style="padding: 2px;"></div>
                    <div class="card-header white">
                        <div class="row align-items-center justify-content-between">
                            <div style="padding-left: 10px">
                                <h1 class="h1-responsive" style="font-size: 20pt;">List of Absent Employees Today</h1>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" style="padding: 10px">
                        <div class="table-responsive col-md-12">
                            <table id="datatables" class="table table-striped table-hover" cellspacing="0" width="99%">
                                <thead>
                                <tr align="center">
                                    <th class="th-sm" style="width: 20px">#
                                        <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                    </th>
                                    <th class="th">Employee Name
                                        <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                    </th>
                                    <th class="th">Clock In
                                        <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                    </th>
                                    <th class="th">Clock Out
                                        <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                    </th>
                                </tr>
                                </thead>
                                <tbody align="center">
                                    @foreach($absen as $absens)
                                        @if(date('H:i', strtotime($absens->clock_in)) > date('H:i', strtotime('09:30')))
                                            <tr class="bg-danger white-text">
                                                <td>{{ $loop->index+1 }}</td>
                                                <td>{{ $absens->name }}</td>
                                                <td>{{ date('H:i', strtotime($absens->clock_in)) }}</td>
                                                <td>
                                                    @if($absens->clock_out == "")
                                                        -
                                                    @else
                                                        {{ date('H:i', strtotime($absens->clock_out)) }}
                                                    @endif
                                                </td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td>{{ $loop->index+1 }}</td>
                                                <td>{{ $absens->name }}</td>
                                                <td>{{ date('H:i', strtotime($absens->clock_in)) }}</td>
                                                <td>
                                                    @if($absens->clock_out == "")
                                                        -
                                                    @else
                                                        {{ date('H:i', strtotime($absens->clock_out)) }}
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    </div>
    </div>
@stop

