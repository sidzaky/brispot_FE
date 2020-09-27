

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class setting_m extends CI_Model 
{

   
    public function __construct()
    {
            parent::__construct();
            //Load Dependencies
    }
    

    public function get_sektorusaha_m(){
        $sql="select * from cluster_sektor_usaha where status=1 ";
        return $this->db->query($sql)->result_array();
    }

    public function up_sektor_usaha_m(){
        if (isset($_POST['idsu']) && $_POST['idsu']!="") {
            $sql="update cluster_sektor_usaha set 
                    keterangan_cluster_sektor_usaha='".$_POST['issu']."' 
                    where id_cluster_sektor_usaha='".$_POST['idsu']."'";
        }
        else {
            $sql="insert into cluster_sektor_usaha 
                    values ('". $this->uuid->v4(true) ."',
                            '".$_POST['issu']."',
                            1)";
        }
        $this->db->query($sql);
    }

    public function dis_sektor_usaha_m(){
        if (isset($_POST['idsu']) && $_POST['idsu']!="") {
            $sql="update cluster_sektor_usaha set status=0 where id_cluster_sektor_usaha='".$_POST['idsu']."'";
            $this->db->query($sql);
        }
    }


    public function get_jenisusahamap_m($i=null){
        $sql="select * from cluster_jenis_usaha_map a
                left join cluster_sektor_usaha b on a.id_cluster_sektor_usaha=b.id_cluster_sektor_usaha
                where a.status=1";
        return $this->db->query($sql)->result_array();
    }

    public function up_jenis_usaha_map_m(){
        if (isset($_POST['idjum']) && $_POST['idjum']!="") {
            $sql="update cluster_jenis_usaha_map set 
                    nama_cluster_jenis_usaha_map='".$_POST['isjum']."',
                    id_cluster_sektor_usaha='".$_POST['idsu']."'
                    where id_cluster_jenis_usaha_map='".$_POST['idjum']."'";
        }
        else {
            $sql="insert into cluster_jenis_usaha_map 
                    values ('". $this->uuid->v4(true) ."',
                            '".$_POST['idsu']."',
                            '".$_POST['isjum']."',
                            '',
                            1)";
        }
        $this->db->query($sql);
    }

    public function dis_jenis_usaha_map_m(){
        if (isset($_POST['idjum']) && $_POST['idjum']!="") {
            $sql="update cluster_jenis_usaha_map set status=0 where id_cluster_jenis_usaha_map='".$_POST['idjum']."'";
            $this->db->query($sql);
        }
    }

    public function up_jenis_usaha_m(){
        if (isset($_POST['idju']) && $_POST['idju']!="") {
            $sql="update cluster_jenis_usaha set 
                    nama_cluster_jenis_usaha='".$_POST['isju']."',
                    id_cluster_jenis_usaha_map='".$_POST['idjum']."'
                    where id_cluster_jenis_usaha='".$_POST['idju']."'";
        }
        else {
            $sql="insert into cluster_jenis_usaha 
                    values ('". $this->uuid->v4(true) ."',
                            '".$_POST['idjum']."',
                            '".$_POST['isju']."',
                            1)";
        }
        $this->db->query($sql);
    }

    public function dis_jenis_usaha_m(){
        if (isset($_POST['idju']) && $_POST['idju']!="") {
            $sql="update cluster_jenis_usaha set status=0 where id_cluster_jenis_usaha='".$_POST['idju']."'";
            $this->db->query($sql);
        }
    }

    public function get_jenisusaha_m($i=null){
        $sql="select * from cluster_jenis_usaha a
                left join cluster_jenis_usaha_map b on a.id_cluster_jenis_usaha_map = b.id_cluster_jenis_usaha_map
                left join cluster_sektor_usaha c on b.id_cluster_sektor_usaha=c.id_cluster_sektor_usaha
                where a.status=1";
        return $this->db->query($sql)->result_array();
    }

    public function get_kebutuhanpendidikan_m(){
        $sql="select * from cluster_kebutuhan_pendidikan_pelatihan where status=1";
        return $this->db->query($sql)->result_array();
    }

    public function up_kebutuhan_pendidikan_pelatihan_m(){
        if (isset($_POST['idpp']) && $_POST['idpp']!="") {
            $sql="update cluster_kebutuhan_pendidikan_pelatihan set 
                    kebutuhan_pendidikan_pelatihan='".$_POST['ispp']."'
                    where id_cluster_kebutuhan_pendidikan_pelatihan='".$_POST['idpp']."'";
        }
        else {
            $sql="insert into cluster_kebutuhan_pendidikan_pelatihan
                    values ('". $this->uuid->v4(true) ."',
                            '".$_POST['ispp']."',
                            1)";
        }
        $this->db->query($sql);
    }

    public function dis_kebutuhan_pendidikan_pelatihan_m(){
        if (isset($_POST['idpp']) && $_POST['idpp']!="") {
            $sql="update cluster_kebutuhan_pendidikan_pelatihan set status=0 where id_cluster_kebutuhan_pendidikan_pelatihan='".$_POST['idpp']."'";
            $this->db->query($sql);
        }
    }

    public function get_kebutuhansarana_m(){
        $sql="select * from cluster_kebutuhan_sarana where status=1";
        return $this->db->query($sql)->result_array();
    }

    public function up_kebutuhan_sarana_m(){
        if (isset($_POST['idks']) && $_POST['idks']!="") {
            $sql="update cluster_kebutuhan_sarana set 
                    kebutuhan_sarana='".$_POST['isks']."'
                    where id_cluster_kebutuhan_sarana='".$_POST['idks']."'";
        }
        else {
            $sql="insert into cluster_kebutuhan_sarana
                    values ('". $this->uuid->v4(true) ."',
                            '".$_POST['isks']."',
                            1)";
        }
        $this->db->query($sql);
    }

    public function dis_kebutuhan_sarana_m(){
        if (isset($_POST['idks']) && $_POST['idks']!="") {
            $sql="update cluster_kebutuhan_sarana set status=0 where id_cluster_kebutuhan_sarana='".$_POST['idks']."'";
            $this->db->query($sql);
        }
    }
    
    public function get_kebutuhanskemakredit_m(){
        $sql="select * from cluster_kebutuhan_skema_kredit where status=1";
        return $this->db->query($sql)->result_array();
    }

    public function up_kebutuhan_skema_kredit_m(){
        if (isset($_POST['idsk']) && $_POST['idsk']!="") {
            $sql="update cluster_kebutuhan_skema_kredit set 
                    kebutuhan_skema_kredit='".$_POST['issk']."'
                    where id_cluster_kebutuhan_skema_kredit='".$_POST['idsk']."'";
        }
        else {
            $sql="insert into cluster_kebutuhan_skema_kredit
                    values ('". $this->uuid->v4(true) ."',
                            '".$_POST['issk']."',
                            1)";
        }
        $this->db->query($sql);
    }

    public function dis_kebutuhan_skema_kredit_m(){
        if (isset($_POST['idsk']) && $_POST['idsk']!="") {
            $sql="update cluster_kebutuhan_skema_kredit set status=0 where id_cluster_kebutuhan_skema_kredit='".$_POST['idsk']."'";
            $this->db->query($sql);
        }
    }
}	
	
/* End of file user_m.php */
/* Location: ./application/models/user_m.php */