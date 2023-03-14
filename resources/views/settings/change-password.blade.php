@extends("layouts.app")
@section("title", "Ubah Password")
@section("content")
<div class="row">
    <div class="col-3"></div>
    <div class="col-6">
        <div class="p-5 bg-white rounded" id="box" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;" style="transform:scale(0.9)">
            <div class="d-flex justify-content-center align-items-center">
                <img src="{{ asset("img/password.png") }}" alt="" style="width: 200px;">
            </div>
            <form>
                <div class="mb-5 mt-3">
                    <label for="" id="alert" class="form-label text-sm text-danger"></label>
                    <label for="" class="form-label text-sm">Masukkan password-mu yang sekarang <span class="text-danger">*</span> </label>
                    <input type="password" class="form-control" id="password">
                </div>
                <div class="mb-3">
                    <button type="button" class="btn btn-outline-primary form-control" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;" onclick="validate()">Selanjutnya <i class="fas fa-arrow-right ms-5"></i></button>
                </div>
            </form>
            </div>
    </div>
    <div class="col-3"></div>
</div>
<script>
    function update() {
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
          });

      $.ajax({
          type: "POST",
          url: "{{ route('settings.profile.update-password') }}",
          dataType: 'JSON',
          data: {
              "_token" : "{{ csrf_token() }}",
              "password": $('#password').val(),
              "retyped_password": $("#re-typed-password").val()
          },
          success: function (data) {
              //
              if(data.response === "success") {
                $("#box").html(data.returns);
              }else {
                $("#alert").html(data.message);
              }
          }
      });
    }

    function validate() {
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
          });

      $.ajax({
          type: "POST",
          url: "{{ route('settings.profile.validate-old-password') }}",
          dataType: 'JSON',
          data: {
              "_token" : "{{ csrf_token() }}",
              "password": $('#password').val()
          },
          success: function (data) {
              //
              if(data.response === true) {
                $("#box").html(data.returns);
              }else {
                $("#alert").html(data.message);
              }
          }
      });
    }
    
</script>
@endsection