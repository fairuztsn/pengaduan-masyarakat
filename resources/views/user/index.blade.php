@extends("layouts.app")
@section("content")
<div class="bg-white rounded" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
    <div class="table p-5">
      {{ $dataTable->table() }}
    </div>
</div>
@endsection

@push("scripts")
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush