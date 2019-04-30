@extends('manager::layouts.master')
@section('title','Manager | My Profile')
@section('content')
    <div class="row">
        <div class="col-md-12">
            @if ($errors->any())
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                        <strong>Error!</strong> {{ $error }}
                    </div>
                @endforeach
            @endif
            <ul class="nav nav-tabs nav-justified blue-gradient">
                <li class="nav-item">
                    <a class="nav-link waves-light active" data-toggle="tab" href="#detail_profile" role="tab">
                        <i class="fa fa-user"></i>
                        <br>Profile
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link waves-light" data-toggle="tab" href="#edit_profile" role="tab">
                        <i class="fa fa-pencil"></i>
                        <br>Edit
                    </a>
                </li>
            </ul>

            <div class="tab-content card text-center" style="margin-bottom:5%">
                <div class="tab-pane fade in show" id="edit_profile" style="margin-top:3%;padding-bottom:8%">
                    <form action="{{ route('update_profile') }}" method="post" enctype="multipart/form-data">
                        {{ method_field('PATCH') }}
                        <div class="row">
                            <div class="col-md-12">
                                <h2>Edit Profile</h2>
                                <hr style="margin-bottom:4%">
                                <div class="row">
                                    <div class="col-md-4 text-center">
                                        <div class="file-field">
                                            <img src="{{ asset('/upload').'/'.$data->photo}}" alt="" class="rounded-circle" id="profile-img-tag" width="250px" height="250px">
                                            <div class="d-flex justify-content-center">
                                                <div class="btn btn-mdb-color btn-rounded float-left">
                                                    <span>Choose Photo</span>
                                                    <input type="file" name="image" value="" placeholder="" id="profile-img">
                                                </div>
                                            </div>
                                        </div>
                                        @if ($errors->has('image'))
                                            <script>swal('Error','Extensi hanya bisa JPG,PNG,JPEG','error')</script>
                                        @endif
                                    </div>
                                    <div class="col-md-6 text-left">
                                        <div class="md-form">
                                            <input type="text" name="name" value="{{ $data->name }}" placeholder="" class="form-control" autocomplete="off">
                                            <label for="">Name</label>
                                        </div>
                                        <div class="md-form" style="margin-bottom: 40px">
                                            <div class="text-left">Gender</div>
                                            <div class="form-check form-check-inline">
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
                                            <input placeholder="Selected date" type="text" id="tgl_lahir" name="birth_date" value="{{ $tgl_lahir_edit }}" class="form-control datepicker" required>
                                            <label for="date-picker-example">Birth Date</label>
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
                                        <button type="submit" class="btn btn-success btn-block">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade in show active" id="detail_profile" style="margin-top: 5%;padding-bottom:8%">
                    <h2>My Profile</h2>
                    <hr style="margin-bottom:5%">
                    <div class="row">
                        <div class="col-md-4 text-center mb-3">
                            <img src="{{ asset('/upload').'/'.$data->photo}}" width="250px" height="250px" alt="" class="rounded-circle">
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-12">
                                    <h1 class="text-center" ><b>{{ Auth::user()->name }}</b></h1>
                                    <h5 class="text-center">{{ $job[0]->job }} | {{ $division[0]->division }}</h5>
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
                                            <h4 class="text-left">{{ $jk }}</h4>
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