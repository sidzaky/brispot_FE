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

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h2 class="box-title"><b>Rekapitulasi Komoditas</b></h2>
          </div><!-- /.box-header -->
          <div class="box-body">
            <?php
                foreach ($report as $row) {
                  echo "<div class='col-md-4 col-sm-6 col-xs-12'>";
                  echo "<div class='info-box' style='background:transparent; box-shadow: none'>";
                  echo "<span class='info-box-icon' style='background: none;'>";
                  echo "<img onclick='setmap(\"".$row["id_cluster_jenis_usaha_map"]."\");' src='assets/img/dashboard/" . ($row['icon'] !="" ? $row['icon'] : "unknown.png") . "' />";
                  echo "</span>";
                  echo "<div class='info-box-content'>";
                  echo "<span class='info-box-text' style='white-space: normal;'>" . $row['nama_cluster_jenis_usaha_map'] . "</span>";
                  echo "<span class='info-box-number'>" .$row['perhitungan'] . " klaster</span>";
                  echo "</div>";
                  echo "</div>";
                  echo "</div>";
                }
              ?>
          </div>
      </div>
    </div>
      <div class="col-md-4">
          <div class="box">
            <div class="box-header with-border">
              <h2 class="box-title"><b>Klaster Dan BPS</b></h2>
            </div><!-- /.box-header -->
            <div class="box-body">
            </div>
          </div>
        </div>
      <div class="col-md-8">
        <div class="box">
          <div class="box-header with-border" align="center">
            <h1 class="box-title" style="font-size:25px"><b>Persebaran Klaster Seluruh Indonesia</b> 
          </h1>  
              <select id="selectormap" onchange="stylemap(this.value);" style="float:right;"> 
                  <option>Google</option>
                  <option>Provinsi</option>
              </select>
          </div><!-- /.box-header --> 
          <div class="box-body" id="byGoogleMap">
            <div id="mapid"></div>
            <div id="list_data"></div>
          </div>
          <div class="box-body" id="byProvinsi" style="display:none;">
            <div id="mapidbyhighchart"></div>
          </div>
        </div>
      </div>
   
    
      <div class="col-md-6">
        <div class="box">
            <div class="box-header with-border"  style="background:#5dbae8;">
                <h2 class="box-title" style="color:white;"> Deskripsi</h2>
            </div><!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-12">
                <div class="col-sm-12"> 
                  <div class="box-header with-border">
                        <h2 class="box-title" id="jum_title"></h2>
                  </div>
                  <div class="box-body" id="jum_deskripsi"></div>
                </div>
              </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="box">
        <div class="box-header with-border" style="background:#5dbae8;">
                <h2 class="box-title" style="color:white;">Detail Klaster</h2>
            </div><!-- /.box-header -->
        <div class="box-body">
                <div class="col-sm-12"> 
                  <ul class="sidebar-menu" id="sidebar-app">
                    <li class="treeview">
                        <a href="#">
                          <i class="fa fa-bar-chart"></i> <span>Laporan Klaster</span>
                          <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu menu-open">         
                                <li></li>
                        </ul>
                    </li>
                  </ul>
                </div>
             
        </div>
      </div>
   
    </div>
  </section>
  
<script src="<?php echo base_url(); ?>assets/js/dashboard.js"></script>



  <style>
  #mapid{
    width: auto;
    height: 400px;
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
<script src="<?php echo base_url()?>/assets/js/send.js"></script>


