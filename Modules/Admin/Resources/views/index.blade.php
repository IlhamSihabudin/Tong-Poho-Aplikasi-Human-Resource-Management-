@extends('admin::layouts.master')

@section('content')
@section('title','Home')
	<div class="row">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header blue-gradient white-text">
					<h4>Amount Of Data</h4>
				</div>
				<div class="card-body">
					<canvas id="myChart" style="max-width: 500px;">
						
					</canvas>
				</div>
			</div>
			<br>
		</div>
		<div class="col-md-6">
		<div class="card mb-3">
			<div class="card-header white-text blue-gradient">
					<h4>Amount Of Data</h4>
					</div>
					<div class="card-body">
					<div class="table-responsive col-md-12">
						<table id="dtMaterialDesignExample" class="table table-hover dt-responsive nowrap" width="100%">
							<thead>
					<th class="text-center">No</th>
					<th class="text-center">Name</th>
				 	<th class="text-center">Job</th>
					<th class="text-center">Division</th>
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
					@endforeach
						</table>
					</div>
				</div>
			</div>
		</div>
			<br>
		</div>
@stop
