@extends("layouts.app")
@section("title", "User - Create")
@section("content")
<div class="p-5 bg-white rounded" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;" style="transform:scale(0.9)">
    <form>
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" class="form-control" id="" name="email">
          <div id="" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label class="form-label">NIK</label>
            <input type="number" class="form-control" id="" name="nik" min=0>
            <div id="" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="email" class="form-control" id="" name="email">
            <div id="" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="email" class="form-control" id="" name="email">
            <div id="" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="email" class="form-control" id="" name="email">
            <div id="" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="email" class="form-control" id="" name="email">
            <div id="" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
</div>
@endsection