
<!DOCTYPEhtml>
<html lang="en">

<head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">

    <link rel="shortcut icon" href="{{ asset('picture/logo-kecil.png') }}" />


    <!-- Bootstrap core CSS -->
    <link href="{{ asset('dashboard/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard/css/mdb.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/addons/datatables.min.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lilita+One|Spectral" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">
    

    <script type="text/javascript" src="{{ asset('dashboard/js/jquery-3.3.1.min.js') }}"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
   
<style type="text/css">
.floating-button{
     position:fixed;
     width:55px;
     height:55px;
     bottom:30px;
     right:40px;
     background-color:#0C9;
     color:#FFF;
     border-radius:50px;
     text-align:center;
     box-shadow: 2px 2px 3px #999;
    }
    .my-float{
     margin-top:20px;
     margin-left:1px;
    }
.dropdown-menu.notify{
  top: 60px;
  right: 0px;
  left: unset;
  width: 460px;
  padding-bottom: 0px;
  padding: 0px;
}
.dropdown-menu.notify:before{
  position: absolute;
  top: -20px;
  right: 12px;
  border:10px solid #343A40;
  border-color: transparent transparent #343A40 transparent;
}
.spinner{
    display: none;
}
#no_message{
  margin-left:32%;
}
.field-icon {
  float: right;
  margin-right:10px;
  margin-top: -26px;
  position: relative;
  z-index: 2;
}
@media (min-width: 1024px){
    #penghasilan{
    margin-left:15%;
    }
}
@media print{
        #print{
            display: none;
        }
        footer{
            display: none;
        }
         #penghasilan{
            margin-left:8%;
        }
}
@media (max-width: 640px) {
    .dropdown-menu.notify{
      top: 50px;
      left:1px;  
      width: 225px;
    }
    #no_message{
       margin-left:15%;
    } 
   /* .nav .nav-item,.nav .nav-item a{
      padding-left: 15px;
    }*/
    .dropdown-menu.notify{
        top: 60px;
        padding-bottom: 20px;
        padding: 0px;
    }
    .message{
      font-size: 13px;
    }
    #ttd{
        margin-left:10%;
    }
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
                        <li><a href="{{ route('dashboard') }}" class="collapsible-header waves-effect arrow-r"><i class="fa fa-dashboard"></i>Home</a></li>
                        <li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-calendar-plus-o"></i>Filling Leave<i class="fa fa-angle-down rotate-icon"></i></a>
                            <div class="collapsible-body">
                                <ul class="list-unstyled">
                                    <li><a href="{{ route('buatpengajuan') }}" class="waves-effect">Create Submission</a>
                                    </li>
                                    <li><a href="{{ route('datapengajuan') }}" class="waves-effect">Submission Data</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li><a href="{{ route('slipgaji') }}" class="collapsible-header waves-effect arrow-r"><i class="fa fa-fax"></i>
                            Sallary
                        </a></li>
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
                <p>HR Management</p>
            </div>
            <ul class="nav navbar-nav nav-flex-icons ml-auto">
                <li class="nav-item dropdown" style="margin-top:3px">
                   @if (count($notify) > 0)
                  <a href="#" class="nav-link fa fa-bell-o animated swing infinite" id="notify" data-toggle="dropdown"> <span class="badge badge-danger">{{ count($notify) }}</span> </a>
                  @else
                  <a href="#" class="nav-link fa fa-bell-o" id="notify" data-toggle="dropdown"></a>
                  @endif
                   
                  <ul class="dropdown-menu notify">
                   <li class="text-light bg-light">
                          <div class="col-sm-12">
                            <p class="text-dark text-center">Notification</p>
                          </div>
                      </li>
                      @if(count($notify) > 0)
                      @foreach ($notify as $notifys)
                      <li class="list-group-item waves-effect" onclick="location.href='{{ URL('/karyawan/notify/'.$notifys->id_submission) }}'">
                        <div class="row">
                          <div class="col-3 text-center">
                            <img src="{{ asset('/upload/').'/'.$link_photo[$loop->index + 1]}}" class="w-50 rounded-circle">
                          </div>
                          <div class="col-8">
                            <strong class="text-info">{{ $notifys->approval }}</strong>
                            <div>
                                @if ($notifys->confirm_status == "Approve")
                                    Your Submission Has been Approved<i style="color:green" class="fa fa-check-circle"></i>
                                @else
                                    I'm Sorry Your Submission Has Been Rejected <i style="color:red" class="fa fa-remove"></i>
                                @endif
                            </div>
                            <small class="text-warning">{{ date('d F Y H:i:s',strtotime($notifys->date_approve)) }}</small>
                          </div>    
                        </div>
                      </li>
                      @endforeach
                      @else
                       <li class="list-group-item waves-effect">
                        <div class="row" class="text-center">
                          <div class="col-12">
                            <strong class="text-info text-center" id="no_message">There's no message</strong>
                          </div>    
                        </div>
                      </li>
                      @endif
                      <li class="footer bg-light text-center">
                        <p>All</p>
                      </li>
                  </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="fa fa-user"></span>
                    {{ Auth::user()->name }} 
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('detailprofile_karyawan') }}">Profile <span class="fa fa-user"></span></a>
                        <a class="dropdown-item" href="{{ route('changepassword_karyawan') }}">Change Password <span class="fa fa-gear"></span></a>
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
        <div class="container-fluid text-center">
            @yield('content')
        </div>
    </main>
    <!--/Main layout-->

    <!--Footer-->
    <footer class="page-footer text-center text-md-left pt-4 mt-4">

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
    

    <!-- Tooltips -->
    <script type="text/javascript" src="{{ asset('dashboard/js/popper.min.js') }}"></script>

    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="{{ asset('dashboard/js/bootstrap.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js" type="text/javascript" ></script>

    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" type="text/javascript" ></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js" type="text/javascript" ></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js" type="text/javascript" ></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js" type="text/javascript" ></script>

    <!-- MDB core JavaScript !-->
    <script type="text/javascript" src="{{ asset('dashboard/js/mdb.min.js') }}"></script>
   @include('sweet::alert')
    <script>
       $(document).ready(function() {

        $('.mdb-select').material_select();
        $(".button-collapse").sideNav();
        new WOW().init();
        $('.datepicker').pickadate();
        //DataTablesMdb
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
        //EndDatatablesMDb
       
        //Profile Photo Auto Change
        function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#profile-img-tag').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
           }
       }
       //Validation Photo
        $("#profile-img").change(function(){
         var Photosize = document.getElementById("profile-img").files[0];
       if (Photosize.size > 2000000) {
        swal('Error','Ukuran tidak boleh lebih dari 2 Mb ','error');
        } else{
        readURL(this);
        } });
        //End ProfilePhoto
   
    $('#pengajuan').on('submit',function(){
        $('.button-prevent').attr('disabled','true');
        $('.icon').hide();
        $('.spinner').show();
    });
    //Show Password
    $(".toggle-password").click(function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
         var input = $($(this).attr("toggle"));
      if (input.attr("type") == "password") {
        input.attr("type", "text");
      } else {
        input.attr("type", "password");
      }
    });
    //EndPass

        });
    </script>
