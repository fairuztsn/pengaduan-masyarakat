@extends("layouts.app")
@section("title", $laporan->judul)
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

  .tanggapan {
    transition: 0.4s;
  }

  .tanggapan:active {
    transform: scale(0.99);
    opacity: 0.8;
  }
  </style>

@endsection
@section("content")
<div class="report @if(Auth::id() == $laporan->id_user) mt-1 @endif">
    <div class="rounded bg-white p-3" style="">
        <div class="p-3">
          <div class="row">
            <div class="col-12">
              @if($laporan->status != 0)
              <span class="text-sm text-{{ ($laporan->status == "process" || $laporan->status == "selesai") ? "info" : "danger" }}"><i class="fas fa-circle-info me-2 mb-3"></i>status: {{ $laporan->status }}</span>
              @endif
              
              <h3>{{ $laporan->judul }}</h3>
              <div class="d-flex" style="font-weight: 800;">
                <span class="me-2"> {{ \App\Models\User::where("id", $laporan->id_user)->first()->nama }} </span>
                <span class="opacity-75">  {{"@".\App\Models\User::where("id", $laporan->id_user)->first()->username}}</span>
              <div class="created-at">
                <span class="opacity-50 ms-3" style="">{{ $laporan->created_at }}</span>
              </div>
              </div>
          </div>
          <div class="mt-3">
            {!! $laporan->isi !!}
          </div>
          <div class="report-image">
            <img src="/storage/foto_laporan/{{$laporan->foto}}" alt="Gambar tidak ditemukan" style="width: 300px;" class="rounded mt-3">
          </div>

          @if(Auth::user()->role_id != 1 && !Str::contains(Route::currentRouteName(), "archived"))
          
          <div class="mt-3"></div>
                <form method="POST"  action="{{ route("tanggapan.store") }}">
                    @csrf
                    <span class="opacity-75 mb-2">Buat tanggapan</span>
                    <textarea name="tanggapan" id="tanggapan" cols="30" rows="1" class="form-control"></textarea>
                    <button class="btn btn-dark mt-3" id="btn-submit"><i class="fas fa-paper-plane me-3" type="submit"></i>Kirim</button>
                </form>

                <script>
                    $("#btn-submit").click(function(e) {
                        e.preventDefault();
                
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                            });

                        $.ajax({
                            type: "POST",
                            url: "<?php echo route("tanggapan.store") ?>",
                            dataType: 'JSON',
                            data: {
                                "_token" : "{{ csrf_token() }}",
                                "tanggapan": $("textarea#tanggapan").val(),
                                "id" : "<?php echo $laporan->id ?>"
                            },
                            success: function (data) {
                                //
                                if(data.message === "Done") {
                                    location.reload();
                                }
                            }
                        });
                    })
                </script>
            @endif
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
          <a href="{{ route("tanggapan.detail", $tanggapan->id) }}" style="text-decoration: none;color: black;" class="m-3">
            <div style="background-color:white;" class="p-4 rounded tanggapan" >
              <div class="creator d-flex created_at fw-bolder">
                <span class="me-3">{{ $tanggapan->user->username }}</span>
                <span>{{ $tanggapan->created_at }}</span>
              </div>
              <div class="field">
                {{ $tanggapan->tanggapan }}
              </div>
            </div>
          </a>
        @empty
        <div class="w-100 ">
            <div class="col-12 text-center">
                <span class="opacity-50">Belum ada tanggapan</span>
            </div>
        </div>
        @endforelse
    </div>
</div>

@if(Auth::user()->role_id != 1)
<div class="row" style="margin-top: 200px;">
  <div class="col-12 mt-3 mb-3 form-control bg-white">
      <p class="text-center mt-3" style="font-weight: bolder;"><i class="fas fa-gear me-3"></i>Pengaturan</p>
      
      <div class="p-1">
        <form action="" class="m-3">
          @csrf
          <label class="text-sm" for="" class="mt-3 ms-1">Atur status</label>
          <select name="status" class="form-select" id="limbo" aria-label="Default select example" onchange="myFunction()">
              <option disabled {{ $laporan->status == 0 ? "selected" : "" }}>Pilih status</option>
              <option value="1" {{ $laporan->status == "process" ? "selected" : "" }} >Diproses</option>
              <option value="3" {{ $laporan->status == "selesai" ? "selected" : "" }}>Selesai</option>
              <option value="2" {{ $laporan->status == "tolak" ? "selected" : "" }}>Tolak</option>
          </select>
        </form>
      </div>

      @if(Auth::user()->role_id == 3)
      <div class="alert alert-danger m-3">
        <p class="text-center mt-3" style="font-weight: bolder;"><i class="fas fa-warning me-3"></i>Danger Zone</p>
        <form action="{{ route("laporan.archive", $laporan->id) }}" method="POST">
          @csrf
          <label for="" class="text-sm"><i class="fas fa-circle-info me-2"></i>Hapus akan membuat laporan ini tidak bisa dilihat oleh user mana pun.</label><br>
          <button type="button" class="btn btn-danger mt-2" data-bs-toggle="modal" data-bs-target="#deleteModal">
            <i class="fas fa-trash me-3"></i> Hapus laporan ini
          </button>

          <!-- Modal -->
          <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Apakah anda yakin akan <span class="text-danger fw-bold">hapus</span> laporan ini?
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
      @endif
  </div>
</div>
@endif
<script>

  function myFunction() {
    const confirm_field = `Apakah yakin ingin mengubah status ke '${ $('#limbo').find(":selected").text().toLowerCase() }'?`
    
    if(confirm(confirm_field)) {

      // AJAX
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
          });

      $.ajax({
          type: "POST",
          url: "<?php echo route('laporan.set') ?>",
          dataType: 'JSON',
          data: {
              "_token" : "{{ csrf_token() }}",
              "status": $('#limbo').find(":selected").val(),
              "id" : "<?php echo $laporan->id ?>"
          },
          success: function (data) {
              //
              if(data.response === "Success") {
                  location.reload();
              }else {
                alert(data.response);
              }
          }
      });
    }
  
  }
</script>
@endsection