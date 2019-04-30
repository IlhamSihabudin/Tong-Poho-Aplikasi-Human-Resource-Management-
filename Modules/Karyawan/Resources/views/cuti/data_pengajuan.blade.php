@extends('karyawan::layouts.master')

@section('title','Data Pengajuan Cuti')
@section('content')
<div class="row">
	<div class="col-md-12">
		<h3 class="text-left">Leave Data</h3>
		<hr>
		<div class="row">
			@if ($sisa_cuti == NULL || $sisa_cuti == 0)
			<a onclick="toastr.info('Sorry You Have No Leftovers')" class="btn btn-primary text-left">Rest Of Leave</a>
			@else	
			<a onclick="toastr.info('Your Remaining Leave '+ {{ $sisa_cuti }}  +' Days Left')" class="btn btn-primary text-left">Rest Of Leave</a>
			@endif
			<a href="{{ route('buatpengajuan') }}" class="btn btn-success">Create Submission <span class="fa fa-plus-circle"></span></a>
		</div>
		<br>
		<table class="table table-bordered table-hover dt-responsive" id="dtMaterialDesignExample" width="100%">
			<thead>
				<tr class="text-center">
				<th>#</th>
				<th>Type Of Leave</th>
				<th>Submission Date</th>
				<th>Statement</th>
				<th>Start Date</th>
				<th>End Date</th>
				<th>Total Days</th>
				<th data-priority="2">Status Confirmation</th>
				<th>Confirmation Date</th>
				<th data-priority="1">Action</th>
				</tr>
			</thead>
			<tbody>
				@if (count($data) <= 0)
					<tr>
						<td colspan="10">Data Empty</td>
					</tr>
				@else
				@foreach ($data as $datas)
				<tr class="text-center">
				<td>{{ $loop->iteration ++ }}</td>
				<td>{{ $datas->leave_type }}</td>
				<td>{{ date('d F Y',strtotime($datas->date_submission)) }}</td>
				<td>{{ $datas->statement }}</td>
				<td>{{ date('d F Y',strtotime($datas->date_begin)) }}</td>
				<td>{{ date('d F Y',strtotime($datas->date_end)) }}</td>
				<td>{{ $datas->total_of_leave }} Hari</td>
				@if ($datas->confirm_status == "Approve")
					<td style="color:green"><b>{{ $datas->confirm_status }} <span class="fa fa-thumbs-o-up"></span></b></td>
				@elseif($datas->confirm_status == "Reject")
				<td style="color:red"><b>{{ $datas->confirm_status }}</b></td>
				@else
				<td><b>{{ $datas->confirm_status }}</b></td>
				@endif
				@if ($datas->date_approve == Null)
				<td>-</td>
				@else
				<td>{{ date('d F Y H:i:s',strtotime($datas->date_approve)) }}</td>
				@endif
				@if ($datas->confirm_status == "Approve")
				<td><a href="javascript:void(0)" class="btn-floating btn-md btn-git" style="margin-left:20%;cursor: default;"><i class="fa fa-ban" id="delete_pengajuan"></i></a>
				</td>
				@else
				<td><a href="{{ url('/karyawan/cuti/hapus_pengajuan/id=') }}{{ $datas->id_submission}}" class="btn-floating btn-md btn-pin" style="margin-left:20%" id="hapus" onclick="return confirm('Are You Sure ?')"><i class="fa fa-trash"></i></a>
				</td>
				</tr>
				@endif
				@endforeach
				@endif
			</tbody>
		</table>
	</div>
</div>
<br><br>
@endsection