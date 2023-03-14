@extends("layouts.app")
@section("title", "Tanggapan #$tanggapan->id")
@section("content")
<div class="rounded p-5" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
    <table class="table">
        <tr>
            <th>
                Username
            </th>
            <td>
                <span class="link-primary">
                    {{ "@".$tanggapan->user->username }}
                </span>
            </td>
        </tr>

        <tr>
            <th>
                Nama
            </th>
            <td>
                {{ $tanggapan->user->nama }}
            </td>
        </tr>

        <tr>
            <th>Menanggapi laporan</th>
            <td>
                <a href="{{ route("laporan.detail", $tanggapan->id_laporan) }}">{{ $tanggapan->laporan->judul }}</a> oleh
                {{ $tanggapan->laporan->user->nama }}
            </td>
        </tr>
        <tr>
            <th>
                Tanggapan
            </th>
            <td>
                {{ $tanggapan->tanggapan }}
            </td>
        </tr>

        <tr>
            <th>
                Dibuat pada
            </th>
            <td>
                {{ $tanggapan->created_at }}
            </td>
        </tr>
    </table>
</div>
@endsection