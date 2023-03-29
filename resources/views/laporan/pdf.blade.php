<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ "@".$laporan->user->username." - ".$laporan->judul }}</title>
    {{-- <link rel="stylesheet" href="/css/bootstrap.min.css" media="all"/> --}}
    <style>
        table { 
	width: 750px; 
	border-collapse: collapse; 
	margin:50px auto;
	}

/* Zebra striping */
tr:nth-of-type(odd) { 
	background: #eee; 
	}

th { 
	font-weight: bold; 
	}

td, th { 
	padding: 10px; 
	border: 1px solid #ccc; 
	text-align: left; 
	font-size: 18px;
	}

/* 
Max width before this PARTICULAR table gets nasty
This query will take effect for any screen smaller than 760px
and also iPads specifically.
*/
@media 
only screen and (max-width: 760px),
(min-device-width: 768px) and (max-device-width: 1024px)  {

	table { 
	  	width: 100%; 
	}

	/* Force table to not be like tables anymore */
	table, thead, tbody, th, td, tr { 
		display: block; 
	}
	
	/* Hide table headers (but not display: none;, for accessibility) */
	thead tr { 
		position: absolute;
		top: -9999px;
		left: -9999px;
	}
	
	tr { border: 1px solid #ccc; }
	
	td { 
		/* Behave  like a "row" */
		border: none;
		border-bottom: 1px solid #eee; 
		position: relative;
		padding-left: 50%; 
	}

	td:before { 
		/* Now like a table header */
		position: absolute;
		/* Top/left values mimic padding */
		top: 6px;
		left: 6px;
		width: 45%; 
		padding-right: 10px; 
		white-space: nowrap;
		/* Label the data */
		content: attr(data-column);

		color: #000;
		font-weight: bold;
	}

}
* {
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
}
        @page {
            size: 21cm 29.7cm;
            margin: 0;
        }
    </style>
</head>
<body>
    <table>
        <tbody>
            <tr>
                <th colspan="2">User</th>
            </tr>
            <tr>
                <th>ID</th>
                <td>{{ $laporan->id_user }}</td>
              </tr>
          <tr>
            <th>NIK</th>
            <td>{{ $laporan->user->nik }}</td>
          </tr>
          <tr>
            <th>Nama Lengkap</th>
            <td>{{ $laporan->user->nama }}</td>
          </tr>
          <tr>
            <th>Email</th>
            <td style="text-decoration:underline; color:blue;">{{ $laporan->user->email }}</td>
          </tr>
          <tr>
            <th>Username</th>
            <td>{{ "@".$laporan->user->username }}</td>
          </tr>
        </tbody>
      </table>

      <table style="margin-top: 100px;">
        <tbody>
            <tr>
                <th colspan="2">Laporan Pengaduan</th>
            </tr>
            <tr>
                <th>ID Laporan</th>
                <td>{{ $laporan->id }}</td>
              </tr>
          <tr>
            <th>Judul</th>
            <td>{{ $laporan->judul }}</td>
          </tr>
          <tr>
            <th>Tanggal Kejadian</th>
            <td>{{ $laporan->tanggal_kejadian }}</td>
          </tr>
          <tr>
            <th>Isi Laporan</th>
            <td>{!! $laporan->isi !!}</td>
          </tr>
          <tr>
            <th>Username</th>
            <td>{{ "@".$laporan->user->username }}</td>
          </tr>
          <tr>
            <th>Foto</th>
            <td><img src="{{ public_path("\\storage\\foto_laporan\\".$laporan->foto) }}" alt="" style="width: 300px;"></td>
          </tr>
          <tr>
            <th>Status</th>
            <td>
                @if($laporan->status == 0)
                Belum diproses
                @elseif($laporan->status == "process")
                Sedang dalam proses
                @elseif($laporan->status == "tolak")
                Ditolak
                @elseif($laporan->status == "selesai")
                Sudah selesai
                @endif
            </td>
          </tr>
          <tr>
            <th>Dibuat pada</th>
            <td>{{ $laporan->created_at." GMT+0" }}</td>
          </tr>
        </tbody>
      </table>

    <table style="margin-top: 100px;">
        <tr style="background-color: white;">
            <td style=" border: none;">{{ $laporan->user->nama }}</td>
            <td style=" border: none; ">Petugas, </td>
        </tr>
    </table>
</body>
</html>