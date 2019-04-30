@extends('admin::layouts.master')
@section('title','Data Division')
@section('content')
	<div class="row">
		<div class="col-md-12">
			<h3>Data Division</h3>
			<br>
			<div class="card">
				<div class="card-body">
			<div class="table-responsive">
				<table id="dtMaterialDesignExample" class="table table-hover" width="100%">
				<thead>
					<th class="text-center">No</th>
					<th class="text-center">Division</th>
					<th class="text-center">Action</th>
				</thead>
				<tbody>
					@foreach($admin as $admins)
					<tr>
					<td class="text-center">{{ $loop->index+1 }}</td>
					<td class="text-center">{{ $admins->division }}</td>
					<td class="text-center" align="center">
						<div class="btn-group">
					<a href="{{ url('admin/deletedivisi/') }}/{{ $admins->id_division }}" onclick="return confirm('Are You Sure!')" class="btn-floating red"><i class="fa fa-trash-o"></i></a>
					{{ csrf_field() }}
					<a href="{{url('/admin/editdivisi/')}}/{{ $admins->id_division }}" onclick="return confirm" class="btn-floating orange accent-3"><i class="fa fa-pencil"></i></a>					
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
