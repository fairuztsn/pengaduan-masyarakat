<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset("static/css/app.css") }}" rel="stylesheet">
    <title>Laporin</title>
    <style>
        @font-face {
			font-family: Poppins;
			src: url("/fonts/poppins/Poppins-Regular.ttf");
			font-weight: normal;
			font-style: normal;
		}

        * {
            font-family: Poppins;
        }
    </style>
</head>
<body class="">
    <div class="row d-flex justify-content-center align-items-center" style="height: 500px;">
        <div class="col-4 text-center">
            <div id="img">
                <img src="{{ asset("img/credit-tradeline.jpg") }}" alt="" class="m-3 rounded" style="width: 200px;">
            </div>
            <h1>Laporin <span class="text-sm opacity-75">keluhan/pengaduan-mu</span>.</h1>
            <div class="login-register d-flex justify-content-center align-items-center">
                <div>
                    <div class="d-flex justify-content-center align-items-center">
                        <a href="{{ route("login") }}" class="btn btn-outline-dark m-2 form-control">Masuk</a>
                    </div>
                    <span class="text-sm opacity-50 m-2">atau</span>
                    <a href="{{ route("register") }}" class="link-primary">Daftar</a>
                </div>
                
            </div>
        </div>
    </div>
    {{-- scripts --}}
	<script src="{{ asset("static/js/app.js" )}}"></script>
</body>
</html>