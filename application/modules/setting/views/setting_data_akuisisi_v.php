<h3 class="box-title" align="center">List data Akuisisi Simpanan, Pinjaman, inklusi </h3>
   <!-- <button class="btn btn-success waves-effect waves-light btn-sm" onclick="showform()" type="button"><i class="fa fa-plus"></i> Tambah List</button> -->
   <button class="btn btn-primary waves-effect waves-light btn-sm" style="float:right;" onclick="getform('setting_content')" type="button"><i class="fa fa-Left"></i> Kembali</button>

    <table class="table table-striped table-bordered" id="table_form" width="100%">
        <thead>
            <tr>
                <th width="20%">Akuisisi </th>
                <th align="right">Jumlah</th>
                <th align="right">Action</th>
            </tr>
        </thead>
        <tbody>
          <?php 
            $i=1;
           
            echo '<tr>';
            echo '<td> Akusisi Rekening Simpanan</td>';
            echo '<td id="data_akuisisi_simpanan" align="right">'. $data_akuisisi[0]['jumlah_akuisisi_simpanan'] .'</td>';
            echo '<td align="right"><button class="btn btn-warning waves-effect waves-light btn-sm" style="float:right;" onclick="showform(\'simpanan\')" type="button"><i class="fa fa-plus"></i> edit</button></td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td> Akusisi Rekening Pinjaman</td>';
            echo '<td id="data_akuisisi_pinjaman" align="right">'. $data_akuisisi[0]['jumlah_akuisisi_pinjaman'] .'</td>';
            echo '<td align="right"><button class="btn btn-warning waves-effect waves-light btn-sm" style="float:right;" onclick="showform(\'pinjaman\')" type="button"><i class="fa fa-plus"></i> edit</button></td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td> Akusisi Inklusi</td>';
            echo '<td id="data_akuisisi_inklusi" align="right">'. $data_akuisisi[0]['jumlah_akuisisi_inklusi'] .'</td>';
            echo '<td align="right"><button class="btn btn-warning waves-effect waves-light btn-sm" style="float:right;" onclick="showform(\'inklusi\')" type="button"><i class="fa fa-plus"></i> edit</button></td>';
            echo '</tr>';
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
                                    <h3 align="center">Form Perubahan Data</h3>
                                </label>
                            </div>
                            <div class="form-group" style="width: 0">
                                <input type="hidden" class="form-control dform" id="id" placeholder="required" value="">
                            </div>
                            <div class="form-group required">
                                <label class="control-label" id="changeform"></label>
                                <input type="number"  class="form-control dform required" id="value_data" value="" placeholder="required" required>
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
        var setdata="";
        function showform(i=null){
            setdata=i;
            document.getElementById("changeform").innerHTML="Data Akuisisi "+i;
            document.getElementById("value_data").value=document.getElementById("data_akuisisi_"+i).innerHTML;
            $("#modal").show();
        }

        function sendform(){
            var data={
                setdata : setdata,
                value : $('#value_data').val(),
            }
           
            var notif   = "Update Data Akusisi "+setdata+" Berhasil ";
            var address = "./setting/up_data_akuisisi";
            sendajax(data, address, null, notif, null);
            document.getElementById("data_akuisisi_"+setdata).innerHTML=$('#value_data').val();
            $("#modal").hide();
        }

    </script>