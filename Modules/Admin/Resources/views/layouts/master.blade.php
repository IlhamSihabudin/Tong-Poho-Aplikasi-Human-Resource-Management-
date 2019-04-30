<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    
    <!-- Responsive DataTable CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    
    <link rel="shorcut icon" href="{{ asset('picture/logo-kecil.png') }}">

    <link rel="shorcut icon" href="{{ asset('picture/Tong-Poho.png') }}">
    <!-- MDBootstrap Datatables  -->
    <link rel="stylesheet" href="{{ asset('css/addons/datatables.min.css') }}">


    <!-- Bootstrap core CSS -->
    <link href="{{ asset('dashboard/css/bootstrap.min.css') }}" rel="stylesheet">

     <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('dashboard/css/mdb.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway|Source+Sans+Pro|Varela+Round" rel="stylesheet">
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

                        <li><a href="{{ route('admin_index') }}" class="collapsible-header waves-effect"><i class="fa fa-home" aria-hidden="true"></i>Home</i></a></li>
                        <li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-user" aria-hidden="true"></i>Employee Data<i class="fa fa-angle-down rotate-icon"></i></a>
                            <div class="collapsible-body">
                                <ul class="list-unstyled">
                                    <li><a href="{{ route('admin_tampil_input') }}" class="waves-effect">Input Employee Data</a>
                                    </li>
                                    <li><a href="{{ route('admin_showdp') }}" class="waves-effect">Show Employee Data</a>
                                    </li>
                                    <li><a href="{{ route('admin_contract') }}" class="waves-effect">Add Contract</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-briefcase" ></i></i>Position Data<i class="fa fa-angle-down rotate-icon"></i></a>
                            <div class="collapsible-body">
                                <ul class="list-unstyled">
                                    <li><a href="{{ url('/admin/tampilijob') }}" class="waves-effect">Input Position</a>
                                    </li>
                                    <li><a href="{{ url('/admin/showjob') }}" class="waves-effect">Show Position</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-eye"></i>Data Division<i class="fa fa-angle-down rotate-icon"></i></a>
                            <div class="collapsible-body">
                                <ul class="list-unstyled">
                                    <li><a href="{{ url('/admin/tampildiv') }}" class="waves-effect">Input Division</a>
                                    </li>
                                    <li><a href="{{ url('/admin/showdivisi') }}" class="waves-effect">Show Division</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
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
                <p><a href="{{ route('admin_index') }}">HR Management</a></p>
            </div>
            <ul class="nav navbar-nav nav-flex-icons ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="fa fa-user"></span>
                    {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('admin_detailprofile') }}">Profile <span class="fa fa-user"></span></a>
                        <a class="dropdown-item" href="{{ route('admin_changepassword') }}">Change Password<span class="fa fa-gear"></span></a>
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
    <footer class="page-footer text-center text-md-left mt-4 pt-4">

        <!--Footer Links-->
        <div class="container-fluid">
            <div class="row">

               

            </div>
        </div>
        <!--/.Footer Links-->

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

    <!-- Responsive DataTable JS -->
     <script src="{{ asset('js/select2.min.js') }}"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>

    <!-- Sweet Alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="{{ asset('dashboard/js/mdb.min.js') }}"></script>
        <!-- MDBootstrap Datatables -->
<script type="text/javascript" src="{{ asset('js/addons/datatables.min.js') }}"></script>
<!-- Optional: include a polyfill for ES6 Promises for IE11 and Android browser -->
<script src="{{ asset('https://cdn.jsdelivr.net/npm/promise-polyfill') }}"></script>
    
    @include('sweet::alert')

    <script>
            // Material Select Initialization

    // // Validasi Image
    // function readURL(input)
    // {
    //     if (input.files[0])
    //     {
    //         var reader = new FileReader();

    //         reader.onload = function (e)
    //         {
    //             $('#profile-img-tag').attr('src', e.target.result);
    //         }
    //         reader.readAsDataURL(input.files[0]);
    //     }
    // }
    // $('#profile-img').change(function(){
    //     var Photosize = document.getElementById("profile-img").files(0);
    //     if (Photosize.size > 5000000) {
    //         swal('Error','Size must not exceed 5MB','error');
    //     }else{
    //         readURL(this);
    //     }
    // });

$(document).ready(function() {
   $('.mdb-select').material_select();

   $('#btds').on('submit',function(){
        $('.btn-submit').attr('disabled','true');
   });
   //DataTables
   $('#dtMaterialDesignExample').dataTable( {
    scrollY:        200,
    deferRender:    true,
    scroller:       true
} );
   $('#dtMaterialDesignExample').DataTable();
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
 });
         // SideNav Initialization
        $(".button-collapse").sideNav();

         $('#user_profile').on('submit',function(){
            $('.button-prevent').attr('disabled','true');
        });
        
        new WOW().init();

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
        Alert('Error','Ukuran tidak boleh lebih dari 5 Mb ','error');
    } else{
        readURL(this);
    } });

         $('#date-picker-example').pickadate({
            max: [2002,01,01],
            formatSubmit: 'yyyy-mm-dd'
         });

   // Get the elements
var from_input = $('#startingDate').pickadate({formatSubmit: 'yyyy-mm-dd'}),
    from_picker = from_input.pickadate('picker')
var to_input = $('#endingDate').pickadate({formatSubmit: 'yyyy-mm-dd'}),
    to_picker = to_input.pickadate('picker')

    $('#job').select2();
    $('#job_edit').select2();
    $('#division').select2();
    $('#division_edit').select2();

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
})       
    </script>
    <!-- Diagram Chart -->
    @if(@$countp)
    <script>
var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["Number Of Employee", "Number Of Job", "Number Of Division"],
        datasets: [{
            label: 'Diagram',
            data: [{{ $countp .','.$countj .','.$countd}}],
            backgroundColor: [
                'rgba(3, 169, 244, 0.7)',
                'rgba(255, 152, 0, 0.7)',
                'rgba(76, 175, 80, 0.7)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ]
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
</script>
    @endif

</body>

</html>
