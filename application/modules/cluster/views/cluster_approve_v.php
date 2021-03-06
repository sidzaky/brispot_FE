<meta name="google-site-verification" content="-5c7n2yDdKK5fU1D1gLtok4-D8XLP2c_2YKWtk30MCc" />
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDD-HjW_D_kUMx9W7MRP473fS-er_DgiYY&callback=initMap" defer></script>
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		
	</section>
 
	<!-- Main content -->
	<section class="content">
		<div class="box box-solid">
			<div id="result" class="box-body">
				<div class="container-fluid control-box">
					<div class="row">
                        <h3> Klaster UMKM <?php echo $this->session->userdata('name_uker'); ?> Yang Telah Disetujui</h3>
					</div>
				</div>
				<script>
					$(document).ready(function() {
						$('#table-cluster').DataTable({
							"scrollX"       : true,
							"processing"    : true,
							"serverSide"    : true,
							"deferRender"   : true,
							"ajax"  : {
								"url"   : "./cluster/get_clusterapproved",
								"type"  : "POST"
							},
							"fnRowCallback": function( nRow, aData, iDisplayIndex ) {
								var colours = aData[0];
								var col = colours.trim(' '); 
								if (col.includes('fa-warning')){
									$('td', nRow).css("background-color","#ffff99"); 
									}
								return nRow;
								},
						});
					});
				</script>
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
<div class="modal " id="cluster-info-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" onclick="$('#modal').hide();" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h5 class="modal-title">Form klaster</h5>
			</div>
			<div class="modal-body">
			</div>
			<div class="modal-footer">
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php include 'cluster_form.php'; ?>
<?php include 'cluster_info.php'; ?>
<script src="../assets/js/send.js"></script>
<script src="../assets/js/cluster_info.js"></script>