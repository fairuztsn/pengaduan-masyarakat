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

  .list-report {
    transition: 0.3s;
  }
  
  .list-report:hover {
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    cursor: pointer;
  }
  .list-report:active {
    box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;
    transform: scale(0.98);
  }
  </style>
@endsection
@section("content")

@if(Auth::user()->role_id == 1)
<div class="row">
  <div class="col-4"></div>
  <div class="col-4 d-flex justify-content-center align-items-center">
    <a href="{{ route("dashboard") }}" class="btn btn-dark mb-3" style="font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif"><i class="fa-solid fas fa-file me-3"></i>Buat laporan</a>
  </div>
  <div class="col-4"></div>
</div>

<ul class="list-group">
  @forelse($report as $laporan)
  <a href="{{ route("laporan.detail", $laporan->id) }}" style="text-decoration: none;">
    <li class="list-group-item m-2 rounded list-report d-flex row" style="">
      <div class="col-2">
        <p class="mt-3"><i class="fas fa-file"></i></p>
      </div>
      <div class="col-3">
        <p class="mt-3">{{$laporan->judul}}</p>
      </div>
      <div class="col-3">
        <p class="mt-3">{{ $laporan->created_at }}</p>
      </div>
      <div class="col-4 text-center">
        <p class="mt-3">
          @if($laporan->status == 0)
          {{ "Belum ditanggapi" }}
          @else
          {{ $laporan->status }}
          @endif
        </p>
      </div>
      {{-- <div class="p-2">
        <div class="row">
          <div class="col-11 d-flex mt-2">
            @if(Auth::user()->role_id != 1)
            <span class="opacity-75"><i class="fas fa-user me-2" style="transform: scale(0.9);"></i>{{\App\Models\User::where("id", $laporan->id_user)->first()->username}}</span>
            @endif
            <div class="created-at">
              <span class="opacity-75 "><i class="fas fa-calendar me-3"></i>{{$laporan->created_at}}</span>
            </div>
          </div> --}}
          {{-- <div class="col-1">
            <label class="dropdown" style="transform: scale(0.9)">
  
              <div class="btn btn-dark">
                <i class="fas fa-bars"></i>
              </div>
            
              <input type="checkbox" class="dd-input" id="test">
            
              <ul class="dd-menu">
                <li>
                  <a href="{{ route("laporan.detail", $laporan->id) }}" style="text-decoration: none; color: black; text-align:center;">
                    <i class="fas fa-eye"></i>{{ __("  Lihat") }}
                  </a>
                </li>
                <li class="divider"></li>
                <li class="">
                  <form action="{{ route("laporan.delete", $laporan->id) }}" method="POST">
                    @csrf
                    <button style="outline: none; border: none; background: none; text-align:center;"><i class="fas fa-trash"></i>{{ __("  Hapus") }}</button>
                  </form>
                </li>
              </ul>
              
            </label>
          </div> --}}
        {{-- </div>
        <div class="mt-3">
          <h3 class="" style="font-weight: bolder;">{{$laporan->judul}}</h3>
        </div>
        <div class="mt-3">
          {!!Str::limit($laporan->isi, 500)!!}
        </div>
  
        <div class="footer mt-3 ms-2">
          <p class="opacity-75"><i class="fas fa-comment me-2"></i>{{ \App\Models\Tanggapan::where("id_laporan", $laporan->id)->count()." tanggapan" }}</p>
        </div> --}}
        
      {{-- </div> --}}
    </li>
  </a>
  @empty
  <p class="ms-2">Tidak ada data</p>
  @endforelse
</ul>
@else
{{ $dataTable->table() }}
@push('scripts')
<script>
  $(document).ready(function(){
    $('.modal').modal('show');
});
</script>
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
@endif
@endsection