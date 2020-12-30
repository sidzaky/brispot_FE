<script src="https://code.highcharts.com/maps/highmaps.js"></script>
<script src="https://code.highcharts.com/maps/modules/exporting.js"></script>
<script src="https://code.highcharts.com/mapdata/countries/id/id-all.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ==" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==" crossorigin=""></script>


<div class="content-wrapper" id="dashboard">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dashboard/Summary
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-8">
        <div class="box">
          <div class="box-header with-border">
            <h2 class="box-title">Summary Klaster</h2>
          </div><!-- /.box-header -->
            <div class="box-body">
              <div id="mapid"></div>
              <div id="list_data"></div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="box">
            <div class="box-header with-border">
              <h2 class="box-title">Detail Klaster</h2>
            </div><!-- /.box-header -->
            <div class="box-body">
                <div class="col-sm-4"><label class="control-label">Klaster</label></div>
                <div class="col-sm-8"><?php echo $klaster[0]['nama_cluster_jenis_usaha_map']?></div> 
            </div>
            <div class="box-body">
                <div class="col-sm-4"><label class="control-label">Komoditas</label></div>
                <div class="col-sm-8"><?php echo $komoditas ?></div> 
            </div>
            <div class="box-body">
                <div class="col-sm-4"><label class="control-label">Lokasi</label></div>
                <div class="col-sm-8"><?php echo ($provinsi[0]['nama']!="" ? $provinsi[0]['nama'] : "Semua Provinsi" ) .', '.($kabupaten[0]['nama']!="" ? $kabupaten[0]['nama'] : "Semua Kota Kabupaten")  ?></div> 
            </div>
        </div>  
      </div>
      <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h2 class="box-title">Performa Daerah</h2>
            </div><!-- /.box-header -->
            <div class="col-sm-6">
              <div class="box-body">
                  <div class="col-sm-4"><label class="control-label">Luas Lahan</label></div>
                  <div class="col-sm-8"><?php echo number_format($performance['luas_lahan'])?> M<sup>2</sup> </div> 
              </div>
              <div class="box-body">
                  <div class="col-sm-4"><label class="control-label">Kapasitas Produksi</label></div>
                  <div class="col-sm-8"><?php echo number_format($performance['kapasitas_produksi'])?> Ton  </div> 
              </div>

              <div class="box-body">
                <div class="col-sm-4"><label class="control-label">Kebutuhan Kredit</label></div>
                    <div class="col-sm-8"><ul class="list-group">
                        <?php foreach ($performance['kk'] as $key => $value){
                              echo '<li>'.$key.' : '.$value.'</li>';
                    }?></ul>
                    </div> 
                    <div class="col-sm-4"><label class="control-label">Kebutuhan Prasarana</label></div>
                    <div class="col-sm-8"><ul class="list-group">
                        <?php foreach ($performance['ks'] as $key => $value){
                              echo '<li>'.$key.' : '.$value.'</li>';
                    }?></ul>
                    </div> 
                    <div class="col-sm-4"><label class="control-label">Pelatihan dan Pendidikan</label></div>
                    <div class="col-sm-8"><ul class="list-group">
                        <?php foreach ($performance['kp'] as $key => $value){
                              echo '<li>'.$key.' : '.$value.'</li>';
                    }?></ul>
                </div> 
              </div> 
           </div>
           <div class="col-sm-6">
              <div class="box-body">
                  <div id="container"></div>
              </div>
            </div>
              <div class="box-body">
                  
            </div>
          </div>
      </div>
   
    </div>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h2 class="box-title">List Klaster</h2>
          </div>
          <div class="box-body">
                <div class="table-responsive">
                  <table id="table-cluster" class="table table-striped table-bordered" width="100%">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama Klaster</th>
                        <th>Ketua Kelompok</th>
                        <th>No Hp</th>
                        <th>Jumlah Anggota</th>
                        <th>Kapasitas Produksi</th>
                        <th>Omset</th>
                        <th>Luas Lahan (M<sup>2</sup>)</th>
                        <th>Kebutuhan</th>
                        <th>Agen Brilink</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i=1;
                          foreach ($cluster as $row){
                              echo '<tr>';
                              echo '<td>'.$i.'</td>';
                              echo '<td>'.$row['kelompok_usaha'].'</td>';
                              echo '<td>'.$row['kelompok_perwakilan'].'</td>';
                              echo '<td>'.$row['kelompok_handphone'].'</td>';
                              echo '<td>'.$row['kelompok_jumlah_anggota'].'</td>';
                              echo '<td>'.number_format(($row['kapasitas_produksi']=="" ? "0" : $row['kapasitas_produksi'])).'</td>';
                              echo '<td>'.number_format($row['kelompok_omset']).'</td>';
                              echo '<td>'.number_format($row['kelompok_luas_usaha']).'</td>';
                              echo '<td><ul class="list-group">';
                              echo    '<li> Kredit  : '.$row['nama_kebutuhan_skema_kredit'].' </li>';
                              echo    '<li> Sarana  : '.$row['nama_kebutuhan_sarana'].' </li>';
                              echo    '<li> Pelatihan  : '.$row['nama_kebutuhan_pendidikan_pelatihan'].' </li>';
                              echo '</ul></td>';
                              echo '<td>'.($row['agen_brilink']== "Ya" ? "Ya" : "Belum").'</td>';
                              echo '</tr>';
                              $i++;
                          }
                        ?>
                    </tobdy>
                  </table>
              </div>
            </div>
          </div>
        </div>
      </div>
  </section>

<script src="<?php echo base_url(); ?>assets/js/summary.js"></script>

<script>
		var map = L.map('mapid').setView([<?php echo $koordinat[0]['lat'] .','. $koordinat[0]['long'].'],'. $koordinat[0]['zoom'] ?>);
		L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
			attribution: 'klasterkuhidupku.com ; peta <?php echo $koordinat[0]['nama']; ?>',
			maxZoom: 18,
			id: 'mapbox.streets',
			accessToken: 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw'
		}).addTo(map);
		var geojsonLayer = new L.GeoJSON.AJAX("geojson.json");       
		geojsonLayer.addTo(map);
	</script>
<style>
#mapid{
	width: 600px;
	height: 400px;
}
</style>

<script>
    $(document).ready(function() {$('#table-cluster').DataTable()});
    Highcharts.chart('container', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Periode Panen'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                }
            }
        },
        series: [{
            name: 'Jumlah',
            colorByPoint: true,
            data: [<?php $i=1;
                    foreach ($performance['panen'] as $key => $value){
                      echo "{";
                      echo 'name : "'.$key.'",';
                      echo 'y : '.$value ;
                      echo "}";
                      if ($i<count($performance['panen'])){$i++;echo ",";}
                  }?>]
          }]
    });
</script>


