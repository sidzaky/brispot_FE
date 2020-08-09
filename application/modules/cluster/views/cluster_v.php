<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Data Pengajuan Klaster UMKM
			<?php echo $this->session->userdata('name_uker'); ?>
		</h1>
	</section>
  
	<!-- Main content -->
	<section class="content">
		<div class="box box-solid">
			<div id="result" class="box-body">
				<div class="container-fluid control-box">
					<div class="row">
						<button class="btn btn-success waves-effect waves-light btn-sm" onclick="getform()" type="button"><i class="fa fa-plus"></i> Tambah Data</button>
						<button class="btn btn-primary waves-effect waves-light btn-sm" onclick="window.open('cluster/dldata')" type="button"><i class="fa fa-download"></i> Download All Data</button>
					</div>
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
					<form>
						<div class="col-sm-12">
							<label for="thedata" class="col-sm-12 control-label">
								<h3 align="center">Isian terkait Unit BRI</h3>
							</label>
						</div>

						<div class="form-group" style="width: 0">
							<label style="padding:0;" for="thedata" class="col-sm-10 control-label" id="setuker"></label>
							<input type="hidden" class="form-control dform" id="id" placeholder="required" value="">
						</div>

						<div class="form-group required">
							<label class="control-label">Kode Uker</label>
							<div id="hsuk"></div>
							<input type="number" class="form-control dform" name="kode uker" <?php echo ($this->session->userdata('permission') > 1 ? '' : 'disabled') ?> id="kode_uker" onchange="getuker(this.value);" placeholder="required" value="<?php echo $this->session->userdata('kode_uker'); ?>" required>
						</div>

						<div class="form-group required">
							<label class="control-label">Nama Kaunit BRI</label>
							<input type="text" pattern="[a-zA-Z]" class="form-control dform required" id="kaunit_nama" value="" placeholder="required" required>
						</div>

						<div class="form-group required">
							<label class="control-label">PN Kaunit</label>
							<input type="number" class="form-control dform required" id="kaunit_pn" value="" placeholder="required" required>
						</div>

						<div class="form-group required">
							<label class="control-label">No Handphone Kaunit</label>
							<input type="text" pattern="[a-zA-Z]" class="form-control dform required" onchange="cekhp(this);" id="kaunit_handphone" value="" placeholder="08xxxxxxxx (required)" required>
						</div>

						<!-- Mantriii -->
						<div class="form-group required">
							<label class="control-label">Nama Mantri / Pekerja BRI (Pembina Klaster)</label>
							<input type="text" pattern="[a-zA-Z]" class="form-control dform required" id="nama_pekerja" value="" placeholder="required" required>
						</div>

						<div class="form-group required">
							<label class="control-label">PN Mantri / Pekerja BRI (Pembina Klaster)</label>
							<input type="number" class="form-control dform required" id="personal_number" value="" placeholder="required" required>
						</div>

						<div class="form-group required">
							<label class="control-label">No Handphone Mantri / Pekerja BRI (Pembina Klaster)</label>
							<input type="text" pattern="[a-zA-Z]" class="form-control dform required" id="handphone_pekerja" value="" placeholder="08xxxxxxxx (required)" required>
						</div>

						<!-- Kelompok Usaha -->

						<div class="col-sm-12">
							<label for="thedata" class="col-sm-12 control-label">
								<h3 align="center">Isian terkait Kelompok Usaha / Klaster</h3>
							</label>
						</div>

						<div class="form-group required">
							<label class="control-label">Nama Kelompok Usaha / Klaster</label>
							<input type="text" pattern="[a-zA-Z]" class="form-control dform required" id="kelompok_usaha" value="" placeholder="required" required>
						</div>

						<div class="form-group required">
							<label class="control-label">Jumlah Anggota (orang)</label>
							<input type="number" min="15" class="form-control dform required" id="kelompok_jumlah_anggota" value="" placeholder="required" required>
						</div>

						<div class="form-group">
							<label class="control-label">Sudah Punya Pinjaman?</label>
							<select class="form-control dform required" id="kelompok_anggota_pinjaman">
								<option value="Seluruh anggota sudah punya pinjaman">Seluruh anggota sudah punya pinjaman</option>
								<option value="Lebih dari 50% anggota punya pinjaman">Lebih dari 50% anggota punya pinjaman</option>
								<option value="Kurang dari 50% anggota punya pinjaman">Kurang dari 50% anggota punya pinjaman</option>
								<option value="Seluruh anggota belum punya pinjaman">Seluruh anggota belum punya pinjaman</option>
							</select>
						</div>

						<div class="form-group required">
							<label class="control-label">Sektor Usaha</label>
							<select class="form-control dform required" onchange="fjum(this.value)" id="id_cluster_sektor_usaha" required>
								<option value="1">Produksi</option>
								<option value="2">Non Produksi</option>
							</select>
						</div>

						<div class="form-group">
							<label class="control-label">Kategori Jenis Usaha</label>
							<select class="form-control dform required" onchange="fju(this.value);" id="id_cluster_jenis_usaha_map">
							</select>
						</div>

						<div class="form-group">
							<label class="control-label drequired">Jenis Usaha</label>
							<select class="form-control dform required" id="id_cluster_jenis_usaha">
							</select>
						</div>

						<div class="form-group">
							<label class="control-label drequired">Bentuk Produk / Jasa</label>
							<input type="text" pattern="[a-zA-Z]" onchange="validatorreqtext(this, iname, this.id)" class="form-control dform  required" id="hasil_produk" value="" placeholder="required" required>
						</div>

						<div class="form-group">
							<label class="control-label drequired">Apakah sudah Masuk Pasar Ekspor?</label>
							<select class="form-control dform  required" id="pasar_ekspor" onchange="te(this);">
								<option value="Ya">Ya</option>
								<option value="Tidak" default>Tidak</option>
							</select>
						</div>

						<div class="form-group">
							<label class="control-label">Jika Ya sejak Tahun Berapa</label>
							<input type="number" class="form-control dform " id="pasar_ekspor_tahun" value="" placeholder="optional" required>
						</div>

						<div class="form-group">
							<label class="control-label">Jika ya, nilai ekspor rata-rata per bulan (Rp) ?</label>
							<input type="number" class="form-control dform " id="pasar_ekspor_nilai" value="" placeholder="optional" required>
						</div>

						<div class="form-group">
							<label class="control-label drequired">Foto/Dokument Ekspor</label>
							<button type="button" class="btn btn-primary waves-effect waves-light btn-sm" id="bfex" onclick="tambahform('fex');"><i class="fa fa-plus"></i> Tambah Foto Ekspor</button>
							<div id="fotoverifikasiexpor"></div>
						</div>

						<div class="form-group">
							<label class="control-label">Luas lahan / tempat usaha (m2)</label>
							<input type="number" class="form-control dform" id="kelompok_luas_usaha" value="" placeholder="optional" required>
						</div>

						<div class="form-group">
							<label class="control-label">Omset Usaha per Bulan (total kelompok - Rp)</label>
							<input type="number" class="form-control dform" id="kelompok_omset" value="" placeholder="optional" required>
						</div>

						<div class="form-group">
							<label class="control-label">Nama Pembeli (inti) Produk/Jasa yang dihasilkan</label>
							<input type="text" class="form-control dform" id="kelompok_pihak_pembeli" onchange="validatoropttext(this,ischar,this.id)" value="" placeholder="optional" required>
						</div>

						<div class="form-group">
							<label class="control-label">Nomor Handphone Pembeli</label>
							<input type="tel" class="form-control dform" onchange="cekhpnor(this);" id="kelompok_pihak_pembeli_handphone" value="" placeholder="08xxxxxxxx optional" required>
						</div>

						<div class="form-group">
							<label class="control-label">Nama Suplier (utama) bahan baku produk/jasa yang dihasilkan</label>
							<input type="text" class="form-control dform" id="kelompok_suplier_produk" value="" placeholder="optional" required>
						</div>

						<div class="form-group">
							<label class="control-label">Nama Suplier (utama) bahan baku produk/jasa yang dihasilkan</label>
							<input type="text" class="form-control dform" id="kelompok_suplier_produk" value="" placeholder="optional" required>
						</div>

						<div class="form-group">
							<label class="control-label">Nama Suplier (utama) bahan baku produk/jasa yang dihasilkan</label>
							<input type="text" class="form-control dform" id="kelompok_suplier_produk" value="" placeholder="optional" required>
						</div>

						<div class="form-group">
							<label class="control-label">Nomor Handphone Supplier</label>
							<input type="tel" class="form-control dform" onchange="cekhpnor(this);" id="kelompok_suplier_handphone" value="" placeholder="08xxxxxxxx optional" required>
						</div>

						<div class="form-group">
							<label class="control-label drequired">Sarana / prasarana yang dimiliki saat ini (perlengkapan / mesin atau aset yang mengubah value / bentuk barang - tidak termasuk mobil, gudang, rumah)</label>
							<input type="text" class="form-control dform required" id="kebutuhan_sarana_milik" value="" placeholder="required" required>
						</div>

						<div class="form-group">
							<label class="control-label drequired">Kebutuhan sarana / prasarana untuk peningkatan usaha kelompok? (usulan RAB Maks Rp 2 juta)</label>
							<select class="form-control dform required" id="kebutuhan_sarana">
								<option value="Renovasi tempat ibadah">Renovasi tempat ibadah</option>
								<option value="Sarana air bersih (Misal. MCK Umum, Penampungan Air, Pompa Air, Sumur Bor)">Sarana air bersih (Misal. MCK Umum, Penampungan Air, Pompa Air, Sumur Bor)</option>
								<option value="Peralatan penunjang produksi (Misal. Cangkul, Hand Traktor, Hand Press, Alat Bor)">Peralatan penunjang produksi (Misal. Cangkul, Hand Traktor, Hand Press, Alat Bor)</option>
								<option value="Lainnya">Lainnya</option>
							</select>
						</div>

						<div class="form-group">
							<label class="control-label">Jika lainnya, kebutuhan sarana / prasarana ? (usulan RAB Maks. Rp 2 juta)</label>
							<input type="text" class="form-control dform" id="kebutuhan_sarana_lainnya" value="" placeholder="optional misal cangkul, pasak, dll" required>
						</div>

						<div class="form-group">
							<label class="control-label drequired">Kebutuhan Pendidikan & Pelatihan untuk peningkatan usaha kelompok</label>
							<select class="form-control dform required" id="kebutuhan_pendidikan">
								<option value="Kepemimpinan">Kepemimpinan</option>
								<option value="Pola Pikir & Cara Pandang">Pola Pikir & Cara Pandang</option>
								<option value="Budaya Inovasi">Budaya Inovasi</option>
								<option value="Manajemen Pemasaran">Manajemen Pemasaran</option>
								<option value="Manajemen Operasional">Manajemen Operasional</option>
								<option value="Manajemen Keuangan">Manajemen Keuangan</option>
								<option value="Manajemen SDM">Manajemen SDM</option>
								<option value="Legalitas & Kepatuhan">Legalitas & Kepatuhan</option>
								<option value="Kepedulian Sosial & Lingkungan">Kepedulian Sosial & Lingkungan</option>
								<option value="Pemahaman Industri & Pasar">Pemahaman Industri & Pasar</option>
								<option value="Manajemen Rantai Pasok">Manajemen Rantai Pasok</option>
								<option value="Skala Usaha / Ekspor">Skala Usaha / Ekspor</option>
							</select>
						</div>

						<div class="form-group required">
							<label class="control-label">Kebutuhan skema kredit / pinjaman BRI ?</label>
							<select class="form-control dform required" id="kebutuhan_skema_kredit">
								<option value="KUR  Mikro">KUR Mikro</option>
								<option value="KUR Retail">KUR Retail</option>
								<option value="Kredit Kemitraan">Kredit Kemitraan</option>
								<option value="Kupedes">Kupedes</option>
							</select>
						</div>

						<div class="form-group">
							<label class="control-label">Cerita Terkait Usaha</label>
							<textarea type="text" class="form-control dform required" id="kelompok_cerita_usaha" value="" placeholder="Ceritakan Sedikit terkait Kelompok Usaha"></textarea>
						</div>

						<div class="form-group">
							<label class="control-label">Foto Kluster Usaha</label>
							<button type="button" class="btn btn-primary waves-effect waves-light btn-sm" onclick="tambahform('fku');"><i class="fa fa-plus"></i> Tambah Foto</button></label>
							<div id="fotoklusterusaha" class="col-sm-12"></div>
						</div>

						<!-- Isian untuk Ketua Kelompok / Klaster -->
						<label for="thedata" class="col-sm-12 control-label">
							<h3 align="center">Isian Ketua Kelompok</h3>
						</label>

						<div class="form-group required">
							<label class="control-label">Nama Ketua Kelompok / Klaster</label>
							<input type="text" class="form-control dform required" id="kelompok_perwakilan" value="" placeholder="required" required>
						</div>

						<div class="form-group required">
							<label class="control-label">Jenis Kelamin</label>
							<select class="form-control dform required" id="kelompok_jenis_kelamin">
								<option value="Pria">Pria</option>
								<option value="Wanita">Wanita</option>
							</select>
						</div>

						<div class="form-group required">
							<label class="control-label">Alamat Lengkap Usaha</label>
							<input type="text" class="form-control dform required" id="lokasi_usaha" value="" placeholder="required" required>
						</div>

						<div class="form-group required">
							<label class="control-label">Provinsi</label>
							<select class="form-control dform required" onchange="getkotakab(this.value);" id="provinsi">
								<?php foreach ($provinsi as $row) {
									echo "<option value='" . $row['id'] . "'>" . $row['nama'] . "</option>";
								} ?>
							</select>
						</div>

						<div class="form-group required">
							<label class="control-label">Kabupaten</label>
							<div id="selkab">
								<select class="form-control dform required" onchange="getkecamatan(this.value)" id="kabupaten">

								</select>
							</div>
						</div>

						<div class="form-group required">
							<label class="control-label">Kecamatan</label>
							<div id="selkec">
								<select class="form-control dform required" onchange="getkelurahan(this.value)" id="kecamatan">

								</select>
							</div>
						</div>

						<div class="form-group required">
							<label class="control-label">Kelurahan</label>
							<div id="selkel">
								<select class="form-control dform required" id="kelurahan">

								</select>
							</div>
						</div>

						<div class="form-group required">
							<label class="control-label">Kode pos</label>
							<input type="number" class="form-control required" id="kode_pos" value="" placeholder="required" required disabled>
						</div>

						<div class="form-group required">
							<label class="control-label">NIK Ketua Kelompok</label>
							<input type="number" class="form-control dform required" onchange="cnik(this.value);" id="kelompok_NIK" value="" placeholder="required" required>
						</div>

						<div class="form-group required">
							<label class="control-label">Tanggal Lahir Ketua Kelompok</label>
							<input type="date" data-date-format="DD-MM-YYYY" class="form-control dform required" id="kelompok_perwakilan_tgl_lahir" value="" placeholder="required" required>
						</div>

						<div class="form-group required">
							<label class="control-label">Tempat Lahir Ketua Kelompok</label>
							<input type="text" class="form-control dform required" id="kelompok_perwakilan_tempat_lahir" value="" placeholder="required" required>
						</div>

						<div class="form-group required">
							<label class="control-label">No Handphone Ketua Kelompok</label>
							<input type="tel" onchange="cekhp(this);" class="form-control dform required" id="kelompok_handphone" value="" placeholder="08xxxxxxxx (required)" required>
						</div>

						<div class="form-group required">
							<label class="control-label">Sudah Punya Pinjaman?</label>
							<select class="form-control dform required" id="pinjaman" required>
								<option value="BRI">BRI</option>
								<option value="Bank Lain">Bank Lain</option>
								<option value="Belum Ada">Belum Ada</option>
							</select>
						</div>

						<div class="form-group">
							<label class="control-label">Jika ada, nominal pinjaman (Rp) ?</label>
							<input type="number" class="form-control dform" id="nominal_pinjaman" value="" placeholder="optional">
						</div>

						<div class="form-group">
							<label class="control-label">Jika di BRI, Norek Pinjaman BRI?</label>
							<input type="number" class="form-control dform" id="norek_pinjaman_bri" value="" placeholder="optional">
						</div>

						<div class="form-group">
							<label class="control-label">Sudah Punya Simpanan di Bank ?</label>
							<select class="form-control dform required" id="simpanan_bank">
								<option value="BRI">BRI</option>
								<option value="Bank Lain">Bank Lain</option>
								<option value="Belum Ada">Belum Ada</option>
							</select>
						</div>

						<div class="form-group">
							<label class="control-label">Jika di BRI, apakah sudah jadi agen BRILink ?</label>
							<select class="form-control dform" id="agen_brilink">
								<option value="Ya">Ya</option>
								<option value="Tidak">Tidak</option>
							</select>
						</div>

						<div class="form-group">
							<input type="checkbox" class="form-check-input form-control-lg" id="checkvalidkunjungan" required>
							<b>Dengan ini saya menyatakan bahwa data ini benar adanya sesuai kenyataan di lapangan</b>
						</div>

						<div class="form-group">
							<input type="checkbox" class="form-check-input form-control-lg" id="checkvalidpotensi" required>
							<b>Data ini memiliki potensi yang baik untuk meningkatkan bisnis BRI melalui pendekatan komunitas</b>
						</div>
					</form>
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