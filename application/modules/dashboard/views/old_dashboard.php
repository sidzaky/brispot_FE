<script src="https://code.highcharts.com/maps/highmaps.js"></script>
<script src="https://code.highcharts.com/maps/modules/exporting.js"></script>
<script src="https://code.highcharts.com/mapdata/countries/id/id-all.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<meta name="google-site-verification" content="-5c7n2yDdKK5fU1D1gLtok4-D8XLP2c_2YKWtk30MCc" />
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script src="https://code.jquery.com/jquery-migrate-3.0.0.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDD-HjW_D_kUMx9W7MRP473fS-er_DgiYY&callback=initMap" defer></script>

<div class="content-wrapper" id="dashboard">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dashboard
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h2 class="box-title">Summary Provinsi</h2>
          </div><!-- /.box-header -->
          <div class="box-body">
            <div id="mapid"></div>
            <div id="list_data"></div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-8">
        <div class="box">
          <div class="box-header with-border">
            <h2 class="box-title">Performa Akuisisi</h2>
          </div><!-- /.box-header -->
          <div class="box-body">
              <div class="col-md-12">
                <canvas id="myChart" height="120"></canvas>
              </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="box">
          <div class="box-header with-border">
            <h2 class="box-title">Data Agent</h2>
          </div><!-- /.box-header -->
          <div class="box-body">
            <div class="cluster-needs-list">
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-8">Agent Qriss</div>
                  <div class="col-md-4"><b><?php echo $agen_qris[0]['agen_qris']?></b></div>
                </div>  
              </div>
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-8">Agent Brilink</div>
                  <div class="col-md-4"><b><?php echo $agen_brilink[0]['agen_brilink']?></b></div>
                </div>  
              </div>
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-8">Agent Stroberi</div>
                  <div class="col-md-4"><b><?php echo $agen_stroberi[0]['agen_stroberi']?></b></div>
                </div>  
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>



<!-- dashboard scripts -->

<script src="<?php echo base_url(); ?>assets/js/dashboard.js"></script>
<script src="<?php echo base_url(); ?>assets/js/send.js"></script>
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['akuisisi Simpanan', 'akuisisi Pinjaman', 'Jumlah Rekening Simpanan', 'Jumlah Rekening Pinjaman'],
            datasets: [{
                label: '# Data',
                data: [<?php echo $jumlah_akuisisi[0]['jumlah_akuisisi_simpanan'].",".$jumlah_akuisisi[0]['jumlah_akuisisi_pinjaman'].",".$jumlah_rekening[0]['jumlah_rekening_simpanan'].",".$jumlah_rekening[0]['jumlah_rekening_pinjaman']?>],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
<style>
    #map {
      height : 500px;
      min-width: 310px; 
      margin: 0 auto; 
    }
    .loading {
      margin-top: 10em;
      text-align: center;
      color: gray;
    }
</style>
