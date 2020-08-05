<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dashboard
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row cluster-summary">
      <?php
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
      ?>
  </section>
</div>