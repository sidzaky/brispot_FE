var table = $('#table-cluster').DataTable({
					"searching":false,
					"scrollX": true,
					"scrollY": true,
					"processing": true,
					"serverSide": true,
					"ajax": {
						"url": "./cluster/getdata",
						"type": "POST",
						"data":  {
							"custom_field"  : function() { return getdatacustom()},
							},
						}
					});
		
				var count=1;

				function add_field(){
        			var select = `<div class="form-group" id="lf`+ count +`">
                                        <label class="control-label">Field `+ count +`</label>
                                            <button class="btn btn-danger waves-effect waves-light" onclick="minformfilter(` + count + `);"><i class="fa fa-close"></i></button> 
                                            <select class="form-control" id="sf` + count + `" onchange="set_customsearch(this, '`+ count +`');">
                                                <option value=""> -- Pilih Filter Pencarian --</option>
                                                <option value="kelompok_usaha">Nama Klaster</option>
                                                <option value="sektor">sektor usaha</option>
                                                <option value="kategori">kategori usaha</option>
                                                <option value="jenis">jenis usaha</option>
                                                <option value="hasil_produk">Bentuk / Hasil Produk</option>
                                                <option value="varian"> Varian Produk </option>
                                                <option value="kebutuhan_pendidikan_pelatihan">kebutuhan pendidikan / pelatihan </option>
                                                <option value="kebutuhan_sarana">Kebutuhan Sarana Penunjang</option>
                                                <option value="kebutuhan_skema_kredit"> Kebutuhan Skema Kredit</option>
                                               
                                            </select>
                                        <div id="rf`+ count +`"></div>`;
        			$("#field_custom_search").append('<div id="cm'+ count +'" class="col-sm-4">' + select + '</div>');
        			count++;
    			}

				function getdatacustom(){
					var customfield = [];    
					for (var i=0; i<=count;i++){
						customfield.push({ 
								'sf' :    $('#sf'+i).val(),
								'df' :    $('#df'+i).val()
							});
					}  
					customfield.push({
							'sf' : "kode_kanwil",
							'df' : $("#kode_kanwil").val(),
					});
					customfield.push({
						'sf' : "kode_kanca",
						'df' : $("#kode_kanca").val(),
					})
					customfield.push({
							'sf' : "kode_uker",
							'df' : $("#fkode_uker").val(),
					});

					return JSON.stringify(customfield);
				}

				function minformfilter(i) {
							$('#cm' + i).remove();
				}

				function set_kanca(i){
					var data1 = {
						'kode_kanwil': i.value
					};
					var address = "./cluster/get_kanca";
					var get = sendajaxreturn(data1, address, 'json');
					var select = '<label class="control-label">Kanca</label><select class="form-control" onchange="set_unit(this);" id="kode_kanca"><option value="">semua</option>';
					get.forEach(function(e) {
						select += "<option value='" + e.BRANCH + "'>" + e.BRDESC + "</option>";
					})
					document.getElementById("selkanca").innerHTML = '' + select + '</select>';
				}

				function set_unit(i){
					var data1 = {
						'kode_kanca': i.value
					};
					var address = "./cluster/get_unit";
					var get = sendajaxreturn(data1, address, 'json');
					var select = '<label class="control-label">Unit</label><select class="form-control" id="fkode_uker"><option value="">semua</option>';
					get.forEach(function(e) {
						select += "<option value='" + e.BRANCH + "'>" + e.BRDESC + "</option>";
					})
					document.getElementById("selunit").innerHTML = '' + select + '</select>';
				}


				function set_customsearch(i,j){
					var text="";
					switch (i.value){
						case "sektor" :
							text='<select class="form-control" id="df' + j + '"><option value="1">Produksi</option> <option value="2">Non Prdoduksi</option> </select>';
						break; 
						case "kategori" :
							var address = "./cluster/fjum";
							var msg = sendajaxreturn("", address, 'json');
							text='<select class="form-control" id="df' + j + '">';
							msg.forEach(function(e) {
								text += '<option value="' + e.id_cluster_jenis_usaha_map +'">' + e.nama_cluster_jenis_usaha_map + '</option>';
							});
						break;
						case "jenis" :
							var address = "./cluster/fju";
							var msg = sendajaxreturn("", address, 'json');
							text='<select class="form-control" id="df' + j + '">';
							msg.forEach(function(e) {
								text += '<option value="' + e.id_cluster_jenis_usaha +'">' + e.nama_cluster_jenis_usaha + '</option>';
							});
						break;
						case "kebutuhan_pendidikan" :
							var address = "./cluster/get_pendidikan";
							var msg = sendajaxreturn("", address, 'json');
							text='<select class="form-control" id="df' + j + '">';
							msg.forEach(function(e) {
								text += '<option value="' + e.id_cluster_kebutuhan_pendidikan_pelatihan +'">' + e.kebutuhan_pendidikan_pelatihan + '</option>';
							});
						break;
						case "kebutuhan_sarana" :
							var address = "./cluster/get_sarana";
							var msg = sendajaxreturn("", address, 'json');
							text='<select class="form-control" id="df' + j + '">';
							msg.forEach(function(e) {
								text += '<option value="' + e.id_cluster_kebutuhan_sarana +'">' + e.kebutuhan_sarana + '</option>';
							});
						break;
						case "kebutuhan_skema_kredit" :
							var address = "./cluster/get_kredit";
							var msg = sendajaxreturn("", address, 'json');
							text='<select class="form-control" id="df' + j + '">';
							msg.forEach(function(e) {
								text += '<option value="' + e.id_cluster_kebutuhan_skema_kredit +'">' + e.kebutuhan_skema_kredit + '</option>';
							});
						break;
						default:
							text='<input type="text" class="form-control" id="df' + j + '" value="">';
							
						break;
					}
					document.getElementById("rf"+j).innerHTML=text;
				}