<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{"@".$laporan->user->username." - ".$laporan->judul}}</title>
    <style>
        * {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
        }
        tr {
            text-align: left;
        }

        td {
            padding: 15px;
            border: 1px solid black;
        }

        @page {
            size: 21cm 29.7cm;
            margin: 0;
        }
    </style>
</head>
<body>
    <table class="" align="left">
        <tbody>
        {{-- User Information  --}}
        <tr>
            <th scope="row">ID User</th>
            <td>{{ $laporan->id_user }}</td>
        </tr>
        <tr>
            <th scope="row">NIK</th>
            <td>{{ $laporan->user->nik }}</td>
        </tr>
        <tr>
            <th scope="row">Nama Lengkap</th>
            <td>{{ $laporan->user->nama }}</td>
        </tr>
        <tr>
            <th scope="row">Email</th>
            <td>{{ $laporan->user->email }}</td>
        </tr>
        <tr>
            <th scope="row">Username</th>
            <td>{{ "@".$laporan->user->username }}</td>
          </tr>
        {{-- User Information - End --}}
        <tr>
            <th></th>
            <td style="border: none;"></td>
        </tr>
        {{-- Report --}}
        <tr>
            <th scope="row">ID Laporan</th>
            <td>{{ $laporan->id }}</td>
        </tr>
        <tr>
            <th scope="row">Judul Laporan</th>
            <td>{{ $laporan->judul }}</td>
        </tr>
        <tr>
            <th scope="row">Tanggal Kejadian</th>
            <td>{{ $laporan->tanggal_kejadian }}</td>
        </tr>
        <tr>
            <th scope="row">Foto</th>
            <td>
                <img src="{{ public_path("\\storage\\foto_laporan\\".$laporan->foto) }}" alt="" style="width: 300px;">
            </td>
        </tr>
        <tr>
            <th scope="row">Isi Laporan</th>
            <td>{!! $laporan->isi !!}</td>
        </tr>
        <tr>
            <th scope="row">Status saat ini ({{ now() }})</th>
            <td>{{ $laporan->status == 0 ? "Belum diproses" : $laporan->status }}</td>
        </tr>
        <tr>
            <th scope="row">Dibuat pada</th>
            <td>{{ $laporan->created_at." GMT +0" }}</td>
        </tr>
        </tbody>
      </table>
</body>
</html>