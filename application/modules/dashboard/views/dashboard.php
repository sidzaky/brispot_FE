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
            <h2 class="box-title">Klaster</h2>
          </div><!-- /.box-header -->
          <div class="box-body">
            <?php
            if (!empty($report)) {
              foreach ($report as $row => $value) {
                echo "<div class='col-md-4 col-sm-6 col-xs-12'>";
                echo "<div class='info-box' style='background:transparent; box-shadow: none'>";
                echo "<span class='info-box-icon' style='background: none;'>";
                echo "<img src=" . $icons[$row] . " />";
                echo "</span>";
                echo "<div class='info-box-content'>";
                echo "<span class='info-box-text' style='white-space: normal;'>" . $value["label"] . "</span>";
                echo "<span class='info-box-number'>" . $value["total"] . " klaster</span>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
              }
            } else { ?>
              <div style="display:flex;justify-content:center;align-items:center;">No data available</div>
            <?php
            }
            ?>
          </div>
        </div>
      </div>
    </div>
 
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h2 class="box-title">Persebaran Klaster</h2>
          </div><!-- /.box-header -->
          <div class="box-body">
            <div class="col-md-12">
              <div id="result" class="box-body">
              <h4>Filter</h4>
                  <div class="col-sm-4">
                      <div class="form-group">
                          <label class="control-label">Sektor Usaha</label>
                          <select class="form-control" onchange="fjum(this.value);" id="kode_kanwil">
                              <option value="">semua</option>
                              <option value="1">Produksi</option>
                              <option value="2">Non Produksi</option>			
                          </select>
                      </div>
                  </div>
                  <div class="col-sm-4">
                      <div class="form-group" id="selkanca">
                          <label class="control-label">Kategori Usaha</label>
                          <select class="form-control" onchange="fju(this.value);" id="id_cluster_jenis_usaha_map">
                              <option value="">semua</option>
                          </select>
                      </div>
                  </div>
                  <div class="col-sm-4">
                      <div class="form-group" id="selunit">
                          <label class="control-label">Jenis Usaha</label>
                          <select class="form-control" onchange="fhp(this.value)" id="id_cluster_jenis_usaha">
                              <option value="">semua</option>
                          </select>
                      </div>
                  </div>
                  <div class="col-sm-3">
                      <div class="form-group" id="selunit">
                          <label class="control-label">Bentuk/Produk Usaha</label>
                          <select class="form-control" onchange="fv(this.value)" id="hasil_produk">
                              <option value="">semua</option>
                          </select>
                      </div>
                  </div>
                  <div class="col-sm-3">
                      <div class="form-group" id="selunit">
                          <label class="control-label">Varian</label>
                          <select class="form-control" id="varian">
                              <option value="">semua</option>
                          </select>
                      </div>
                  </div>

                  <div class="col-sm-3">
                      <div class="form-group" id="selunit">
                          <label class="control-label">Lokasi</label>
                          <select class="form-control" onchange="getkotakab(this.value);" id="provinsi">
                              <option value="">semua</option>
                              <?php foreach ($provinsi as $row) {
									              echo "<option value='" . $row['id'] . "'>" . $row['nama'] . "</option>";
								              } ?>
                          </select>
                      </div>
                  </div>

                  <div class="col-sm-3">
                      <div class="form-group" id="selunit">
                          <label class="control-label">Sub Lokasi</label>
                          <select class="form-control" id="kabupaten">
                              <option value="">semua</option>
                          </select>
                      </div>
                  </div>
                  <div class="col-sm-12">    
                      <button class="btn btn-success waves-effect waves-light" id="sbt" onclick="setfilter();">Cari</button>
                  </div>
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
