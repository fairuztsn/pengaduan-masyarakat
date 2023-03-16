<!DOCTYPE html>
<html lang="en">
<head>
	{{-- jQuery --}}
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield("title")</title>
    <link href="{{ asset("static/css/app.css") }}" rel="stylesheet">
	<link href="{{ asset("css/custom.css") }}" rel="stylesheet">
	
    @vite(['resources/js/app.js'])

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

		table {
			font-size: 10px;
		}
	</style>
	@yield("custom-css")
</head>
<body>
	<div class="wrapper">
		@if(Auth::check())
		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" style="text-decoration:none;" href="{{ route("dashboard") }}">
          <span class="align-middle">{{ __("Laporin")}}</span>
        </a>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Pages
					</li>
					<li class="sidebar-item {{Route::currentRouteName() == "dashboard" ? "active" : ""}}">
						<a class="sidebar-link" href="{{ route("dashboard") }}">
						<i class="align-middle" data-feather="sliders"></i> <span class="align-middle">{{ Auth::user()->role_id == 1 ? "Buat laporan" : "Dashboard" }}</span>
						</a>
					</li>
					{{-- if role is user --}}
					@if(Auth::user()->role_id == 1)
					<li class="sidebar-item {{ explode(".", Route::currentRouteName())[0] == "laporan" ? "active" : "" }}">
						<a class="sidebar-link" href="{{ route("laporan.index") }}">
						<i class="align-middle" data-feather="book"></i> <span class="align-middle">Riwayat Laporan</span>
						</a>
					</li>
					@endif
					
					{{-- if role is petugas or admin --}}
					@if(Auth::user()->role_id == 2 || Auth::user()->role_id == 3)
					<li class="sidebar-item {{ explode(".", Route::currentRouteName())[0] == "laporan" ? "active" : "" }}">
						<a class="sidebar-link" href="{{ route("laporan.index") }}">
						<i class="align-middle" data-feather="book"></i> <span class="align-middle">Laporan Pengaduan</span>
						</a>
					</li>
					@endif

					<li class="sidebar-item {{ explode(".", Route::currentRouteName())[0] == "tanggapan" ? "active" : "" }}">
						<a class="sidebar-link" href="{{ route("tanggapan.index") }}">
						<i class="fas fa-comment align-middle"></i> <span class="align-middle">Tanggapan</span>
						</a>
					</li>

					{{-- if role is admin --}}
					@if(Auth::user()->role_id == 3)
					<li class="sidebar-item {{ explode(".", Route::currentRouteName())[0] == "user" ? "active" : "" }}">
						<a class="sidebar-link" href="{{ route("user.index") }}">
						<i class="fas fa-user align-middle"></i> <span class="align-middle">User</span>
						</a>
					</li>
					@endif

					<li class="sidebar-header">
						Settings
					</li>

					<li class="sidebar-item {{ Str::contains(Route::currentRouteName(), "settings") || Str::contains(Route::currentRouteName(), "archive") ? "active" : "" }}">
						<a class="sidebar-link" href="{{ route("settings.index") }}">
						<i class="fas fa-gear align-middle"></i> <span class="align-middle">Settings</span>
						</a>
					</li>

					{{-- <li class="sidebar-item">
						<form class="sidebar-link" action="{{ route("logout") }}" method="POST">
							@csrf
							<button class=" btn btn-danger form-control"><i class="align-middle fas fa-right-from-bracket"></i>
								{{ " Log out" }}
							</button>
						</form>
					</li> --}}
		</nav>
		@endif

		<div class="main">
			@if(Auth::check())
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="ms-2 sidebar-toggle js-sidebar-toggle">
                    <i class="hamburger align-self-center"></i>
                </a>
			</nav>
			@endif

			<main class="content">
				@if(Session::has("message"))
					<div class="alert alert-{{ Session::get("message")["type"] }}" role="alert">
						{{ Session::get("message")["message"] }}
					</div>
				@endif
				@yield("content")
			</main>

			{{-- <footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-start">
							<p class="mb-0">
								<a class="text-muted" href="#" target="_blank"><strong>AdminKit</strong></a> - <a class="text-muted" href="#" target="_blank"><strong>Bootstrap Admin Template</strong></a>								&copy;
							</p>
						</div>
						<div class="col-6 text-end">
							<ul class="list-inline">
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Support</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Help Center</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Privacy</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Terms</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</footer> --}}
		</div>
	</div>

	<script src="{{ asset("js/tinymce/tinymce.min.js") }}"></script>
	<script src="{{ asset("static/js/app.js" )}}"></script>
	<script src="{{ asset("js/custom.js") }}"></script>
	<script>
		tinymce.init({
			selector: "#editor"
		})
	 </script>
	 
	 @stack('scripts')
	 @yield("js-scripts")
	
	{{-- <script type="text/javascript" src="Scripts/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="Scripts/bootstrap.min.js"></script> --}}
	
</body>
</html>