@extends("layouts.app")
@section("title", "Archived Laporan")
@section("content")
<div class="bg-white p-5">
    {{ $dataTable->table() }}
</div>
@endsection
@push("scripts")
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush