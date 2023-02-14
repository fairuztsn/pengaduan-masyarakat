@extends("layouts.app")
@section("content")
<table class="tablem-3">
    <tbody>
        @foreach($reports as $laporan)
        <tr>
            <td>{{$laporan->id}}</td>
            <td>{{$laporan->tanggal_pengaduan}}</td>
            <td>{{Str::limit($laporan->isi_laporan, 150)}}</td>
            <td>{{$laporan->foto}}</td>
            <td>{{$laporan->status}}</td>
            <td>
                <a href="#" class="btn btn-primary">Button</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection