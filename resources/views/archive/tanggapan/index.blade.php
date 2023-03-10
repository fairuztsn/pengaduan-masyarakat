@extends("layouts.app")
@section("title", "Archived Tanggapan")
@section("content")
<div class="bg-white rounded" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;" style="transform:scale(0.95)">
    <div class="d-flex justify-content-center align-items-center" >
      <div class="table p-5">
        <div class="mb-2 row">
            <span class="text-sm">
                <i class="fas fa-circle-info me-3"></i>Tanggapan yang ada dalam laporan yang dihapus tidak akan tampil disini.
            </span>
        </div>
        <div class="mb-5">
            <span class="text-sm">
                <i class="fas fa-circle-info me-3"></i>Tanggapan yang tampil disini adalah tanggapan yang di-delete di 
                <a href="{{ route("tanggapan.index") }}" class="link-danger fw-bolder">/tanggapan</a>
            </span>
        </div>
        <h3>
          <a href="{{ route("archived.index") }}" class="link-dark fw-bold me-2">archive</a>
          <span>></span>
          <a class="ms-2 link-dark fw-bold" href="{{ route("archived.tanggapan") }}">tanggapan</a> </h3>
        {{ $dataTable->table() }}
      </div>
    </div>
  </div>
@endsection
@push("scripts")
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush