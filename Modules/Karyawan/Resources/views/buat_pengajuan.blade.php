@extends('karyawan::layouts.master')
@section('title','Buat Pengajuan Cuti')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="col-md-8 offset-md-2">
			@foreach ($errors as $error)
			 	<alert class="alert danger">
			 		{{ $error->any() }}
			 	</alert>
			@endforeach
			@if ($jumlah_cuti->number_of_leave == NULL || $jumlah_cuti->number_of_leave == 0)
			<a onclick="toastr.info('Sorry You Have No Leftovers')" class="floating-button"<span style="color:white" class="fa fa-info my-float"></span></a>
			@else	
			<a onclick="toastr.info('Your Remaining Leave '+ {{ $jumlah_cuti->number_of_leave }}  +' Days Left')" class="floating-button"><span style="color:white" class="fa fa-info my-float"></span></a>
			@endif
			<div class="card card-primary-color">
				<div class="card-header white-text">
					<h3>Form of Leave</h3>
				</div>
				<div class="card-body">
					<form action="{{ route('storepengajuan') }}" method="post" id="pengajuan">
					<div class="col-md-12">
						<div class="form-group">
						<div class="md-form">
							<select class="mdb-select colorful-select dropdown-primary" id="jenis_cuti" name="jenis_cuti">
   								 <option value="" disabled="" selected>Choose Type of Leave</option>
    							 <option value="Sakit">Sick</option>
    							 <option value="Izin">Permit</option>
							</select>
							<label for="">Type of Leave</label>
							@if($errors->has('jenis_cuti'))
								<script>swal('Error','Fill Field Type Of Leave','error')</script>
							@endif
						</div>
						</div>
						<div class="form-group">
						<div class="md-form mb-4 blue-textarea active-blue-textarea">
							<textarea name="keterangan" id="keterangan" class="md-textarea form-control{{ $errors->has('keterangan') ? ' is-invalid' : '' }}" required="" value="{{ old('keterangan') }}"></textarea>
							<label for="keterangan">Statement</label>
							@if ($errors->has('keterangan'))
								<span class="invalid-feedback">
									{{ $errors->first('keterangan') }}
								</span>
							@endif
						</div>
						</div>
						<div class="form-group">
						<div class="md-form">
							<input type="date" name="tgl_mulai" id="tgl_mulai" value="{{ old('tgl_mulai') }}" placeholder="" class="form-control datepicker" required="">
							<input type="date" name="tgl_mulai2" id="tgl_mulai2" value="{{ old('tgl_mulai') }}" placeholder="" class="form-control datepicker" required="">
							<label for="tgl_mulai" class="text-left{{ $errors->has('tgl_mulai') ? ' is-invalid' : ''  }}">Start Date</label>
							@if ($errors->has('tgl_mulai_submit'))
								<script>swal('Error','Fill Field Start Date','error')</script>
							@endif
							@if ($errors->has('tgl_mulai2_submit'))
								<script>swal('Error','Fill Field Start Date','error')</script>
							@endif
						</div>
						</div>
						<div class="form-group">
						<div class="md-form">
							<input type="date" name="tgl_berakhir" value="{{ old('tgl_berakhir') }}" placeholder="" id="tgl_berakhir" class="form-control datepicker" required="">

							<input type="date" name="tgl_berakhir2" value="{{ old('tgl_berakhir') }}" id="tgl_berakhir2" placeholder="" id="tgl_berakhir" class="form-control datepicker" required="">
							<label for="">End Date</label>
							@if ($errors->has('tgl_berakhir_submit'))
								<script>swal('Error','Fill Field End Date','error')</script>
							@endif
							@if ($errors->has('tgl_berakhir_submit'))
								<script>swal('Error','Fill Field End Date','error')</script>
							@endif
						</div>
						</div>
					</div>
				</div>
				<div class="card-footer">
					@if($jumlah_cuti->number_of_leave <= 0)
					<button type="submit" class="btn btn-primary" disabled="" style="cursor: not-allowed;">Send <span class="fa fa-send"></span></button>
					@else
					<button type="submit" class="btn btn-primary button-prevent">Send <span class="spinner fa fa-spinner fa-spin"></span><span class="icon fa fa-send"></span></button>
					@endif
					@csrf
				</div>
				</form>
			</div>
		</div>
	</div>
</div>
<br><br>
@endsection
