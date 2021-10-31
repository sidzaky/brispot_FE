<div class="row">
    <div class="col-md-6">
        <h2 class="box-title" align="center">List Gambar</h2>
    </div>
    <div class="col-md-6">
        
        <button class="btn btn-primary waves-effect waves-light" style="float:right;" onclick="getform('setting_content')" type="button"><i class="fa fa-Left"></i> Kembali</button> 
        <button class="btn btn-success btn-file waves-light" style="float:right;"><i class="fa fa-upload"></i> Upload 
            <input class="fku" type="file" onchange="readURL(this);">
            <input type="hidden" id="rz" value="">
        </button>
    </div>
</div>
<hr>
    <table class="table table-striped table-bordered" id="table_form" width="100%">
        <thead>
            <tr>
                <th width="20%">Nomor </th>
                <th align="right">gambar</th>
                <th align="right">Action</th>
            </tr>
        </thead>
        <tbody>
          <?php 
          $i=1;
           foreach ($carousel_lp as $row){
                echo '<tr>';
                echo '<td> '.$i.'</td>';
                echo '<td><img src="'.base_url().$row['src'] .'"></td>';
                echo '<td align="right"><button class="btn btn-warning waves-effect waves-light btn-sm" style="float:right;" onclick="dellist(\''.$row['id'].'\')" type="button"><i class="fa fa-close"></i> hapus</button></td>';
                echo '</tr>';
                $i++;
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
            document.getElementById("changeform").innerHTML="Jumlah agen qris";
            document.getElementById("value_data").value=document.getElementById("data_qris").innerHTML;
            $("#modal").show();
        }

        function dellist(i){
            if (confirm("apakah anda Yakin Menghapus Gambar ini?")){
                var data={
                    id : i,
                }
                var notif   = "Hapus Gambar Dashboard Berhasil"
                var address = "./setting/del_carousel_lp";
                var element = "setting_content";
                sendajax(data, address, element, notif, null);
            }
        }

        function sendform(i){
            var data={
                setdata : i
            }
            var notif   = "Update Gambar Dashboard berhasil ";
            var address = "./setting/up_carousel_lp";
            var element = "setting_content";
            sendajax(data, address, element, notif, null);
        }


        
        function readURL(input, j) {
      
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            var typeimages = ["jpg", "jpeg", "png", "bmp"];
            reader.onload = function (e) {
            if (
                typeimages.includes(
                input.files[0].type.replace("image/", "").toLowerCase()
                ) == true
            ) {
                processImage(reader.result, input.files[0].type, "r");
                
            } 
            else alert("type file tidak ada yang didukung");
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

        function processImage(dataURL, fileType, j) {
        var maxWidth = 1280;
        var maxHeight = 570;
        var image = new Image();
        var newimage="";
        image.src = dataURL;

        image.onload = function () {
            var width = image.width;
            var height = image.height;
            var shouldResize = width > maxWidth || height > maxHeight;
            if (!shouldResize) {
                sendform(dataURL.replace(/^data:image\/(png|jpg|jpeg);base64,/,""));
                
                return;
            }

            var newWidth;
            var newHeight;
            if (width > height) {
                newHeight = height * (maxWidth / width);
                newWidth = maxWidth;
            }  else {
                newWidth = width * (maxHeight / height);
                newHeight = maxHeight;
            }

            var canvas = document.createElement("canvas");
            canvas.width = newWidth;
            canvas.height = newHeight;
            var context = canvas.getContext("2d");
            context.drawImage(this, 0, 0, newWidth, newHeight);
            dataURL = canvas.toDataURL(fileType);
            
            sendform(dataURL.replace(/^data:image\/(png|jpg|jpeg);base64,/,""));
        };
        
        image.onerror = function () {
            alert("There was an error processing your file!");
        };

        console.log(document.getElementById("rz").value + "zzz");
    }
</script>