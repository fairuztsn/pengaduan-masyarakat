@extends("layouts.app")
@section("content")
<form action="" method="GET">
    @csrf
    <code>
        {
            "tabel" : 
            <select name="" id="" class="form-control">
                <option value="user" selected>user</option>
                <option value="laporan">laporan</option>
                <option value="tanggapan">tanggapan</option>
            </select>
            "kolom": <input type="text" name="" id="" class="form-control">,
            "keyword": <input type="text" name="" id="" class="form-control">
        }
    </code>
</form>
@endsection