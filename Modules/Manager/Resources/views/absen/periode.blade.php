@extends('manager::layouts.master')
@section('title','Manager | Home')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-header" style="padding: 2px;"></div>
                <div class="card-body">
                    <form action="{{ url(route('periode')) }}" method="get">
                        <div class="row align-content-center">
                            <div class="col-md-10 col-sm-12">
                                <label for="" class="forn-control-label" style="font-size: 14pt">Period of Absence</label>
                                <!--Grid row-->
                                <div class="row">
                                    <!--Grid column-->
                                    <div class="col-md-6 mb-4">

                                        <div class="md-form">
                                            <!--The "from" Date Picker -->
                                            <input type="text" id="startingDate" class="form-control datepicker" name="tgl_awal" value="{{\Request::get('tgl_awal')}}">
                                            <label for="startingDate">Select Start Date</label>
                                        </div>

                                    </div>
                                    <!--Grid column-->

                                    <!--Grid column-->
                                    <div class="col-md-6 mb-4">

                                        <div class="md-form">
                                            <!--The "to" Date Picker -->
                                            <input type="text" id="endingDate" class="form-control datepicker" name="tgl_akhir" value="{{\Request::get('tgl_akhir')}}">
                                            <label for="endingDate">Select End Date</label>
                                        </div>

                                    </div>
                                    <!--Grid column-->

                                </div>
                                <!--Grid row-->
                            </div>
                            <div class="col-md-2 col-sm-12 align-self-center">
                                <button type="submit" class="btn btn-primary btn-lg btn-block mt-2">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="padding: 2px;"></div>
                <div class="card-header white">
                    <div class="row align-items-center">
                        <h1 class="h1-responsive" style="font-size: 20pt;padding-left: 10px;">Absent Report <br><span style="font-size: 16pt">From {{\Request::get('tgl_awal')}} to {{\Request::get('tgl_akhir')}}</span></h1>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('export') }}">
                        <div class="row align-content-center">
                            <div class="col-md-12 text-right">
                                <button class="btn btn-success" onclick="document.location.href='{{ route('export') }}'"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Export Excel</button>
                            </div>
                            <div class="table-responsive col-md-12">
                                <table id="dtMaterialDesignExample" class="table table-striped table-hover" cellspacing="0" width="99%">
                                    <thead>
                                    <tr align="center">
                                        <th class="th-sm" style="width: 20px">#
                                            <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                        </th>
                                        <th class="th">Employee Name
                                            <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                        </th>
                                        <th class="th">Gender
                                            <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                        </th>
                                        <th class="th">Job
                                            <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                        </th>
                                        <th class="th">Division
                                            <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                        </th>
                                        <th class="th">Permit
                                            <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                        </th>
                                        <th class="th">Sick
                                            <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                        </th>
                                        <th class="th">Alpa
                                            <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                        </th>
                                        <th class="th">Late
                                            <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody align="center">
                                    @foreach($karyawan as $item)
                                        <tr>
                                            <td>{{ $loop->index+1 }}</td>
                                            <td>{{ $item->name }}</td>
                                            @if($item->gender == "L")
                                                <td>Male</td>
                                            @elseif($item->gender == "P")
                                                <td>Famale</td>
                                            @endif
                                            <td>{{ $item->job }}</td>
                                            <td>{{ $item->division }}</td>
                                            <td>{{ $izin[$loop->index+1] }}</td>
                                            <td>{{ $sakit[$loop->index+1] }}</td>
                                            <td>{{ $alpa[$loop->index+1] }}</td>
                                            <td>{{ $telat[$loop->index+1] }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br>

    </div>
    </div>
@stop