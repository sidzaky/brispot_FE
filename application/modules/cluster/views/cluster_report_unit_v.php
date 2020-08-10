<div class="content-wrapper">
	<!-- Content Header (Page header) -->
			<section class="content">
					<div class="box box-solid">
						<div id="result" class="box-body">
							<div class="container-fluid control-box">
													<div class="row">
								<h3 class="box-title m-b-0" align="center"><b>Data Brispot Unit</b></h3>
								<div id="result">
									<table id="example" class="table table-striped table-bordered" style="width:100%">
										<thead>
											<tr>
												<th>No</th>
												<th>Kantor Wilayah</th>
												<th>Kosong</th>
												<th>Terisi Sebagian</th>
												<th>Terisi</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$i = 1;
											foreach ($data as $row) {
												$kosongDetailBtn = '<button class="btn btn-primary waves-effect waves-light btn-sm" onclick="switchcase(\'' . $row['REGION'] . '\',\'kosong\')"><i class="fa fa-info"></i></button>';
												$isiSebagianDetailBtn = '<button class="btn btn-primary waves-effect waves-light btn-sm" onclick="switchcase(\'' . $row['REGION'] . '\',\'sebagian\')"><i class="fa fa-info"></i></button>';
												$terisiDetailBtn = '<button class="btn btn-primary waves-effect waves-light btn-sm" onclick="switchcase(\'' . $row['REGION'] . '\',\'terisi\')"><i class="fa fa-info"></i></button>';
												$kosong = isset($row['kosong']) ? $row['kosong'] . $kosongDetailBtn : 0;
												$isiSebagian = isset($row['isi_sebagian']) ? $row['isi_sebagian'] . $isiSebagianDetailBtn : 0;
												$terisi = isset($row['terisi']) ? $row['terisi'] . $terisiDetailBtn : 0;
												echo '<tr>';
												echo '<td>' . $i . '</td>';
												echo '<td>' . $row['RGDESC'] . '</td>';
												echo '<td>' . $kosong . '</td>';
												echo '<td>' . $isiSebagian . '</td>';
												echo '<td>' . $terisi . '</td>';
												echo '</tr>';
												$i++;
											}
											?>
										</tbody>
									</table>

								</div>
							</div>
						</div>
					</div>
					<style>
						.modal-body {
							max-height: calc(100vh - 200px);
							overflow-y: auto;
						}
					</style>
			</div>
		</section>
	</div>
					<div class="modal " id="modalz" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" onclick="$('#modalz').hide();" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h5 class="modal-title">Form klaster <?php echo $this->session->userdata('nama_uker') ?></h5>
								</div>
								<div class="modal-body">
									<div id="mod-content">
										<div class="row" id="datashow">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

<script>
	function switchcase(i, j) {
		var data1 = {
			'REGION': i,
			'case': j
		};
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>cluster/report_unit_detail",
			data: data1,
			success: function(msg) {
				document.getElementById("datashow").innerHTML = msg;
				$('#modalz').show();
			}
		});
	}
</script>