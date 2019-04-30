
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>JSP | Dashboard</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('dashboard/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Material Design Bootstrap -->
    <link href="{{ asset('dashboard/css/mdb.min.css') }}" rel="stylesheet">

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
                       <img src="{{ asset('img/Tong-Poho.png') }}" alt="" width="100px">
                    </div>
                </li>
                <!--/. Logo -->
                <!-- Side navigation links -->
                <li>
                    <ul class="collapsible collapsible-accordion">
                        <li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-chevron-right"></i> Submit blog<i class="fa fa-angle-down rotate-icon"></i></a>
                            <div class="collapsible-body">
                                <ul class="list-unstyled">
                                    <li><a href="#" class="waves-effect">Submit listing</a>
                                    </li>
                                    <li><a href="#" class="waves-effect">Registration form</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-hand-pointer-o"></i> Instruction<i class="fa fa-angle-down rotate-icon"></i></a>
                            <div class="collapsible-body">
                                <ul class="list-unstyled">
                                    <li><a href="#" class="waves-effect">For bloggers</a>
                                    </li>
                                    <li><a href="#" class="waves-effect">For authors</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-eye"></i> About<i class="fa fa-angle-down rotate-icon"></i></a>
                            <div class="collapsible-body">
                                <ul class="list-unstyled">
                                    <li><a href="#" class="waves-effect">Introduction</a>
                                    </li>
                                    <li><a href="#" class="waves-effect">Monthly meetings</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-envelope-o"></i> Contact me<i class="fa fa-angle-down rotate-icon"></i></a>
                            <div class="collapsible-body">
                                <ul class="list-unstyled">
                                    <li><a href="#" class="waves-effect">FAQ</a>
                                    </li>
                                    <li><a href="#" class="waves-effect">Write a message</a>
                                    </li>
                                    <li><a href="#" class="waves-effect">FAQ</a>
                                    </li>
                                    <li><a href="#" class="waves-effect">Write a message</a>
                                    </li>
                                    <li><a href="#" class="waves-effect">FAQ</a>
                                    </li>
                                    <li><a href="#" class="waves-effect">Write a message</a>
                                    </li>
                                    <li><a href="#" class="waves-effect">FAQ</a>
                                    </li>
                                    <li><a href="#" class="waves-effect">Write a message</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
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
                <li class="nav-item dropdown">
                  <a href="#" class="nav-link fa fa-envelope"><span class="badge badge-danger">3</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="fa fa-user"></span>
                    {{ Auth::user()->name }} 
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Profile <span class="fa fa-user"></span></a>
                        <a class="dropdown-item" href="#">Help <span class="fa fa-gear"></span></a>
                        <a href="{{ url('logout') }}" class="dropdown-item">Logout</a>
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

            
        
        </div>
        
    </main>
    <!--/Main layout-->

    <!--Footer-->
    <footer class="page-footer text-center text-md-left pt-4">

        <!--Footer Links-->
        <div class="container-fluid">
            <div class="row">

               

            </div>
        </div>
        <!--/.Footer Links-->

        <!--Social buttons-->
        <div class="social-section text-center">
            <ul class="list-unstyled list-inline">
                <li class="list-inline-item"><a class="btn-floating btn-fb"><i class="fa fa-facebook"> </i></a></li>
                <li class="list-inline-item"><a class="btn-floating btn-tw"><i class="fa fa-twitter"> </i></a></li>
                <li class="list-inline-item"><a class="btn-floating btn-gplus"><i class="fa fa-google-plus"> </i></a></li>
                <li class="list-inline-item"><a class="btn-floating btn-li"><i class="fa fa-linkedin"> </i></a></li>
                <li class="list-inline-item"><a class="btn-floating btn-git"><i class="fa fa-github"> </i></a></li>
            </ul>
        </div>
        <!--/.Social buttons-->

        <!--Copyright-->
        <div class="footer-copyright py-3 text-center">
            <div class="container-fluid">
              &copy; P Gans 2020202020
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

    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="{{ asset('dashboard/js/mdb.min.js') }}"></script>
    <script>

         // SideNav Initialization
        $(".button-collapse").sideNav();
        
        new WOW().init();
    
    </script>

</body>

</html>
