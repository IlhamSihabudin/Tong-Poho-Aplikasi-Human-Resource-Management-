<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">

    <link rel="shorcut icon" href="{{ asset('picture/logo-kecil.png') }}">


    <!-- Bootstrap core CSS -->
    <link href="{{ asset('dashboard/css/bootstrap.min.css') }}" rel="stylesheet">

    {{--DataTables--}}
    <link href="{{ asset('css/addons/datatables.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">

    <!-- Material Design Bootstrap -->
    <link href="{{ asset('dashboard/css/mdb.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway|Source+Sans+Pro|Varela+Round" rel="stylesheet">

    <!-- Select2 -->
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />

    <style>
        .hover:hover{
            transition: ease-in 0.3s;
            box-shadow: 3px 3px 10px grey;
        }
    </style>
</head>

<body class="fixed-sn white-skin">
<!--Double navigation-->
<header>
    <!-- Sidebar navigation -->
    <div id="slide-out" class="side-nav fixed">
        <ul class="custom-scrollbar">
            <!-- Logo -->
            <li>
                <br>
                <div class="text-center">
                    <img src="{{ asset('picture/Tong-Poho.png') }}" alt="" width="100px">
                </div>
            </li>
            <!--/. Logo -->
            <!-- Side navigation links -->
            <li>
                <ul class="collapsible collapsible-accordion">
                    <li><a href="{{ route('home_manager') }}" class="collapsible-header waves-effect"><i class="fa fa-home"></i> Home</a></li>
                    <li><a href="{{ route('absen') }}" class="collapsible-header waves-effect"><i class="fa fa-file"></i> Absent Report</a></li>
                    <li><a href="{{ route('riwayat') }}" class="collapsible-header waves-effect"><i class="fa fa-history"></i> Employee Leave History</a></li>
                    <li><a href="{{ route('tunjangan') }}" class="collapsible-header waves-effect"><i class="fa fa-dollar"></i> Allowances</a></li>
                </ul>
            </li>
            <!--/. Side navigation links -->
        </ul>
        <div class="sidenav-bg mask-strong"></div>
    </div>
    <!--/. Sidebar navigation -->
    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-toggleable-md navbar-expand-lg scrolling-navbar double-nav">
        <!-- SideNav slide-out button -->
        <div class="float-left">
            <a href="#" data-activates="slide-out" class="button-collapse black-text"><i class="fa fa-bars"></i></a>
        </div>
        <!-- Breadcrumb-->
        <div class="breadcrumb-dn mr-auto">
            <p><a href="{{ route('home_manager') }}">HR Management</a></p>
        </div>
        <ul class="nav navbar-nav nav-flex-icons ml-auto">
            <li class="nav-item dropdown">
                @if(count($notify) > 0)
                    <a href="{{ route('notifikasi_manager') }}" class="nav-link"><i class="fa fa-bell animated swing infinite text-warning"></i></a>
                @else
                    <a href="{{ route('applied_manager') }}" class="nav-link"><i class="fa fa-bell-o"></i></a>
                @endif
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="fa fa-user"></span>
                    {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                    <a href="{{ route('detail_profile') }}" class="dropdown-item" href="#">Profile <span class="fa fa-user"></span></a>
                    <a href="{{ route('change_password_manager') }}" class="dropdown-item">Change Password <span class="fa fa-gear"></span></a>
                    <a href="{{ url('logout') }}" class="dropdown-item">Logout <span class="fa fa-sign-out"></span></a>
                </div>
            </li>
        </ul>
    </nav>
    <!-- /.Navbar -->
</header>
<!--/.Double navigation-->

<!--Main layout-->
<main>
    <div class="container-fluid">
        @yield('content')
    </div>
</main>
<!--/Main layout-->

<!--Footer-->
<footer class="page-footer text-center text-md-left pt-4">

    <!--Copyright-->
    <div class="footer-copyright py-3 text-center">
        <div class="container-fluid">
            &copy; Tong Poho 2018
        </div>
    </div>
    <!--/.Copyright-->

</footer>
<!--/.Footer-->

<!-- SCRIPTS -->

<!-- JQuery -->
<script type="text/javascript" src="{{ asset('dashboard/js/jquery-3.3.1.min.js') }}"></script>

<!-- Tooltips -->
<script type="text/javascript" src="{{ asset('dashboard/js/popper.min.js') }}"></script>

<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="{{ asset('dashboard/js/bootstrap.min.js') }}"></script>

{{--DataTables--}}
<script type="text/javascript" src="{{ asset('js/addons/datatables.min.js') }}"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>

<!-- MDB core JavaScript -->
<script type="text/javascript" src="{{ asset('dashboard/js/mdb.min.js') }}"></script>

{{--Select2--}}
<script src="{{ asset('js/select2.min.js') }}"></script>

{{--SweetAlert--}}
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- Include this after the sweet alert js file -->
@include('sweet::alert')

{{--Alert Home--}}


<script>
    // DataTable
    $(document).ready(function () {
        $('#dtMaterialDesignExample').DataTable({
            "responsive": true,
        });
        $('#dtMaterialDesignExample_wrapper').find('label').each(function () {
            $(this).parent().append($(this).children());
        });
        $('#dtMaterialDesignExample_wrapper .dataTables_filter').find('input').each(function () {
            $('input').attr("placeholder", "Search");
            $('input').removeClass('form-control-sm');
        });
        $('#dtMaterialDesignExample_wrapper .dataTables_length').addClass('d-flex flex-row');
        $('#dtMaterialDesignExample_wrapper .dataTables_filter').addClass('md-form');
        $('#dtMaterialDesignExample_wrapper select').removeClass('custom-select custom-select-sm form-control form-control-sm');
        $('#dtMaterialDesignExample_wrapper select').addClass('mdb-select');
        $('#dtMaterialDesignExample_wrapper .mdb-select').material_select();
        $('#dtMaterialDesignExample_wrapper .dataTables_filter').find('label').remove();
        $('#startingDate').removeAttr('placeholder');
        $('#endingDate').removeAttr('placeholder');

        //Data Tables Home
        $('#datatables').DataTable({
            "scrollY": '30vh',
            "scrollCollapse": true,
            "searching": false,
            "info": false,
        });
        $('#datatables_wrapper').find('label').each(function () {
            $(this).parent().append($(this).children());
        });
        $('#datatables_wrapper .dataTables_filter').find('input').each(function () {
            $('input').attr("placeholder", "Search");
            $('input').removeClass('form-control-sm');
        });
        $('#datatables_wrapper .dataTables_length').addClass('d-flex flex-row');
        $('#datatables_wrapper .dataTables_filter').addClass('md-form');
        $('#datatables_wrapper select').removeClass('custom-select custom-select-sm form-control form-control-sm');
        $('#datatables_wrapper select').addClass('mdb-select');
        $('#datatables_wrapper .mdb-select').material_select();
        $('#datatables_wrapper .dataTables_filter').find('label').remove();
        $('#startingDate').removeAttr('placeholder');
        $('#endingDate').removeAttr('placeholder');

        //datePicker
        $('#tgl_lahir').pickadate({
            formatSubmit: 'yyyy-mm-dd',
            max: [2002,11,31],
        });

        // Select2
        $('.js-example-basic-single').select2({
            placeholder: "Select Employee",
            allowClear: true
        });

        //validasi Image
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#profile-img-tag').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#profile-img").change(function(){
            var Photosize = document.getElementById("profile-img").files[0];
            if (Photosize.size > 5000000) {
                swal('Error','Size Must Not Exceed 5MB','error');
            } else{
                readURL(this);
            }
        });
    });

    //Validate Button
    $('#val-form').on('submit', function () {
        $('#val-button').attr('disabled', 'true');
    });

    // SideNav Initialization
    $(".button-collapse").sideNav();

    new WOW().init();

    @if(@$only_time)
    //bar
    var ctxB = document.getElementById("barChart").getContext('2d');
    var myBarChart = new Chart(ctxB, {
        type: 'bar',
        data: {
            labels: ["Clock In", "Not yet Clock In", "Late", "Sick", "Permit"],
            datasets: [{
                label: ["Absent Today"],
                data: [{{ $clockin . ',' . $belum_clockin . ',' . $telat . ',' . $sakit . ',' . $izin}}],
                backgroundColor: [
                    '#2196F3',
                    '#009688',
                    '#F44336',
                    '#FFC107',
                    '#446CB3'
                ],
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });
    @endif
</script>

@if(@$aktif_absen)
    <script type="text/javascript">
        // Get the elements
        var from_input = $('#startingDate').pickadate({
                formatSubmit: 'yyyy-mm-dd',
                max: true
            }),
            from_picker = from_input.pickadate('picker')
        var to_input = $('#endingDate').pickadate({
                formatSubmit: 'yyyy-mm-dd',
                max: true
            }),
            to_picker = to_input.pickadate('picker')

        // Check if there’s a “from” or “to” date to start with and if so, set their appropriate properties.
        if ( from_picker.get('value') ) {
            to_picker.set('min', from_picker.get('select'))
        }
        if ( to_picker.get('value') ) {
            from_picker.set('max', to_picker.get('select'))
        }

        // Apply event listeners in case of setting new “from” / “to” limits to have them update on the other end. If ‘clear’ button is pressed, reset the value.
        from_picker.on('set', function(event) {
            if ( event.select ) {
                to_picker.set('min', from_picker.get('select'))
            }
            else if ( 'clear' in event ) {
                to_picker.set('min', false)
            }
        })
        to_picker.on('set', function(event) {
            if ( event.select ) {
                from_picker.set('max', to_picker.get('select'))
            }
            else if ( 'clear' in event ) {
                from_picker.set('max', false)
            }
        });
    </script>
@endif
</body>
</html>
