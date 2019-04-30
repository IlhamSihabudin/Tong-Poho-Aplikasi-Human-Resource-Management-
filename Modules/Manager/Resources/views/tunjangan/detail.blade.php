@extends('manager::layouts.master')
@section('title','Manager | Allowances')
@section('content')
    <div class="row">
        <div class="col-md-12 mb-3">
            <div class="card">
                <div class="card-header" style="padding: 2px;"></div>
                <div class="card-body">
                    <form action="{{ route('detail') }}" method="get">
                        <div class="row align-content-center">
                            <div class="col-md-10">
                                <label for="" class="forn-control-label" style="font-size: 14pt">Search Employee</label>
                                <select class="form-control js-example-basic-single{{ $errors->has('nama_karyawan') ? ' is-invalid' : ''}}" style="width: 100%;" name="nama_karyawan">
                                    <option></option>
                                    @foreach($karyawan as $karyawans)
                                        <option value="{{ $karyawans->name }}">{{ $karyawans->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('nama_karyawan'))
                                    <span class="invalid-feedback">
                                        {{ $errors->first('nama_karyawan') }}
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-2 align-self-center">
                                <button type="submit" class="btn btn-primary btn-lg btn-block mt-2">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-5 mb-3">
            <!-- Card -->
            <div class="card testimonial-card">

                <!-- Bacground color -->
                <div class="card-up blue-gradient">
                </div>

                <!-- Avatar -->
                <div class="avatar mx-auto white">
                    <img src="{{ asset('upload/'.$nama->photo) }}" class="rounded-circle" style="width: 110px;height: 110px">
                </div>

                <div class="card-body">
                    <!-- Name -->
                    <h3 class="card-title">{{ $nama->name }}</h3>
                    <h5 class="text-center">{{ $job->job }} | {{ $division->division }}</h5>
                    <hr>
                    <div class="table-responsive col-md-12">
                        <table id="tablePreview" class="table table-striped table-borderless">
                            <tbody>
                                @foreach($tun_yg_dimiliki as $item)
                                    <tr>
                                        <td style="font-size: 12pt">{{ $loop->index+1 }}.</td>
                                        <td style="font-size: 12pt">{{ $item->allowance_title }}</td>
                                        <td style="font-size: 12pt" align="right">{{ "Rp.".number_format($item->allowance_amount,2,',','.') }}</td>
                                        <td>
                                            <a href="{{ url('manager/tunjangan/detail/hapus/'.$item->id_tmp) }}" class="btn-floating btn-danger btn-sm"><i class="fa fa-close"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <!-- Card -->
        </div>
        <div class="col-md-7">
            <div class="card">
                <div class="card-header" style="padding: 2px;"></div>
                <div class="card-header white">
                    <div class="row align-items-center">
                        <h1 class="h1-responsive" style="font-size: 20pt;padding-left: 10px;">Allowances</h1>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row align-content-center">
                        <div class="table-responsive col-md-12">
                            <form id="val-form" action="{{ route('bagi_tunjangan') }}" method="post">
                                @csrf
                                <table id="dtMaterialDesignExample" class="table table-striped table-hover" cellspacing="0" width="100%">
                                    <thead>
                                    <tr align="center">
                                        <th class="th-sm" style="width: 20px">#
                                            <i class="fa fa-sort float-right" aria-hidden="true" data-priority="1"></i>
                                        </th>
                                        <th class="th">Allowance Name
                                            <i class="fa fa-sort float-right" aria-hidden="true" data-priority="2"></i>
                                        </th>
                                        <th class="th">Allowance Amount
                                            <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                        </th>
                                        <th class="th-sm" data-priority="3">
                                            Action
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody align="center">
                                    @foreach($data as $row)
                                        <tr>
                                            <td>{{ $loop->index+1 }}</td>
                                            <td>{{ $row->allowance_title }}</td>
                                            <td align="right">{{ 'Rp.' . number_format($row->allowance_amount,2,',','.') }}</td>
                                            <td>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" name="tunjangan[]" id="materialInline{{ $row->id_allowance }}" value="{{ $row->id_allowance }}">
                                                    <label class="form-check-label" for="materialInline{{ $row->id_allowance }}"></label>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="col-md-12 text-right">
                                    <button id="val-button" type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
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