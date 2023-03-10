@extends("layouts.app")
@section("title", "Dashboard")
@section("content")
<div class="bg-white rounded p-5">
  <h4>Dashboard</h4>
  <div class="">
    Disini nanti grafik
  </div>
</div>
    {{-- <ul class="list-group">
      @foreach($report as $laporan)
      <li class="list-group-item m-2 rounded" style="box-shadow: rgba(255, 255, 255, 0.2) 0px 0px 0px 1px inset, rgba(0, 0, 0, 0.9) 0px 0px 0px 1px;">
        <div class="p-2">
          <div class="">
            <span class=""> 
              {{ \App\Models\User::where("id", $laporan->id_user)->first()->username }}</span>  
            <span class="opacity-50">{{$laporan->tanggal_pengaduan}}</span> 
            @if(\App\Models\Tanggapan::where("id_laporan", $laporan->id)->count() > 0) 
              <span class="btn btn-dark btn-sm ms-3">
                <i class="fas fa-check"></i> Laporan ini sudah ditanggapi
              </span> 
              @endif
          </div> 
          <div class="created-at mt-3">
            <span class="opacity-50"></span></span>
          </div>
          <div class="mt-3">
            {{Str::limit($laporan->isi_laporan, 250)}}
          </div>
          <div class="reply mt-3">
            <a href="{{ url("u/laporan/$laporan->id") }}" class="btn btn-outline-dark"><i class="fas fa-eye me-2"></i> Lihat</a>
          </div>
        </div>
      </li>
      @endforeach
    </ul> --}}
@endsection