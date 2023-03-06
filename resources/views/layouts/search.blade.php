@extends("layouts.app")
@section("content")
<form action="" method="GET">
    @csrf
    <select name="table" id="table" class="form-control">
        <option value="" disabled selected>Pilih tabel</option>
        <option value="user">User</option>
        <option value="laporan">Laporan</option>
        <option value="tanggapan">Tanggapan</option>
    </select>

    <select name="user" id="user">
        <option value="" disabled selected>Pilih Field</option>
        <option value=""></option>
    </select>
</form>
<script>
    $("select").change(function() {
        var selected = "";
        $("select option:selected").each(function() {
            selected = $(this).text();
        });

        if(selected == "User") {

        }
    }).trigger("change");
//     $( "select" )
//   .change(function() {
//     var str = "";
//     $( "select option:selected" ).each(function() {
//       str += $( this ).text() + " ";
//     });
//     $( "div" ).text( str );
//   })
//   .trigger( "change" );
</script>
@endsection