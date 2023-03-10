@extends("layouts.app")
@section("title", "Archived Laporan")
@section("content")
<div class="bg-white rounded" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;" style="transform:scale(0.95)">
    <div class="d-flex justify-content-center align-items-center" >
      <div class="table p-5">
        <h3>
          <a href="{{ route("archived.index") }}" class="link-dark fw-bold me-2">archive</a>
          <span>></span>
          <a class="ms-2 link-dark fw-bold" href="{{ route("archived.laporan") }}">laporan</a> 
        </h3>
        {{ $dataTable->table() }}
      </div>
    </div>
  </div>
@endsection
@push("scripts")
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush