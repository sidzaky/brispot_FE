<script src="https://code.highcharts.com/maps/highmaps.js"></script>
<script src="https://code.highcharts.com/maps/modules/exporting.js"></script>
<script src="https://code.highcharts.com/mapdata/countries/id/id-all.js"></script>


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
                <?php if ($this->session->userdata('permission')==4) {?>
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
                              <select class="form-control" onchange="getkotakab(this.value);" name="provinsi" id="provinsi" required >
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
      <div class="col-md-4">
        <div class="box" id="loan-needs">
          <div class="box-header with-border">
            <div class="section-heading">
              <img src="<?php echo base_url() ?>assets/img/dashboard/loan.png" alt="kebutuhan-kredit" />
              <h2 class="title">Kebutuhan Kredit</h2>
            </div>
          </div>
          <div class="box-body"></div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="box" id="tool-needs">
          <div class="box-header with-border">
            <div class="section-heading">
              <img src="<?php echo base_url() ?>assets/img/dashboard/tools.png" alt="kebutuhan-sarana-prasarana" />
              <h2 class="title">Kebutuhan Sarana Prasarana</h2>
            </div>
          </div>
          <div class="box-body"></div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="box" id="training-needs">
          <div class="box-header with-border">
            <div class="section-heading">
              <img src="<?php echo base_url() ?>assets/img/dashboard/training.png" alt="kebutuhan-pelatihan" />
              <h2 class="title">Kebutuhan Pelatihan</h2>
            </div>
          </div>
          <div class="box-body"></div>
        </div>
      </div>
    </div>
  </section>
</div>



<!-- dashboard scripts -->

<script src="<?php echo base_url(); ?>assets/js/dashboard.js"></script>
<script src="<?php echo base_url(); ?>assets/js/send.js"></script>
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
