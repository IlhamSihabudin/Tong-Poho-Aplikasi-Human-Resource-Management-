@extends('manager::layouts.master')
@section('title','Manager | Allowances')
@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header" style="padding: 2px;"></div>
                <div class="card-header white">
                    <div class="row align-items-center justify-content-between">
                        <div style="padding-left: 10px">
                            <h1 class="h1-responsive" style="font-size: 18pt;">Input Allowance</h1>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form id="val-form" action="{{ route('simpan_tunjangan') }}" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                @csrf
                                <div class="form-group">
                                    <label class="form-control-label">Allowance Name</label>
                                    <input type="text" class="form-control{{ $errors->has('nama_tunjangan') ? ' is-invalid' : ''}}" name="nama_tunjangan">
                                    @if($errors->has('nama_tunjangan'))
                                        <span class="invalid-feedback">
                                            {{ $errors->first('nama_tunjangan') }}
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Allowance Amount</label>
                                    <input type="number" min="1000" class="form-control{{ $errors->has('jumlah_tunjangan') ? ' is-invalid' : ''}}" name="jumlah_tunjangan">
                                    @if($errors->has('jumlah_tunjangan'))
                                        <span class="invalid-feedback">
                                            {{ $errors->first('jumlah_tunjangan') }}
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-md btn-block" id="val-button">Save</button>
                                </div>
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