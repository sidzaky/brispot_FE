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
												echo '<td>' . $row['total'] . '<button class="btn btn-primary waves-effect waves-light btn-sm" id="button'.$i.'" onclick="getcsv(\''.$row['kode_kanwil'].'\', \''. $i .'\', \''. $row['kanwil'] .'\')" name="kanwil" value="' . $row['kode_kanwil'] . '" type="submit"><i class="fa fa-download"></i></button></td>';
												echo '</tr>';
												$i++;
												$d +=$row['total'];
											}
											?>
											<tr>
												<td><?php $i+1?></td>
												<td>Grand Total</td>
												<td><?php echo $d . '<button class="btn btn-primary waves-effect waves-light btn-sm" id="button'.$i.'" onclick="getcsv(\'all\', \''. $i .'\', \'all\')" name="kanwil" value="all" type="submit"><i class="fa fa-download"></i></button>';?></td>
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

		<script>
			function ConvertToCSV(objArray) {
                var array = typeof objArray != 'object' ? JSON.parse(objArray) : objArray;
                var str = '';

                for (var i = 0; i < array.length; i++) {
                    var line = '';

                    for (var index in array[i]) {
                        if (line != '') line += '|'
                        var j ="-"; 
                        if (array[i][index]){
                            j = array[i][index].toString();
                        }
                        line += j;
                    }

                    str += line + '\r\n';
                }

                return str;
            }

			function getcsv(i = '', k, l) {
                var data1 = {
                    'kode_kanwil': i,
                };
                if (i == "") i = "all";
                var name = l.trim();
                $("#button" + k).attr("disabled", "disabled");
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>cluster/dldatareportlocalheroes/",
                    data: data1,
                    success: function(msg) {
                        var jsonObject = msg;
                        var csv = ConvertToCSV(jsonObject),
                            a = document.createElement('a');
                        a.textContent = 'download';
                        a.download = 'Local_heroes_'+ name + '.csv';
                        a.href = 'data:text/csv;charset=utf-8,' + escape(csv);
                        document.body.appendChild(a);
                        a.click();
                        $("#button" + k).removeAttr("disabled");
                    }
                });
            }
		
		</script>
