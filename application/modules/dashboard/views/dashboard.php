
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ==" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==" crossorigin=""></script>

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
             <div id="mapid"></div>
          </div>
        </div>
      </div>
    </div>
    
    <script>
        var map = L.map('mapid').setView([1.084149, 104.027813], 10);
        L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
            attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://mapbox.com">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox.streets',
            accessToken: 'your.mapbox.access.token'
        }).addTo(map);
    </script>

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