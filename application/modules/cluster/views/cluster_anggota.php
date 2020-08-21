<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content">
		<div class="box box-solid">
			<div id="result" class="box-body">
				<div class="container-fluid control-box">
					<div class="row">
                        <div class="white-box">
                            <h3 class="box-title m-b-0" align="center"><b>Data Anggota Kelompok <div id="nk"><?php echo $kelompok_usaha?></div></b></h3>
							<div id="result">
							<script>
									var id_cluster= "<?php echo $id ?>";
									$(document).ready(function() {
												 $('#example').DataTable( {
														"scrollX": true,
														"processing": true,
														"serverSide": true,
														 "ajax": {
															"url"  : "<?php echo base_url();?>cluster/getdata_anggota",
															"data" : function ( d ){d.id = id_cluster},
															"type" : "POST"
														},
													});
													var tambah='&nbsp<button class="btn btn-success waves-effect waves-light btn-sm" onclick="getform_anggota()" type="button"><i class="fa fa-plus"></i> Tambah</button>';
													var upl='&nbsp<button id="csv" class="btn btn-info waves-effect waves-light btn-sm" onclick="getcsv()"; type="button"><i class="fa fa-upload"></i> Upload XLS</button>';
													var csvanggota='&nbsp<button class="btn btn-primary waves-effect waves-light btn-sm" onclick="window.location.href=\'\../assets/form_anggota.xls\'" type="button"><i class="fa fa-file-excel-o"></i> Template XLS</button>';
													var dl='&nbsp<button class="btn bg-navy waves-effect waves-light btn-sm" onclick="dlcsv()" type="button"><i class="fa fa-download"></i> Download list</button>';
													$("#example_length").append(<?php echo ($this->session->userdata('kode_uker')=='kanpus' ? '' : "tambah+upl+csvanggota+") ?>dl);
											});</script>
								<div class="col-sm-12">
									<table id="example" class="table table-striped table-bordered" style="width:100%">
											<thead>
												<tr>
													<th>No</th>
													<th>Nama Anggota</th>
													<th>NIK</th>
													<th>Jenis Kelamin</th>
													<th>Kode Pos</th>
													<th>Pinjaman</th>
													<th>Simpanan/Tabungan</th>
													<th>Handphone</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
											</tbody>
										</table>
								</div>
							</div>
					</div>
				</div>
            </div>
        </div>
    </section>
