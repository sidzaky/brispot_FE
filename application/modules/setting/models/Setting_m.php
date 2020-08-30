

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class setting_m extends CI_Model 
{

   
    public function __construct()
    {
            parent::__construct();
            //Load Dependencies
    }
    
    public function get_jenisusaha_m(){
        $sql="select * from cluster_jenis_usaha";
        return $this->db->query($sql)->result_array();
    }

    public function get_jenisusahamap_m(){
        $sql="select * from cluster_jenis_usaha_map";
        return $this->db->query($sql)->result_array();
    }

    public function get_kebutuhansarana_m(){
        $sql="select * from cluster_kebutuhan_sarana";
        return $this->db->query($sql)->result_array();
    }

    public function get_kebutuhanpendidikan_m(){
        $sql="select * from cluster_kebutuhan_pendidikan_pelatihan";
        return $this->db->query($sql)->result_array();
    }

    public function get_kebutuhanskemakredit_m(){
        $sql="select * from cluster_kebutuhan_skema_kredit";
        return $this->db->query($sql)->result_array();
    }
}	
	
/* End of file user_m.php */
/* Location: ./application/models/user_m.php */