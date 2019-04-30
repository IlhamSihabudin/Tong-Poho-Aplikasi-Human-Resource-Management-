@extends('admin::layouts.master')

@section('content')
@section('title','Edit Data Divisi')
<div class="row">
	<div class="col-md-6 offset-md-3">
		<div class="card card-default" style="margin-top:9.1%">
			<div class="card-header white-text blue-gradient">
				<h3>Edit Division</h3>
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
			<form action="{{ url('/admin/updatedivisi/'.$edit->id_division)}}" method="post">
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
						<input type="text" autocomplete="off" name="division" value="{{ $edit->division }}" placeholder="" class="form-control" required="">
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
<br>
<br>
<br>
<br>
@endsection
