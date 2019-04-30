@extends('manager::layouts.master')
@section('title','Manager | Leave History')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="padding: 2px;"></div>
                <div class="card-header white">
                    <div class="row align-items-center justify-content-between">
                        <div style="padding-left: 10px">
                            <h1 class="h1-responsive" style="font-size: 20pt;">List Employee</h1>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive col-md-12">
                        <table id="dtMaterialDesignExample" class="table table-striped table-hover" cellspacing="0" width="99%">
                            <thead>
                            <tr align="center">
                                <th class="th-sm" style="width: 20px" data-priority="2">#
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
                                <th class="th" data-priority="2">Employee Name
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
                                <th class="th" data-priority="3">
                                    Detail
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
                                        <td>
                                            <a href="{{ url('manager/riwayat_cuti/detail/'.base64_encode($item->id_employee)) }}" class="btn btn-default btn-rounded">Detail</a>
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