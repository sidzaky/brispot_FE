<h3 class="box-title" align="center">List Jenis Usaha</h3>
   <button class="btn btn-success waves-effect waves-light btn-sm" onclick="showform()" type="button"><i class="fa fa-plus"></i> Tambah List</button>
   <button class="btn btn-primary waves-effect waves-light btn-sm" style="float:right;" onclick="getform('setting_content')" type="button"><i class="fa fa-Left"></i> Kembali</button>

    <table class="table table-striped table-bordered"  id="table_form" width="100%">
        <thead>
            <tr>
                <th width="10%">No</th>
                <th>Sektor Usaha</th>
                <th>Kategori Usaha</th>
                <th>Jenis Usaha</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
          <?php 
            $i=1;
            foreach ($jenis_usaha as $row){
                echo '<tr>';
                echo '<td>'. $i++ .'</td>';
                echo '<td>'. $row['keterangan_cluster_sektor_usaha'] .'</td>'; 
                echo '<td>'. $row['nama_cluster_jenis_usaha_map'] .'</td>'; 
                echo '<td>'. $row['nama_cluster_jenis_usaha'] .'</td>'; 
                echo '<td><button class="btn btn-danger waves-effect waves-light btn-sm" style="float:right;" onclick="dellist(\''. $row['id_cluster_jenis_usaha'] .'\')" type="button"><i class="fa fa-close"></i> Hapus</button><button class="btn btn-warning waves-effect waves-light btn-sm" style="float:right;" onclick="showform(\''. $row['id_cluster_jenis_usaha'] .'\', \''. $row['id_cluster_jenis_usaha_map'] .'\' , \''. $row['id_cluster_sektor_usaha'] .'\', \''. $row['nama_cluster_jenis_usaha'] .'\')" type="button"><i class="fa fa-pencil"></i> Ubah</button></td>';
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
                                    <h3 align="center">Form Jenis Usaha</h3>
                                </label>
                            </div>

                            <div class="form-group" style="width: 0">
                                <input type="hidden" class="form-control dform" id="idju" placeholder="required" value="">
                            </div>

                            <div class="form-group required">
							<label class="control-label">Sektor Usaha</label>
							    <select class="form-control dform required" id="idsu" onchange="setjum(this.value);" required>
                                    <?php 
                                        foreach ($sektor_usaha as $row){
                                            echo '<option value="'. $row['id_cluster_sektor_usaha'] .'"> '. $row['keterangan_cluster_sektor_usaha'] .'</option>';
                                        }
                                    ?>
							    </select>
						    </div>

                            <div class="form-group required">
							<label class="control-label">Kategori Usaha</label>
							    <select class="form-control dform required" id="idjum" required>
                                    <?php 
                                        foreach ($jenis_usaha_map as $row){
                                            echo '<option set="'.$row['id_cluster_sektor_usaha'].'" value="'. $row['id_cluster_jenis_usaha_map'] .'"> '. $row['nama_cluster_jenis_usaha_map'] .'</option>';
                                        }
                                    ?>
							    </select>
						    </div>

                            <div class="form-group required">
                                <label class="control-label">Jenis Usaha</label>
                                <input type="text" pattern="[a-zA-Z]" class="form-control dform required" id="isju" value="" placeholder="required" required>
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
            document.getElementById("idju").value="";
            if (i==""){
                $(".dform").value="";
            }
            else {
                setjum(k);
                document.getElementById("idju").value=i;
                document.getElementById("idjum").value=j;
                document.getElementById("idsu").value=k;
                document.getElementById("isju").value=l;
                
            }
            $("#modal").show();
        }

        function sendform(){
            var data={
                idju : $('#idju').val(),
                idjum : $('#idjum').val(),
                idsu : $('#idsu').val(),
                isju : $('#isju').val(),
            }
            var notif   = "Update Kategori Usaha Berhasil "
            var address = "./setting/up_jenis_usaha";
            var element = "setting_content";
            sendajax(data, address, element, notif, null);
            $("#modal").hide();
        }

        function dellist(i){
            if (confirm("apakah anda Yakin Menghapus Data ini?")){
                var data={
                    idju : i,
                }
                var notif   = "Hapus kategori Usaha Berhasil "
                var address = "./setting/dis_jenis_usaha";
                var element = "setting_content";
                sendajax(data, address, element, notif, null);
                $("#modal").hide();
            }
        }

        function setjum(idset){
            var d=document.getElementById('idjum');
            d.value="";
            for (var i=0; i<d.length; i++){
                if (d[i].attributes.set.value == idset){
                    d[i].style.display="";
                }
                else d[i].style.display="none";
            }
        }

        </script>