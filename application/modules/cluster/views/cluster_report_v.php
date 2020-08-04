     <div class="container-fluid">
     	<div class="row bg-title">
     	</div>
     	<div class="col-md-12">
     		<div class="white-box">
     			<h3 class="box-title m-b-0" align="center"><b>Report Total Cluster BRIspot <?php echo ($harian != "" ? ' Per' . date('d M, Y', time()) : '') ?></b></h3>
     			<div id="result">
     				<div class="col-sm-12">
     					<script>
     						$(document).ready(function() {
     							$('#example').DataTable({
     								paging: false,
     								searching: false,
     								"scrollX": true,
     							});
     						})
     					</script>
     					<table id="example" class="table table-striped table-bordered" style="width:100%">
     						<thead>
     							<tr>
     								<th>No</th>
     								<th>Kantor Wilayah</th>
     								<th>PERTANIAN, PERBURUAN, DAN KEHUTANAN</th>
     								<th>Perikanan</th>
     								<th>INDUSTRI PENGOLAHAN</th>
     								<th>JASA-JASA</th>
     								<th>PERDAGANGAN</th>
     								<th>Pariwisata</th>
     								<th>Grand Total </th>
     							</tr>
     						</thead>
     						<tbody>
     							<?php
										$i = 1;
										foreach ($kanwil as $row => $value) {
											$totalkanwil = $kanwil[$row]['PERTANIAN, PERBURUAN, DAN KEHUTANAN'] + $kanwil[$row]['Perikanan'] + $kanwil[$row]['INDUSTRI PENGOLAHAN'] + $kanwil[$row]['JASA-JASA'] + $kanwil[$row]['PERDAGANGAN'] + (isset($kanwil[$row]["Pariwisata"]) ? $kanwil[$row]['Pariwisata'] : 0);
											echo '<tr>
																		<td>' . $i . '</td>
																		<td>' . $row . '</td>
																		<td>' . $kanwil[$row]['PERTANIAN, PERBURUAN, DAN KEHUTANAN'] . '</td>
																		<td>' . $kanwil[$row]['Perikanan'] . '</td>
																		<td>' . $kanwil[$row]['INDUSTRI PENGOLAHAN'] . '</td>
																		<td>' . $kanwil[$row]['JASA-JASA'] . '</td>
																		<td>' . $kanwil[$row]['PERDAGANGAN'] . '</td>
																		<td>' . (isset($kanwil[$row]["Pariwisata"]) ? $kanwil[$row]['Pariwisata'] : 0) . '</td>
																		<td>' . $totalkanwil . '<button class="btn btn-primary waves-effect waves-light btn-sm" onclick="getcsv(\'' . $row . '\',\'' . $harian . '\',\'' . $i . '\')" id="button' . $i . '" name="kanwil" value="' . $row . '" type="submit"><i class="fa fa-download"></i></button></td>
															</tr>';
											$i++;
										}
										echo '</tbody>
																<tfoot>
																	<tr>
																		<td></td>
																		<td>Grand Total</td>
																		<td>' . $total['PERTANIAN, PERBURUAN, DAN KEHUTANAN'] . '</td>
																		<td>' . $total['Perikanan'] . '</td>
																		<td>' . $total['INDUSTRI PENGOLAHAN'] . '</td>
																		<td>' . $total['JASA-JASA'] . '</td>
																		<td>' . $total['PERDAGANGAN'] . '</td>
																		<td>' . $total['Pariwisata'] . '</td>
																		<td>' . ($total['PERTANIAN, PERBURUAN, DAN KEHUTANAN'] + $total['Perikanan'] + $total['INDUSTRI PENGOLAHAN'] + $total['JASA-JASA'] + $total['PERDAGANGAN'] + $total['Pariwisata']) . ($this->session->userdata('permission') == 4 ? '<button class="btn btn-primary waves-effect waves-light btn-sm" id="buttonall" onclick="getcsv(\'\',\'' . $harian . '\',\'all\')" name="kanwil" value="' . $row . '" type="submit"><i class="fa fa-download"></i></button>' : '') . '</td>
																	</tr>
																</tfoot>';

										?>

     					</table>



     				</div>
     			</div>
     		</div>
     	</div>
     </div>


     <script type="text/javascript">
     	// JSON to CSV Converter
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

     	function getcsv(i = '', j, k) {
     		console.log(i.length);
     		var data1 = {
     			'kanwil': i,
     		};
     		if (i == "") i = "all";
     		var name = i.trim();
     		$("#button" + k).attr("disabled", "disabled");
     		$.ajax({
     			type: "POST",
     			url: "<?php echo base_url(); ?>cluster/dldata/" + j,
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