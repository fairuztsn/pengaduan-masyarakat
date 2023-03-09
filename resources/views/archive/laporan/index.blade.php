@extends("layouts.app")
@section("title", "Archived Laporan")
@section("content")
<div class="bg-white rounded" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;" style="transform:scale(0.95)">
    <div class="d-flex justify-content-center align-items-center" >
      <div class="table p-5">
        <h3>Laporan Pengaduan</h3>
        {{ $dataTable->table() }}
      </div>
    </div>
  </div>
@endsection
@push("scripts")
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush