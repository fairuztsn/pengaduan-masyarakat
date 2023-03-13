@extends("layouts.app")
@section("title", "Ubah Password")
@section("content")
<div class="row">
    <div class="col-3"></div>
    <div class="col-6">
        <div class="p-5 bg-white rounded" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;" style="transform:scale(0.9)">
            <div class="d-flex justify-content-center align-items-center">
                <img src="{{ asset("img/password.png") }}" alt="" style="width: 200px;">
            </div>
            <form action="">
                @csrf
                <div class="mb-5 mt-3">
                    <label for="" class="form-label text-sm">Masukkan password-mu yang sekarang <span class="text-danger">*</span> </label>
                    <input type="password" class="form-control">
                </div>
                <div class="mb-3">
                    <button class="btn btn-outline-primary form-control" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">Selanjutnya <i class="fas fa-arrow-right ms-5"></i></button>
                </div>
            </form>
            </div>
    </div>
    <div class="col-3"></div>
</div>
@endsection