     <div class="container-fluid">
                <div class="row bg-title">
                </div>
				<div class="col-md-12">
                        <div class="white-box">
                            <h3 class="box-title m-b-0"  align="center"><b>Report Total Cluster BRIspot <?php echo ($harian!="" ? ' Per'.date('d M, Y', time()) : '')?></b></h3>
							<div id="result">
								<div class="col-sm-12">
									<script>
											$(document).ready(function(){ 
													$('#example').DataTable({
															 paging: false,
															 searching : false,
															 "scrollX": true,
													});
											})
									</script>
									<table id="example" class="table table-striped table-bordered" style="width:100%">
											<thead>
												<tr>
													<th>No</th>
													<th>Kantor Wilayah</th>
													<th>Pertanian</th>
													<th>Pertenakan</th>
													<th>Perikanan</th>
													<th>Industri Makanan & Minuman</th>
													<th>Perdagangan</th>
													<th>Pariwisata</th>
													<th>Lainnya </th>
													<th>Grand Total </th>
												</tr>
											</thead>
											<tbody>
												<?php 
													$i=1;
													foreach ($kanwil as $row => $value){
														$totalkanwil=$kanwil[$row]['Pertanian']+$kanwil[$row]['Peternakan']+$kanwil[$row]['Perikanan']+$kanwil[$row]['Industri Makanan & Minuman']+$kanwil[$row]['Perdagangan Besar dan Eceran, bukan Mobil dan Sepeda']+$kanwil[$row]['Pariwisata']+$kanwil[$row]['Lainnya'];
															echo '<tr>
																		<td>'.$i.'</td>
																		<td>'.$row.'</td>
																		<td>'.$kanwil[$row]['Pertanian'].'</td>
																		<td>'.$kanwil[$row]['Peternakan'].'</td>
																		<td>'.$kanwil[$row]['Perikanan'].'</td>
																		<td>'.$kanwil[$row]['Industri Makanan & Minuman'].'</td>
																		<td>'.$kanwil[$row]['Perdagangan Besar dan Eceran, bukan Mobil dan Sepeda'].'</td>
																		<td>'.$kanwil[$row]['Pariwisata'].'</td>
																		<td>'.$kanwil[$row]['Lainnya'].'</td>
																		<td>'.$totalkanwil.'<button class="btn btn-primary waves-effect waves-light btn-sm" onclick="getcsv(\''.$row.'\',\''.$harian.'\',\''.$i.'\')" id="button'.$i.'" name="kanwil" value="'.$row.'" type="submit"><i class="fa fa-download"></i></button></td>
															</tr>';
															$i++;
													}
													echo '</tbody>
																<tfoot>
																	<tr>
																		<td></td>
																		<td>Grand Total</td>
																		<td>'.$total['Pertanian'].'</td>
																		<td>'.$total['Peternakan'].'</td>
																		<td>'.$total['Perikanan'].'</td>
																		<td>'.$total['Industri Makanan & Minuman'].'</td>
																		<td>'.$total['Perdagangan Besar dan Eceran, bukan Mobil dan Sepeda'].'</td>
																		<td>'.$total['Pariwisata'].'</td>
																		<td>'.$total['Lainnya'].'</td>
																		<td>'.($total['Pertanian']+$total['Peternakan']+$total['Perikanan']+$total['Industri Makanan & Minuman']+$total['Perdagangan Besar dan Eceran, bukan Mobil dan Sepeda']+$total['Pariwisata']+$total['Lainnya']).($this->session->userdata('permission')==4 ? '<button class="btn btn-primary waves-effect waves-light btn-sm" id="buttonall" onclick="getcsv(\'\',\''.$harian.'\',\'all\')" name="kanwil" value="'.$row.'" type="submit"><i class="fa fa-download"></i></button>' : '').'</td>
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
					var j=array[i][index].toString();
					j=j.replace(/;/g," ");
                    line += j;
                }

                str += line + '\r\n';
            }

            return str;
        }
	
		function getcsv(i='',j,k){
			console.log(i.length);
			var data1={ 
							'kanwil' :  i,
						};
			if (i=="") i="all";
			var name=i.replace(/ /g," ");
			$("#button"+k).attr("disabled", "disabled");
			$.ajax({ 
						   type:"POST",
						   url: "<?php echo base_url();?>cluster/dldata/"+j,
						   data: data1,
						   success:function(msg){
								var jsonObject = msg;
								var csv=ConvertToCSV(jsonObject),
								a=document.createElement('a');
								a.textContent='download';
								a.download=name+'.csv';
								a.href='data:text/csv;charset=utf-8,'+escape(csv);
								document.body.appendChild(a);
								a.click();
								$("#button"+k).removeAttr("disabled");
							}
					});
		}
    </script>
			
			