@extends("layouts.app")
@section("title", "User - Create")
@section("content")
<div class="p-5 bg-white rounded" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;" style="transform:scale(0.9)">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route("settings.profile.update") }}">
        @csrf
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" class="form-control" id="" name="email" value="{{ $email }}">
          <div id="" class="form-text">@error('email') {{ $message  }} @enderror</div>
        </div>
        <div class="mb-3">
            <label class="form-label">NIK</label>
            <input type="number" class="form-control" id="" name="nik" min=0 value="{{ $nik }}">
            <div id="" class="form-text"></div>
        </div>
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" class="form-control" id="" name="username" value="{{ $username }}">
            <div id="" class="form-text"></div>
        </div>
        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" class="form-control" id="" name="nama" value="{{ $nama }}">
            <div id="" class="form-text"></div>
        </div>
        <div class="mb-3">
            <a href="#" class="link-primary"><i class="fas fa-key me-2"></i>Ubah password</a>
        </div>
        <button type="submit" class="btn btn-dark"><i class="fas fa-save me-3"></i> Simpan Perubahan</button>
      </form>
</div>
@endsection