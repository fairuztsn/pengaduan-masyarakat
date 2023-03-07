@extends("layouts.app")
@section("content")
<form action="{{ route("laporan.store") }}" method="POST" class="form" enctype="multipart/form-data">
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