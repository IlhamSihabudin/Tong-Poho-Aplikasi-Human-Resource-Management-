@extends('admin::layouts.master')

@section('content')
@section('title','Change Employee Data')
<div class="row">
	<div class="col-md-12">
		<div class="card card-default ">
			<div class="card-header white-text blue-gradient">
				<h3>Edit Employee Data</h3>
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
			<form action="{{ url('/admin/update/'.$edit->id_employee)}}" method="post" enctype="multipart/form-data">
						{{ csrf_field() }}
			<div class="card-body">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="">Name</label>
						<input type="text" autocomplete="off" name="nama" value="{{ $edit->name }}" placeholder="Masukan Nama" class="form-control" required="">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="">Gender</label>
						<select class="mdb-select" name="jk">
							<option value="" disabled="">Select Gender</option>
							@if($edit->gender == "L")
    						<option value="{{ $edit->gender }}">Male</option>
    						<option value="P" data-icon="{{ asset('img/icon/female.png') }}" class="rounded-circle">Female</option>
    						@elseif($edit->gender == "P")
    						<option value="{{ $edit->gender }}">Female</option>
    						<option value="L" data-icon="{{ asset('img/icon/bisnis.png') }}" class="rounded-circle">Male</option>
    						@endif
						</select>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="">Place Of Birth</label>
						<input type="text" name="tempat" value="{{ $edit->birth_place }}" placeholder="Masukan Tempat" class="form-control" autocomplete="true" required="">
			</div>
		</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="">Date Of Birth</label>
						<input placeholder="Selected date" value="{{ $edit->birth_date }}" name="tgl_lahir" data-value="{{ $edit->birth_date }}" type="text" id="date-picker-example" required="" class="form-control datepicker">
			</div>
		</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="">Email</label>
						<input type="email" autocomplete="off" name="email" placeholder="Masukan Email" value="{{ $edit->email }}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required="">
						@if($errors->has('email'))
						<span class="invalid-feedback">
							Email Already Taken!!
						</span>
						@endif
						@if($errors->has('email'))
      						<script> swal
      							(
            						'Good job!',
            						'Email Already Taken!!',
            						'error'
        						)
        				</script>
        				@endif
						@csrf
			</div>
		</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="">Job</label>
						<select class="mdb-select" name="job" required="" id="job_edit" style="width:100%">
							<option value="" disabled="">Select Job</option>
							@foreach($job as $jobs)
								@if($jobs->id_job == $edit->id_job)
    						<option value="{{ $edit->id_job }}">{{ $jobs->job }}</option>	
    							@endif
    						@endforeach
    						@foreach($job as $jobs)
    							@if($jobs->id_job != $edit->id_job)
    								<option value="{{ $jobs->id_job }}">{{ $jobs->job }}</option>
    							@endif
    						@endforeach
						</select>
			</div>
		</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="">Division</label>
						<select class="mdb-select" name="divisi" required="" id="division_edit" style="width:100%">
							<option value="" disabled="">Select Division</option>
							@foreach($divisi as $division)
								@if($division->id_division == $edit->id_division)
							<option value="{{ $edit->id_division }}">{{ $division->division }}</option>
    							@endif
    						@endforeach
    						@foreach($divisi as $division)
    							@if($division->id_division != $edit->id_division)
    							<option value="{{ $division->id_division }}">{{ $division->division }}</option>
    							@endif
    						@endforeach
						</select>
			</div>
		</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="">Contract Begin</label>
						<input placeholder="Selected date" value="{{ date('d F, Y', strtotime($edit->contract_begin)) }}" required="" name="tgl_awal" type="text" id="startingDate" class="form-control datepicker">
			</div>
		</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="">Contract End</label>
						<input placeholder="Selected date" value="{{ date('d F, Y', strtotime($edit->contract_end)) }}" required="" name="tgl_akhir" type="text" id="endingDate" class="form-control datepicker">
			</div>
		</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="">Number Of Leave</label>
						<input type="number" autocomplete="off" name="jml_cuti" value="{{ $edit->number_of_leave }}" required="" min="0" max="12"  class="form-control">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="">Password</label>
						<input type="password" autocomplete="off" name="pass" value="" placeholder="Password" class="form-control">
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

<br><br>
@endsection