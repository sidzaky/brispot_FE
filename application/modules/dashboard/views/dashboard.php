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
            <h2 class="box-title">Persebaran Klaster</h2>
          </div><!-- /.box-header -->
          <div class="box-body">
            <div class="col-md-12">
              <div id="result" class="box-body">
                <?php if ($this->session->userdata('permission')>2) {?>
                  <form action="./dashboard/summary" method="POST" target="_blank">
                  <div class="col-sm-4">
                      <div class="form-group">
                              <label class="control-label">Sektor Usaha</label>
                              <select class="form-control" onchange="fjum(this.value);fp();" name="id_cluster_sektor_usaha" id="id_cluster_sektor_usaha" required >
                                  <option value="">Pilih Salah Satu </option>
                                  <option value="1">Produksi</option>
                                  <option value="2">Non Produksi</option>			
                              </select>
                          </div>
                      </div>
                      <div class="col-sm-4">
                          <div class="form-group" id="selkanca">
                              <label class="control-label">Kategori Usaha</label>
                              <select class="form-control" onchange="fju(this.value);fp();" name="id_cluster_jenis_usaha_map" id="id_cluster_jenis_usaha_map" required >
                                <option value="">Pilih Salah Satu </option>
                              </select>
                          </div>
                      </div>
                      <div class="col-sm-4">
                          <div class="form-group" id="selunit">
                              <label class="control-label">Jenis Usaha</label>
                              <select class="form-control" onchange="fhp(this.value);fp();" name="id_cluster_jenis_usaha" id="id_cluster_jenis_usaha" required >
                                <option value="">Pilih Salah Satu </option>
                              </select>
                          </div>
                      </div>
                      <div class="col-sm-3">
                          <div class="form-group" id="selunit">
                              <label class="control-label">Bentuk/Produk Usaha</label>
                              <select class="form-control" onchange="fv(this.value);fp();" name="hasil_produk" id="hasil_produk" required >
                                <option value="">Pilih Salah Satu </option>
                              </select>
                          </div>
                      </div>
                      <div class="col-sm-3">
                          <div class="form-group" id="selunit">
                              <label class="control-label">Varian</label>
                              <select class="form-control" onchange="fp();" name="varian" id="varian">
                                <option value="">Pilih Salah Satu </option>
                              </select>
                          </div>
                      </div>

                      <div class="col-sm-3">
                          <div class="form-group" id="selunit">
                              <label class="control-label">Provinsi</label>
                              <select class="form-control" onchange="getkotakab(this.value);" name="provinsi" id="provinsi">
                                  <option value=""> Semua </option>
                                  <?php foreach ($provinsi as $row) {
                                    echo "<option value='" . $row['id'] . "'>" . $row['nama'] . "</option>";
                                  } ?>
                              </select>
                          </div>
                      </div>
                      <div class="col-sm-3">
                          <div class="form-group" id="selunit">
                              <label class="control-label">Kota / Kabupaten</label>
                              <select class="form-control" name="kabupaten" id="kabupaten"  >
                                <option value=""> Semua </option>
                              </select>
                          </div>
                      </div>
                      <div class="col-sm-12">    
                          <button type="submit" class="btn btn-success waves-effect waves-light" id="sbt">Cari</button>
                      </div>
                  </form>
                    <?php } ?>
                </div>
              <div id="map"></div>
            </div>
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
