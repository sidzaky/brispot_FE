<meta name="google-site-verification" content="-5c7n2yDdKK5fU1D1gLtok4-D8XLP2c_2YKWtk30MCc" />
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script src="https://code.jquery.com/jquery-migrate-3.0.0.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyDD-HjW_D_kUMx9W7MRP473fS-er_DgiYY&callback=initMap" defer></script>
<script src="https://code.highcharts.com/maps/highmaps.js"></script>
<script src="https://code.highcharts.com/maps/modules/exporting.js"></script>
<script src="https://code.highcharts.com/mapdata/countries/id/id-all.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<div class="content-wrapper" id="dashboard">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dashboard
    </h1>
  </section>
  <style>
    .newcard{
      border-radius: 15px;
      position: relative;
      padding-right: 5px;
      padding-left: 5px;
      padding-top: 1%;
      height:135px;
      text-align: center;
    }
    .newcardrekap{
      font-weight: bold; 
      color:#000000;
    }
  </style>

  <section class="content">
   
    <div class="row">  
      <div class="col-md-2">
        <div class="text-center newcard" style="background:#B5FACB; ">
          <a onclick="setmap(1)";> 
              <h2 class="newcardrekap">209</h2>
              <p>PERTANIAN, PERBURUAN dan PERHUTANAN</p>
          </a>
        </div>
      </div>
      <div class="col-md-2">
        <div class="text-center newcard" style="background:#F7BF81 ;">
        <a onclick="setmap(2)";> 
          <h2 class="newcardrekap">209</h2>
            <p>Judul 2</p>
          </div>
        </a>
      </div>
      <div class="col-md-2">
        <div class="text-center newcard" style="background:#82D4FD;">
        <h2 class="newcardrekap">209</h2>
          <p class="card-description">Judul 3</p>
        </div>
      </div>
      <div class="col-sm-2">
        <div class="text-center newcard" style="background:#a0bff0;">
        <h2 class="newcardrekap">209</h2>
          <p class="card-description">Judul 4</p>
        </div>
      </div>
      <div class="col-sm-2">
        <div class="text-center newcard" style="background:#e6e6ea;">
        <h2 class="newcardrekap">209</h2>
        <p class="card-description">Judul 5</p>
        </div>
        
      </div>
      <div class="col-sm-2">
        <div class="text-center newcard" style="background:#f4b6c2;">
        <h2 class="newcardrekap">209</h2>
          <p class="card-description">Judul 6</p>
        </div>
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-md-4">
          <div class="row">
            <div class="col-sm-12">
              <div class="text-center newcard"  style="background:#93caed; border-radius: 2px; ">
                <h2 class="newcardrekap">209 %</h2>
                <p>PERTANIAN, PERBURUAN dan PERHUTANAN</p>
              </div>
            </div>
            </div>
          </br>
          <div class="row">
            <div class="col-sm-12">
              <div class="text-center newcard" style="background:#93caed; border-radius: 2px; ">
                <h2 class="newcardrekap">209 %</h2>
                <p>PERTANIAN, PERBURUAN dan PERHUTANAN</p>
              </div>
            </div>
          </div>
            </br>
          <div class="row">
            <div class="col-sm-12">
              <div class="text-center newcard" style="background:#93caed; border-radius: 2px;">
                <h2 class="newcardrekap">209 %</h2>
                <p>PERTANIAN, PERBURUAN dan PERHUTANAN</p>
              </div>
            </div>
          </div>
        </div>
      <div class="col-md-8">
        <div class="box">
          <div class="box-header with-border" style="background:#5dbae8;" align="center">
            <h1 class="box-title" style="font-size:25px; "><b>Persebaran Klaster Seluruh Indonesia</b> 
          </h1>  
              <select id="selectormap" onchange="stylemap(this.value);" style="float:right;"> 
                  <option>Provinsi</option>
                  <option>Google</option>
              </select>
          </div><!-- /.box-header --> 
          <div class="box-body" id="byGoogleMap" style="display:none;">
            <div id="mapid"></div>
            <div id="list_data"></div>
          </div>
          <div class="box-body" id="byProvinsi" >
            <div id="mapidbyhighchart"></div>
          </div>
        </div>
      </div>
      <div class="col-md-12" id="listCluster" style="display:none;"  >
        <div class="box">
        <div class="box-header with-border" style="background:#5dbae8;">
                <h2 class="box-title" style="color:white;">List Klaster</h2>
            </div><!-- /.box-header -->
        <div class="box-body">
                <div class="col-sm-12"> 
                    <table id="table-cluster" class="table table-striped dataTable table-bordered" width="100%">
                        <thead>
                          <tr>
                          <th>No</th>
                          <th>Nama Klaster</th>
                          <th>Nama Mantri</th>
                          <th>Hp Mantri</th>
                          <th>Kota/Kabupaten</th>
                          <th>Kelurahan</th>
                          <th>Kecamatan</th>
                          <th>Ketua Kelompok</th>
                          <th>No Hp</th>
                          <th>Jumlah Anggota</th>
                          </tr>
                        </thead>
                      </table>
                </div>
             
        </div>
      </div>
     </div>
    </div>
  </section>
  
<script src="<?php echo base_url(); ?>assets/js/dashboard.js"></script>
  <style>
  #mapid{
    width: auto;
    height: 380px;
  }
  .infowindow-container {
      width: 330px;
    }

    .inner {
      display: inline-block;
      position: absolute;
      top: 0;
      padding: 10px;
    }
  table.dataTable td,
  table.dataTable th {
      font-size: 13px;
  }
  
  #mapidbyhighchart {
      height : 380px;
      min-width: 310px; 
      margin: 0 auto; 
    }
    .loading {
      margin-top: 10em;
      text-align: center;
      color: gray;
    }
  </style>
<script>
    var canvas = document.getElementById("barChart");
    var ctx = canvas.getContext('2d');

    // Global Options:
    Chart.defaults.global.defaultFontColor = 'black';
    Chart.defaults.global.defaultFontSize = 16;

    const data = {
      labels: [
        'Pertanian',
        'Kehutanan',
        'Perburuan'
      ],
      datasets: [{
        data: [300, 50, 100],
        backgroundColor: [
          'rgb(255, 99, 132)',
          'rgb(54, 162, 235)',
          'rgb(255, 205, 86)'
        ],
        hoverOffset: 4
      }]
    };

    var myBarChart = new Chart(ctx, {
      type: 'pie',
      data: data
    });

</script>
<script src="<?php echo base_url()?>/assets/js/send.js"></script>


