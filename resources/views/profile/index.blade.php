@extends("layouts.app")
@section("title", "@".$user->username)
@section("custom-css")
<style>
</style>
@endsection
@section("content")
<section class="h-100 gradient-custom-2">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-lg-9 col-xl-7">
          <div class="card">
            <div class="rounded-top text-white d-flex flex-row" style="background-color: #000; height:200px;">
              <div class="ms-4 mt-5 d-flex flex-column" style="width: 150px;">
                <img src="{{ url("img/profile.jpg") }}"
                  alt="Generic placeholder image" class="img-fluid img-thumbnail mt-4 mb-2"
                  style="width: 150px; z-index: 1">
                  @php
                      $redirect = $user->role_id == 1 ? "laporan" : "tanggapan";
                      $redirect = "$redirect.index";
                  @endphp
                <a class="btn btn-outline-dark" href="{{ route($redirect)."?uid=$user->id" }}"
                  style="z-index: 1;">
                  Lihat {{ $user->role_id == 1 ? "Laporan" : "Tanggapan" }}
              </a>
              </div>
              <div class="ms-3" style="margin-top: 130px;">
                <h5 style="color: white;">{{ $user->nama }}</h5>
                <p>{{ $user->username }}</p>
              </div>
            </div>
            <div class="p-4 text-black" style="background-color: #f8f9fa;">
              <div class="d-flex justify-content-end text-center py-1">
                @if($user->role_id === 2 || $user->role_id == 3)
                <div>
                    <p class="mb-1 h5">{{ \App\Models\Tanggapan::where("id_user", $user->id)->count() }}</p>
                    <p class="small text-muted mb-0">Total Tanggapan</p>
                </div>
                @elseif($user->role_id == 1)
                <div>
                    <p class="mb-1 h5">{{ \App\Models\Laporan::where("id_user", $user->id)->count() }}</p>
                    <p class="small text-muted mb-0">Total Laporan</p>
                </div>
                @endif
                </div>                                                        
              </div>
            </div>
            <div class="card-body p-4 text-black">
              <div class="mb-5">
                <p class="lead fw-normal mb-1">About</p>
                <div class="p-4 bg-white rounded">
                  <p class="font-italic mb-1"><i class="fas fa-id-card me-3"></i>{{ $user->nik }}</p>
                  <p class="font-italic mb-1 link-primary"><i class="fas fa-at me-3"></i><u>{{ $user->email }}</u></p>
                  <p class="font-italic mb-0">
                    <i class="fas fa-{{ $user->role_id == 1 ? "users" : "user-secret" }} me-3"></i>
                    Pengguna / {{ $user->role_id == 1 ? "Masyarakat" : "Petugas" }} @if($user->role_id == 3) / Admin @endif
                  </p>
                </div>
              </div>
              <div class="d-flex justify-content-between align-items-center mb-4">
                <p class="lead fw-normal mb-0">{{ $user->role_id == 1 ? "Laporan" : "Tanggapan" }} terbaru</p>
                <p class="mb-0"><a href="#!" class="text-muted">Show all</a></p>
              </div>
              <div class="row g-2">
                <div class="row">
                  @if($user->role_id == 1)
                  @forelse($recent as $laporan)
                  <div class="card mb-5" style="border-radius: 15px;">
                    <div class="card-body p-4">
                      <h3 class="mb-3">{{ $laporan->judul }}</h3>
                      <p class="small mb-0"><i class="far fa-calendar fa-lg"></i> <span class="mx-2">|</span> Dibuat pada {{ explode("T", $laporan->created_at)[0] }}</p>
                      <hr class="my-4">
                      {!! Str::limit($laporan->isi, 50) !!}
                      <hr class="my-4">
                      <div class="d-flex justify-content-start align-items-center">
                        <a href="{{ route("laporan.detail", $laporan->id) }}" class="btn btn-outline-dark btn-sm btn-floating form-control">
                          <i class="fas fa-eye me-2"></i>Lihat
                        </a>
                      </div>
                    </div>
                  </div>
                  @empty
                  <p class="text-center">Tidak ada data</p>
                  @endforelse

                  @elseif($user->role_id == 2)
                  @forelse($recent as $tanggapan)
                  <div class="card mb-5" style="border-radius: 15px;">
                    <div class="card-body p-4">
                      <p class="small mb-0"><i class="far fa-calendar fa-lg"></i> <span class="mx-2">|</span> Dibuat pada {{ explode("T", $tanggapan->created_at)[0] }}</p>
                      <hr class="my-4">
                      {!! Str::limit($tanggapan->tanggapan, 100) !!}
                      <hr class="my-4">
                      <div class="d-flex justify-content-start align-items-center">
                        <a href="{{ route("laporan.detail", $tanggapan->id_laporan) }}" class="btn btn-outline-dark btn-sm btn-floating form-control">
                          <i class="fas fa-eye me-2"></i>Lihat
                        </a>
                      </div>
                    </div>
                  </div>
                  @empty
                  <p class="text-center">Tidak ada data</p>
                  @endforelse
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection