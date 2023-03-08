@extends("layouts.app")
@section("custom-css")
@endsection
@section("content")
<x-button-launch-modal target="#modalTest" text="CLICK MEEE"></x-button-launch-modal>
<x-bootstrap-modal id="modalTest" title="HEHEYEYEYEYYEEY NOT BAD" type="danger" text="UBAHHH??"></x-bootstrap-modal>
@endsection