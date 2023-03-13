@extends("layouts.app")
@section("title", "Settings")
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
      <i class="fas fa-gear me-3"></i> Settings <span class="translate opacity-50 text-sm ms-2">Pengaturan</span>
  </div>
</div>
<div class="list-group">
    <a href="{{ route("settings.profile") }}" class="list-group-item list-group-item-action form-control">
      <span class="line me-5 text-danger" style="text-weight: bolder;">|</span>
      <i class="fas fa-user me-3"></i>
      Profile
    </a>
    @if(Auth::user()->role_id == 3)
    <a href="{{ route("archived.index") }}" class="list-group-item list-group-item-action form-control">
      <span class="line me-5 text-danger" style="text-weight: bolder;">|</span>
      <i class="fas fa-archive me-3"></i>
      Archived
    </a>
    @endif
  </div>
@endsection