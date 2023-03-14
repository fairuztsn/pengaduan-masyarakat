<div class="d-flex justify-content-center align-items-center">
    <img src="{{ asset("img/new-password.png") }}" alt="" style="width: 200px;">
</div>
<form action="" method="POST">
    @csrf
    <div class="mb-3 mt-3">
        <label for="" id="alert" class="form-label text-sm text-danger"></label>
        <label for="" class="form-label text-sm">Masukkan password-mu yang baru <span class="text-danger">*</span> </label>
        <input type="password" class="form-control"id="password">
    </div>
    <div class="mb-5">
        <label for="" class="form-label text-sm">Ketik ulang password-mu yang baru <span class="text-danger">*</span> </label>
        <input type="password" class="form-control" id="re-typed-password">
    </div>
    <div class="mb-3">
        <button type="button" class="btn btn-outline-primary form-control" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;" onclick="update()">Ubah password <i class="fas fa-key ms-5"></i></button>
    </div>
</form>
</div>