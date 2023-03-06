@extends("layouts.app")
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
<div class="report @if(Auth::id() == $laporan->id_user) mt-1 @endif">

    
    <div class="rounded bg-white">
        <div class="p-3">
          <div class="row">
            <div class="col-12">
              @if($laporan->status != 0)
              <span class="alert alert-{{ $laporan->status == "process" || $laporan->status == "selesai" ? "success" : "danger" }} form-control">
                <i class="fas fa-info me-3"></i>
                @if($laporan->status == "process")
                proses
                @elseif($laporan->status == "tolak")
                tidak valid
                @elseif($laporan->status == "selesai")
                selesai
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
              {{-- @if(\App\Models\Tanggapan::where("id_laporan", $laporan->id)->count() > 0)
              <div class="ms-5 btn btn-dark btn-sm m2-2">
              <span class=""><i class="fas fa-check me-2"></i>Laporan ini sudah ditanggapi</span>
              </div>
              @endif --}}
            </div>

            {{-- Dropdown option --}}
            {{-- @if(Auth::user()->role_id != 1)
            <div class="col-2">
                <label class="dropdown" style="transform: scale(0.9)">
  
                  <div class="btn btn-dark" style="position: relative; left: 70px;">
                    <i class="fas fa-bars"></i>
                  </div>
                
                  <input type="checkbox" class="dd-input" id="test">
                
                  
                  <ul class="dd-menu">
                    @if($laporan->status != "process")
                    <li class="">
                      <form action="{{ route("laporan.set", [
                          "id" => $laporan->id, 
                          "method" => 1
                      ]) }}" method="POST">
                        @csrf
                        <button style="outline: none; border: none; background: none; text-align:center;">
                            <i class="fas fa-bars-progress me-2"></i> Atur menjadi diproses
                        </button>
                      </form>
                    </li>
                    @endif
                    <li class="divider"></li>
                    @if($laporan->status != "tolak")
                    <li class="">
                      <form action="{{ route("laporan.set", [
                            "id" => $laporan->id, 
                            "method" => 2
                        ]) }}" method="POST">
                        @csrf
                        <button style="outline: none; border: none; background: none; text-align:center;">
                            <i class="fas fa-close me-2"></i> Atur menjadi ditolak
                        </button>
                      </form>
                    </li>
                    @endif
                    <li class="divider"></li>
                    @if($laporan->status != "selesai")
                    <li class="">
                      <form action="{{ route("laporan.set", [
                          "id" => $laporan->id, 
                          "method" => 3
                      ]) }}" method="POST">
                        @csrf
                        <button style="outline: none; border: none; background: none; text-align:center;">
                            <i class="fas fa-check me-2"></i> Atur menjadi selesai
                        </button>
                      </form>
                    </li>
                    @endif
                  </ul>
                  
                </label>
              </div>
            @endif --}}
          </div>
          <div class="mt-3">
            {!! $laporan->isi !!}
          </div>
          <div class="report-image">
            <img src="/storage/foto_laporan/{{$laporan->foto}}" alt="Gambar tidak ditemukan" style="width: 300px;" class="rounded mt-3">
          </div>

          @if(Auth::user()->role_id != 1)
          
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
        <div class="tanggapan">
            <div class="m-2 rounded bg-white">
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
@endsection