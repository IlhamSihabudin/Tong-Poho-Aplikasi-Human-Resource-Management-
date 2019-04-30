@extends('layouts.app')
@section('title','Tong Poho | Login')
@section('content')
<form action="{{ route('login') }}" method="POST" id="login">
<div style="height: 100vh; background-image: url('picture/blur2.jpg');background-repeat: none;background-position: center;background-size: cover;">
        <div class="flex-center">
            <div class="col-md-4">
                <div class="card" style="box-shadow: 20px 20px 50px black;">
                    <div class="card-header" style="padding-top: 0px;height: 10px;background: linear-gradient(40deg,#05ffa3,#2096ff)!important"></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12" style="position: block;text-align: center;">
                                <img src="picture/Tong-Poho.png" width="100px">
                            </div>

                            <div class="col-md-12 mt-3">
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1" style="width: 40px"><i class="fa fa-user" style="color: #2096ff"></i></span>
                                    </div>
                                    <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : ''  }}" placeholder="Email" value="{{ old('email') }}" autocomplete="off">
                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        {{ $errors->first('email') }}
                                    </span>
                                    @endif
                                </div>
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1" style="width: 40px"><i class="fa fa-key" style="color: #2096ff"></i></span>
                                    </div>
                                    <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : ''  }}" placeholder="Password">
                                     @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        {{ $errors->first('password') }}
                                    </span>
                                     @endif
                                </div>
                                <div class="input-group">
                                    {{ csrf_field() }}
                                    <button class="btn btn-block button-prevent" type="submit" name="login" style="background: linear-gradient(40deg,#2096ff,#05ffa3)!important">Login</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection
