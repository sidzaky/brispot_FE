<div class="content-wrapper">
	<!-- Content Header (Page header) -->
			<section class="content">
					<div class="box box-solid">
						<div id="result" class="box-body">
							<div class="container-fluid control-box">
													<div class="row">
								<h3 class="box-title m-b-0" alignt="center"><b>Data Klaster Anggota</b></h3>
								<div id="result">
									<table id="example" class="table table-striped table-bordered" style="width:100%">
										<thead>
											<tr>
												<th>No</th>
												<th>Kantor Wilayah</th>
												<th>Klaster belum Mengisi</th>
												<th>Klaster telah Mengisi</th>
												<th>Total Data Anggota</th>
											</tr>
										</thead>
										<tbody>
											<?php
                                                $i = 1;
                                                $kosong=0;
                                                $terisi=0;
                                                $totalanggota=0;
                                                foreach ($anggota as $row => $value) {
                                                    echo '<tr>';
                                                    echo '<td>' . $i . '</td>';
                                                    echo '<td>' . $row. '</td>';
                                                    echo '<td>' . $value['kosong'] . '</td>';
                                                    echo '<td>' . $value['terisi'] . '</td>';
                                                    echo '<td><button class="btn btn-primary waves-effect waves-light btn-sm" id="button'.$i.'" onclick="getcsv(\''.$value['kode_kanwil'].'\', \''. $i .'\', \''. $row .'\')" name="kanwil" value="' . $value['kode_kanwil'] . '" type="submit"><i class="fa fa-download"></i></button>' . $value['total_anggota'] . '</td>';
                                                    echo '</tr>';
                                                    $i++;
                                                    $kosong += $value['kosong'];
                                                    $terisi += $value['terisi']; 
                                                    $totalanggota += $value['total_anggota'];
                                                }
                                                echo '<tr><td>'.($i+1).'</td><td>Grand Total</td><td>'.$kosong.'</td><td>'.$terisi.'</td><td>'.$totalanggota.'</td></tr>';
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

            function getcsv(i = '', k, l) {
                var data1 = {
                    'kode_kanwil': i,
                };
                if (i == "") i = "all";
                var name = l.trim();
                $("#button" + k).attr("disabled", "disabled");
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>cluster/dldatareportanggota/",
                    data: data1,
                    success: function(msg) {
                        var jsonObject = msg;
                        var csv = ConvertToCSV(jsonObject),
                            a = document.createElement('a');
                        a.textContent = 'download';
                        a.download = name + '.csv';
                        a.href = 'data:text/csv;charset=utf-8,' + escape(csv);
                        document.body.appendChild(a);
                        a.click();
                        $("#button" + k).removeAttr("disabled");
                    }
                });
            }
</script>