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
      <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h2 class="box-title">Performa Daerah</h2>
            </div><!-- /.box-header -->
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
                            echo "<td>".$s."</td>";
                            echo "<td>".$key."</td>";
                            echo "<td>".number_format($row['total'],'0',',','.')."</td>";
                            $i=0;
                            foreach ($data_bps as $srow){
                              if ($srow['nama_cluster_jenis_usaha'] == $key){
                                echo "<td>".number_format($srow['value'],'0',',','.')."</td>";
                                echo "<td>".($srow['value'] != "" || $srow['value']!=0 ? round(($row['total']/$srow['value'] * 100), 2)."%" : "-" )."</td>";
                                $i=0;
                                break;
                              }
                              $i++;
                            }
                            if ($i!=0)  {
                              echo "<td> tidak ada data </td>";
                              echo "<td> - </td>";
                            }
                           
                            echo "</tr>";
                            $s++;
                          }
                        ?>
                      </tbody>
                    </table>
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
<?php print_r ($data_bps)?>
<script src="<?php echo base_url(); ?>assets/js/summary.js"></script>

<script>

  let listloc      = <?php echo json_encode($listloc)?>;
  let latcenter   = <?php echo $koordinat[0]['lat']?>;
  let longcenter  = <?php echo $koordinat[0]['long']?>;
  let zoomcenter  = <?php echo $koordinat[0]['zoom']?>;
  
  $('#table-cluster').DataTable();
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


