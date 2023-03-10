@extends("layouts.app")
@section("title", "Buat Laporan")
@section("content")
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route("laporan.store") }}" method="POST" class="form p-4 rounded" enctype="multipart/form-data" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
    @csrf
  <div class="mb-3">
    <input type="text" name="title" id="" class="form-control bg-white">
    <div id="reportHelp" class="form-text">Tulis judul laporan-mu disini <span class="text-danger">*</span> </div>
  </div>
  <div class="mb-3">
    <input type="date" name="date" id="" class="form-control bg-white">
    <div id="reportHelp" class="form-text">Masukkan tanggal kejadian <span class="text-danger">*</span></div>
  </div>
  <div class="mb-3">
      <textarea name="report" id="editor"></textarea>
      <div id="reportHelp" class="form-text">Tulis laporan-mu disini <span class="text-danger">*</span></div>
  </div>
  <div class="mb-3">
    <input type="file" name="photo" id="" class="form-control bg-white">
    <div id="photoHelp" class="form-text">Upload foto buktinya disini <span class="text-danger">*</span></div>
  </div>
  <div class="mb-3">
    <button type="submit" class="btn btn-dark">Upload</button>
  </div>
</form>
@endsection