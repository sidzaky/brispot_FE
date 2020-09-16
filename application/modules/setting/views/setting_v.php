
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
			<div class="box-header with-border">
                <h3 class="box-title" align="center">
                    Tabel Usaha
                </h3>
                <style>
                    table, th, td {
                    border: 1px solid black;
                    }
                    </style>
				<table class="table table-bordered" width="100%">
                    <thead>
                        <tr>
                            <th width="20%">
                                Sektor Usaha
                                <button class="btn btn-success waves-effect waves-light btn-sm" style="float:right;" onclick="getform()" type="button"><i class="fa fa-plus"></i></button>
                            </th>
                            <th width="20%">
                                Kategori Usaha
                                <button class="btn btn-success waves-effect waves-light btn-sm" style="float:right;" onclick="getform()" type="button"><i class="fa fa-plus"></i></button>
                            </th>
                            <th width="70%">
                                Jenis Usaha
                                <button class="btn btn-success waves-effect waves-light btn-sm" style="float:right;" onclick="getform()" type="button"><i class="fa fa-plus"></i></button>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            echo $con->get_datausaha();
                        ?>
                    </tbody>
                </table>

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
				$('#table-cluster').DataTable({
						"scrollX": true,
						"processing": true,
						"serverSide": true,
						"deferRender": true,
						"ajax": {
							"url": "./cluster/getdata",
							"type": "POST"
						},
					});
				$('#table-cluster').DataTable({
						"scrollX": true,
						"processing": true,
						"serverSide": true,
						"deferRender": true,
						"ajax": {
							"url": "./cluster/getdata",
							"type": "POST"
						},
					});
				$('#table-cluster').DataTable({
						"scrollX": true,
						"processing": true,
						"serverSide": true,
						"deferRender": true,
						"ajax": {
							"url": "./cluster/getdata",
							"type": "POST"
						},
					});
			});

</script>


