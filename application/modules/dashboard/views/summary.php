<script src="https://code.highcharts.com/maps/highmaps.js"></script>
<script src="https://code.highcharts.com/maps/modules/exporting.js"></script>
<script src="https://code.highcharts.com/mapdata/countries/id/id-all.js"></script>

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
              <div id="map"></div>
                <div id="list_data">
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
                          <th>Luas Lahan (M<sup>2</sup></th>
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
                                echo '<td>'.$row['kapasitas_produksi'].'</td>';
                                echo '<td>'.$row['kelompok_omset'].'</td>';
                                echo '<td>'.$row['kelompok_luas_usaha'].'</td>';
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
                <div class="col-sm-8"><?php echo $provinsi[0]['nama'] .', '.$kabupaten[0]['nama'] ?></div> 
            </div>

            <div class="box-header with-border">


              <h2 class="box-title">Performa Daerah</h2>
            </div><!-- /.box-header -->
              <div class="box-body">
                  <div class="col-sm-4"><label class="control-label">Luas Lahan</label></div>
                  <div class="col-sm-8"><?php echo $performance['luas_lahan']?> M<sup>2</sup> </div> 
              </div>
              <div class="box-body">
                  <div class="col-sm-4"><label class="control-label">Kapasitas Produksi</label></div>
                  <div class="col-sm-8"><?php echo $performance['kapasitas_produksi']?> Ton  </div> 
              </div>
              <div class="box-body">
                  <div class="col-sm-4"><label class="control-label">Periode Panen</label></div>
                  <div class="col-sm-8"><?php echo $performance['panen']?>  </div> 
              </div>
          </div>
      </div>
      <div class="col-md-4">
        <div class="box">
            <div class="box-header with-border">
              <h2 class="box-title">Kebutuhan</h2>
            </div><!-- /.box-header -->
              <div class="box-body">
                  <div class="col-sm-4"><label class="control-label">Saranan Prasana</label></div>
                  <div class="col-sm-8"><ul class="list-group">
                      <?php foreach ($performance['kebutuhan_pendidikan_pelatihan'] as $key => $value){
                            echo '<li>'.$key.' : '.$value.'</li>';
                  }?></ul>
                  
                </div> 
              </div>
          </div>
      </div>
    </div>

<script src="<?php echo base_url(); ?>assets/js/summary.js"></script>

<script>
   Highcharts.mapChart('map', {
                  chart: {
                      map: 'countries/id/id-all'
                  },
                  title: {
                      text: 'Persebaran Klaster BRI berdasarkan Provinsi'
                  },
                  subtitle: {
                      text: 'Source map: <a href="http://code.highcharts.com/mapdata/countries/id/id-all.js">Indonesia</a>'
                  },
                  mapNavigation: {
                      enabled: true,
                      buttonOptions: {
                          verticalAlign: 'bottom'
                      }
                  },
                  series: [{
                      data: ['id-ji'],
                      name: 'Data klaster',
                      states: {
                          hover: {
                              color: '#BADA55'
                          }
                      },
                      dataLabels: {
                          enabled: true,
                          format: '{point.name}'
                      }
                  }]
              });
</script>
<style>
#mapid{
	width: 600px;
	height: 400px;
}
</style>


