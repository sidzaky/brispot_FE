
<div class="content-wrapper">
    <section class="content-header">
          <h1>
            Pengaturan Form Cluster
          </h1>
    </section>
	<section class="content">
	<div class="row">
      <div class="col-md-12">
        <div class="box box-solid">
			<div class="box-header with-border" id="setting_content">
                <?php 
                    $con->get_setting_content();
                ?>
            </div>
        </div>
    </div>

<script src="./assets/js/send.js"></script>
<script>

        function getform(i){
            var address = "./setting/get_"+i;
            var element = "setting_content";
            sendajax(null, address, element, null, null);   
        }

</script>


