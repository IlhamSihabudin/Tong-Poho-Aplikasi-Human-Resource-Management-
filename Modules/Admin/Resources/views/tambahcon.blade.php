@extends('admin::layouts.master')

@section('content')
@section('title','Add Contract')
<div class="row">
	<div class="col-md-6 offset-md-3">
		<div class="card card-default">
			<div class="card-header white-text blue-gradient">
				<h3>Add Contract</h3>
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
			<form action="{{ url('/admin/updatecon/'.$edit->id_employee)}}" method="post">
						{{ csrf_field() }}
			<div class="card-body">
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label for="">Name</label>
						<input type="text" autocomplete="off" name="nama" value="{{ $edit->name }}" placeholder="Masukan Nama" class="form-control" disabled="">
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<label for="">Contract Begin</label>
						<input placeholder="Selected date" value="{{ date('d F, Y', strtotime($edit->contract_begin)) }}" required="" name="tgl_awal" type="text" id="startingDate" class="form-control datepicker">
			</div>
		</div>
				<div class="col-md-12">
					<div class="form-group">
						<label for="">Contract End</label>
						<input placeholder="Selected date" value="{{ date('d F, Y', strtotime($edit->contract_end)) }}" required="" name="tgl_akhir" type="text" id="endingDate" class="form-control datepicker">
			</div>
		</div>
			</div>	
			</div>
		<div class="card-footer">
			<button type="submit" class="btn blue-gradient btn-block">Update</button>
		</div>
		</form>
	</div>
	<br>
	</div>
</div>

@endsection