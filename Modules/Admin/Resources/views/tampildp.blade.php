@extends('admin::layouts.master')
@section('title','Show Employee Data')
@section('content')
	<div class="row">
		<div class="col-md-12">
			@if (session('alert'))
    	<div class="alert alert-danger">
        {{ session('alert') }}
    	</div>
			@endif
			<h3>Employee Data</h3>
			<br>
			<div class="table-responsive">
					<br>
			<table id="dtMaterialDesignExample" class="table table-hover dt-responsive nowrap">
				<thead>
					<th class="text-center" data-priority="1">No</th>
					<th class="text-center" data-priority="2">Name</th>
					<th class="text-center">Gender</th>
					<th class="text-center">Place Of Birth</th>
					<th class="text-center">Email</th>
				 	<th class="text-center">Job</th>
					<th class="text-center">Division</th>
					<th class="text-center">Contract Begin</th>
					<th class="text-center">Contract End</th>
					<th class="text-center" data-priority="3">Action</th>
				</thead>
				<tbody>
					@foreach($admin as $admins)

					<tr>
					<td class="text-center">{{ $loop->index+1 }}</td>
					<td class="text-center">{{ $admins->name }}</td>
					@if($admins->gender == "L")
						<td class="text-center">Male</td>
					@elseif($admins->gender == "P")
						<td class="text-center">Female</td>
					@endif
					<td class="text-center">{{ $admins->birth_place }}</td>
					<td class="text-center">{{ $admins->email }}</td>
					@foreach($job as $jobs)
						@if($jobs->id_job == $admins->id_job)
						<td class="text-center">{{ $jobs->job }}</td>
						@endif
					@endforeach
					@foreach($divisi as $division)
						@if($division->id_division == $admins->id_division)
					<td class="text-center">{{ $division->division }}</td>
						@endif
					@endforeach
					<td class="text-center">{{ date('d F Y', strtotime($admins->contract_begin)) }}</td>
					<td class="text-center">{{ date('d F Y', strtotime($admins->contract_end)) }}</td>
					<td class="text-center" align="center">
						<div class="btn-group">
					<a href="{{ url('admin/hapus/') }}/{{ $admins->id_employee }}" onclick="return confirm('Are You Sure?')" class="btn-floating red darken-3"><i class="fa fa-trash-o"></i></a>
					{{ csrf_field() }}
					<a href="{{url('/admin/edit/')}}/{{ $admins->id_employee }}" onclick="return confirm" class="btn-floating orange accent-4"><i class="fa fa-pencil"></i></a>					
					</div>
					</tr>
					@endforeach
				</tbody>
			</table>
			</div>
				<br><br>
		</div>	
@stop
