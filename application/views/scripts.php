<!-- REQUIRED JS SCRIPTS -->



<!-- jQuery 2.1.4 -->
<script src="<?php echo base_url(); ?>assets/plugins/jQueryUI/jquery-ui.min.js"></script>
<!-- Moment -->
<!-- <script src="<?php echo base_url(); ?>assets/plugins/daterangepicker/moment.min.js"></script> -->
<!-- Datepicker -->
<!-- <script src="<?php echo base_url(); ?>assets/plugins/datepicker/bootstrap-datepicker.js"></script> -->
<!-- Daterangepicker -->
<!-- <script src="<?php echo base_url(); ?>assets/plugins/daterangepicker/daterangepicker.js"></script> -->
<!-- ChartJS 1.0.1 -->
<!-- <script src="<?php echo base_url(); ?>assets/plugins/chartjs/Chart.min.js"></script> -->
<!-- FastClick -->
<!-- <script src="<?php echo base_url(); ?>assets/plugins/fastclick/fastclick.min.js"></script> -->
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/js/app.min.js"></script>
<!-- mY sCRIPTS -->
<script src="<?php echo base_url(); ?>assets/js/myScript.js"></script>
<!-- iCheck -->
<!-- <script src="<?php echo base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script> -->
<!-- Toastr -->
<script src="<?php echo base_url(); ?>assets/plugins/toastr/toastr.min.js"></script>

<div id="sendserver"></div>
<script>
  $("#calendar").datepicker();
  $(window).load(function() {
    $(".loader").fadeOut("slow");
  })

  function loading(i) {
    document.getElementById(i).innerHTML = '<img src="<?php echo base_url() ?>assets/img/loading_funny.gif" style="display:block;margin:auto;overflow:hidden;max-width:500px;">';
  }
  $("#example2").DataTable();
</script>

</body>

</html>