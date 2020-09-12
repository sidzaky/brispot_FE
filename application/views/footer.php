
<footer style="background:#f5f5f5">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1 text-center">
                    <h4><strong></strong>
                    </h4>
                    <hr class="small">
                    <p class="text-muted"></p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
	<?php if ($this->session->userdata('notif') == 1) { 
	
	?>
	<script>
        $( document ).ready(function() {$('#modalnotif').show()});
        function endnotif(){
            $('#modalnotif').hide();
            $.ajax({
                    type: "POST",
                    url: "./login/closenotif",
                });
            }
	</script>
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
                        <h3><b>Update Klaster Binaan BRI 0.4 13 September 2020</b></h3>
						<div>
							<ul>
								<li>Perbaikan Bug "Ganti Password Uker"</li>
							</ul>
						</div>
                        <h4>Update Klaster Binaan BRI 0.4 10 September 2020</h4>
						<div>
							<ul>
								<li>View Menjadi lebih baik</li>
								<li>Tambahan menu Bantuan untuk mengirimkan pertanyaan kepada admin </li>
								<li>terdapat Button Profile UMKM</li>
							</ul>
						</div>
						<h4>Update Klaster Binaan BRI 0.3 4 Juli 2020</h4>
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
<?php } ?>
    <!-- Custom Theme JavaScript -->
</body>

</html>
