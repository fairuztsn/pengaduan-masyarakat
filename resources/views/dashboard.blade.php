@extends("layouts.app")
@section("title", "Dashboard")
@section("content")
<div class="bg-white rounded p-5 text-center">
  <h4>Jumlah laporan per bulan</h4>
  <div class="">
    <div id="chart"></div>
  </div>
</div>
<script src="{{ asset("cdn/apexchart.js") }}"></script>
<script>
  const months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
  var data = [];
  
  // Get data each month
  months.forEach(month => {
    data.push({
      x: months.indexOf(month)+1,
      y: 100
    });
  });
  var options = {
      chart: {
        type: 'bar'
      }
      ,series: [{
        data: data
      }]
  }

var chart = new ApexCharts(document.querySelector("#chart"), options);

chart.render();
</script>
@endsection