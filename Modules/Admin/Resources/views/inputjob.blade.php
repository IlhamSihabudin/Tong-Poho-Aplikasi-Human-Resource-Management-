@extends('admin::layouts.master')

@section('content')
@section('title','Input Job')
<div class="row">
	<div class="col-md-6 offset-md-3">
		<div class="card card-default">
			<div class="card-header white-text blue-gradient">
				<h3>Input Job</h3>
			</div>
			<form action="{{ url('/admin/inputjob') }}" method="post" id="btds">
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
						<label for="">Job</label>
						<input type="text" name="job" value="" autocomplete="off" placeholder="" class="form-control" required="">
					</div>
					<div class="form-group">
						<label for="">Salary</label>
						<input type="number" name="salary" autocomplete="off" value="" placeholder="" min="1" class="form-control" required="">
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

@endsection