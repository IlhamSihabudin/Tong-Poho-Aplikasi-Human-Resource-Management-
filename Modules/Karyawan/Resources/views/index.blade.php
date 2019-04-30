@extends('karyawan::layouts.master')
@section('title','Karyawan | Home')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card testimonial-card">
            <div class="card-up blue-gradient"></div>
                 <div class="avatar mx-auto white"><img src="{{ asset('/upload/'.'/'.Auth::user()->photo) }}" class="rounded-circle" width="110px" height="110px">
                </div>
                    <div class="card-body">
                     <h3 class="card-title wow fadeInDown blue-text">Welcome {{ Auth::user()->name }} !</h3>
                    <hr>
                        <p style="font-size:20px" class="wow fadeInDown">Hopefully today is better than yesterday</p>
                            <form action="{{ route('clockin_karyawan') }}" method="post" id="pengajuan">
                                 @if ($date_now == $date_clockin)
                                     <p class="wow fadeIn" data-wow-duration="2s"
                                    data-wow-delay="1s">Thank you, you already clockin today</p>
                                 @elseif($only_time >= $jam_masuk && $only_time <= $max_clockin && $hari <= 5)
                                    @csrf
                                 <button type="submit" class="btn blue-gradient btn-lg button-prevent" name="clock_in">Clock In <span class="spinner fa fa-spinner fa-spin"></span></button>
                                 @endif
                             </form>

                             <form action="{{ route('clockout_karyawan') }}" method="post" id="pengajuan">
                                {{ method_field('PATCH') }}
                                 @if ($date_clockout == $date_now)
                                <p>See you next time</p>
                                 @elseif($only_time >= $jam_keluar && $date_now == $date_clockin && $only_time <= $max_clockout && $hari <= 5)
                                @csrf
                                <button type="submit" class="btn blue-gradient btn-lg button-prevent" name="clock_out">Clock Out <span class="spinner fa fa-spinner fa-spin"></span></button>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
               
                @foreach($birthday as $birthdays)
                     <div class="col-md-4 col-6" style="margin-top:3%">
                    <div class="card">
                        <div class="view-overlay">
                            <img src="{{ asset('picture/').'/'.$photo_birthday[$loop->index + 1] }}" alt="" class="card-img-top" height="220px" width="200px">
                        </div>
                        <div class="card-body stylish-color white-text rounded-bottom">
                            <h4 class="card-title">{{ $birthdays->name }}</h4>
                            <hr class="hr-light">
                            <p class="card-text white-text">Today {{ $birthdays->name }} 's birthday, give him a birthday greeting and a wish</p>
                        </div>
                    </div>
                </div>
                @endforeach
               
</div>
<br>
<br>
@stop

