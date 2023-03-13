@extends("layouts.app")
@section("title", "User")
@section("content")

<div class="mb-3">
  <a href="{{ route("user.create") }}" class="btn btn-primary"><i class="fas fa-user-plus me-3"></i> Tambah petugas</a>
</div>
<div class="bg-white rounded" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;" style="transform:scale(0.9)">
  <div class="d-flex justify-content-center align-items-center" >
    <div class="table p-5">
      <h3>User</h3>
      {{ $dataTable->table() }}
    </div>
  </div>
</div>
@endsection

@push("scripts")
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush