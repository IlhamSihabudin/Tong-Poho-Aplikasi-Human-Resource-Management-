@extends('admin::layouts.master')

@section('content')
@section('title','Edit Job Data')
<div class="row">
	<div class="col-md-6 offset-md-3">
		<div class="card card-default">
			<div class="card-header white-text blue-gradient">
				<h3>Edit Job Data</h3>
			</div>
					@if (session('message'))
					 <div class="alert alert-info">
					 	{{ session('message') }}
					 </div>
					@endif
					@if ($errors->any())
					 @foreach($errors->all() as $error)
						<div class="alert alert-info">
						 	{{ $error }}
						 </div>
					 @endforeach
					@endif
			<form action="{{ url('/admin/updatejob/'.$edit->id_job)}}" method="post">
						{{ csrf_field() }}
			<div class="card-body">
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label for="">Job</label>
						<input type="text" name="job" autocomplete="off" value="{{ $edit->job }}" class="form-control" required="">
			</div>
		</div>
				<div class="col-md-12">
					<div class="form-group">
						<label for="">Salary</label>
						<input type="number" name="salary" autocomplete="off" value="{{ $edit->salary }}" min="1" class="form-control" required="">
			</div>
		</div>
			</div>	
			</div>
		<div class="card-footer">
			<button type="submit" class="btn blue-gradient btn-block">Update</button>
		</div>
		</form>
	</div>
	</div>
</div>

@endsection