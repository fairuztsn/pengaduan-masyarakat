@extends("layouts.app")
@section("title", "Tanggapan")
@section("content")
<div class="bg-white rounded" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
  <div class="p-5">
    <h3>Tanggapan</h3>
    <div class="table">
      {{ $dataTable->table() }}
    </div>
  </div>
</div>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush