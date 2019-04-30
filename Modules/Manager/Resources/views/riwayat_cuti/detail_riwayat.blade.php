@extends('manager::layouts.master')
@section('title','Manager | Leave History')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- Card -->
            <div class="card testimonial-card">

                <!-- Bacground color -->
                <div class="card-up color-block blue-gradient">
                </div>

                <!-- Avatar -->
                <!-- Avatar -->
                <div class="avatar mx-auto white">
                    <img src="{{ asset('upload/'.$data->photo) }}" class="rounded-circle" style="width: 110px;height: 110px">
                </div>

                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-5">
                            <!-- Name -->
                            <h2 class="card-title">{{ $data->name }}</h2>
                            <hr>
                            <!-- Quotation -->
                            <p style="font-size: 18pt;color: grey;">{{ $jobs[0]->job }} <span style="color: #000;">|</span> {{ $divisions[0]->division }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="card-title">Sick</h4>
                            <hr style="align-items: center;width: 250px">
                            <div class="table-responsive col-md-12">
                                <table id="tablePreview" class="table table-striped table-borderless">
                                    <tbody>
                                    @foreach($sakit as $sakits)
                                        <tr>
                                            <th scope="row">{{ $loop->index+1 }}.</th>
                                            <td>{{ date('l, d F Y', strtotime($sakits->clock_in)) }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h4 class="card-title">Permit</h4>
                            <hr style="align-items: center;width: 250px">
                            <div class="table-responsive col-md-12">
                                <table id="tablePreview" class="table table-striped table-borderless">
                                    <tbody>
                                    @foreach($izin as $izins)
                                        <tr>
                                            <th scope="row">{{ $loop->index+1 }}.</th>
                                            <td>{{ date('l, d F Y', strtotime($izins->clock_in)) }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- Card -->
        </div>
    </div>
    <br>

    </div>
    </div>
@stop