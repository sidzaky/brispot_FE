	  <div class="container-fluid">
                <div class="row bg-title">
                </div>
				<div class="col-md-12">
                        <div class="white-box">
                            <h3 class="box-title m-b-0"  align="center"><b>Data Brispot unit</b></h3>
							<div id="result">	
								<table id="example" class="table table-striped table-bordered" style="width:100%">
																		<thead>
																			<tr>
																				<th>No</th>
																				<th>Kantor Wilayah</th>
																				<th>kosong</th>
																				<th>Terisi Sebagian</th>
																				<th>terisi</th>
																			</tr>
																		</thead>
																		<tbody>
																		<?php 
																			$i=1;
																			foreach ($data as $row){	
																				echo '<tr>
																								<td>'.$i.'</td>
																								<td>'.$row['RGDESC'].'</td>
																								<td>'.$row['kosong'].'<button class="btn btn-primary waves-effect waves-light btn-sm" onclick="switchcase(\''.$row['REGION'].'\',\'kosong\')"><i class="fa fa-info"></i></button></td>
																								<td>'.$row['isi_sebagian'].'<button class="btn btn-primary waves-effect waves-light btn-sm" onclick="switchcase(\''.$row['REGION'].'\',\'sebagian\')"><i class="fa fa-info"></i></button></td>
																								<td>'.$row['terisi'].'<button class="btn btn-primary waves-effect waves-light btn-sm" onclick="switchcase(\''.$row['REGION'].'\',\'terisi\')"><i class="fa fa-info"></i></button></td>
																						</tr>';
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
			.modal-body{
					max-height: calc(100vh - 200px);
					overflow-y: auto;
			}
		
	</style>
	 <div class="modal " id="modalz" tabindex="-1" role="dialog"  aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
						<button type="button" class="close" onclick="$('#modalz').hide();" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h5 class="modal-title">Form klaster <?php echo $this->session->userdata('nama_uker')?></h5>
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
			function switchcase(i,j){
				var data1={ 
							'REGION' :  i,
							'case' :  j
						};
				$.ajax({ 
						   type:"POST",
						   url: "<?php echo base_url();?>cluster/report_unit_detail",
						   data: data1,
						   success:function(msg){
								document.getElementById("datashow").innerHTML=msg;
								$('#modalz').show();
							}
					});	
		}
		</script>