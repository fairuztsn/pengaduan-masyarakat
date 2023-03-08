@extends("layouts.app")
@section("content")
<div class="bg-white p-5">
    {{ $dataTable->table() }}
</div>
@endsection
@push("scripts")
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush