<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Data Klaster BRIspot 0.3
			<?php echo $this->session->userdata('name_uker'); ?>
		</h1>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="box box-solid">
			<div id="result" class="box-body">
				<div class="container-fluid control-box">
					<div class="row">
						<button class="btn btn-primary waves-effect waves-light btn-sm" onclick="window.open('cluster/dldata')" type="button"><i class="fa fa-download"></i> Download All Data</button>
						<button class="btn btn-info waves-effect waves-light btn-sm" onclick="window.open('cluster/report_unit')" type="button"><i class="fa fa-info"></i> Rekap unit</button>
						<button class="btn btn-info waves-effect waves-light btn-sm" onclick="window.open('cluster/getreport/harian')" type="button"><i class="fa fa-info"></i> Laporan Harian</button>
						<?php if ($this->session->userdata('permission') > 3) {
							echo '<button class="btn btn-info waves-effect waves-light btn-sm" onclick="window.open(\'cluster/getreport/\')" type="button"><i class="fa fa-info"></i> Report akhir</button>';
						}
						?>
					</div>
				</div>
				<script>
					$(document).ready(function() {
						$('#table-cluster-kanpus').DataTable({
							"scrollX": true,
							"processing": true,
							"serverSide": true,
							"deferRender": true,
							"ajax": {
								"url": "<?php echo base_url(); ?>cluster/getdata",
								"type": "POST"
							},
						});
					});
				</script>
				<div class="table-responsive">
					<table id="table-cluster-kanpus" class="table table-striped table-bordered" width="100%">
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
					<div class="row">

						<div class="col-sm-12"><label for="thedata" class="col-sm-12 control-label">
								<h3 align="center">Isian terkait Unit BRI</h3>
							</label></div>
						<label for="thedata" class="col-sm-10 control-label" id="setuker"></label>
						<div class="col-sm-12">
							<input type="hidden" class="form-control dform " id="id" placeholder="required" value="" required>
						</div>
						<label for="thedata" class="col-sm-2 control-label drequired">Kode Uker</label>
						<div id="hsuk"></div>
						<div class="col-sm-12">
							<input type="number" class="form-control dform  required" name="kode uker" <?php echo ($this->session->userdata('permission') > 1 ? '' : 'disabled') ?> id="kode_uker" onchange="getuker(this.value);" placeholder="required" value="<?php echo $this->session->userdata('kode_uker'); ?>" required>
						</div>
						<label for="thedata" class="col-sm-12 control-label drequired">Nama Kaunit BRI</label>
						<div class="col-sm-12">
							<input type="text" pattern="[a-zA-Z]" class="form-control dform  required" id="kaunit_nama" value="" placeholder="required" required>
						</div>
						<label for="thedata" class="col-sm-12 control-label drequired">PN Kaunit</label>
						<div class="col-sm-12">
							<input type="number" class="form-control dform  required" id="kaunit_pn" value="" placeholder="required" required>
						</div>

						<label for="thedata" class="col-sm-12 control-label drequired">No Handphone Kaunit</label>
						<div class="col-sm-12">
							<input type="text" pattern="[a-zA-Z]" class="form-control dform  required" onchange="cekhp(this);" id="kaunit_handphone" value="" placeholder="08xxxxxxxx (required)" required>
						</div>

						<!-- Mantriii -->
						<label for="thedata" class="col-sm-12 control-label drequired">Nama Mantri / Pekerja BRI (Pembina Klaster)</label>
						<div class="col-sm-12">
							<input type="text" pattern="[a-zA-Z]" class="form-control dform  required" id="nama_pekerja" value="" placeholder="required" required>
						</div>
						<label for="thedata" class="col-sm-12 control-label drequired">PN Mantri / Pekerja BRI (Pembina Klaster)</label>
						<div class="col-sm-12">
							<input type="number" class="form-control dform  required" id="personal_number" value="" placeholder="required" required>
						</div>

						<label for="thedata" class="col-sm-12 control-label drequired">No Handphone Mantri / Pekerja BRI (Pembina Klaster)</label>
						<div class="col-sm-12">
							<input type="text" pattern="[a-zA-Z]" class="form-control dform  required" id="handphone_pekerja" value="" placeholder="08xxxxxxxx (required)" required>
						</div>


						<!-- Kelompok Usaha -->

						<div class="col-sm-12"><label for="thedata" class="col-sm-12 control-label">
								<h3 align="center">Isian terkait Kelompok Usaha / Klaster</h3>
							</label></div>
						<label for="thedata" class="col-sm-12 control-label drequired">Nama Kelompok Usaha / Klaster</label>
						<div class="col-sm-12">
							<input type="text" pattern="[a-zA-Z]" class="form-control dform  required" id="kelompok_usaha" value="" placeholder="required" required>
						</div>
						<label for="thedata" class="col-sm-12 control-label drequired">Jumlah Anggota (orang)</label>
						<div class="col-sm-12">
							<input type="number" min="15" class="form-control dform  required" id="kelompok_jumlah_anggota" value="" placeholder="required" required>
						</div>

						<label for="thedata" class="col-sm-12 control-label drequired">Sudah Punya Pinjaman?</label>
						<div class="col-sm-12">
							<select class="form-control dform  required" id="kelompok_anggota_pinjaman">
								<option value="Seluruh anggota sudah punya pinjaman">Seluruh anggota sudah punya pinjaman</option>
								<option value="Lebih dari 50% anggota punya pinjaman">Lebih dari 50% anggota punya pinjaman</option>
								<option value="Kurang dari 50% anggota punya pinjaman">Kurang dari 50% anggota punya pinjaman</option>
								<option value="Seluruh anggota belum punya pinjaman">Seluruh anggota belum punya pinjaman</option>
							</select>
						</div>

						<label for="thedata" class="col-sm-12 control-label drequired">Sektor Usaha</label>
						<div class="col-sm-12">
							<select class="form-control dform  required" id="sektor_usaha">
								<option value="Produksi">Produksi</option>
								<option value="Non Produksi">Non Produksi</option>
							</select>
						</div>
						<label for="thedata" class="col-sm-12 control-label drequired">Jenis Usaha</label>
						<div class="col-sm-12">
							<select class="form-control dform  required" id="jenis_usaha">
								<option value="Pertanian - Pangan">Pertanian - Pangan</option>
								<option value="Pertanian - Holtikultura">Pertanian - Holtikultura</option>
								<option value="Pertanian - Perkebunan">Pertanian - Perkebunan</option>
								<option value="Peternakan">Peternakan</option>
								<option value="Jasa Pertanian dan Perburuan">Jasa Pertanian dan Perburuan</option>
								<option value="Kehutanan & Penebangan Kayu">Kehutanan & Penebangan Kayu</option>
								<option value="Perikanan">Perikanan</option>
								<option value="Pertambangan Minyak & Gas Bumi">Pertambangan Minyak & Gas Bumi</option>
								<option value="Pertambangan Batubara & Lignit">Pertambangan Batubara & Lignit</option>
								<option value="Pertambangan Biji Logam">Pertambangan Biji Logam</option>
								<option value="Pertambangan & Penggalian Lainnya">Pertambangan & Penggalian Lainnya</option>
								<option value="Industri Batubara & Pengilangan Migas">Industri Batubara & Pengilangan Migas</option>
								<option value="Industri Makanan & Minuman">Industri Makanan & Minuman</option>
								<option value="Pengolahan Tembakau">Pengolahan Tembakau</option>
								<option value="Industri Tekstil dan Pakaian Jadi">Industri Tekstil dan Pakaian Jadi</option>
								<option value="Industri Kulit, Barang dari Kulit dan Alas Kaki">Industri Kulit, Barang dari Kulit dan Alas Kaki</option>
								<option value="Industri Kayu, Barang dari Kayu, Gabus dan Barang Anyaman dari Bambu, Rotan dan sejenisnya">Industri Kayu, Barang dari Kayu, Gabus dan Barang Anyaman dari Bambu, Rotan dan sejenisnya</option>
								<option value="Industri Kertas dan Barang dari kertas, Percetakan dan Reproduksi Media Rekaman">Industri Kertas dan Barang dari kertas, Percetakan dan Reproduksi Media Rekaman</option>
								<option value="Industri Kimia, Farmasi dan Obat Tradisional">Industri Kimia, Farmasi dan Obat Tradisional</option>
								<option value="Industri Karet, Barang dari Karet dan Plastik">Industri Karet, Barang dari Karet dan Plastik</option>
								<option value="Industri Barang Galian bukan logam">Industri Barang Galian bukan logam</option>
								<option value="Industri Logam Dasar">Industri Logam Dasar</option>
								<option value="Industri Barang dari Logam, Komputer, Barang Elektronik, Optik dan Peralatan Listrik">Industri Barang dari Logam, Komputer, Barang Elektronik, Optik dan Peralatan Listrik</option>
								<option value="Industri Mesin dan Perlengkapan">Industri Mesin dan Perlengkapan</option>
								<option value="Industri Alat Angkutan">Industri Alat Angkutan</option>
								<option value="Industri Furnitur">Industri Furnitur</option>
								<option value="Industri Pengolahan Lainnya, Jasa Reparasi dan Pemasangan Mesin dan Peralatan">Industri Pengolahan Lainnya, Jasa Reparasi dan Pemasangan Mesin dan Peralatan</option>
								<option value="Pengadaan Listrik dan Gas">Pengadaan Listrik dan Gas</option>
								<option value="Pengadaan Gas dan Produksi Es">Pengadaan Gas dan Produksi Es</option>
								<option value="Pengadaan Air, Pengelolaan Sampah, Limbah dan Daur Ulang">Pengadaan Air, Pengelolaan Sampah, Limbah dan Daur Ulang</option>
								<option value="Konstruksi">Konstruksi</option>
								<option value="Perdagangan Mobil, Sepeda Motor dan Reparasinya">Perdagangan Mobil, Sepeda Motor dan Reparasinya</option>
								<option value="Perdagangan Besar dan Eceran, bukan Mobil dan Sepeda">Perdagangan Besar dan Eceran, bukan Mobil dan Sepeda</option>
								<option value="Transportasi Angkutan Rel">Transportasi Angkutan Rel</option>
								<option value="Transportasi Angkutan Darat">Transportasi Angkutan Darat</option>
								<option value="Transportasi Angkutan Laut">Transportasi Angkutan Laut</option>
								<option value="Transportasi Angkutan Sungai, Danau & Penyeberangan">Transportasi Angkutan Sungai, Danau & Penyeberangan</option>
								<option value="Transportasi Angkutan Udara">Transportasi Angkutan Udara</option>
								<option value="Pergudangan dan Jasa Penunjang Angkutan, Pos dan Kurir">Pergudangan dan Jasa Penunjang Angkutan, Pos dan Kurir</option>
								<option value="Penyediaan Akomodasi dan makan minum">Penyediaan Akomodasi dan makan minum</option>
								<option value="Informasi dan Komunikasi">Informasi dan Komunikasi</option>
								<option value="Jasa Keuangan dan Asuransi">Jasa Keuangan dan Asuransi</option>
								<option value="Real Estate">Real Estate</option>
								<option value="Jasa Perusahaan">Jasa Perusahaan</option>
								<option value="Administrasi Pemerintahan, Pertahanan dan Jaminan Sosial Wajib">Administrasi Pemerintahan, Pertahanan dan Jaminan Sosial Wajib</option>
								<option value="Jasa Pendidikan">Jasa Pendidikan</option>
								<option value="Jasa Kesehatan dan Kegiatan Lainnya">Jasa Kesehatan dan Kegiatan Lainnya</option>
								<option value="Pariwisata">Pariwisata</option>
								<option value="Jasa Lainnya">Jasa Lainnya</option>
							</select>
						</div>

						<label for="thedata" class="col-sm-12 control-label drequired">Bentuk Produk / Jasa</label>
						<div class="col-sm-12">
							<input type="text" pattern="[a-zA-Z]" onchange="validatorreqtext(this, iname, this.id)" class="form-control dform  required" id="hasil_produk" value="" placeholder="required" required>
						</div>

						<label for="thedata" class="col-sm-12 control-label drequired">Apakah sudah Masuk Pasar Ekspor?</label>
						<div class="col-sm-12">
							<select class="form-control dform  required" id="pasar_ekspor">
								<option value="Ya">Ya</option>
								<option value="Tidak">Tidak</option>
							</select>
						</div>

						<label for="thedata" class="col-sm-12 control-label">Jika Ya sejak Tahun Berapa</label>
						<div class="col-sm-12">
							<input type="number" class="form-control dform " id="pasar_ekspor_tahun" value="" placeholder="optional" required>
						</div>
						<label for="thedata" class="col-sm-12 control-label">Jika ya, nilai ekspor rata-rata per bulan (Rp) ?</label>
						<div class="col-sm-12">
							<input type="number" class="form-control dform " id="pasar_ekspor_nilai" value="" placeholder="optional" required>
						</div>



						<label for="thedata" class="col-sm-12 control-label">Luas lahan / tempat usaha (m2)</label>
						<div class="col-sm-12">
							<input type="number" class="form-control dform " id="kelompok_luas_usaha" value="" placeholder="optional" required>
						</div>

						<label for="thedata" class="col-sm-12 control-label">Omset Usaha per Bulan (total kelompok - Rp)</label>
						<div class="col-sm-12">
							<input type="number" class="form-control dform " id="kelompok_omset" value="" placeholder="optional" required>
						</div>

						<label for="thedata" class="col-sm-12 control-label">Nama Pembeli (inti) Produk/Jasa yang dihasilkan</label>
						<div class="col-sm-12">
							<input type="text" class="form-control dform " id="kelompok_pihak_pembeli" onchange="validatoropttext(this,ischar,this.id)" value="" placeholder="optional" required>
						</div>

						<label for="thedata" class="col-sm-12 control-label">Nomor Handphone Pembeli</label>
						<div class="col-sm-12">
							<input type="tel" class="form-control dform " onchange="cekhpnor(this);" id="kelompok_pihak_pembeli_handphone" value="" placeholder="08xxxxxxxx optional" required>
						</div>

						<label for="thedata" class="col-sm-12 control-label">Nama Suplier (utama) bahan baku produk/jasa yang dihasilkan</label>
						<div class="col-sm-12">
							<input type="text" class="form-control dform " id="kelompok_suplier_produk" value="" placeholder="optional" required>
						</div>

						<label for="thedata" class="col-sm-12 control-label">Nomor Handphone Supplier</label>
						<div class="col-sm-12">
							<input type="tel" class="form-control dform " onchange="cekhpnor(this);" id="kelompok_suplier_handphone" value="" placeholder="08xxxxxxxx optional" required>
						</div>




						<label for="thedata" class="col-sm-12 control-label drequired">Sarana / prasarana yang dimiliki saat ini (perlengkapan / mesin atau aset yang mengubah value / bentuk barang - tidak termasuk mobil, gudang, rumah)</label>
						<div class="col-sm-12">
							<input type="text" class="form-control dform  required" id="kebutuhan_sarana_milik" value="" placeholder="required" required>
						</div>

						<label for="thedata" class="col-sm-12 control-label drequired">Kebutuhan sarana / prasarana untuk peningkatan usaha kelompok? (usulan RAB Maks Rp 2 juta)</label>
						<div class="col-sm-12">
							<select class="form-control dform  required" id="kebutuhan_sarana">
								<option value="Renovasi tempat ibadah">Renovasi tempat ibadah</option>
								<option value="Sarana air bersih (Misal. MCK Umum, Penampungan Air, Pompa Air, Sumur Bor)">Sarana air bersih (Misal. MCK Umum, Penampungan Air, Pompa Air, Sumur Bor)</option>
								<option value="Peralatan penunjang produksi (Misal. Cangkul, Hand Traktor, Hand Press, Alat Bor)">Peralatan penunjang produksi (Misal. Cangkul, Hand Traktor, Hand Press, Alat Bor)</option>
								<option value="Lainnya">Lainnya</option>
							</select>
						</div>

						<label for="thedata" class="col-sm-12 control-label">Jika lainnya, kebutuhan sarana / prasarana ? (usulan RAB Maks. Rp 2 juta)</label>
						<div class="col-sm-12">
							<input type="text" class="form-control dform " id="kebutuhan_sarana_lainnya" value="" placeholder="optional misal cangkul, pasak, dll" required>
						</div>

						<label for="thedata" class="col-sm-12 control-label drequired">Kebutuhan Pendidikan & Pelatihan untuk peningkatan usaha kelompok</label>
						<div class="col-sm-12">
							<select class="form-control dform  required" id="kebutuhan_pendidikan">
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

						<label for="thedata" class="col-sm-12 control-label drequired">Kebutuhan skema kredit / pinjaman BRI ?</label>
						<div class="col-sm-12">
							<select class="form-control dform  required" id="kebutuhan_skema_kredit">
								<option value="KUR  Mikro">KUR Mikro</option>
								<option value="KUR Retail">KUR Retail</option>
								<option value="Kredit Kemitraan">Kredit Kemitraan</option>
								<option value="Kupedes">Kupedes</option>
							</select>
						</div>
						<div class="col-sm-12">



							<!-- Isian untuk Ketua Kelompok / Klaster -->
							<label for="thedata" class="col-sm-12 control-label">
								<h3 align="center">Isian Ketua Kelompok</h3>
							</label></div>

						<label for="thedata" class="col-sm-12 control-label drequired">Nama Ketua Kelompok / Klaster</label>
						<div class="col-sm-12">
							<input type="text" class="form-control dform  required" id="kelompok_perwakilan" value="" placeholder="required" required>
						</div>

						<label for="thedata" class="col-sm-12 control-label drequired">Jenis Kelamin</label>
						<div class="col-sm-12">
							<select class="form-control dform  required" id="kelompok_jenis_kelamin">
								<option value="Pria">Pria</option>
								<option value="Wanita">Wanita</option>
							</select>
						</div>

						<label for="thedata" class="col-sm-12 control-label drequired">Alamat Lengkap Usaha</label>
						<div class="col-sm-12">
							<input type="text" class="form-control dform  required" id="lokasi_usaha" value="" placeholder="required" required>
						</div>


						<label for="thedata" class="col-sm-12 control-label drequired">Provinsi</label>
						<div class="col-sm-12">
							<select class="form-control dform  required" onchange="getkotakab(this.value);" id="provinsi">
								<?php foreach ($provinsi as $row) {
									echo "<option value='" . $row['id'] . "'>" . $row['nama'] . "</option>";
								} ?>
							</select>
						</div>

						<label for="thedata" class="col-sm-12 control-label drequired">Kabupaten</label>
						<div class="col-sm-12" id="selkab">
							<select class="form-control dform  required" onchange="getkecamatan(this.value)" id="kabupaten">

							</select>
						</div>

						<label for="thedata" class="col-sm-12 control-label drequired">Kecamatan</label>
						<div class="col-sm-12" id="selkec">
							<select class="form-control dform  required" onchange="getkelurahan(this.value)" id="kecamatan">

							</select>
						</div>

						<label for="thedata" class="col-sm-12 control-label drequired">Kelurahan</label>
						<div class="col-sm-12" id="selkel">
							<select class="form-control dform  required" id="kelurahan">

							</select>
						</div>

						<label for="thedata" class="col-sm-3 control-label drequired">Kode pos</label><label id="kodeposview" class="col-sm-9 control-label"></label>
						<div class="col-sm-12">
							<input type="number" class="form-control required" id="kode_pos" value="" placeholder="required" required disabled>
						</div>

						<label for="thedata" class="col-sm-12 control-label drequired">NIK Ketua Kelompok</label>
						<div class="col-sm-12">
							<input type="number" class="form-control dform  required" onchange="cnik(this.value);" id="kelompok_NIK" value="" placeholder="required" required>
						</div>
						<label for="thedata" class="col-sm-12 control-label drequired">Tanggal Lahir Ketua Kelompok</label>
						<div class="col-sm-12">
							<input type="date" data-date-format="DD-MM-YYYY" class="form-control dform  required" id="kelompok_perwakilan_tgl_lahir" value="" placeholder="required" required>
						</div>
						<label for="thedata" class="col-sm-12 control-label drequired">Tempat Lahir Ketua Kelompok</label>
						<div class="col-sm-12">
							<input type="text" class="form-control dform  required" id="kelompok_perwakilan_tempat_lahir" value="" placeholder="required" required>
						</div>


						<label for="thedata" class="col-sm-12 control-label drequired">No Handphone Ketua Kelompok</label>
						<div class="col-sm-12">
							<input type="tel" onchange="cekhp(this);" class="form-control dform  required" id="kelompok_handphone" value="" placeholder="08xxxxxxxx (required)" required>
						</div>


						<label for="thedata" class="col-sm-12 control-label drequired">Sudah Punya Pinjaman?</label>
						<div class="col-sm-12">
							<select class="form-control dform  required" id="pinjaman">
								<option value="BRI">BRI</option>
								<option value="Bank Lain">Bank Lain</option>
								<option value="Belum Ada">Belum Ada</option>
							</select>
						</div>



						<label for="thedata" class="col-sm-12 control-label">Jika ada, nominal pinjaman (Rp) ?</label>
						<div class="col-sm-12">
							<input type="number" class="form-control dform " id="nominal_pinjaman" value="" placeholder="optional" required>
						</div>

						<label for="thedata" class="col-sm-12 control-label">Jika di BRI, Norek Pinjaman BRI?</label>
						<div class="col-sm-12">
							<input type="number" class="form-control dform " id="norek_pinjaman_bri" value="" placeholder="optional" required>
						</div>

						<label for="thedata" class="col-sm-12 control-label drequired">Sudah Punya Simpanan di Bank ?</label>
						<div class="col-sm-12">
							<select class="form-control dform  required" id="simpanan_bank">
								<option value="BRI">BRI</option>
								<option value="Bank Lain">Bank Lain</option>
								<option value="Belum Ada">Belum Ada</option>
							</select>
						</div>

						<label for="thedata" class="col-sm-12 control-label drequired">Jika di BRI, apakah sudah jadi agen BRILink ?</label>
						<div class="col-sm-12">
							<select class="form-control dform  required" id="agen_brilink">
								<option value="Ya">Ya</option>
								<option value="Tidak">Tidak</option>
							</select>
						</div>

						</br>
						<label for="thedata" class="col-sm-12 control-label">Dengan ini saya menyatakan bahwa data ini benar adanya sesuai kenyataan di lapangan <input type="checkbox" class="form-check-input form-control-lg" id="checkvalidkunjungan" required> </label>
						</br>
						<label for="thedata" class="col-sm-12 control-label">Data ini memiliki potensi yang baik untuk meningkatkan bisnis BRI melalui pendekatan komunitas <input type="checkbox" class="form-check-input form-control-lg" id="checkvalidpotensi" required> </label>
						</br>
					</div>
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
						<h2>Update Klaster Binaan BRI 0.2 2 Februari 2020</h2>
						<h4>2 Februari 2020</h4>
						<div>
							<ul>
								<li>Perbaikan fungsi Upload Anggota Menggunakan Excel</li>
								<li>Halaman ini Bejalan Lebih baik jika menggunakan Browser Firefox</li>
							</ul>
						</div>
						<h4>27 Januari 2020</h4>
						<div>
							<ul>
								<li>Halaman ini Bejalan Lebih baik jika menggunakan Browser Firefox</li>
								<li>Data Kode Pos Mengacu pada data provinsi, kabupaten/kota, kecamatan dan kelurahan yang telah diupdate</li>
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
		$(document).ready(function() {
			$('#modalnotif').show()
		});

		function endnotif() {
			var address = "<?php echo base_url(); ?>login/closenotif"
			sendajaxreturn("", address);
			$('#modalnotif').hide();
		}
	</script>
<?php }

?>



<script src="<?php echo base_url(); ?>assets/js/send.js"></script>

<script>
	var valuker = true;
	var valhp = true;
	var valnik = true;

	function getuker(i) {
		var data1 = {
			'kode_uker': i,
		};
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>cluster/cekuker",
			data: data1,
			success: function(smsg) {
				var msg = JSON.parse(smsg);
				document.getElementById("hsuk").innerHTML = '<label for="thedata" class="col-sm-8 control-label">' + msg + '</label>';
				document.getElementById("chker").innerHTML = '<label for="thedata" class="col-sm-8 control-label">' + msg + '</label>';
				valuker = (msg == "data uker tidak ditemukan" ? false : true);
			}
		});
	}



	function getform(i = null) {
		$("#sbt").removeAttr("disabled");
		document.getElementById("checkvalidpotensi").checked = false;
		document.getElementById("checkvalidkunjungan").checked = false;
		if (i != null) {
			var data1 = {
				'id': i,
			};
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>cluster/getdata_s",
				data: data1,
				success: function(nmsg) {
					var msg = JSON.parse(nmsg);
					document.getElementById('id').value = msg[0].id;
					document.getElementById('kode_uker').value = msg[0].kode_uker;
					getuker(msg[0].kode_uker);

					document.getElementById('kaunit_nama').value = msg[0].kaunit_nama;
					document.getElementById('kaunit_pn').value = msg[0].kaunit_pn;
					document.getElementById('kaunit_handphone').value = msg[0].kaunit_handphone;

					document.getElementById('nama_pekerja').value = msg[0].nama_pekerja;
					document.getElementById('personal_number').value = msg[0].personal_number;
					document.getElementById('handphone_pekerja').value = msg[0].handphone_pekerja;


					document.getElementById('kelompok_usaha').value = msg[0].kelompok_usaha;
					document.getElementById('kelompok_jumlah_anggota').value = msg[0].kelompok_jumlah_anggota;
					document.getElementById('kelompok_perwakilan').value = msg[0].kelompok_perwakilan;
					document.getElementById('kelompok_jenis_kelamin').value = msg[0].kelompok_jenis_kelamin;

					document.getElementById('kelompok_NIK').value = msg[0].kelompok_NIK;
					document.getElementById('kelompok_perwakilan_tgl_lahir').value = msg[0].kelompok_perwakilan_tgl_lahir;
					document.getElementById('kelompok_perwakilan_tempat_lahir').value = msg[0].kelompok_perwakilan_tempat_lahir;
					document.getElementById('kelompok_handphone').value = msg[0].kelompok_handphone;
					document.getElementById('lokasi_usaha').value = msg[0].lokasi_usaha;


					setprov(msg[0].provinsi);
					getkotakab(msg[0].provinsi, msg[0].kabupaten);
					getkecamatan(msg[0].kabupaten, msg[0].kecamatan);
					getkelurahan(msg[0].kecamatan, msg[0].kelurahan);


					document.getElementById('sektor_usaha').value = msg[0].sektor_usaha;
					document.getElementById('jenis_usaha').value = msg[0].jenis_usaha;

					document.getElementById('pasar_ekspor').value = msg[0].pasar_ekspor;
					document.getElementById('pasar_ekspor_tahun').value = msg[0].pasar_ekspor_tahun;
					document.getElementById('pasar_ekspor_nilai').value = msg[0].pasar_ekspor_tahun;

					document.getElementById('kelompok_anggota_pinjaman').value = msg[0].kelompok_anggota_pinjaman;
					document.getElementById('hasil_produk').value = msg[0].hasil_produk;
					document.getElementById('kelompok_pihak_pembeli').value = msg[0].kelompok_pihak_pembeli;
					document.getElementById('kelompok_pihak_pembeli_handphone').value = msg[0].kelompok_pihak_pembeli_handphone;
					document.getElementById('kelompok_suplier_produk').value = msg[0].kelompok_suplier_produk;
					document.getElementById('kelompok_suplier_handphone').value = msg[0].kelompok_suplier_handphone;
					document.getElementById('kelompok_luas_usaha').value = msg[0].kelompok_luas_usaha;
					document.getElementById('kelompok_omset').value = msg[0].kelompok_omset;
					document.getElementById('pinjaman').value = msg[0].pinjaman;
					document.getElementById('nominal_pinjaman').value = msg[0].nominal_pinjaman;
					document.getElementById('norek_pinjaman_bri').value = msg[0].norek_pinjaman_bri;
					document.getElementById('agen_brilink').value = msg[0].agen_brilink;

					document.getElementById('kebutuhan_sarana_milik').value = msg[0].kebutuhan_sarana_milik;
					document.getElementById('kebutuhan_sarana').value = msg[0].kebutuhan_sarana;
					document.getElementById('kebutuhan_sarana_lainnya').value = msg[0].kebutuhan_sarana_lainnya;
					document.getElementById('kebutuhan_skema_kredit').value = msg[0].kebutuhan_skema_kredit;

					document.getElementById('kebutuhan_pendidikan').value = msg[0].kebutuhan_pendidikan;
					document.getElementById('simpanan_bank').value = msg[0].simpanan_bank;
					$('#modal').show();
				}
			});
		} else {
			var dd = $('.form-control');
			document.getElementById('setuker').innerHTML = "";
			for (var j = 0; j < dd.length; j++) {
				dd[j].value = "";
				valnik = false;
				valhp = false;
				$('#modal').show();
			}
			document.getElementById('kode_uker').value = "<?php echo $this->session->userdata('kode_uker'); ?>";
			document.getElementById('kelompok_jumlah_anggota').value = "15";
		}
	}

	function userm(i = false) {
		if (i == false) {
			var dd = $('.form-control');
			for (var j = 0; j < dd.length; j++) {
				dd[j].value = "";
			}
			$('#modalz').show();
		} else {
			var data1 = {
				'kode_uker_c': $('#kode_uker_c').val(),
				'password': $('#password').val()
			};
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>login/chpassuker",
				data: data1,
				success: function(smsg) {
					alert('ganti password uker berhasil');
					$('#modalz').hide();
				}
			});
		}
	}

	function inputform() {
		if (document.getElementById("checkvalidkunjungan").checked == true && document.getElementById("checkvalidpotensi").checked == true) {
			if (valuker == true) {
				var data1 = {};
				var dform = document.getElementsByClassName('dform');
				for (var i = 0; i < dform.length; i++) {
					data1[dform[i].id] = dform[i].value;
				}
				var msg = "";
				msg = reval();
				if (msg == "") {
					$("#sbt").attr("disabled", "disabled");
					$.ajax({
						type: "POST",
						url: "<?php echo base_url(); ?>cluster/inputdata",
						data: data1,
						success: function(msg) {
							alert('data berhasil diinput');
							$("#sbt").removeAttr("disabled");
							$('#modal').hide();
							$('#example').DataTable().ajax.reload(null, false);
						}
					});
				} else alert(msg);
			} else alert("Data Uker salah");
		} else alert("Harap isi checkbox pertanyaan diatas!!")
	}



	function cnik(i = null, j = null) {
		var validator = ["0000000000000000", "1111111111111111", "2222222222222222", "3333333333333333", "4444444444444444", "5555555555555555", "6666666666666666", "7777777777777777", "8888888888888888", "9999999999999999"];
		// return true;
		if (i != null) {
			if (i.toString().length == 16) {
				if (validator.includes(i.toString) == false) {
					return true;
				} else {

					if (j != null) alert('Data NIK tidak valid');

					return false;
				}
			} else {

				if (j != null) alert('NIK harus 16 digit');

				return false;
			}
		} else return false;
	}




	function reval() {
		var msg = "";
		msg += (validatorreqtext(document.getElementById('kaunit_nama'), iname) == false ? "data Nama Kaunit tidak valid \n" : "");
		msg += (validatorreqnumber(document.getElementById('kaunit_pn')) == false ? "data PN Kaunit tidak valid \n" : "");
		msg += (cekhp(document.getElementById('kaunit_handphone')) == false ? "data PN Kaunit tidak valid \n" : "");

		msg += (validatorreqtext(document.getElementById('nama_pekerja'), iname) == false ? "data nama_pekerja tidak valid \n" : "");
		msg += (validatorreqnumber(document.getElementById('personal_number')) == false ? "data personal_number pekerja tidak valid \n" : "");
		msg += (cekhp(document.getElementById('handphone_pekerja')) == false ? "data handphone_pekerja tidak valid \n" : "");

		msg += (validatorreqtext(document.getElementById('kelompok_usaha'), iname) == false ? "data Kelompok usaha tidak valid \n" : "");
		msg += (validatorreqnumber(document.getElementById('kelompok_jumlah_anggota')) == false ? "data kelompok_jumlah_anggota  tidak valid \n" : "");
		msg += (validatorreqtext(document.getElementById('hasil_produk'), ischar) == false ? "data hasil_produk tidak valid \n" : "");
		msg += (validatoroptnumber(document.getElementById('pasar_ekspor_tahun')) == false ? "data pasar_ekspor_tahun  tidak valid \n" : "");
		msg += (validatoroptnumber(document.getElementById('pasar_ekspor_nilai')) == false ? "data pasar_ekspor_nilai  tidak valid \n" : "");
		msg += (validatoroptnumber(document.getElementById('kelompok_luas_usaha')) == false ? "data kelompok_luas_usaha  tidak valid \n" : "");

		msg += (validatoropttext(document.getElementById('kelompok_pihak_pembeli'), ischar) == false ? "data kelompok_pihak_pembeli  tidak valid \n" : "");
		msg += (cekhpnor(document.getElementById('kelompok_pihak_pembeli_handphone')) == false ? "data kelompok_pihak_pembeli_handphone tidak valid \n" : "");
		msg += (validatoropttext(document.getElementById('kelompok_suplier_produk'), ischar) == false ? "data kelompok_suplier_produk  tidak valid \n" : "");
		msg += (cekhpnor(document.getElementById('kelompok_suplier_handphone')) == false ? "data kelompok_suplier_handphone tidak valid \n" : "");

		msg += (validatorreqtext(document.getElementById('kebutuhan_sarana_milik'), ischar) == false ? "data kebutuhan_sarana_milik tidak valid \n" : "");
		msg += (validatoropttext(document.getElementById('kebutuhan_sarana_lainnya'), ischar) == false ? "data kebutuhan_sarana_lainnya tidak valid \n" : "");

		msg += (validatorreqtext(document.getElementById('kelompok_perwakilan'), iname) == false ? "data nama ketua kelompok tidak valid \n" : "");
		msg += (validatorreqtext(document.getElementById('lokasi_usaha'), ischar) == false ? "data lokasi_usaha tidak valid \n" : "");

		msg += (validatorreqtext(document.getElementById('provinsi'), ischar) == false ? "data provinsi tidak valid \n" : "");
		msg += (validatorreqtext(document.getElementById('kabupaten'), ischar) == false ? "data kabupaten tidak valid \n" : "");
		msg += (validatorreqtext(document.getElementById('kecamatan'), ischar) == false ? "data kecamatan tidak valid \n" : "");
		msg += (validatorreqtext(document.getElementById('kelurahan'), ischar) == false ? "data kelurahan tidak valid \n" : "");
		msg += (validatorreqnumber(document.getElementById('kode_pos')) == false ? "data kode_pos pekerja tidak valid \n" : "");

		msg += (cnik(document.getElementById('kelompok_NIK').value) == false ? "data kelompok_NIK pekerja tidak valid \n" : "");
		msg += (validatorreqtext(document.getElementById('kelompok_perwakilan_tgl_lahir'), ischar) == false ? "data kelompok_perwakilan_tgl_lahir pekerja tidak valid \n" : "");
		msg += (validatorreqtext(document.getElementById('kelompok_perwakilan_tempat_lahir'), ischar) == false ? "data kelompok_perwakilan_tempat_lahir tidak valid \n" : "");
		msg += (cekhp(document.getElementById('kelompok_handphone')) == false ? "data kelompok_handphone tidak valid \n" : "");

		msg += (validatoroptnumber(document.getElementById('nominal_pinjaman')) == false ? "data nominal_pinjaman  tidak valid \n" : "");
		msg += (validatoroptnumber(document.getElementById('norek_pinjaman_bri')) == false ? "data norek_pinjaman_bri  tidak valid \n" : "");
		msg += (document.getElementById('kelompok_anggota_pinjaman').value == "" ? "data kelompok angota pinjaman tidak boleh kosong \n" : "");
		msg += (document.getElementById('sektor_usaha').value == "" ? "data sektor usaha tidak boleh kosong \n" : "");
		msg += (document.getElementById('jenis_usaha').value == "" ? "data  Jenis usaha tidak boleh kosong \n" : "");
		msg += (document.getElementById('pasar_ekspor').value == "" ? "data Pasar Ekspor tidak boleh kosong\n" : "");
		msg += (document.getElementById('kebutuhan_sarana').value == "" ? "data  Kebutuhan Sarana tidak boleh kosong\n" : "");
		msg += (document.getElementById('kebutuhan_pendidikan').value == "" ? "data Kebutuhan pendidikan tidak boleh kosong\n" : "");
		msg += (document.getElementById('kebutuhan_skema_kredit').value == "" ? "data Skema Kredit  tidak boleh kosong\n" : "");
		msg += (document.getElementById('kelompok_jenis_kelamin').value == "" ? "data  Jenis Kelamin ketua/Perwakilan usaha tidak boleh kosong\n" : "");
		msg += (document.getElementById('pinjaman').value == "" ? "data punya Pinjaman tidak boleh kosong\n" : "");
		msg += (document.getElementById('simpanan_bank').value == "" ? "data  simpanan tidak boleh kosong\n" : "");
		msg += (document.getElementById('agen_brilink').value == "" ? "data agen brilink tidak boleh kosong\n" : "");
		return msg;
	}

	var iname = "!@#$%^&*()+=-[]\\\';,/{}|0123456789\":<>?";
	var ischar = "!@#$%^&*()+=[]\\\';/{}|\":<>?";

	///z for value, y for select iname char, x if call from input then alert from id, w if optional
	function validatorreqtext(z, y, x = null) {
		if (z.value.length != 0) {
			var dfalse = 0;
			for (var i = 0; i < (z.value.length); i++) {
				if (y.indexOf(z.value.charAt(i)) != -1) dfalse++;
			}
			if (dfalse == 0) return true;
			else {
				if (x != null) alert("Data " + x + " Tidak Valid (mengandung karakter yang tidak diperbolehkan)");
				return false;
			}
		} else {
			if (x != null) alert("Data " + x + " tidak boleh kosong");
			return false;
		}
	}

	function validatoropttext(z, y, x = null) {
		if (z.value.length != 0) {
			var dfalse = 0;
			for (var i = 0; i < (z.value.length); i++) {
				if (y.indexOf(z.value.charAt(i)) != -1) dfalse++;
			}
			if (dfalse == 0) return true;
			else {
				if (x != null) alert("Data " + x + " Tidak Valid (mengandung karakter yang tidak diperbolehkan)");
				return false;
			}
		}
		return true;
	}
	///i for value, j if call from input, k if optional	

	function validatorreqnumber(i, j = null, k = null) {
		if (i.value.length != 0) {
			var number = /^[0-9]+$/;
			var res = i.value.substring(0, 2);

			if (!i.value.match(number)) {
				if (j != null) alert("data " + j + " tidak valid");
				return false;
			} else if (i.value.length == 0) {
				if (j != null) alert("data " + j + " tidak valid");
				return false;
			} else return true;
		} else {
			if (j != null) alert("data " + j + " tidak boleh kosong");
			return false;
		}
	}

	function validatoroptnumber(i, j = null, k = null) {
		if (i.value.length != 0) {
			var number = /^[0-9]+$/;
			var res = i.value.substring(0, 2);

			if (!i.value.match(number)) {
				if (j != null) alert("data " + j + " tidak valid");
				return false;
			} else if (i.value.length == 0) {
				if (j != null) alert("data " + j + " tidak valid");
				return false;
			} else return true;
		} else return true;
	}


	function cekhp(i, j = null) {
		if (j == null) i = i.value;
		//console.log(i);
		var number = /^[0-9]+$/;
		var res = i.substring(0, 2);
		if (i == null || i == "") {
			if (j != null) alert('nomer handphone tidak boleh kosong')
			return false;
		} else if (!i.match(number)) {
			if (j != null) alert("nomer handphone  harus angka");
			return false;

		} else if (i.length < 8) {
			if (j != null) alert("nomor handphone tidak valid");
			return false;
		} else if (res != "08") {
			if (j != null) alert(j + " Harus diawali 08");
			return false;
		} else return true;
	}



	function cekhpnor(i, j = null) {
		if (i.value.length != 0) {
			var number = /^[0-9]+$/;
			var res = i.value.substring(0, 2);
			if (!i.value.match(number)) {
				if (j != null) alert("nomer handphone harus angka");
				return false;
			} else if (i.value.length < 8) {
				if (j != null) alert("nomor handphone tidak valid");
				return false
			} else if (res != "08") {
				if (j == null) alert(d.name + " Harus diawali 08");
				return false;
			} else return true;
		} else return true;
	}

	function deldata(i) {
		if (confirm('Apakah anda yakin akan menghapus data ini?')) {
			var data1 = {
				'id': i,
			};
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>cluster/deldata",
				data: data1,
				success: function(msg) {
					alert('data berhasil dihapus');
					$('#example').DataTable().ajax.reload(null, false);
				}
			});
		}
	}

	function setprov(i) {
		$("#provinsi").val(i);
	}

	function getkotakab(i, j = null) {
		var data1 = {
			'provinsi_id': i
		};
		var address = "<?php echo base_url() ?>/cluster/getkotakab";
		var get = sendajaxreturn(data1, address, 'json');
		var select = '<select class="form-control dform  required" onchange="getkecamatan(this.value)" id="kabupaten"><option></option>';
		get.forEach(function(e) {
			select += "<option value='" + e.id + "' " + (j != null ? (j == e.id ? "selected" : "") : "") + ">" + e.nama + "</option>";
		})
		document.getElementById("selkab").innerHTML = '' + select + '</select>';
	}

	function getkecamatan(i, j = null) {
		var data1 = {
			'kabupaten_kota_id': i
		};
		var address = "<?php echo base_url() ?>/cluster/getkecamatan";
		var get = sendajaxreturn(data1, address, 'json');
		var select = '<select class="form-control dform  required" onchange="getkelurahan(this.value)" id="kecamatan"><option></option>';
		get.forEach(function(e) {
			select += "<option value='" + e.id + "' " + (j != null ? (j == e.id ? "selected" : "") : "") + ">" + e.nama + "</option>";
		})
		document.getElementById("selkec").innerHTML = '' + select + '</select>';
	}

	function getkelurahan(i, j = null) {
		var data1 = {
			'kecamatan_id': i
		};
		var address = "<?php echo base_url() ?>/cluster/getkelurahan";
		var get = sendajaxreturn(data1, address, 'json');
		var select = '<select class="form-control dform  required" onchange="setkdpos(this)" id="kelurahan"><option></option>';
		get.forEach(function(e) {
			select += "<option value='" + e.id + "' " + (j != null ? (j == e.id ? "selected" : "") : "") + " kdpos='" + e.kode_pos + "'>" + e.nama + "</option>";
			if (j != null && j == e.id) setkdpos("", e.kode_pos);
		})
		document.getElementById("selkel").innerHTML = '' + select + '</select>';
	}

	function setkdpos(i, j = null) {
		var element = (j == null ? $("option:selected", i).attr('kdpos') : j);
		document.getElementById("kode_pos").innerHTML = element;
		document.getElementById("kode_pos").value = element;
	}
</script>