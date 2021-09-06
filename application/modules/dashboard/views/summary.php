<meta name="google-site-verification" content="-5c7n2yDdKK5fU1D1gLtok4-D8XLP2c_2YKWtk30MCc" />
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script src="https://code.jquery.com/jquery-migrate-3.0.0.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDD-HjW_D_kUMx9W7MRP473fS-er_DgiYY&callback=initMap" defer></script>
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
                    <tbody>
                        <?php 
                        $i=1;
                          foreach ($cluster as $row){
                              echo '<tr>';
                              echo '<td>'.$i.'</td>';
                              echo '<td><form action="'.base_url().'cluster/cluster_anggota" target="_blank" method="POST"><a action="#" onclick="document.getElementById(\'actanggota'.$i.'\').click()">' .$row['kelompok_usaha'].'</a><button  style="display:none;" id="actanggota'.$i.'" name="id" value="' . $row['id'] . '" type="submit"></button></form></td>';
                              echo '<td>'.$row['nama_pekerja'].'</td>';
                              echo '<td>'.$row['handphone_pekerja'].'</td>';
                              echo '<td>'.$row['nama_kabupaten'].'</td>';
                              echo '<td>'.$row['nama_kelurahan'].'</td>';
                              echo '<td>'.$row['nama_kecamatan'].'</td>';
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

  let listloc      = <?php echo json_encode($listloc)?>;
  let latcenter   = <?php echo $koordinat[0]['lat']?>;
  let longcenter  = <?php echo $koordinat[0]['long']?>;
  let zoomcenter  = <?php echo $koordinat[0]['zoom']?>;

</script>

<style>
#mapid{
	width: auto;
	height: 400px;
}
table.dataTable td,
table.dataTable th {
    font-size: 13px;
}
</style>
<script src="<?php echo base_url()?>/assets/js/send.js"></script>


