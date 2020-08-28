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
								"url"   : "./cluster/getdata/approve",
								"type"  : "POST"
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
</style>
<div class="modal " id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" onclick="$('#modal').hide();" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h5 class="modal-title">Form klaster <?php echo $this->session->userdata('nama_uker') ?></h5>
			</div>
			<div class="modal-body">
				<div id="mod-content">
				
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-primary waves-effect waves-light" onclick="$('#modal').hide();">Batal</button>
				<button class="btn btn-success waves-effect waves-light" id="sbt" onclick="inputform();">Kirim</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php if ($this->session->userdata('notif') == 1) { ?>
	<div class="modal " id="modalnotif" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" onclick="$('#modalnotif').hide();" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h5 class="modal-title">Notif <?php echo $this->session->userdata('nama_uker') ?></h5>
				</div>
				<div class="modal-body">
					<div id="mod-content">
						<title>Site Maintenance</title>
						<h2>Update Klaster Binaan BRI 0.3 4 Juli 2020</h2>
						<h4>04 Juli 2020</h4>
						<div>
							<ul>
								<li>Terhitung tanggal 6 Juli 2020, alamat "https://tinyurl.com/s4gxhba" akan dimatikan dan berpindah menuju halaman "https://www.klasterkuhidupku.com"</li>
								<li>Tambahan Form Upload Foto Klaster Usaha </li>
								<li>Tambahan Form Upload Foto dokument Ekspor (optional)</li>
								<li>Tambahan Form Cerita kelompok Usaha</li>
							</ul>
						</div>
						<h4>MAJOR UPDATE 2 Februari 2020</h4>
						<div>
							<ul>
								<li>Perbaikan fungsi Upload Anggota Menggunakan Excel</li>
								<li>Halaman ini Bejalan Lebih baik jika menggunakan Browser Firefox</li>
							</ul>
						</div>
						<h4>04 Januari 2020</h4>
						<div>
							<ul>
								<li>Terhitung tanggal 5 Juli 2020, alamat "https://tinyurl.com/s4gxhba" akan dimatikan dan berpindah menuju halaman https://www.klasterkuhidupku.com</li>
								<li></li>
								<li>Mohon Cek kembali terkait data provinsi, kabupaten/kota, kecamatan dan kelurahan setelah update 26 Januari 2020</li>
								<li>Pada Tabel Kluster, Kolom Jml/Input Anggota adalah jumlah data berbanding data yang telah diinput di dalam halaman Anggota</li>
								<li>Terdapat Pembaharuan pada Klasifikasi data Jenis usaha</li>
								<li>Halaman anggota untuk menginput data anggota pada data kluster</li>
								<li>Anggota dapat diinput manual atau diinput menggunakan template excel yang telah disediakan</li>
							</ul>
						</div>

					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-primary waves-effect waves-light" onclick="endnotif();">close</button>
			</div>
		</div>
	</div>
	</div>
	<script>
		
	</script>
<?php }

?>

<script src="./assets/js/send.js"></script>
<script src="./assets/js/cluster.js"></script>