@extends('karyawan::layouts.master')
@section('title','Data Slip Gaji')

@section('content')
<div class="row">
	<a href="" class="btn btn-dark" id="print" onclick="window.print()" style="margin-left:1.4%">Print <span class="fa fa-print"></span></a>
	<div class="col-12">
		<div class="card card-body">
		<h3><b>PT. COMPANY </b></h3>
		<p>Human Resource Managament System</p>
		<p style="margin-top:-8px">Jl.Jendral H Edisukma No.23,Bogor Selatan Phone Number 0251-22222</p>
		<hr style="margin-top:-10px">
		<h4><b>Slip Gaji Karyawan</b></h4>
		<div class="row">
			<div class="col-md-8 offset-md-1">
				<table>
					<tbody>
						<tr class="text-left">
							<td><h6>ID Employee</h6></td>
							<td><h6>:</h6></td>
							<td><h6>{{ $id_employee }}</h6></td>
						</tr>
						<tr class="text-left">
							<td><h6>Name</h6></td>
							<td><h6>:</h6></td>
							<td><h6>{{ Auth::user()->name }}</h6></td>
						</tr>
						<tr class="text-left">
							<td><h6>Position</h6></td>
							<td><h6>:</h6></td>
							<td><h6>{{ $job->job }}</h6></td>
						</tr>
						<tr class="text-left">
							<td><h6>Division</h6></td>
							<td><h6>:</h6></td>
							<td><h6>{{ $division->division }}</h6></td>
						</tr>
					</tbody>
				</table>
				<br>
				</div>
				<div class="col-md-10 offset-md-1">
				<h5><b>Sallary</b></h5>
				<hr>
				<div class="col-md-8 offset-md-3">	
				<table id="penghasilan">
					<tr class="text-left">
						<td><h5>Gaji Pokok</h5></td>
						<td><h5>:</b></td>
						<td><h5>Rp.{{ number_format($job->salary,2,',','.') }}</b></td>
					</tr>
					@foreach ($penghasilan as $hasil)
					<tr class="text-left">
						<td><h5>{{ $hasil->allowance_title }}</h5></td>
						<td><h5>:</h5></td>
						<td><h5>Rp.{{ number_format($hasil->allowance_amount,2,',','.') }}</h5></td>
					</tr>
						@endforeach
					<tr>
						<td colspan="3"><hr></td>
						<td><h5>(+)</h5></td>
					</tr>
					<tr class="text-left">
						<td><h5>Total</h5></td>
						<td><h5>:</h5></td>
						<td><h5>Rp.{{ number_format($total,2,',','.') }}</h5></td>
					</tr>
				</table>
				</div>
			</div>
		</div>
		<div class="col-md-4 offset-md-8" style="margin-top:10%" id="ttd">
		<p class="text-center">Division Manager</p>
		<br><br><br>
		<p class="text-center">(..................................................)</p>
		</div>
		</div>
	</div>
</div>
<br><br>
@endsection