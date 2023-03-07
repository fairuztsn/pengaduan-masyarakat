@extends("layouts.app")
@section("content")
<div class="row">
  <div class="col-12 text-center opacity-50 mt-2 mb-3">
      <i class="fas fa-danger"></i> Archived
  </div>
</div>
<div class="list-group">
    <a href="{{ route("archived.laporan") }}" class="list-group-item list-group-item-action">
        <i class="fas fa-book me-3"></i>Laporan
    </a>
  </div>
@endsection