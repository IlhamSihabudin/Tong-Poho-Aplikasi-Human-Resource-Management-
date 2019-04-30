@extends('manager::layouts.master')
@section('title','Manager | Change Password')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header blue-gradient" style="padding: 2px;"></div>
                <div class="card-header white">
                    <div class="row align-items-center justify-content-between">
                        <div style="padding-left: 10px">
                            <h1 class="h1-responsive" style="font-size: 20pt;">Change Password</h1>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('ubah') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="form-control-label">Last Password</label>
                            <input type="password" class="form-control" name="last_password" required>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">New Password</label>
                            <input type="password" class="form-control" name="new_password" required>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Confirm New Password</label>
                            <input type="password" class="form-control" name="confirm_new_password" required>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-block blue-gradient">Change</button>
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