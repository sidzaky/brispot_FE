<h3 class="box-title" align="center">List Kategori Usaha</h3>
   <button class="btn btn-success waves-effect waves-light btn-sm" onclick="add()" type="button"><i class="fa fa-plus"></i> Tambah List</button>
   <button class="btn btn-primary waves-effect waves-light btn-sm" style="float:right;" onclick="getform('setting_content')" type="button"><i class="fa fa-Left"></i> Kembali</button>

    <table class="table table-striped table-bordered" id="table_form" width="100%">
        <thead>
            <tr>
                <th width="10%">No</th>
                <th>Sektor Usaha</th>
                <th>Kategori Usaha</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
          <?php 
            $i=1;
            foreach ($jenis_usaha_map as $row){
                echo '<tr>';
                echo '<td>'. $i++ .'</td>';
                echo '<td>'. $row['keterangan_cluster_sektor_usaha'] .'</td>'; 
                echo '<td>'. $row['nama_cluster_jenis_usaha_map'] .'</td>'; 
                echo '<td><button class="btn btn-warning waves-effect waves-light btn-sm" style="float:right;" onclick="edit(\''. $row['id_cluster_sektor_usaha'] .'\')" type="button"><i class="fa fa-plus"></i> edit</button></td>';
            }
          ?>
        </tbody>
    </table>
    <script>
        $(document).ready(function() {$('#table_form').DataTable();});
    </script>