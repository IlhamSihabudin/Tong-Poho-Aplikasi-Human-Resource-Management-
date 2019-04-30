@extends('admin::layouts.master')

@section('content')
@section('title','Input Employee Data')
<div class="row">
	<div class="col-md-12">
		<div class="card card-default">
			<div class="card-header white-text blue-gradient
">
				<h3>Input Employee Data</h3>
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
			</div>
			<form action="{{ route('admin_simpandp') }}" method="post" enctype="multipart/form-data" id="btds">
						{{ csrf_field() }}
			<div class="card-body">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="">Name</label>
						<input type="text" name="nama" value="{{ old('nama') }}" autocomplete="off" placeholder="Input Name" class="form-control" required="">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="">Gender</label>
						<select class="mdb-select" name="jk">
    						<option value="" disabled selected>Select Gender</option>
    						<option value="L" data-icon="{{ asset('img/icon/bisnis.png') }}" class="rounded-circle">Male</option>
    						<option value="P" data-icon="{{ asset('img/icon/female.png') }}" class="rounded-circle">Female</option>
						</select>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="">Place Of Birth</label>
						<input type="text" name="tempat" autocomplete="off" value="{{ old('tempat') }}" placeholder="Input Place" class="form-control" required="">
			</div>
		</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="">Date Of Birth</label>
						<input placeholder="Selected date" name="tgl_lahir" type="text" id="date-picker-example" value="{{ old('tgl_lahir') }}" required="" class="form-control datepicker">
			</div>
		</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="">Email</label>
						<input type="email" autocomplete="off" name="email" placeholder="Input Email" value="{{ old('email') }}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required="">
						@if($errors->has('email'))
						<span class="invalid-feedback">
							Email Already Taken!!
						</span>
						@endif
			</div>
		</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="">Photo</label>
						<input type="file" name="photo" value="" class="form-control" required="" accept="image/*" data-type='image'>
			</div>
		</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="">Job</label>
						<select id="job" name="job" required="" style="width: 100%;">
    						<option value="" disabled selected>Select Job</option>
							@foreach($job as $jobs)
							<option value="{{  $jobs->id_job }}" class="">{{ $jobs->job }}</option>
							@endforeach
						</select>

			</div>
		</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="">Division</label>
						<select name="divisi" required="" id="division" style="width:100%">
    						<option value="" disabled selected>Select Division</option>
    						@foreach($divisi as $divisis)
							<option value="{{  $divisis->id_division }}" class="">{{ $divisis->division }}</option>
							@endforeach
						</select>
			</div>
		</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="">Contract Begin</label>
						<input placeholder="Starting Date" value="{{ old('tgl_awal') }}" id="startingDate" required="" name="tgl_awal" type="text"  class="form-control datepicker">
			</div>
		</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="">Contract End</label>
						<input placeholder="Ending Date" id="endingDate" required="" name="tgl_akhir" type="text" id="akhir" value="{{ old('tgl_akhir') }}" class="form-control datepicker">
			</div>
		</div>

				<div class="col-md-6">
					<div class="form-group">
						<label for="">Number Of Leave</label>
						<input type="number" autocomplete="off" name="jml_cuti" value="" min="1" placeholder="Leave" class="form-control">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="">Password</label>
						<input type="password" name="pass" placeholder="Password" autocomplete="off" value="{{ old('pass') }}" class="form-control" required="">
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
<br><br><br>
@endsection