@extends("layouts.app")
@section("title", "Archived Tanggapan #$tanggapan->id")
@section("content")
<div class="rounded p-5" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
    <div class="input-group mb-3">
        <span class="input-group-text">@</span>
        <input type="text" class="form-control" disabled value="{{ $tanggapan->user->username }}">
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text">Tanggapan</span>
        <textarea class="form-control" aria-label="With textarea" disabled>{{ $tanggapan->tanggapan }}</textarea>
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text">created_at</span>
        <input type="date" class="form-control" disabled value="{{ date("Y-m-d", strtotime($tanggapan->created_at)) }}">
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text">deleted_at</span>
        <input type="date" class="form-control" disabled value="{{ date("Y-m-d", strtotime($tanggapan->deleted_at)) }}">
    </div>

    <div class="danger-zone mt-5">
        <div class="mb-3">
            <form action="{{ route("tanggapan.unarchive", $tanggapan->id) }}" method="POST">
                @csrf
                <label for="" class="text-sm">
                    <i class="fas fa-circle-info me-2"></i>
                    Dengan melakukan unarchive, laporan ini akan bisa diakses dan dilihat oleh semua user.
                </label><br>
                <button class="btn btn-outline-dark mt-2" type="button" data-bs-toggle="modal" data-bs-target="#unarchiveModal"> <i class="fas fa-eye me-3" ></i> Unarchive</button>

                <!-- Confirm Unarchive Modal -->
                <div class="modal fade" id="unarchiveModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Apakah anda yakin akan <span class="text-danger fw-bold">unarchive</span> tanggapan ini?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                            <button type="submit" class="btn btn-danger">Ya, saya yakin</button>
                        </div>
                    </div>
                    </div>
                </div>
            </form>
        </div>
    
        <div class="mb-3 mt-4">
            <form action="{{ route("tanggapan.delete", $tanggapan->id) }}" method="POST">
                @csrf
                <label for="" class="text-sm text-danger"><i class="fas fa-circle-info me-2"></i>Tanggapan ini tidak bisa diakses oleh siapapun jika dihapus.</label><br>
                <button class="btn btn-danger mt-2" type="button" data-bs-toggle="modal" data-bs-target="#deletionModal"> 
                    <i class="fas fa-eye me-3"></i> Hapus permanen
                </button>

                <!-- Confirm Deletion Modal -->
                <div class="modal fade" id="deletionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Apakah anda yakin akan <span class="text-danger fw-bold">menghapus permanen</span> tanggapan ini?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                            <button type="submit" class="btn btn-danger">Ya, saya yakin</button>
                        </div>
                    </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection