@extends("layouts.app")
@section("content")
<div class="m-4">
    <form method="POST" action="{{route("laporan.store")}}">
      @csrf
        <div class="m-4">
            <h3>Laporan Pengaduan</h3>
            <span style="opacity: 0.8;">{{ date("Y-m-d") }}</span>
        </div>
        <div class="form-group row m-3">
          <label class="col-sm-2 col-form-label">Isi laporan</label>
          <div class="col-sm-10">
            <textarea name="isi_laporan" class="form-control" rows="5">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Esse sequi voluptas doloribus, reprehenderit neque perferendis expedita magnam nesciunt placeat, a illum delectus. Similique delectus eum aliquid quidem fugit inventore, labore voluptatum sequi. Rem, atque doloribus! Qui fuga neque vero possimus nulla inventore tempore, expedita numquam quam minima? Alias, vitae est.</textarea>
          </div>
        </div>
        <div class="form-group row m-3">
          <label class="col-sm-2 col-form-label">Foto</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" value="test.jpg" name="foto">
          </div>
        </div>
        <div class="form-group row m-3">
            <label class="col-sm-2 col-form-label">Tanggal Pengaduan</label>
            <div class="col-sm-10">
              <input type="date" class="form-control" value="{{date("Y-m-d")}}" name="tanggal_pengaduan">
            </div>
        </div>
        <div class="form-group row m-3">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Kirim</button>
            </div>
        </div>
      </form>
</div>
@endsection