</div>
		<style>
			.modal-body{
					max-height: calc(100vh - 200px);
					overflow-y: auto;
			}
		
		</style>		

	<div class="modal" id="modal" tabindex="-1" role="dialog"  aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" onclick="$('#modal').hide();" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h5 class="modal-title">Form Anggota </h5>
					</div>
					<div class="modal-body">
							<div id="mod-content">
								<div class="row">
									<label for="thedata" class="col-sm-12 control-label drequired"> Nama Anggota</label>
									<div class="col-sm-12">
										<input type="hidden"  id="id_ca" value="">
										<input type="text" class="form-control required"  id="ca_nama" value="" placeholder="required" required>
									</div>
									
									<label for="thedata" class="col-sm-12 control-label drequired"> NIK</label>
									<div class="col-sm-12">
										<input type="number" class="form-control required"  id="ca_nik" value="" placeholder="required" required>
									</div>
									
									<label for="thedata" class="col-sm-12 control-label drequired">Jenis Kelamin</label>
									<div class="col-sm-12">
										<select class="form-control required"  id="ca_jk">
												<option value="pria">Pria</option>
												<option value="wanita">Wanita</option>
											</select>
									</div>
									
									<label for="thedata" class="col-sm-3 control-label drequired">Kode pos Anggota</label><label id="kodeposview" class="col-sm-9 control-label"></label>
									<div class="col-sm-12">
										<input type="text" class="form-control required"  onchange="cekkpos(this.value);" id="ca_kodepos" value="" placeholder="required" required>
									</div>
									
									<label for="thedata" class="col-sm-12 control-label drequired"> Sudah Memiliki Pinjaman? </label>
									<div class="col-sm-12">
										<select class="form-control required"  id="ca_pinjaman">
											<option value="bri">BRI</option>
											<option value="bank lain">Bank Lain</option>
											<option value="belum ada">Belum Ada</option>
										</select>
									</div>
									
									<label for="thedata" class="col-sm-12 control-label drequired">Sudah Punya Simpanan/Tabungan di Bank ?</label>
									<div class="col-sm-12">
										<select class="form-control required"  id="ca_simpanan">
											<option value="bri">BRI</option>
											<option value="bank lain">Bank Lain</option>
											<option value="belum ada">Belum Ada</option>
										</select>
									</div>
									
									<label for="thedata" class="col-sm-12 control-label drequired">Handphone Anggota </label>
									<div class="col-sm-12">
										<input type="number" class="form-control required" onchange="cekhp(this);" id="ca_handphone" value="" placeholder="required" required>
									</div>
									
									</br>
									<label for="thedata" class="col-sm-12 control-label">Dengan ini saya menyatakan bahwa data ini benar adanya sesuai kenyataan di lapangan <input type="checkbox" class="form-check-input form-control-lg"  id="checkvalidkunjungan" required> </label>
									</br>
									<label for="thedata" class="col-sm-12 control-label">Data ini memiliki potensi yang baik untuk meningkatkan bisnis BRI melalui pendekatan komunitas <input type="checkbox" class="form-check-input form-control-lg"  id="checkvalidpotensi" required> </label>
									</br>
									
								</div>
							</div>
					</div>
					<div class="modal-footer">
						<button class="btn btn-primary waves-effect waves-light" onclick="$('#modal').hide();">Batal</button>
						<button class="btn btn-success waves-effect waves-light"  id="sbt"  onclick="inputform_anggota();">Kirim</button>
					</div>
				</div>
			</div>
		</div>
		
		<div class="modal" id="modalcsv" tabindex="-1" style="overflow-y: auto;" role="dialog"  aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" onclick="$('#modalcsv').hide();" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h5 class="modal-title">Data CSV yang gagal diinput</h5>
					</div>
					<div class="modal-body">
							<div id="mod-content">
								<div class="row">
									<div class="col-sm-12">
										<input class="formedit" type="file"  id="ccsv" onchange="readcsv(this);" value="" style="display:none;"> 
										<div id="outcsv">
										</div>
									</div>
								</div>
							</div>
					</div>
				</div>
			</div>	
		</div>	
		<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.8.0/jszip.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.8.0/xlsx.js"></script>
		<script>
		
					var valkdpos;
					var fileinput = document.getElementById("ccsv");
					var datacsvupload;
					var dataparser;
					var simpin=["bri","bank lain", "belum ada"];
					
					function readcsv(evt){
						if (confirm('Apakah Data Excel sudah sesuai format?')){
							var letters = /^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$/;
							var numbers = /^[0-9]+$/;
							var df=[];
							datacsvupload=[];
							dataparser=[];
							var leterror='<table id="exit" style="font-size:13px;" class="table-striped table-bordered" ><thead><tr><th>No</th><th>Nama Anggota</th><th>NIK</th><th>Jenis Kelamin</th><th>Kode Pos</th><th>Pinjaman </br> (bri/bank lain/belum ada)</th><th>Simpanan/Tabungan</br> (bri/bank lain/belum ada)</th><th>Handphone</th><th>Error</th></tr></thead>';
							var file = evt.files;
							var reader = new FileReader();
							reader.onload = function(e) {
								 var data = e.target.result;
								 var workbook = XLSX.read(data, {
									type: 'binary'
								 });
					
								 workbook.SheetNames.forEach(function(sheetName) {
									// Here is your object
									var XL_row_object = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheetName]);
									var dataparser = XL_row_object;
									for (var i=0;i<dataparser['length'];i++){
										var z=0;
										var zerror="";
									
										if (Object.keys(dataparser[i]).length>1){
											var x=0;
											Object.entries(dataparser[i]).forEach( function([key, value]) {
												switch (x) {
													case (0) : 
														if (!value.match(letters))  			{zerror +="- Format Nama salah </br> "; z++;}
														break;
													case (1)  :
														value=value.replace("'","");
														if (cnik(value,true)==false) 		{zerror +="- Format nik salah  </br>"; z++;}	
														break;
													case (2)  :
														value=cekjk(value.toLowerCase());
														if (value=="")	{zerror +="- Format jenis kelamin salah </br>";z++;}
														break;
													case (3)  :
														value=value.replace("'","");
														if (cekkpos(value, true)==false) 		{zerror +="- Format kodepos salah  </br>"; z++;}	
														break;
													case (4)  :
														value=value.toLowerCase();
														if (simpin.includes(value)==false)		{zerror +="- Format pinjaman Salah </br>";z++;}
														break;
													case (5)  :
														value=value.toLowerCase();
														if (simpin.includes(value)==false)		{zerror +="- Format Simpanan Salah </br>";z++;}
														break;
													case (6)  :
														value=value.replace("'","");
														if (cekhp(value,true)==false) 			{zerror +="- Format handphone salah </br>";z++;}
														break;
												}
												
												x++;
											}) ;
											
											if (z==0) datacsvupload[datacsvupload.length]=dataparser[i];
											
											else {
													leterror +='<tr><td>'+(i+1)+'</td>';
													Object.entries(dataparser[i]).forEach( function([key, value]) {
															leterror +='<td>'+value+'</td>';
														});
													leterror +='<td>'+zerror+'</td></tr>';	
												} 
											}
									
										
									}
									if (leterror !=""){ document.getElementById("outcsv").innerHTML = leterror+'<tbody></table>';$('#modalcsv').show();}
									console.log(df);
									if (datacsvupload.length>0) {
										$("#csv").attr("disabled", "disabled");
										var data1 = { 
														'id_cluster' : id_cluster,
														'anggota'  :   JSON.stringify(datacsvupload),
													};
										console.log(data1);
										$.ajax({ 
												   type:"POST",
												   url: "<?php echo base_url();?>cluster/inputanggotacsv",
												   data: data1,
												   success:function(nmsg){
														$("#csv").removeAttr("disabled");
														$('#example').DataTable().ajax.reload(null, false);
													}
										});
									}
								 });
								
							};		
							reader.readAsBinaryString(evt.files[0]);
						}
					}
					
					function valkp(i){
						var number=/^[0-9]+$/;
						if (!i.match(number))return false;
						else if (i.length!=5) return false;
						else return true;
					}
					function cekjk(i=""){
						let pria = ['pria','laki-laki','lelaki','cowok'];
						let wanita = ['wanita','perempuan','gadis','cewek'];
						
						if (pria.includes(i)) i='pria';
						if (wanita.includes(i)) i='wanita';
						return i;
					}
					
					function getcsv() {
							fileinput.click();
					}
					var valhp=true;
					
					function ConvertToCSV(objArray) {
						var array = typeof objArray != 'object' ? JSON.parse(objArray) : objArray;
						var str = '';

						for (var i = 0; i < array.length; i++) {
							var line = '';
							for (var index in array[i]) {
								if (line != '') line += ','

								line += array[i][index];
							}

							str += line + '\r\n';
						}

						return str;
					}
					
					function dlcsv(i){
						var data1={ 
										'id_cluster' :  id_cluster,
									};
						$.ajax({ 
									   type:"POST",
									   url: "<?php echo base_url();?>cluster/dldataanggota",
									   data: data1,
									   success:function(msg){
											var jsonObject = msg;
											var csv=ConvertToCSV(jsonObject),
											a=document.createElement('a');
											a.textContent='download';
											a.download='anggota '+document.getElementById('nk').innerHTML+'.csv';
											a.href='data:text/csv;charset=utf-8,'+escape(csv);
											a.click();
										}
								});
					}

				
					function getform_anggota(i=null){
							document.getElementById("checkvalidpotensi").checked = false;
							document.getElementById("checkvalidkunjungan").checked = false;
							document.getElementById("kodeposview").innerHTML="";
							if (i!=null){
								var data1 = { 
											'id_ca' :  i,
										};
								$.ajax({ 
										   type:"POST",
										   url: "<?php echo base_url();?>cluster/getdata_anggota_s",
										   data: data1,
										   success:function(nmsg){
												var msg=JSON.parse(nmsg);
												document.getElementById('id_ca').value=msg[0].id_ca;
												document.getElementById('ca_nama').value=msg[0].ca_nama;
												document.getElementById('ca_nik').value=msg[0].ca_nik;
												document.getElementById('ca_jk').value=msg[0].ca_jk;
												document.getElementById('ca_kodepos').value=msg[0].ca_kodepos;
												cekkpos(msg[0].ca_kodepos);
												document.getElementById('ca_pinjaman').value=msg[0].ca_pinjaman;
												document.getElementById('ca_simpanan').value=msg[0].ca_simpanan;
												document.getElementById('ca_handphone').value=msg[0].ca_handphone;
												$('#modal').show();
											}
									});
							}
							else {
								var dd = $('.form-control');
								for (var j=0;j<dd.length;j++){
									dd[j].value = "";
									$('#modal').show();
								}
							}
					}
					
					
				
					
					function inputform_anggota(){
						console.log("1")
						var data1 = { 
								'id_ca' 					:  $('#id_ca').val(),
								'id_cluster' 			:  id_cluster,
								'ca_nama' 			:  $('#ca_nama').val(),
								'ca_nik' 				:  $('#ca_nik').val(),
								'ca_jk' 					:  $('#ca_jk').val(),
								'ca_kodepos' 		:  $('#ca_kodepos').val(),
								'ca_pinjaman' 		:  $('#ca_pinjaman').val(),
								'ca_simpanan' 		:  $('#ca_simpanan').val(),
								'ca_handphone' 		:  $('#ca_handphone').val(),
						}
						
						if (document.getElementById("checkvalidkunjungan").checked == true && document.getElementById("checkvalidpotensi").checked == true){
							console.log("1")
							var msg="";
							msg=reval();
								
							if (msg=="") {
								console.log("2")
								$("#sbt").attr("disabled", "disabled");
								$.ajax({ 
										   type:"POST",
										   url: "<?php echo base_url();?>cluster/inputdata_anggota",
										   data: data1,
										   success:function(msg){
											  alert('data berhasil diinput');
											  $("#sbt").removeAttr("disabled");
											  $('#modal').hide();
											  $('#example').DataTable().ajax.reload(null, false);
											}
								});
							}
							else alert(msg);
						}
						else alert ("Harap isi checkbox pertanyaan diatas!!")
					}
					function reval(){
						var msg="";
						msg+=(validatorreqtext(document.getElementById('ca_nama'),iname)==false ? "data Nama tidak valid \n" : ""  );
						msg+=(cnik(document.getElementById('ca_nik').value, true)==false ? "data NIK tidak valid \n" : ""  );
						msg+=(document.getElementById('ca_jk').value=="" ? "data jenis kelamin tidak boleh kosong \n" : ""  );
						msg+=(cekkpos(document.getElementById('ca_kodepos').value)==false ? "data kodepost tidak boleh kosong \n" : ""  );
						msg+=(document.getElementById('ca_pinjaman').value=="" ? "data pinjaman tidak boleh kosong \n" : ""  );
						msg+=(document.getElementById('ca_simpanan').value=="" ? "data simpanan tidak boleh kosong \n" : ""  );
						msg+=(cekhp(document.getElementById('ca_handphone').value, true)==false ? "data Handphone tidak valid \n" : ""  );
						return msg;
					}
					
					var iname = "!@#$%^&*(_)+=-[]\\\';,/{}|0123456789\":<>?";
					var ischar = "!@#$%^&*()+=[]\\\';/{}|\":<>?";
					
					
					///z for value, y for select iname char, x if call from input then alert from id, w if optional
					function validatorreqtext(z, y, x=null){
						if (z.value.length!=0){
							var dfalse=0;
							for (var i=0;i<(z.value.length);i++) {
								if (y.indexOf(z.value.charAt(i)) != -1) dfalse++;
							}
							if (dfalse==0) return true;
							else {
									if (x!=null) alert ("Data "+x+" Tidak Valid (mengandung karakter yang tidak diperbolehkan)");
									return false;
							}
						}
						else {
							if (x!=null) alert ("Data "+x+" tidak boleh kosong");
							return false;
						}
					}
					
					function validatorreqnumber(i,j=null,k=null){
						if (i.value.length!=0){
							var number=/^[0-9]+$/;
							var res = i.value.substring(0, 2);
							
							if (!i.value.match(number)){
								if (j!=null) alert ("data "+j+" tidak valid");
								return false;
							}
							else if (i.value.length==0){
								if (j!=null) alert ("data "+j+" tidak valid");
								return false;
							}
							else return true;
						}
						else {
								if (j!=null) alert ("data "+j+" tidak boleh kosong");
								return false;
						}
					}
		
					
					function cekkpos(i,j){
						var data1 = { 
							'kodepos' :  i
							};
							$.ajax({ 
									   type:"POST",
									   url: "<?php echo base_url();?>cluster/cekkpos",
									   data: data1,
									   success:function(smsg){
											var msg=JSON.parse(smsg);
											if (j==null) document.getElementById("kodeposview").innerHTML=(msg=="false" ? "kode tidak ditemukan" : msg['kelurahan']+', '+msg['kecamatan']+', '+msg['kabupaten']+', '+msg['provinsi']);
											if (msg==false) return false;
											else return true;
										}
								});
					}
					
					function deldata_anggota(i){
						if (confirm('Apakah anda yakin akan menghapus anggota ini?')){
							var data1={ 
										'id_ca' :  i,
									};
							$.ajax({ 
									   type:"POST",
									   url: "<?php echo base_url();?>cluster/deldata_anggota",
									   data: data1,
									   success:function(msg){
										  alert('data berhasil dihapus');
										  $('#example').DataTable().ajax.reload(null, false);
										}
								});
						}
					}
					
						
				function cnik(i=null,j=null){
					var validator=["000000","1111111","222222","333333","444444","555555","666666","777777","888888","999999"];
					// return true;
					if (i!=null){
						if (i.toString().length==16){
							if (validator.includes(i.toString)==false){
								valnik=true;
								return true;
							}
							else {
								valnik=false;
								if (j==null){
									alert ('Data NIK tidak valid');
								}
								return false;
							}
						}
						else {
							valnik=false;
							if (j==null){
								alert ('NIK harus 16 digit');
							}
							return false;
						}
					}
					else return false;
				}
				
				function cekhp(i,j=null){
					if (j==null) i=i.value;
					var number=/^[0-9]+$/;
					var res = i.substring(0, 2);
					var resa = i.substring(0, 1);
					if (i==null || i==""){
						valhp=false;
						if (j==null) alert ('nomer handphone tidak boleh kosong')
						return false;
					}
					else if (!i.match(number)){
						valhp=false;
						if (j==null) alert ("nomer handphone harus angka");
						return false;
						
					}
					else if (i.length<8){
						if (j==null)  alert ("nomor handphone tidak valid");
						valhp=false;
						return false;
					}
					else if (resa!="8" && res!="08"){
						if (j==null) alert ("Harus diawali 08");
						valhp=false;
						return false;
					}
					else {valhp=true;return true;}
				}
					
		
			
			</script>
          <!-- Modal -->