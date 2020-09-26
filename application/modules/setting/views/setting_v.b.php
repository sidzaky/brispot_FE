
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
                    
				<table class="table table-striped table-bordered" width="100%">
                    <thead>
                        <tr>
                            <th width="20%">
                               No
                                <button class="btn btn-success waves-effect waves-light btn-sm" style="float:right;" onclick="getform()" type="button"><i class="fa fa-plus"></i> Tambah</button>
                            </th>
                            <th width="20%">
                               Form
                                <button class="btn btn-success waves-effect waves-light btn-sm" style="float:right;" onclick="getform()" type="button"><i class="fa fa-plus"></i> Tambah</button>
                            </th>
                            <th width="70%">
                                Action
                                <button class="btn btn-success waves-effect waves-light btn-sm" style="float:right;" onclick="getform()" type="button"><i class="fa fa-plus"></i> Tambah</button>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Sektor Usaha</td>
                            <td><button class="btn btn-success waves-effect waves-light btn-sm" style="float:right;" onclick="getform()" type="button"><i class="fa fa-plus"></i> Lihat List</button></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Kategori Usaha</td>
                            <td><button class="btn btn-success waves-effect waves-light btn-sm" style="float:right;" onclick="getform()" type="button"><i class="fa fa-plus"></i> Lihat List</button></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Jenis Usaha</td>
                            <td><button class="btn btn-success waves-effect waves-light btn-sm" style="float:right;" onclick="getform()" type="button"><i class="fa fa-plus"></i> Lihat List</button></td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Kebutuhan Pendidikan & Pelatihan</td>
                            <td><button class="btn btn-success waves-effect waves-light btn-sm" style="float:right;" onclick="getform()" type="button"><i class="fa fa-plus"></i> Lihat List</button></td>
                        </tr>
                    </tbody>
                </table>



<!-- 
				<table class="table table-striped table-bordered" width="100%">
                    <thead>
                        <tr>
                            <th width="20%">
                                Sektor Usaha
                                <button class="btn btn-success waves-effect waves-light btn-sm" style="float:right;" onclick="getform()" type="button"><i class="fa fa-plus"></i> Tambah</button>
                            </th>
                            <th width="20%">
                                Kategori Usaha
                                <button class="btn btn-success waves-effect waves-light btn-sm" style="float:right;" onclick="getform()" type="button"><i class="fa fa-plus"></i> Tambah</button>
                            </th>
                            <th width="70%">
                                Jenis Usaha
                                <button class="btn btn-success waves-effect waves-light btn-sm" style="float:right;" onclick="getform()" type="button"><i class="fa fa-plus"></i> Tambah</button>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            // echo $con->get_datausaha();
                        ?>
                    </tbody>
                </table> -->

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
                <div class="table-responsive">
                    <table id="table-pendidikan" class="table table-striped table-bordered" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>List Pendidikan dan Pelatihan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
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
                <div class="table-responsive">
                    <table id="table-sarana" class="table table-striped table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>List Kebutuhan Sarana </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
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
                <div class="table-responsive">
                    <table id="table-kredit" class="table table-striped table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>List Skema Kredit</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
			$(document).ready(function() {
				$('#table-pendidikan').DataTable({
						"scrollX": true,
						"processing": true,
						"serverSide": true,
						"deferRender": true,
						"ajax": {
							"url": "./cluster/get_kebutuhanpendidikan",
							"type": "POST"
						},
					});
				$('#table-sarana').DataTable({
						"scrollX": true,
						"processing": true,
						"serverSide": true,
						"deferRender": true,
						"ajax": {
							"url": "./cluster/get_kebutuhansarana",
							"type": "POST"
						},
					});
				$('#table-cluster').DataTable({
						"scrollX": true,
						"processing": true,
						"serverSide": true,
						"deferRender": true,
						"ajax": {
							"url": "./cluster/get_kebutuhanskemakredit",
							"type": "POST"
						},
					});
			});

</script>


