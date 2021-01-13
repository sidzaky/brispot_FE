

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sidebar extends MX_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function getdataclusterpengajuan(){
        $sql="";
        switch ($this->session->userdata('approve_level')) {
			case (2):
                $sql = "select count(id) as total from cluster where cluster_status=1 and 
                                checker_status=1";
				break;
			case (1):
                $sql = 'select count(id) as total from cluster where cluster_status=1 and 
                        checker_status is null ';
                break;
			case (0):
                $sql ="select count(id) as total from cluster where cluster_status=1 and 
                            kode_uker='".$this->session->userdata("kode_uker")."' and 
                     (checker_status=0 or signer_status=0)";
				break;
        }
        $cq = $this->db->query($sql)->result_array();
        echo $cq[0]['total'];
    }

    public function getdatafaq(){
        if ($this->session->userdata('permission')==4){
            $sql= "select * from faq where timeinput_answer = 0";
            $cq = $this->db->query($sql)->num_rows();
            echo $cq;
        }
        else echo "0";
    }
}
?>    