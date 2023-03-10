@extends("layouts.app")
@section("title", "Archived - ".$laporan->judul)
@section("custom-css")
<style>
  /* Dropdown */
  
  .dropdown {
    display: inline-block;
    position: relative;
  }
  
  .dd-button {
    display: inline-block;
    border: 1px solid gray;
    border-radius: 4px;
    padding: 10px 30px 10px 20px;
    background-color: #ffffff;
    cursor: pointer;
    white-space: nowrap;
  }
  
  .dd-button:after {
    content: '';
    position: absolute;
    top: 50%;
    right: 15px;
    transform: translateY(-50%);
    width: 0; 
    height: 0; 
    border-left: 5px solid transparent;
    border-right: 5px solid transparent;
    border-top: 5px solid black;
  }
  
  .dd-button:hover {
    background-color: #eeeeee;
  }
  
  
  .dd-input {
    display: none;
  }
  
  .dd-menu {
    position: absolute;
    top: 100%;
    border: 1px solid #ccc;
    border-radius: 4px;
    padding: 0;
    margin: 2px 0 0 0;
    box-shadow: 0 0 6px 0 rgba(0,0,0,0.1);
    background-color: #ffffff;
    list-style-type: none;
  }
  
  .dd-input + .dd-menu {
    display: none;
  } 
  
  .dd-input:checked + .dd-menu {
    display: block;
  } 
  
  .dd-menu li {
    padding: 10px 20px;
    cursor: pointer;
    white-space: nowrap;
  }
  
  .dd-menu li:hover {
    background-color: #f6f6f6;
  }
  
  .dd-menu li a {
    display: block;
    margin: -10px -20px;
    padding: 10px 20px;
  }
  
  .dd-menu li.divider{
    padding: 0;
    border-bottom: 1px solid #cccccc;
  }
  </style>

@endsection
@section("content")
<!-- Button trigger modal -->
<!-- Button trigger modal -->
<div class="report">
    <div class="rounded bg-white p-4" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
        <div class="">
          <div class="row">
            <div class="col-12">
              @if($laporan->status != 0)
              <span class="alert alert-{{ $laporan->status == "process" || $laporan->status == "selesai" ? "success" : "danger" }} form-control">
                <i class="fas fa-info me-3"></i>
                @if($laporan->status == "process")
                Laporan ini sedang dalam proses
                @elseif($laporan->status == "tolak")
                Laporan ini dianggap tidak valid
                @elseif($laporan->status == "selesai")
                Laporan ini telah selesai
                @endif
              </span>
              @endif
              <div class="d-flex" style="font-weight: 800;">
                <span class="me-2"> {{ \App\Models\User::where("id", $laporan->id_user)->first()->nama }} </span>
                <span class="opacity-75">  {{"@".\App\Models\User::where("id", $laporan->id_user)->first()->username}}</span>
              <div class="created-at">
                <span class="opacity-50 ms-3" style="">{{ $laporan->created_at }}</span>
              </div>
              </div>
            </div>
          </div>
          <div class="mt-3">
            {!! $laporan->isi !!}
          </div>
          <div class="report-image">
            <img src="/storage/foto_laporan/{{$laporan->foto}}" alt="Gambar tidak ditemukan" style="width: 300px;" class="rounded mt-3">
          </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 text-center opacity-50 mt-3 mb-3">
        Tanggapan
    </div>
</div>
<div class="row">
    <div class="w-100"></div>
    <div class="col-12">
        @forelse($tanggapans as $tanggapan)
        <div class="tanggapan" id="tanggapan{{$tanggapan->id}}">
            <div class="m-2 rounded bg-white p-4" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                <div class="p-3">
                    <div class="d-flex">
                        <span class="" style="font-weight: bold;">
                            <?php $user = \App\Models\User::where("id", $tanggapan->id_user)->first() ?>
                            {{ $user->id == Auth::id() ? "Anda" : $user->username }}
                        <span>
                        <span class="opacity-50 ms-2 created-at">{{__("  ".$tanggapan->created_at)}}</span>
                        
                    </div>
        
                    <div class="mt-3">
                        {{ $tanggapan->tanggapan }}
                    </div>
                </div>
            </div>
        </div>

    @empty
    <div class="w-100 ">
        <div class="col-12 text-center">
            <span class="opacity-50">Belum ada tanggapan</span>
        </div>
    </div>
    @endforelse
    </div>
</div>
<div class="" style="margin-top: 100px;"></div>
<div class="d-flex justify-content-center align-items-center" style="margin-top: 200px;">
    <div class="alert alert-danger m-3 form-control">
        <p class="text-center mt-3" style="font-weight: bolder;"><i class="fas fa-warning me-3"></i>Danger Zone</p>
        <form action="{{ route("laporan.unarchive", $laporan->id) }}" method="POST">
          @csrf
          <label for="" class="text-sm"><i class="fas fa-circle-info me-2"></i>Dengan melakukan unarchive, laporan ini akan bisa diakses dan dilihat oleh semua user.</label><br>
          <button type="button" class="btn btn-outline-danger mt-2" data-bs-toggle="modal" data-bs-target="#unarchiveModal">
            <i class="fas fa-box-archive me-3"></i> Unarchive
          </button>

          <!-- Modal -->
          <div class="modal fade" id="unarchiveModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Apakah anda yakin akan melakukan <span class="text-danger fw-bold">unarchive</span> pada laporan ini?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                  <button type="submit" class="btn btn-danger">Ya, saya yakin</button>
                </div>
              </div>
            </div>
          </div>
      </form>

        <form action="{{ route("laporan.delete", $laporan->id) }}" class="mt-3" method="POST">
          @csrf
          <label for="" class="text-sm"><i class="fas fa-circle-info me-2"></i>Dengan menghapus laporan ini, semua yang berkaitan dengan laporan ini seperti tanggapan, foto, dll akan dihapus dari storage dan database.</label><br>

          <!-- Button trigger modal -->
          <button type="button" class="btn btn-danger mt-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="fas fa-trash me-3"></i> Hapus permanen
          </button>

          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body">
                  Apakah anda yakin akan <span class="text-danger fw-bold">menghapus permanen</span> laporan ini?
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
<script>
</script>
@endsection