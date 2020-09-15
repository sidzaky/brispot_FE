     <div class="content-wrapper">
	<!-- Content Header (Page header) -->
	
<section class="content">
		<div class="box box-solid">
			<div id="result" class="box-body">
				<div class="container-fluid control-box">
					<div class="row">
     			<h3 class="box-title m-b-0" align="center"><b>Report Total Cluster BRIspot <?php echo ($harian != "" ? ' Per' . date('d M, Y', time()) : '') ?> <?php echo $this->session->userdata('name_uker'); ?></b></h3>
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
     								<th>Kanwil</th>
									<?php 
										foreach ($listkategori as $s){
												echo '<th>'.$s['nama_cluster_jenis_usaha_map'].'</th>';
										}
									?>
     								<th>Grand Total </th>
     							</tr>
     						</thead>
     						<tbody>
     							<?php
										$i = 1;
                                        $grandtotal = 0;
										foreach ($kanwil as $row => $value) {
											$totalkanwil=0;
											echo '<tr>
													 <td>' . $i . '</td>
													 <td>'.$row.'</td>';
											for ($z=1;$z<=count($listkategori);$z++){
												if (!isset($value[$z])) {
                                                        $value[$z]=0;
                                                    }
													$totalkanwil = $totalkanwil+$value[$z];
													echo '<td>'.$value[$z].'</td>';
												}
											echo '<td>'.$totalkanwil.($this->session->userdata('permission') >= 3 ? '<button class="btn btn-primary waves-effect waves-light btn-sm" id="buttonall" onclick="getcsv(\''.$row.'\',\'' . $harian . '\',\''.$i.'\')" name="kanwil" value="' . $row . '" type="submit"><i class="fa fa-download"></i></button>' : '').'</td></tr>';
											$i++;
										}
										echo '</tbody>
																<tfoot>
																	<tr>
																		<td></td>
																		<td>Grand Total</td>';
										for ($z=1;$z<=count($listkategori);$z++){
										
												echo '<td>'.(isset($total[$z]) ? $total[$z] : '0').'</td>';
												$grandtotal += (isset($total[$z]) ? $total[$z] : 0 );
										}
										echo '<td>'.$grandtotal.($this->session->userdata('permission') >= 3 ? '<button class="btn btn-primary waves-effect waves-light btn-sm" id="buttonall" onclick="getcsv(\'\',\'' . $harian . '\',\'all\')" name="kanwil" value="' . $row . '" type="submit"><i class="fa fa-download"></i></button>' : '') . '</td></tr></tfoot>';
										?>

     					</table>



     				</div>
     			</div>
     		</div>
     	</div>
     	</div>
     	</div>
<section class="content">
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