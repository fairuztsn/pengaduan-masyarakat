@extends("layouts.app")
@section("title", "Archived")
@section("custom-css")
<style>
  a.list-group-item {
    padding: 20px;
    margin: 5px;
  }
</style>
@endsection
@section("content")
<div class="row">
  <div class="col-12 text-center mt-2 mb-3">
      <i class="fas fa-archive me-3"></i> Archive Section
  </div>
</div>
<div class="list-group">
    <a href="{{ route("archived.laporan") }}" class="list-group-item list-group-item-action form-control">
      <span class="line me-5 text-danger" style="text-weight: bolder;">|</span>
      <i class="fas fa-book me-3"></i>
      Laporan
    </a>
    <a href="{{ route("archived.tanggapan") }}" class="list-group-item list-group-item-action form-control">
      <span class="line me-5 text-danger" style="text-weight: bolder;">|</span>
      <i class="fas fa-reply me-3"></i>
      Tanggapan
    </a>
  </div>
@endsection