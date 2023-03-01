@extends("layouts.app")
@section("content")
<form action="{{ route("laporan.update", $laporan->id) }}" method="POST" class="form" enctype="multipart/form-data">
    @csrf
  <div class="mb-3">
      <h4 class="form-label" style="font-weight: bold;">Buat Pengaduan</h4>
      <textarea name="report" id="editor">{{$laporan->isi_laporan}}</textarea>
      <div id="reportHelp" class="form-text">Ubah laporan-mu disini <span class="text-danger">*opsional</span> </div>
  </div>
  <div class="mb-3">
    <img src="/storage/foto_laporan/{{ $laporan->foto }}" alt="Gambar tidak ditemukan" class="rounded mt-3 mb-2" style="width: 300px;">
    <input type="file" name="photo" id="" class="form-control">
    <div id="photoHelp" class="form-text">Ubah foto buktinya disini <span class="text-danger">*opsional</span> </div>
  </div>
  <div class="mb-3">
    <button type="submit" class="btn btn-dark"> <i class="fas fa-save"></i>&emsp;Simpan</button>
  </div>
</form>
@endsection