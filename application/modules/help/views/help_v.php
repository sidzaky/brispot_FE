<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Bantuan dan Pertanyaan
			<?php echo $this->session->userdata('name_uker'); ?><nbsp></nbsp>
		</h1>
	</section>
    <section class="content">
		<div class="box box-solid">
			<div id="result" class="box-body">
				<div class="container-fluid control-box">
					<div class="row">
						<button class="btn btn-success waves-effect waves-light btn-sm" onclick="getform()" type="button"><i class="fa fa-plus"></i> Tambah Data</button>
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