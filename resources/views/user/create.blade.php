@extends("layouts.app")
@section("title", "Buat Petugas")
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

    <h3 class="title mb-4"><i class="fas fa-circle-info me-3"></i>  Buat petugas</h3>
    <form method="POST" action="{{ route("user.store") }}">
        @csrf
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" class="form-control" id="" name="email">
          <div id="" class="form-text">@error('email') {{ $message  }} @enderror</div>
        </div>
        <div class="mb-3">
            <label class="form-label">NIK</label>
            <input type="number" class="form-control" id="" name="nik" min=0>
            <div id="" class="form-text"></div>
        </div>
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" class="form-control" id="" name="username">
            <div id="" class="form-text"></div>
        </div>
        <div class="mb-3">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="" name="nama">
            <div id="" class="form-text"></div>
        </div>
        <button type="submit" class="btn btn-primary"><i class="fas fa-user-plus me-3"></i> Buat Petugas</button>
      </form>
</div>
@endsection