<script>
$('#tgl_mulai2').hide();
$('#tgl_berakhir2').hide();
$('#jenis_cuti').change(function(){
  if (this.value == "Sakit") {
    $('#tgl_mulai').hide(); 
    $('#tgl_berakhir').hide();
    $('#tgl_mulai2').show(); 
    $('#tgl_berakhir2').show(); 
  }
  if(this.value == "Izin"){
    $('#tgl_berakhir2').hide();
    $('#tgl_mulai2').hide();
     $('#tgl_mulai').show();
    $('#tgl_berakhir').show();
  }
});
var tgl_lahir = $('#birth_date').pickadate({
    formatSubmit:'yyyy/mm/dd',
    max:[2001,12,31],

});  
var from_input = $('#tgl_mulai').pickadate({
   formatSubmit: 'yyyy/mm/dd',
   min: true,
}),
    from_picker = from_input.pickadate('picker')
var to_input = $('#tgl_berakhir').pickadate({
    formatSubmit: 'yyyy/mm/dd',
    min: true,
}),
    to_picker = to_input.pickadate('picker')
    

// Check if there’s a “from” or “to” date to start with and if so, set their appropriate properties.
if ( from_picker.get('value') ) {
    to_picker.set('min', from_picker.get('select'))
}
if ( to_picker.get('value') ) {
    from_picker.set('max', to_picker.get('select'))
}
  
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


//Another date
var tgl_awal = $('#tgl_mulai2').pickadate({
  formatSubmit: 'yyyy/mm/dd',
  max:true,
}),
  awal_picker = tgl_awal.pickadate('picker')
var tgl_akhir = $('#tgl_berakhir2').pickadate({
  formatSubmit: 'yyyy/mm/dd',
  max:true,
}),
  akhir_picker = tgl_akhir.pickadate('picker')
// Check if there’s a “from” or “to” date to start with and if so, set their appropriate properties.
if ( awal_picker.get('value') ) {
    akhir_picker.set('min', awal_picker.get('select'))
}
if ( akhir_picker.get('value') ) {
    awal_picker.set('max', akhir_picker.get('select'))
}

// Apply event listeners in case of setting new “from” / “to” limits to have them update on the other end. If ‘clear’ button is pressed, reset the value.
awal_picker.on('set', function(event) {
    if ( event.select ) {
        akhir_picker.set('min', awal_picker.get('select'))
    }
    else if ( 'clear' in event ) {
        akhir_picker.set('min', false)
    }
})
akhir_picker.on('set', function(event) {
    if ( event.select ) {
        awal_picker.set('max', akhir_picker.get('select'))
    }
    else if ( 'clear' in event ) {
        awal_picker.set('max', false)
    }
});

</script>

</body>

</html>
