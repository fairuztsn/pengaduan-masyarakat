{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}

@extends("layouts.app")
@section("title", "Laporin - Masuk")
@section("content")
<div class="row d-flex justify-content-center align-items-center">
    <div class="col-4 bg-white p-5 rounded">
        <div class="d-flex justify-content-center align-items-center">
            <h4 class="title">Laporin - Masuk/Login</h4>
            <img src="{{ asset("img/login.jpg") }}" alt="" style="width: 150px;">
        </div>
        <form action="{{ route("login") }}" class="mt-4" method="POST">
            @csrf
            <div class="mb-3">
                <label for="" class="form-label text-sm"><i class="fas fa-envelope me-3"></i>Email <span class="text-sm text-danger">*</span> </label>
                <input type="email" name="email" id="email" class="form-control bg-white @error('email') is-invalid @enderror">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="" class="form-label text-sm"><i class="fas fa-key me-3"></i>Password <span class="text-sm text-danger">*</span> </label>
                <input type="password" name="password" id="password" class="form-control bg-white @error('password') is-invalid @enderror">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <button class="btn btn-outline-dark form-control mb-4" style="box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;"><i class="fas fa-right-to-bracket me-3"></i>Masuk</button>
                <span class="text-sm opacity">Belum punya akun? <a href="{{ route("register") }}">Daftar</a></span>
            </div>
        </form>
    </div>
</div>
@endsection