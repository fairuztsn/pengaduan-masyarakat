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
<!-- Button trigger modal -->
<!-- Button trigger modal -->
<div class="report">
    <div class="rounded bg-white">
        <div class="p-3">
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
<div class="" style="margin-top: 100px;"></div>
<div class="d-flex justify-content-center align-items-center" style="margin-top: 200px;">
    <div class="alert alert-danger m-3 form-control">
        <p class="text-center mt-3" style="font-weight: bolder;"><i class="fas fa-warning me-3"></i>Danger Zone</p>
        <form action="">
            @csrf
            <label for="" class="text-sm"><i class="fas fa-info me-2"></i>Dengan melakukan unarchive, laporan ini akan bisa diakses dan dilihat oleh semua user.</label><br>
            <button class="btn btn-danger form-control mt-2 mb-2" onclick="unarchive()"> <i class="fas fa-eye me-3"></i>Unarchive</button>
        </form>
    </div>
</div>
<script>
    function unarchive() {
    const confirm_field = `Apakah anda yakin ingin unarchive laporan ini?`

    if(confirm(confirm_field)) {
      // AJAX
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
          });

      $.ajax({
          type: "POST",
          url: "<?php echo route('laporan.unarchive') ?>",
          dataType: 'JSON',
          data: {
              "_token" : "{{ csrf_token() }}",
              "id" : "<?php echo $laporan->id ?>"
          },
          success: function (data) {
              //
              if(data.response === "Success") {
                  window.location.href = "<?php echo route('archived.laporan') ?>"
              }else {
                alert(data.response);
              }
          }
      });
    }
  }
</script>
@endsection