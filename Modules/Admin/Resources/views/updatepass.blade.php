@extends('admin::layouts.master')
@section('title','Change Password')
@section('content')
<div class="row">
	<div class="col-md-8 offset-md-2">
		<div class="card">
			<h3 class="card-header blue-gradient white-text">Change Password</h3>
			<div class="card-body">
				<form action="{{ route('admin_update_password') }}" method="post">
					{{ method_field('PATCH') }}
				<div class="form-group text-left">
					<label for="" >Last Password</label>
					<input type="password" name="last_password" value="" placeholder="" class="form-control">
				</div>
				<div class="form-group text-left">
					<label for="" >New Password</label>
					<input type="password" name="new_password" value="" placeholder="" class="form-control">
				</div>
				<div class="form-group text-left">
					<label for="" >Confirm Password</label>
					<input type="password" name="confirm_password" value="" placeholder="" class="form-control{{ $errors->has('confirm_password') ? ' is-invalid' : ''  }}">
					@if ($errors->has('confirm_password'))
						<div class="invalid-feedback">
						 	{{ $errors->first('confirm_password') }}
						</div>
					@endif
				</div>
				
			</div>
			<div class="card-footer">
				@csrf
				<button type="submit" class="btn btn-primary btn-block">Simpan</button>
			</div>
			</form>
		</div>
	</div>
</div>
<br>
@endsection