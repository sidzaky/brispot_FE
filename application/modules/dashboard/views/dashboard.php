<meta name="google-site-verification" content="-5c7n2yDdKK5fU1D1gLtok4-D8XLP2c_2YKWtk30MCc" />
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script src="https://code.jquery.com/jquery-migrate-3.0.0.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyDD-HjW_D_kUMx9W7MRP473fS-er_DgiYY&callback=initMap" defer></script>
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
            <hr>
          <div class="box-header with-border" align="center">
            <h1 class="box-title" style="font-size:25px"><b>Persebaran Klaster Seluruh Indonesia</b></h1>
          </div><!-- /.box-header -->
          <div class="box-body">
            <div id="mapid"></div>
            <div id="list_data"></div>
          </div>
        </div>
      </div>
   
    
      <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h2 class="box-title">Performa Daerah</h2>
            </div><!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-6">
                <div class="col-sm-12"> 
                  <div class="box-header with-border">
                    <h2 class="box-title">Deskripsi Singkat</h2>
                  </div>
                  <div class="box-body"><?php echo $provinsi[0]['summary'] ?></div>
                </div>
               
                <div class="col-sm-12"> 
                  <div class="box-header with-border">
                      <h2 class="box-title">Detail Provinsi</h2>
                  </div>
                  <div class="box-body">
                    <div class="col-sm-4"><label class="control-label">Luas Provinsi</label></div>
                    <div class="col-sm-8"><?php echo number_format($provinsi[0]['luas_wilayah']) ?> Km<sup>2</sup> </div>
                  </div>
                  <div class="box-body">
                    <div class="col-sm-4"><label class="control-label">Jumlah Penduduk</label></div>
                    <div class="col-sm-8"><?php echo number_format($provinsi[0]['penduduk']) ?> Jiwa</div>
                  </div>
                  <div class="box-body">
                    <div class="col-sm-4"><label class="control-label">Kabupaten / Kota </label></div>
                    <div class="col-sm-8"><?php echo $provinsi[0]['kab'].' / '.$provinsi[0]['kota'] ?> </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                
                <div class="box-header with-border">
                    <h2 class="box-title">Data BPS</h2>
                </div>
                <div class="box-body">
                  <div class="col-sm-12">
                    <div class="table-responsive">
                          <table id="table-performance" class="table table-striped dataTable table-bordered" width="100%">
                            <thead>
                              <tr>
                                <th>No</th>
                                <th>Kategori Usaha</th>
                                <th>Total Data</th>
                                <th>Data BPS</th>
                                <th>Persentase</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php 
                                $s=1;
                                foreach ($performance['jenis_usaha'] as $key=>$row ){
                                  echo "<tr>";
                                  foreach ($data_bps as $srow){
                                    if ($srow['nama_cluster_jenis_usaha'] == $key){ 
                                      echo "<td>".$s."</td>";
                                      echo "<td>".$key."</td>";
                                      echo "<td>".number_format($row['total'],'0',',','.')."</td>";
                                      echo "<td>".number_format($srow['value'],'0',',','.')."</td>";
                                      echo "<td>".($srow['value'] != "" || $srow['value']!=0 ? round(($row['total']/$srow['value'] * 100), 2)."%" : "-" )."</td>";
                                      $s++;
                                      break;
                                    }
                                  }
                                  echo "</tr>";
                                 
                                }
                              ?>
                            </tbody>
                          </table>
                      </div>
                    </div>
                  </div>
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
  </style>
<script src="<?php echo base_url()?>/assets/js/send.js"></script>


