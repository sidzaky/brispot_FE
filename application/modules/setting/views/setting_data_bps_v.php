<h3 class="box-title" align="center">List Data BPS </h3>
   <button class="btn btn-success waves-effect waves-light btn-sm" onclick="showform()" type="button"><i class="fa fa-plus"></i> Tambah List</button>
   <button class="btn btn-primary waves-effect waves-light btn-sm" style="float:right;" onclick="getform('setting_content')" type="button"><i class="fa fa-Left"></i> Kembali</button>

    <table class="table table-striped table-bordered" id="table_form" width="100%">
        <thead>
            <tr>
                <th width="10%">No</th>
                <th>Provinsi</th>
                <th>Jenis Usaha</th>
                <th>Data BPS</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
          <?php 
            $i=1;
            foreach ($data_bps as $row){
                echo '<tr>';
                echo '<td>'. $i++ .'</td>';
                echo '<td>'. $row['nama'] .'</td>';
                echo '<td>'. $row['nama_cluster_jenis_usaha'] .'</td>';
                echo '<td>'. number_format(floatval($row['value'])) .'</td>';
                echo '<td><button class="btn btn-danger waves-effect waves-light btn-sm" style="float:right;" onclick="dellist(\''. $row['id_cluster_bps_provinsi'] .'\')" type="button"><i class="fa fa-close"></i> Hapus</button><button class="btn btn-warning waves-effect waves-light btn-sm" style="float:right;" onclick="showform(\''. $row['id_cluster_bps_provinsi'] .'\',\''. $row['id_provinsi'] .'\', \''. $row['id_cluster_jenis_usaha'] .'\', \''.$row['value'].'\')" type="button"><i class="fa fa-plus"></i> edit</button></td>';
            }
          ?>
        </tbody>
    </table>

    <div class="modal " id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" onclick="$('#modal').hide();" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h5 class="modal-title">Form Module<?php echo $this->session->userdata('nama_uker') ?></h5>
                </div>
                <div class="modal-body">
                    <div id="mod-content">
                        <form>
                            <div class="col-sm-12">
                                <label for="thedata" class="col-sm-12 control-label">
                                    <h3 align="center">Form Kategori Usaha</h3>
                                </label>
                            </div>
                            <div class="form-group" style="width: 0">
                                <input type="hidden" class="form-control dform" id="id" placeholder="required" value="">
                            </div>
                            <div class="form-group required">
							<label class="control-label">Provinsi</label>
							    <select class="form-control dform required" id="id_provinsi" required>
                                    <option> Pilih Provinsi </option>
                                    <?php 
                                        foreach ($provinsi as $row){
                                            echo '<option value="'. $row['id'] .'"> '. $row['nama'] .'</option>';
                                        }
                                    ?>
							    </select>
						    </div>

                            <div class="form-group required">
							<label class="control-label">Jenis Usaha</label>
							    <select class="form-control dform required" id="idju" required>
                                    <option> Pilih Kategori </option>
                                    <?php 
                                        foreach ($ju as $row){
                                            echo '<option value="'. $row['id_cluster_jenis_usaha'] .'"> '. $row['nama_cluster_jenis_usaha'] .'</option>';
                                        }
                                    ?>
							    </select>
						    </div>

                            <div class="form-group required">
                                <label class="control-label">Data BPS</label>
                                <input type="number"  class="form-control dform required" id="value" value="" placeholder="required" required>
                            </div>

                            </br>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                        <button class="btn btn-primary waves-effect waves-light" onclick="$('#modal').hide();">Batal</button>
                        <button class="btn btn-success waves-effect waves-light" id="sbt" onclick="sendform();">Kirim</button>
                </div>
         </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {$('#table_form').DataTable();});
        
        function showform(i=null,j=null, k=null, l=null){
            document.getElementById("id").value="";
            if (i==""){
                $(".dform").value="";
            }
            else {
                document.getElementById("id").value=i;
                document.getElementById("id_provinsi").value=j;
                document.getElementById("idju").value=k;
                document.getElementById("value").value=l;
            }
            $("#modal").show();
        }

        function sendform(){
            var data={
                id : $('#id').val(),
                id_provinsi : $('#id_provinsi').val(),
                idju : $('#idju').val(),
                value : $('#value').val(),
            }
            var notif   = "Update Data BPS Berhasil "
            var address = "./setting/up_data_bps";
            var element = "setting_content";
            sendajax(data, address, element, notif, null);
            $("#modal").hide();
        }

        function dellist(i){
            if (confirm("apakah anda Yakin Menghapus Data ini?")){
                var data={
                    id : i,
                }
                var notif   = "Hapus Data BPS Berhasil "
                var address = "./setting/dis_data_bps";
                var element = "setting_content";
                sendajax(data, address, element, notif, null);
                $("#modal").hide();
            }
        }


    </script>