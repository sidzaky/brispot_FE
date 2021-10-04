
<meta name="google-site-verification" content="-5c7n2yDdKK5fU1D1gLtok4-D8XLP2c_2YKWtk30MCc" />
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDD-HjW_D_kUMx9W7MRP473fS-er_DgiYY&callback=initMap" defer></script>
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Data Pengajuan Klaster UMKM
			<?php echo $this->session->userdata('name_uker'); ?><nbsp></nbsp>
		</h1>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="box box-solid">
				<div id="result" class="box-body">
				<h4>Field Pencarian</h4>
					<?php if ($this->session->userdata('permission')>2) { ?>
					<div class="col-sm-4">
						<div class="form-group">
							<label class="control-label">Kanwil</label>
							<select class="form-control" onchange="set_kanca(this);" id="kode_kanwil">
								<option value="">semua</option>
								<?php foreach ($kanwil as $row){
									echo '<option value="'.$row['kode_kanwil'].'">'.$row['kanwil'].'</option>';
								}?>
							</select>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group" id="selkanca">
							<label class="control-label">Kanca</label>
							<select class="form-control" onchange="set_unit(this);" id="kode_kanca">
								<option value="">semua</option>
							</select>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group" id="selunit">
							<label class="control-label">unit</label>
							<select class="form-control" id="fkode_uker">
								<option value="">semua</option>
							</select>
						</div>
					</div>
					<?php } ?>
					<div id="field_custom_search"></div>
					<div class="col-sm-12">    
						<input type="hidden" id="finalresult" value="">
						<button class="btn btn-info waves-effect waves-light" onclick="add_field();">Tambah Field</button>
						<button class="btn btn-success waves-effect waves-light" id="sbt" onclick="$('#table-cluster').DataTable().ajax.reload(null, false);">Cari</button>
					</div>
				</div>
			</div>
		<div class="box box-solid">
			<div id="result" class="box-body">
				<div class="container-fluid control-box">
					<div class="row">
					<button class="btn btn-success waves-effect waves-light btn-sm" onclick="getform();initMap();" type="button"><i class="fa fa-plus"></i> Tambah Data</button>
					<button class="btn btn-primary waves-effect waves-light btn-sm" onclick="dldata();" type="button"><i class="fa fa-download"></i> Download Data</button>
						
					</div>
				</div>
			
				<div class="table-responsive">
					<table id="table-cluster" class="table table-striped table-bordered" width="100%">
						<thead>
							<tr>
								<th>No</th>
								<th>Kantor Wilayah</th>
								<th>Nama Kanca</th>
								<th>Nama Uker</th>
								<th>Nama Kelompok Usaha</th>
								<th>Jml / Input Anggota </th>
								<th>Jenis Usaha</th>
								<th>Bentuk Produk/Jasa</th>
								<?php if ($this->session->userdata("approve_level") == 2) echo "<th>Status Local Heroes</th>";?>
								<th>Status Pengajuan</th>
								<th>Action</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</section>
</div>
<!-- Modal -->
<style>
	.modal-body {
		max-height: calc(100vh - 200px);
		overflow-y: auto;
	}

	.btn-file {
		position: relative;
		overflow: hidden;
	}

	.btn-file input[type=file] {
		position: absolute;
		top: 0;
		right: 0;
		min-width: 100%;
		min-height: 100%;
		font-size: 100px;
		text-align: right;
		filter: alpha(opacity=0);
		opacity: 0;
		outline: none;
		background: white;
		cursor: inherit;
		display: block;
	}

	.img-upload {
		width: 100%;
	}

	#map{
	width: auto;
	height: 400px;
}
</style>

<div class="modal " id="modal-noncluster" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" onclick="$('#modal').hide();" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h5 class="modal-title">Form klaster</h5>
			</div>
			<div class="modal-body">
			</div>
			<div class="modal-footer">
				<button class="btn btn-primary waves-effect waves-light" onclick="$('#modal').hide();">Batal</button>
				<button class="btn btn-success waves-effect waves-light" id="sbt" onclick="inputform();">Kirim</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal " id="modalreject" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" onclick="$('#modal').hide();" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h5 class="modal-title">Form Aproval klaster <?php echo $this->session->userdata('nama_uker') ?></h5>
			</div>
			<div class="modal-body">
                <div id="mod-loadings" style="display:none">
                    <div class="col-sm-12">
                                <label for="thedata" class="col-sm-12 control-label">
                                    <h3 align="center">Harap Menunggu, Data Sedang Dikirim</h3>
                                </label>
                            </div>
                </div>
				<div id="mod-contents">
				<div class="form-group required">
							<label class="control-label">Berikan Alasan</label>
							<input type="hidden" class="form-control " id="idreject" placeholder="required" value="">
							<input type="hidden" class="form-control " id="statusreject" placeholder="required" value="">
							<textarea type="text" class="form-control  required" id="reject" placeholder="required" required></textarea>
						</div>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-primary waves-effect waves-light" onclick="$('#modalreject').hide();">Batal</button>
				<button class="btn btn-success waves-effect waves-light" onclick="setrejj();">Kirim</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script src="./assets/js/cluster_v.js"></script>
<?php include 'cluster_form.php'; ?>
<script src="./assets/js/send.js"></script>
<?php include 'cluster_info.php'; ?>
<script src="./assets/js/cluster_info.js"></script>

<script>		
			function dldata(i){
						var d = new Date();
						$.ajax({ 
									   type:"POST",
									   url: "<?php echo base_url();?>cluster/dlDataPengajuan",
									   success:function(msg){
											var jsonObject = msg;
											var csv=ConvertToCSV(jsonObject),
											a=document.createElement('a');
											a.textContent='download';
											a.download='Data Pengajuan '+d+'.csv';
											a.href='data:text/csv;charset=utf-8,'+escape(csv);
											a.click();
										}
								});
					}	
					
			function ConvertToCSV(objArray) {
				var array = typeof objArray != 'object' ? JSON.parse(objArray) : objArray;
				var str = '';

				for (var i = 0; i < array.length; i++) {
					var line = '';

					for (var index in array[i]) {
						if (line != '') line += ';'

						var j = array[i][index].toString();
						j = j.replace(/;/g, " ");
						line += j;
					}

					str += line + '\r\n';
				}

				return str;
			}
			
</script>