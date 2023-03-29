@extends("layouts.app")
@section("title", "Tanggapan")
@section("content")
<div class="bg-white rounded" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;" style="transform:scale(0.95)">
  <div class="d-flex justify-content-center align-items-center" >
    <div class="table p-5">
      <div class="">
        <h3>Tanggapan</h3>
        @if(Auth::user()->role_id == 1) <span class="text-sm text-dark"><i class="fas fa-circle-info me-3"></i>Semua tanggapan yang ditujukan ke kamu ditampilkan disini.</span> @endif
      </div>
      
      {{ $dataTable->table() }}
    </div>
  </div>
</div>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush