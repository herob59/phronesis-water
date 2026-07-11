<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', config('app.name'))</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/css/app.css','resources/js/app.js'])

    <style>

        body{
            background:#f4f7fb;
            min-height:100vh;
        }

        .auth-wrapper{
            min-height:100vh;
            display:flex;
            align-items:center;
            justify-content:center;
            padding:40px 15px;
        }

        .auth-card{

            border:none;
            border-radius:18px;
            overflow:hidden;
            box-shadow:0 15px 45px rgba(0,0,0,.08);

        }

        .left-panel{

            background:linear-gradient(135deg,#0d6efd,#0dcaf0);
            color:#fff;
            padding:60px;

        }

        .left-panel h2{

            font-weight:700;

        }

        .factory-icon{

            width:80px;
            height:80px;
            border-radius:50%;
            background:rgba(255,255,255,.2);
            display:flex;
            justify-content:center;
            align-items:center;
            font-size:40px;
            margin-bottom:25px;

        }

        .right-panel{

            background:#fff;
            padding:50px;

        }

        .form-control{

            height:50px;

        }

        .btn-primary{

            height:50px;

        }

    </style>

</head>

<body>

<div class="container auth-wrapper">

    <div class="row auth-card w-100" style="max-width:1100px;">

        <div class="col-lg-5 d-none d-lg-flex left-panel flex-column justify-content-center">

            <div class="factory-icon">
                💧
            </div>

            <h2>Water Factory ERP</h2>

            <p class="mt-3">

                Production Management<br>
                Inventory Control<br>
                Sales & Delivery<br>
                Customer Management<br>
                Reports & Analytics

            </p>

            <hr>

            <small>
                © {{ date('Y') }}
                {{ config('app.name') }}
            </small>

        </div>

        <div class="col-lg-7 right-panel">

            @yield('content')

        </div>

    </div>

</div>

</body>

</html>