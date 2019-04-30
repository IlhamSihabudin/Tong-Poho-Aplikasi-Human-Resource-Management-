@extends('admin::layouts.master')
@section('title','Add Contract')
@section('content')
	<div class="row">
		<div class="col-md-12">
			<h3>Contract Data</h3>
			<br>
			<div class="card">
				<div class="card-body">
					<br>
			<div class="table-responsive">

			<table id="dtMaterialDesignExample" class="table table-hover dt-responsive" width="100%">
				<thead>
					<th class="text-center" >No</th>
					<th class="text-center"data-priority="1">Name</th>
				 	<th class="text-center">Job</th>
					<th class="text-center">Division</th>
					<th class="text-center">Contract Begin</th>
					<th class="text-center">Contract End</th>
					<th class="text-center" data-priority="1">Action</th>
				</thead>
				<tbody>
					@foreach($admin as $admins)

					<tr>
					<td class="text-center">{{ $loop->index+1 }}</td>
					<td class="text-center">{{ $admins->name }}</td>
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
					{{ csrf_field() }}
					<a href="{{url('/admin/editcon/')}}/{{ $admins->id_employee }}" onclick="return confirm" class="btn-floating orange accent-4"><i class="fa fa-pencil"></i></a>					
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
