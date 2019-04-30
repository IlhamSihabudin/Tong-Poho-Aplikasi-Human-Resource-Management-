@extends('manager::layouts.master')
@section('title','Manager | Absent Report')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-header" style="padding: 2px;"></div>
                <div class="card-body">
                    <form action="{{ url(route('report_absen')) }}" method="get">
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
                    <div class="row align-items-center justify-content-between">
                        <div class="col-md-5">
                            <h1 class="h1-responsive" style="font-size: 20pt;padding-left: 10px;">Absent Report <br><span style="font-size: 16pt">From {{\Request::get('tgl_awal')}} to {{\Request::get('tgl_akhir')}}</span></h1>
                        </div>
                        <div class="col-md-3 text-right">
                            <button class="btn btn-success" onclick="document.location.href='{{ route('export') }}'"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Export Excel</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ url(route('export')) }}">
                        <div class="row align-content-center">
                            <div class="col-md-12 mb-3">
                                <b>Keterangan : </b><br>
                                <table class="ml-2">
                                    <tr>
                                        <td>H</td>
                                        <td>:</td>
                                        <td>Hadir</td>
                                    </tr>
                                    <tr>
                                        <td>HT</td>
                                        <td>:</td>
                                        <td>Hadir Terlambat</td>
                                    </tr>
                                    <tr>
                                        <td>BC</td>
                                        <td>:</td>
                                        <td>Belum Clock In</td>
                                    </tr>
                                    <tr>
                                        <td>S</td>
                                        <td>:</td>
                                        <td>Sakit</td>
                                    </tr>
                                    <tr>
                                        <td>A</td>
                                        <td>:</td>
                                        <td>Alpha / Bolos</td>
                                    </tr>
                                    <tr>
                                        <td>I</td>
                                        <td>:</td>
                                        <td>Izin</td>
                                    </tr>
                                    <tr>
                                        <td>-</td>
                                        <td>:</td>
                                        <td>Tidak Ada Data</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="table-responsive col-4" style="padding: 0;white-space: nowrap">
                                <table class="table table-bordered table-striped table-hover" cellspacing="0">
                                    <thead class="blue white-text">
                                    <tr>
                                        <th class="th" width="20px">#</th>
                                        <th class="th">Name</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($karyawan as $item)
                                        <tr>
                                            <td>{{ $loop->index+1 }}</td>
                                            <td style="vertical-align: middle;"><a href="">{{ $item->name }}</a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive col-8" style="padding: 0;white-space: nowrap">
                                <table class="table table-bordered table-striped table-hover" cellspacing="0">
                                    <thead class="blue white-text">
                                    <tr align="center">
                                        @foreach($only_tgl as $item)
                                            <th>{{ $item }}</th>
                                        @endforeach
                                        <th>Rekap</th>
                                    </tr>
                                    </thead>
                                    <tbody align="center">
                                    @for($i=0;$i<count($karyawan);$i++)
                                        <tr>
                                            @for($j=0;$j<count($only_tgl);$j++)
                                                <td width="50">{{ $absen_report[$i][$j] }}</td>
                                            @endfor
                                            <td>HT = <b>{{ $telat[$i] }}</b> ; S = <b>{{ $sakit[$i] }}</b> ; I = <b>{{ $izin[$i] }}</b> ; A = <b>{{ $alpa[$i] }}</b></td>
                                        </tr>
                                    @endfor
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