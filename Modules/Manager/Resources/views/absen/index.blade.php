@extends('manager::layouts.master')
@section('title','Manager | Absent Report')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-header" style="padding: 2px;"></div>
                <div class="card-body">
                    <form action="{{ url(route('report_absen')) }}" method="get">
                        <div class="row align-content-center">
                            <div class="col-md-10 col-sm-12">
                                <label for="" class="forn-control-label" style="font-size: 14pt">Period of Absence</label>
                                <!--Grid row-->
                                <div class="row">
                                    <!--Grid column-->
                                    <div class="col-md-6 mb-4">

                                        <div class="md-form">
                                            <!--The "from" Date Picker -->
                                            <input type="text" id="startingDate" class="form-control datepicker" name="tgl_awal">
                                            <label for="startingDate">Select Start Date</label>
                                        </div>

                                    </div>
                                    <!--Grid column-->

                                    <!--Grid column-->
                                    <div class="col-md-6 mb-4">

                                        <div class="md-form">
                                            <!--The "to" Date Picker -->
                                            <input type="text" id="endingDate" class="form-control datepicker" name="tgl_akhir">
                                            <label for="endingDate">Select End Date</label>
                                        </div>

                                    </div>
                                    <!--Grid column-->

                                </div>
                                <!--Grid row-->
                            </div>
                            <div class="col-md-2 col-sm-12 align-self-center">
                                <button type="submit" class="btn btn-primary btn-lg btn-block mt-2">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br>

    </div>
    </div>
@stop