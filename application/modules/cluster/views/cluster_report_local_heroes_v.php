<div class="content-wrapper">
	<!-- Content Header (Page header) -->
			<section class="content">
					<div class="box box-solid">
						<div id="result" class="box-body">
							<div class="container-fluid control-box">
													<div class="row">
								<h3 class="box-title m-b-0" align="center"><b>Data UMKM Local Heroes</b></h3>
								<div id="result">
									<table id="example" class="table table-striped table-bordered" style="width:100%">
										<thead>
											<tr>
												<th>No</th>
												<th>Kantor Wilayah</th>
												<th>Jumlah Local Heroes</th>

											</tr>
										</thead>
										<tbody>
											<?php
											$i = 1;
											$d=0;
											foreach ($klaster as $row) {
												echo '<tr>';
												echo '<td>' . $i . '</td>';
												echo '<td>' . $row['kanwil'] . '</td>';
												echo '<td>' . $row['total'] . '</td>';
												echo '</tr>';
												$i++;
												$d +=$row['total'];
											}
											?>
											<tr>
												<td><?php $i+1?></td>
												<td>Grand Total</td>
												<td><?php echo $d?></td>
											</td>
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
