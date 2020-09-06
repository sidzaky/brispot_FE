
<div class="content-wrapper">
    <section class="content-header">
          <h1>
            Pengaturan Form Cluster
          </h1>
    </section>
	<section class="content">
	<div class="row">
      <div class="col-md-4">
        <div class="box box-solid">
			<div class="box-header with-border">
                <h3 class="box-title">
                    List Jenis Usaha
                </h3>
				<button class="btn btn-success waves-effect waves-light btn-sm" style="float:right;" onclick="getform()" type="button"><i class="fa fa-plus"></i> Tambah Data</button>

                <?php print_r ($jenisusaha);?>
            </div>
        </div>
       </div> 
	   <div class="col-md-4">
        <div class="box box-solid">
			<div class="box-header with-border">
                <h3 class="box-title">
                    List Kategori Usaha
                </h3>
				<button class="btn btn-success waves-effect waves-light btn-sm" style="float:right;" onclick="getform()" type="button"><i class="fa fa-plus"></i> Tambah Data</button>
            </div>
        </div>
       </div>
	    <div class="col-md-4">
        <div class="box box-solid">
			<div class="box-header with-border">
                <h3 class="box-title">
                    List Kebutuhan Pendidikan & Pelatihan
                </h3>
				<button class="btn btn-success waves-effect waves-light btn-sm" style="float:right;" onclick="getform()" type="button"><i class="fa fa-plus"></i> Tambah Data</button>
            </div>
        </div>
       </div>
	   
	    <div class="col-md-4">
        <div class="box box-solid">
			<div class="box-header with-border">
                <h3 class="box-title">
                    List Kebutuhan Sarana
                </h3>
				<button class="btn btn-success waves-effect waves-light btn-sm" style="float:right;" onclick="getform()" type="button"><i class="fa fa-plus"></i> Tambah Data</button>
            </div>
        </div>
       </div>
	   
	   
	    <div class="col-md-4">
        <div class="box box-solid">
			<div class="box-header with-border">
                <h3 class="box-title">
                    List Kebutuhan Skema Kredit
                </h3>
				<button class="btn btn-success waves-effect waves-light btn-sm" style="float:right;" onclick="getform()" type="button"><i class="fa fa-plus"></i> Tambah Data</button>
            </div>
        </div>
       </div>
    </section>
</div>
<script>
			$(document).ready(function() {
                $('#table-kategori_usaha').DataTable({
						"scrollX": true,
						"processing": true,
						"serverSide": true,
						"deferRender": true,
						"ajax": {
							"url": "./setting/get_jenisusahamap",
							"type": "POST"
						},
					});
			    });

</script>


