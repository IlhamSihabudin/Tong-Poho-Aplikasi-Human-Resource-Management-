@extends('admin::layouts.master')
@section('title','My Profile')
@section('content')
<div class="row">
	<div class="col-md-12">

		<ul class="nav nav-tabs blue-gradient nav-justified">
					<li class="nav-item">
						<a class="nav-link active" data-toggle="tab" href="#detail_profile" role="tab">
							<i class="fa fa-user"></i>
							<br>Profile
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#edit_profile" role="tab">
							<i class="fa fa-pencil"></i>
							<br>Edit
						</a>
					</li>
		</ul>

		<div class="tab-content card" style="margin-bottom:5%">
			<div class="tab-pane fade in show" id="edit_profile" style="margin-top:3%;padding-bottom:8%">
				<form action="{{ route('admin_updateprofile') }}" method="post" enctype="multipart/form-data" id="user_profile">
				{{ method_field('PATCH') }}
					<div class="row">
						<div class="col-md-12">
							<h2 align="center">Edit Profile</h2>
							<hr style="margin-bottom:4%">
							<div class="row justify-item-center">
								<div class="col-md-4 text-center">
									<div class="file-field">
										<img src="{{ asset('/upload/').'/'.$data->photo}}" alt="Responsive Image" class="rounded-circle" id="profile-img-tag" width="250px" height="250px">
										<div class="d-flex justify-content-center">
											<div class="btn btn-mdb-color btn-rounded float-left">
											<span>Choose Photo</span>
											<input type="file" name="image" value="" placeholder="" id="profile-img" accept="image/*" data-type='image'>
											</div>
										</div>
									</div>	
									@if ($errors->has('image'))
										<script>swal('Error','Extensi hanya bisa JPG,PNG,JPEG','error')</script>
									@endif		
								</div>
								<div class="col-md-6">
									<div class="md-form">
										<input type="text" name="name" value="{{ $data->name }}" placeholder="" class="form-control" autocomplete="off">
										<label for="">Name</label>
									</div>
									<div class="md-form">
										<p class="text-left">Gender</p>
										<div class="form-check form-check-inline" style="margin-bottom: 3%">
											<input type="radio" name="gender" value="L" placeholder="" class="form-check-input" id="gender1" {{ $male_check }}>
											<label for="gender1" class="form-check-label" style="font-size:18px">Male</label>
										</div>
										<div class="form-check form-check-inline">
											<input type="radio" name="gender" value="P" placeholder="" id="gender2" class="form-check-input" {{ $female_check }}>
											<label for="gender2" class="form-check-label" style="font-size:18px">Female</label>
										</div>
									</div>
									<div class="md-form">
										<input type="text" name="birth_place" value="{{ $data->birth_place }}" class="form-control" autocomplete="off">
										<label for="">Birth Place</label>
											@if ($errors->has('birth_place'))
											<span class="invalid-feedback">
												{{ $errors->first('birth_place') }}
											</span>
											@endif	
									</div>
									<div class="md-form">
										<input type="text" name="birth_date" id="date-picker-example" data-value="{{ $data->birth_date }}" value="{{ $data->birth_date }}" placeholder="" class="form-control datepicker">
										<label for="">Birth Date</label>
											@if ($errors->has('birth_date'))
											<span class="invalid-feedback">
												{{ $errors->first('birth_date') }}
											</span>
											@endif
									</div>
									<div class="md-form">
										<input type="email" name="email" value="{{ $data->email }}" placeholder="" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" autocomplete="off">
										<label for="">Email</label>
									</div>
									 @if($errors->has('email'))
      									<script> swal(
            								'Good job!',
            								'You clicked the button!',
            								'error'
         								)</script>
        							@endif
									@csrf
									<button type="submit" class="btn blue-gradient btn-block button-prevent">Save</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="tab-pane fade in show active" id="detail_profile" style="margin-top: 5%;padding-bottom:8%">
				<h2 align="center">My Profile</h2>
				<hr style="margin-bottom:5%">
				<div class="row">
					<div class="col-md-4 text-center">
						<img src="{{ asset('/upload').'/'.$data->photo}}" width="250px" height="250px" alt="Responsive image" class="rounded-circle">	
					</div>
					<div class="col-md-8">
						<div class="row">
						<div class="col-md-12">
							<h1 class="text-left" style="font-family: 'Spectral', serif;"><b>{{ Auth::user()->name }}</b></h1>
							<h5 class="text-left">{{ $job->job }} | {{ $division->division }}</h5>
						</div>
						<div class="col-md-12">
							<hr>
						</div>
						<div class="col-12">
							<div class="row">
								<div class="col-4">
									<h4 class="text-left">Gender</h4>
								</div>
								<div class="col-1">
									<h4>:</h4>
								</div>
								<div class="col-7">
									@if($data->gender == "L")
										<h4 class="text-left">Male</h4>
									@else
										<h4 class="text-left">Female</h4>
									@endif
								</div>
							</div>
						</div>
						<div class="col-12">
							<div class="row">
								<div class="col-4">
									<h4 class="text-left">Born</h4>
								</div>
								<div class="col-1">
									<h4>:</h4>
								</div>
								<div class="col-7">
									<h4 class="text-left">{{ $data->birth_place }}, {{ $tgl_lahir }}</h4>
								</div>
							</div>
						</div>
						<div class="col-12">
							<div class="row">
								<div class="col-4">
									<h4 class="text-left">Email</h4>
								</div>
								<div class="col-1">
									<h4>:</h4>
								</div>
								<div class="col-7">
									<h4 class="text-left">{{ $data->email }}</h4>
								</div>
							</div>
						</div>
						</div>
					</div>
				</div>

		
			</div>
		</div>
	</div>
</div>
<br><br>
  
@endsection