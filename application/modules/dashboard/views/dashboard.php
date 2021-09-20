<meta name="google-site-verification" content="-5c7n2yDdKK5fU1D1gLtok4-D8XLP2c_2YKWtk30MCc" />
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script src="https://code.jquery.com/jquery-migrate-3.0.0.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyDD-HjW_D_kUMx9W7MRP473fS-er_DgiYY&callback=initMap" defer></script>
<script src="https://code.highcharts.com/maps/highmaps.js"></script>
<script src="https://code.highcharts.com/maps/modules/exporting.js"></script>
<script src="https://code.highcharts.com/mapdata/countries/id/id-all.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url()?>assets/css/dashboard.css">
<div class="content-wrapper" id="dashboard">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dashboard
    </h1>
  </section>
  <style>
  
  </style>

  <section class="content">
   
    <div class="row">  
      <div class="col-lg-2 col-6" style="flex: 0 0 16.666667%;max-width: 16.666667%;">
          <div class="small-box" style="background-color: #28a745  !important;" >
            <div class="inner">
              <h3 onclick="setmap(<?php echo $report[0]['id_cluster_jenis_usaha_map']?>)"><b> 
                  <?php echo $report[0]['perhitungan']?></b> 
              </h3>
              <p>Klaster</p>
            </div>
            <div class="icon">
              <i class="fa fa-tree "></i>
            </div>
            <a href="#" onclick="setmap(<?php echo $report[0]['id_cluster_jenis_usaha_map']?>)" class="small-box-footer">PERTANIAN</a>
          </div>
      </div>
      <div class="col-lg-2 col-6" style="flex: 0 0 16.666667%;max-width: 16.666667%;">
          <div class="small-box" style="background-color: #17a2b8 !important;" >
            <div class="inner">
              <h3 onclick="setmap(<?php echo $report[2]['id_cluster_jenis_usaha_map']?>)"><b> 
                  <?php echo $report[2]['perhitungan']?> </b></h3>
              <p>Klaster</p>
            </div>
            <div class="icon">
              <i class="fa fa-tint "></i>
            </div>
            <a href="#" onclick="setmap(<?php echo $report[2]['id_cluster_jenis_usaha_map']?>)" class="small-box-footer">PERIKANAN</a>
          </div>
      </div>
      <div class="col-lg-2 col-6" style="flex: 0 0 16.666667%;max-width: 16.666667%;">
          <div class="small-box" style="background-color: #ffc107  !important;" >
            <div class="inner">
              <h3 onclick="setmap(<?php echo $report[3]['id_cluster_jenis_usaha_map']?>)"><b> 
                <?php echo $report[3]['perhitungan']?></b> </h3>
              <p>Klaster</p>
            </div>
            <div class="icon">
              <i class="fa fa-industry "></i>
            </div>
            <a href="#" onclick="setmap(<?php echo $report[3]['id_cluster_jenis_usaha_map']?>)" class="small-box-footer">INDUSTRI PENGOLAHAN</a>
          </div>
      </div>
      <div class="col-lg-2 col-6" style="flex: 0 0 16.666667%;max-width: 16.666667%;">
          <div class="small-box" style="background-color: #c1a7b0 !important;" >
            <div class="inner">
              <h3 onclick="setmap(<?php echo $report[4]['id_cluster_jenis_usaha_map']?>)" ><b> <?php echo $report[4]['perhitungan']?></b> </b></h3>
              <p>Klaster</p>
            </div>
            <div class="icon">
              <i class="fa fa-check "></i>
            </div>
            <a href="#" onclick="setmap(<?php echo $report[4]['id_cluster_jenis_usaha_map']?>)" class="small-box-footer">JASA JASA</a>
          </div>
      </div>
      <div class="col-lg-2 col-6" style="flex: 0 0 16.666667%;max-width: 16.666667%;">
          <div class="small-box" style="background-color: #7d3865 !important;" >
            <div class="inner">
              <h3 onclick="setmap(<?php echo $report[5]['id_cluster_jenis_usaha_map']?>)"><b> <?php echo $report[5]['perhitungan']?></b> </b></h3>
              <p>Klaster</p>
            </div>
            <div class="icon">
              <i class="fa fa-sellsy "></i>
            </div>
            <a href="#" onclick="setmap(<?php echo $report[5]['id_cluster_jenis_usaha_map']?>)" class="small-box-footer">PERDAGANGAN</a>
          </div>
      </div>
      <div class="col-lg-2 col-6" style="flex: 0 0 16.666667%;max-width: 16.666667%;">
          <div class="small-box" style="background-color: #949217 !important;" >
            <div class="inner">
              <h3 onclick="setmap(<?php echo $report[6]['id_cluster_jenis_usaha_map']?>)"><b> <?php echo $report[6]['perhitungan']?></b> </b></h3>
              <p>Klaster</p>
            </div>
            <div class="icon">
              <i class="fa fa-plane "></i>
            </div>
            <a href="#"  onclick="setmap(<?php echo $report[6]['id_cluster_jenis_usaha_map']?>)" class="small-box-footer">PARIWISATA</a>
          </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-3">
          <div class="row">
            <div class="col-sm-12">
                <div class="info-box mb-3">
                  <span class="info-box-icon bg-danger "  style="background-color: #00bc8c  !important;"><i class="fa fa-thumbs-up"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text" style="font-size:14px;"><b>Akuisisi Simpanan</b></span>
                    <span class="info-box-number" style="font-size:20px;"><b><?php echo number_format($akuisisi[0]["jumlah_akuisisi_simpanan"]) ?><b></span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
              </div>
            </div>
            <br>

            <div class="row">
              <div class="col-sm-12">
                <div class="info-box mb-3">
                  <span class="info-box-icon elevation-1" style="background-color: #e74c3c !important;"><i class="fa fa-users"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text" style="font-size:14px;"><b>Akuisisi Pinjaman<b></span>
                    <span class="info-box-number" style="font-size:20px;"><b><?php echo number_format($akuisisi[0]["jumlah_akuisisi_pinjaman"])?><b></span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-sm-12">
                <div class="info-box mb-3">
                  <span class="info-box-icon bg-danger elevation-1" style="background-color: #3498db   !important;"><i class="fa fa-percent"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text" style="font-size:14px;"><b>Inklusi<b></span>
                    <span class="info-box-number" style="font-size:20px;"><b><?php echo $akuisisi[0]["jumlah_akuisisi_inklusi"] ?>  %<b></span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
              </div>
            </div>
      </div>
      <div class="col-md-9">
        <div class="box">
          <div class="box-header with-border" style="background:#5dbae8;" align="center">
            <h1 class="box-title" style="font-size:25px; "><b>Persebaran Klaster Seluruh Indonesia</b> 
          </h1>  
              <select id="selectormap" onchange="stylemap(this.value);" style="float:right;"> 
                  <option>Provinsi</option>
                  <option>Google</option>
              </select>
          </div><!-- /.box-header --> 
          <div class="box-body" >
            <div id="byGoogleMap" style="display:none">
              <div id="mapid"></div>
              <div id="list_data"></div>
            </div>
            <div id="byProvinsi" style="display:block">
              <div id="mapidbyhighchart"></div>
            </div> 
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
                          <th>Kota/Kabupaten</th>
                          <th>Jumlah Anggota</th>
                          <th>Hasil Produk</th>
                          <th>Varian</th>
                          <th>Agen Brilink</th>
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
    height: 280px;
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
      height : 280px;
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


