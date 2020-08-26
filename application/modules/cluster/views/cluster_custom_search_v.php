<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Pencarian Kluster
		</h1>
	</section>
 
	<!-- Main content -->
	<section class="content">
		<div class="box box-solid">
			<div id="result" class="box-body">
                    <script>
                        $(document).ready(function() {
                            $('#table-cluster').DataTable({
                                "searching":false,
                                "scrollX": true,
                                "processing": true,
                                "serverSide": true,
                                "deferRender": true,
                                "ajax": {
                                    "url": "./cluster/getdatacustom",
                                    "type": "POST",
                                    "data":  {
                                        "s1"   : "",
                                        "f1"   : "",
                                        "s2"   : "",
                                        "f2"   : "",
                                        "s3"   : "",
                                        "f3"   : "",
                                    }
                                },
                            });
                        });
                    </script>
                    <div class="col-sm-10">
                        <div class="table-responsive">
                            <table id="table-cluster" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kantor Wilayah</th>
                                        <th>Nama Kanca</th>
                                        <th>Nama Uker</th>
                                        <th>Nama Kelompok Usaha</th>
                                        <th>Jml / Input Anggota </th>
                                        <th>Jenis Usaha</th>
                                        <th>Bentuk Produk/Jasa</th>
                                        <th>Status Pengajuan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <h4>Field Pencarian</h4>
                        <div class="form-group">
                            <label class="control-label">Kanwil</label>
                           
                            <select class="form-control" onchange="set_kanca(this);" id="kode_kanwil">
                                <option value="all">semua</option>
                                <?php foreach ($kanwil as $row){
                                    echo '<option value="'.$row['kode_kanwil'].'">'.$row['kanwil'].'</option>';
                                }?>
							</select>
                        </div>
                        <div class="form-group" id="selkanca">
							<label class="control-label">Kanca</label>
							<select class="form-control" onchange="set_unit(this);" id="kode_kanca">
							</select>
                        </div>
                        <div class="form-group" id="selunit">
							<label class="control-label">unit</label>
							<select class="form-control" id="kode_uker">
							</select>
                        </div>
                        <div id="field_custom_search"></div>
                       
                        <button class="btn btn-info waves-effect waves-light" onclick="add_field();">Tambah Field</button>
                        <button class="btn btn-success waves-effect waves-light" id="sbt" onclick="alert('zz')">Cari</button>
                    </div>
			</div>
		</div>
	</section>
</div>
<!-- Modal -->
<style>
	.modal-body {
		max-height: calc(100vh - 200px);
		overflow-y: auto;
	}

	.btn-file {
		position: relative;
		overflow: hidden;
	}

	.btn-file input[type=file] {
		position: absolute;
		top: 0;
		right: 0;
		min-width: 100%;
		min-height: 100%;
		font-size: 100px;
		text-align: right;
		filter: alpha(opacity=0);
		opacity: 0;
		outline: none;
		background: white;
		cursor: inherit;
		display: block;
	}

	.img-upload {
		width: 100%;
	}
</style>

<script src="../assets/js/send.js"></script>
<script>

    var count=1;
    function add_field(){

        var select = '<div class="form-group" id="lf'+ count +'"><label class="control-label">Field '+ count +'</label><button class="btn btn-danger waves-effect waves-light" onclick="minform(\'' + count + '\');"><i class="fa fa-close"></i></button> <select class="form-control" onchange="set_customsearch(this, \''+ count +'\');"><option value="sektor">sektor usaha</option><option value="kategori">kategori usaha</option><option value="jenis">jenis usaha</option><option value="pendidikan">kebutuhan pendidikan / pelatihan </option><option value="sarana">Kebutuhan Sarana Penunjang</option><option value="kredit"> Kebutuhan Skema Kredit</option><option value="hasil_product">Hasil Produk</option></select><div id="rf'+ count +'"></div>';
        $("#field_custom_search").append(select);
        count++;
    }

    function minform(id) {
				$('#lf' + id).remove();
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
		var select = '<label class="control-label">Unit</label><select class="form-control" id="kode_uker"><option value="">semua</option>';
		get.forEach(function(e) {
			select += "<option value='" + e.BRANCH + "'>" + e.BRDESC + "</option>";
		})
		document.getElementById("selunit").innerHTML = '' + select + '</select>';
    }


    function set_customsearch(i,j){
        var text="";
        switch (i.value){
            case "sektor" :
                text='<select class="form-control" id="df' + j + '"><option value="1">Prdoduksi</option> <option value="2">Non Prdoduksi</option> </select>';
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
            case "pendidikan" :
                var address = "./cluster/get_pendidikan";
                var msg = sendajaxreturn("", address, 'json');
                text='<select class="form-control" id="df' + j + '">';
                msg.forEach(function(e) {
                    text += '<option value="' + e.id_cluster_kebutuhan_pendidikan_pelatihan +'">' + e.kebutuhan_pendidikan_pelatihan + '</option>';
                });
            break;
            case "sarana" :
                var address = "./cluster/get_sarana";
                var msg = sendajaxreturn("", address, 'json');
                text='<select class="form-control" id="df' + j + '">';
                msg.forEach(function(e) {
                    text += '<option value="' + e.id_cluster_kebutuhan_sarana +'">' + e.kebutuhan_sarana + '</option>';
                });
            break;
            case "kredit" :
                var address = "./cluster/get_kredit";
                var msg = sendajaxreturn("", address, 'json');
                text='<select class="form-control" id="df' + j + '">';
                msg.forEach(function(e) {
                    text += '<option value="' + e.id_cluster_kebutuhan_skema_kredit +'">' + e.kebutuhan_skema_kredit + '</option>';
                });
            break;
            default:
                text='<input type="text" class="form-control dform" id="df' + j + '" value="">';
                
            break;
        }
        document.getElementById("rf"+j).innerHTML=text;
    }

</script>



