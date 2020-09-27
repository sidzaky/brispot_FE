   <h3 class="box-title" align="center">List Sektor Usaha</h3>
   <button class="btn btn-success waves-effect waves-light btn-sm" onclick="showform()" type="button"><i class="fa fa-plus"></i> Tambah List</button>
   <button class="btn btn-primary waves-effect waves-light btn-sm" style="float:right;" onclick="getform('setting_content')" type="button"><i class="fa fa-Left"></i> Kembali</button>

    <table class="table table-striped table-bordered" id="table_form" width="100%">
        <thead>
            <tr>
                <th width="10%">No</th>
                <th>Sektor Usaha</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
          <?php 
            $i=1;
            foreach ($sektor_usaha as $row){
                echo '<tr>';
                echo '<td>'. $i++ .'</td>';
                echo '<td>'. $row['keterangan_cluster_sektor_usaha'] .'</td>'; 
                echo '<td><button class="btn btn-danger waves-effect waves-light btn-sm" style="float:right;" onclick="dellist(\''. $row['id_cluster_sektor_usaha'] .'\')" type="button"><i class="fa fa-close"></i> Hapus</button> <button class="btn btn-warning waves-effect waves-light btn-sm" style="float:right;" onclick="showform(\''. $row['id_cluster_sektor_usaha'] .'\',\''. $row['keterangan_cluster_sektor_usaha'] .'\')" type="button"><i class="fa fa-plus"></i> Ubah</button></td>';
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
                                    <h3 align="center">Form Sektor Usaha</h3>
                                </label>
                            </div>
                            <div class="form-group" style="width: 0">
                                <input type="hidden" class="form-control dform" id="idsu" placeholder="required" value="">
                            </div>

                            <div class="form-group required">
                                <label class="control-label">Sektor Usaha</label>
                                <input type="text" pattern="[a-zA-Z]" class="form-control dform required" id="issu" value="" placeholder="required" required>
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
       
        function showform(i=null,j=null){
            document.getElementById("idsu").value="";
            if (i==null){
                $(".dform").value="";
            }
            else {
                document.getElementById("idsu").value=i;
                document.getElementById("issu").value=j;
            }
            $("#modal").show();
        }

        function sendform(){
            var data={
                idsu : $('#idsu').val(),
                issu : $('#issu').val(),
            }
            var notif   = "Update Sektor Usaha Berhasil "
            var address = "./setting/up_sektor_usaha";
            var element = "setting_content";
            sendajax(data, address, element, notif, null);
            $("#modal").hide();
        }

        function dellist(i){
            if (confirm("apakah anda Yakin Menghapus Data ini?")){
                var data={
                idsu : i,
                }
                var notif   = "Hapus Sektor Usaha Berhasil "
                var address = "./setting/dis_sektor_usaha";
                var element = "setting_content";
                sendajax(data, address, element, notif, null);
                $("#modal").hide();
            }
        }
        
    </script>