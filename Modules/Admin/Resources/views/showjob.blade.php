@extends('admin::layouts.master')
@section('title','Data Job')
@section('content')
	<div class="row">
		<div class="col-md-12">
			@if (session('alert'))
    	<div class="alert alert-success">
        {{ session('alert') }}
    	</div>
			@endif
			<h3>Data Job</h3>
			<br>
			<div class="card">
				<div class="card-body">
			<div class="table-responsive">
				<table id="dtMaterialDesignExample" class="table table-hover dt-responsive">
				<thead>
					<th class="text-center">No</th>
					<th class="text-center">Job</th>
					<th class="text-center">Salary</th>
					<th class="text-center" data-priority="1">Action</th>
				</thead>
				<tbody>
					@foreach($admin as $admins)
					<tr>
					<td class="text-center">{{ $loop->index+1 }}</td>
					<td class="text-center">{{ $admins->job }}</td>
					<td class="text-center">{{ number_format($admins->salary,2,',','.') }}</td>
					<td class="text-center" align="center">
						<div class="btn-group">
					<a href="{{ url('admin/deletejob/') }}/{{ $admins->id_job }}" onclick="return confirm('Are You Sure?')" class="btn-floating red darken-3"><i class="fa fa-trash-o"></i></a>
					{{ csrf_field() }}
					<a href="{{url('/admin/editjob/')}}/{{ $admins->id_job }}" onclick="return confirm" class="btn-floating orange accent-4"><i class="fa fa-pencil"></i></a>					
					</div>
					@endforeach
					</tr>
				</tbody>
			</table>
				</div>
			</div>
			</div>
			<br><br>
		</div>	
@stop
