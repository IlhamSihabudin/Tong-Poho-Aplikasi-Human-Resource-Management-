@extends('admin::layouts.master')

@section('content')
@section('title','Input Division')
<div class="row">
	<div class="col-md-6 offset-md-3">
		<div class="card card-default" style="margin-top:9.1%">
			<div class="card-header white-text blue-gradient">
				<h3>Input Division</h3>
			</div>
			<form action="{{ url('/admin/inputdiv') }}" method="post" id="btds">
						{{ csrf_field() }}
			<div class="card-body">
			<div class="row">
				<div class="col-md-12">
					@if (session('message'))
					 <div class="alert alert-info">
					 	{{ session('message') }}
					 </div>
					@endif
					
					
					<div class="form-group">
						<label for="">Division</label>
						<input type="text" name="division" autocomplete="off" value="" placeholder="" class="form-control" required="">
					</div>
				</div>
			</div>
		</div>
				
		<div class="card-footer">
			<button type="submit" class="btn blue-gradient btn-block btn-submit">Submit</button>
		</div>
		</form>
	</div>
	</div>
</div>
<br>
<br><br><br>
@endsection