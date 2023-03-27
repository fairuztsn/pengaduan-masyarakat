@extends("layouts.app")

@section("title", "Dashboard")
@section("custom-css")
<style>
  .shadow-15 {
    box-shadow: rgba(255, 255, 255, 0.1) 0px 1px 1px 0px inset, rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px;
  }
  .shadow-13 {
    box-shadow: rgba(17, 12, 46, 0.15) 0px 48px 100px 0px;
  }
  .shadow-46 {
    box-shadow: rgba(0, 0, 0, 0.1) 0px 10px 50px;
  }
  .shadow-0 {
    
  }
  .rounded-v {
    border-radius: 20px;
  }

  .hover-1 {
    transition: 0.15s;
  }
  .hover-1:hover {
    box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
    cursor: pointer;
  }
  .hover-1:active {
    transform: scale(0.98);
  }
</style>
@endsection

@section("content")
<div class="row">
  <div class="col-6">
    <div class="row">
      <div class="col-11 bg-white text-center p-4 m-3 rounded-v d-flex justify-content-center align-items-center hover-1" 
      onclick="window.location.href = '{{ route('laporan.index') }}'">
        <div class="">
          <label for="" class="text-md mb-1">Laporan hari ini</label><br>
          <span class="text-success"><i class="fas fa-book me-3"></i>{{ $todays_report }}</span>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-5 bg-white text-center p-4 ms-4 rounded-v d-flex justify-content-center align-items-center hover-1" 
      onclick="window.location.href = '{{ route('user.index') }}'">
        <div class="">
          <label for="" class="text-md mb-1">Petugas</label><br>
          <span class="text-danger"><i class="fas fa-user me-3"></i>{{ $petugas_count }}</span>
        </div>
      </div>
      <div class="col-5 bg-white text-center p-4 ms-4 rounded-v d-flex justify-content-center align-items-center hover-1" 
      @if(Auth::user()->role_id == 3) onclick="window.location.href = '{{ route('user.index') }}'" @endif>
        <div>
          <label for="" class="text-md mb-1">Masyarakat</label><br>
        <span class="text-primary"><i class="fas fa-user me-3"></i>{{ $user_count }}</span>
        </div>
      </div>
    </div>
  </div>

  <div class="col-5 bg-white text-left p-4 m-3 rounded-v d-flex justify-content-center align-items-center hover-1">
    
      <img src="{{ asset("img/shapes.png") }}" alt="" style="width: 150px;">
      <label for="" class="text-md mb-1"><span class="text-sm">Selamat datang</span>, <br> {{Auth::user()->nama}}</label>
    
  </div>
</div>

<div class="row mt-2">
  <div class="col-11 bg-white p-4 m-3 rounded-v  hover-1">
    <div>
      <span class="ms-2 me-2 opacity-50">Hari ini </span> {{ $today }}
    </div>
  </div>
</div>

<div class="row">
  <div class="col-11 bg-white p-5 m-3 rounded-v  hover-1">
    <div id="chart"></div>
  </div>
</div>
@endsection

@section("js-scripts")
<script>
  function redirect(route) {
    location.href = route
  }
</script>
<script src="{{ asset("cdn/apexchart.js") }}"></script>
<script>

  $.getJSON("{{ route('laporan.data') }}", function(result) {
    let data = [];
    let keys = [];

    result.data.forEach(element => {
      let currentKey = Object.keys(element)[0];
      keys.push(currentKey);
    });

    var options = {
          series: [{
          name: 'Belum diproses',
          data: result.data.map(each => {
            return each[Object.keys(each)[0]]["Belum diproses"]
          })
        }, {
          name: 'Sedang diproses',
          data: result.data.map(each => {
            return each[Object.keys(each)[0]]["Sedang diproses"]
          })
        }, {
          name: 'Ditolak',
          data: result.data.map(each => {
            return each[Object.keys(each)[0]]["Ditolak"]
          })
        }, {
          name: 'Selesai',
          data: result.data.map(each => {
            return each[Object.keys(each)[0]]["Selesai"]
          })
        }],
          chart: {
          type: 'bar',
          height: 400,
          stacked: true,
        },
        plotOptions: {
          bar: {
            horizontal: true,
            dataLabels: {
              total: {
                enabled: true,
                offsetX: 0,
                style: {
                  fontSize: '13px',
                  fontWeight: 900
                }
              }
            }
          },
        },
        stroke: {
          width: 1,
          colors: ['#fff']
        },
        title: {
          text: 'Grafik Laporan Pengaduan 6 Bulan Terakhir'
        },
        xaxis: {
          categories: keys,
          labels: {
            formatter: function (val) {
              return val + ""
            }
          },
          title: {
            text: "Jumlah"
          }
        },
        yaxis: {
          title: {
            text: "Bulan"
          },
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return val + ";"
            }
          }
        },
        fill: {
          opacity: 1
        },
        legend: {
          position: 'top',
          horizontalAlign: 'left',
          offsetX: 40
        }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
  });
</script>
@endsection