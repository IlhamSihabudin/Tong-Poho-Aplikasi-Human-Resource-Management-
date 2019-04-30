@extends('manager::layouts.master')
@section('title','Manager | Allowances')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="padding: 2px;"></div>
                <div class="card-body">
                    <form id="val-form" action="{{ route('detail') }}" method="get">
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
                                <button id="val-button" type="submit" class="btn btn-primary btn-lg btn-block mt-2">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-3">
            <div class="card">
                <div class="card-header" style="padding: 2px;"></div>
                <div class="card-header white">
                    <div class="row align-items-center justify-content-between">
                        <div style="padding-left: 10px">
                            <h1 class="h1-responsive" style="font-size: 20pt;">Allowances</h1>
                        </div>
                        <div class="col-xs-6">
                            <a href="{{ route('input_tunjangan') }}" class="btn btn-primary btn-md" style="margin-top: 0px;width: 100px">Add</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive col-md-12">
                        <table id="dtMaterialDesignExample" class="table table-striped table-hover dt-responsive" cellspacing="0" width="99%">
                            <thead>
                            <tr align="center">
                                <th class="th-sm" style="width: 20px" data-priority="1">#
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
                                <th class="th" data-priority="2">Allowance Name
                                    <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                </th>
                                <th class="th">Allowances Amount
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
                                        <div class="row justify-content-center">
                                            <div class="col-2" style="padding: 0;">
                                                <a href="{{ url('/manager/tunjangan/edit/'.base64_encode($row->id_allowance)) }}" class="btn-floating btn-sm btn-success"><i class="fa fa-pencil"></i></a>
                                            </div>
                                            <div class="col-2">
                                                <a href="{{ url('/manager/tunjangan/hapus/'.base64_encode($row->id_allowance)) }}" onclick="return confirm('Apakah Anda Yakin?')" class="btn-floating btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                            </div>
                                        </div>
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