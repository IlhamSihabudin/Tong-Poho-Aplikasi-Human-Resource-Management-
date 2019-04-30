<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="picture/logo-kecil.png" />
    <title>Tong Poho | Login</title>
    <style type="text/css">
        body{
            margin: 0;
            padding: 0;
            background-color: whitesmoke;
        }

        #main{
            position: absolute;
            height: 70px;
            width: 70px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            overflow: hidden;
            font-family: arial;
            font-size: 12pt;
            color: #2096ff;
            line-height: 30px;
        }
        #d{
            height: 35px;
            width: 35px;
            background-color: #2096ff;
            position: absolute;
        }
        #d:nth-child(1){
            top: 35px;
            left: 0;
        }
        #d:nth-child(2){
            top: 35px;
            left: 35px;
            animation: effect1 1s infinite linear;
        }
        #d:nth-child(3){
            top: 0;
            left: 0;
            animation: effect2 1s infinite linear;
        }
        #d:nth-child(4){
            top: 0;
            left: 35px;
            animation: effect3 1s infinite linear;
        }
        #bigsqr{
            position: relative;
            width: 70px;
            height: 70px;
            overflow: hidden;
            transform-origin: bottom left;
            animation: bigsqrEffect 1s infinite linear;
        }
        @-webkit-keyframes effect1{
            0%{
                transform: translateY(-50px);
            }
            25%{
                transform: translateY(0px);
            }
            100%{
                transform: translateY(0px);
            }
        }
        @-webkit-keyframes effect2{
            0%{
                transform: translateY(-50px);
            }
            50%{
                transform: translateY(0px);
            }
            100%{
                transform: translateY(0px);
            }
        }
        @-webkit-keyframes effect3{
            0%{
                transform: translateY(-50px);
            }
            75%{
                transform: translateY(0px);
            }
            100%{
                transform: translateY(0px);
            }
        }
        @-webkit-keyframes bigsqrEffect{
            0%{
                transform: scale(1);
            }
            90%{
                transform: scale(1);
            }
            100%{
                transform: scale(0.5);
            }
        }
    </style>
</head>
<body>
<div id="main">
    <div id="bigsqr">
        <div id="d"></div>
        <div id="d"></div>
        <div id="d"></div>
        <div id="d"></div>
    </div>
</div>
<script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
<script>
    var count = 1;
    setInterval(function() {
        if (count == 0) {
            @if (Auth::user()->id_job == "1")
                document.location.href="{{ url('/admin') }}";
            @elseif(Auth::user()->id_job == "2")
                 document.location.href="{{ url('/manager') }}";
             @else
                 document.location.href="{{ url('/karyawan') }}";     
            @endif
        }
        count--;
    }, 700);
</script>
</body>
</html>