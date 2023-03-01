@extends("layouts.admin")
@section("content")
<div class="text-center rounded p-4">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h6 class="mb-0">Laporan Pengaduan</h6>
        <a href="">Show All</a>
    </div>
    <div class="table-responsive">
        <table class="table table-striped text-start align-middle table-bordered table-hover mb-0" style="font-size: 15px;">
            <thead>
                <tr class="text-dark">
                    <th scope="col">ID</th>
                    <th scope="col">Date</th>
                    <th scope="col">Report Content</th>
                    <th scope="col">Image</th>
                    <th scope="col">Status</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($report as $laporan)
                <tr>
                    <td>{{$laporan->id}}</td>
                    <td>{{$laporan->tanggal_pengaduan}}</td>
                    <td>{{Str::limit($laporan->isi_laporan, 250)}}</td>
                    <td>{{$laporan->foto}}</td>
                    <td>{{$laporan->status}}</td>
                    <td>
                        <div class="d-flex">
                            <a class="btn btn-sm btn-light me-2" href=""><i class="fas fa-eye"></i></a>
                        <form action="">
                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                        </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection