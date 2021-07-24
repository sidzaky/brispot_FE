

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sidebar extends MX_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function getdataclusterpengajuan(){
        $sql="";
        switch ($this->session->userdata('approve_level')) {
			case (2):
                $sql = "select count(id) as total from cluster where cluster_status=1 and checker_status=1 and signer_status is null";
				break;
			case (1):
                $sql = 'select count(id) as total from cluster where cluster_status=1 and kode_kanwil="'. $this->session->userdata('kode_kanwil') . '" and checker_status is null ';
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

    public function getDataNotification(){
            switch ($this->session->userdata('permission')) {
                case (4):
                    $where .= " false ";
                    break;
                case (3):
                    $where .= " kode_kanwil='" . $this->session->userdata('kode_kanwil') . "' ";
                    break;
                case (2):
                    $where .= " kode_kanca='" . $this->session->userdata('kode_kanca') . "' ";
                    break;
                case (1):
                    $where .= " kode_uker='" . $this->session->userdata("kode_uker") . "' ";
                    break;
            }
            
            $sql= "select id, kelompok_usaha from cluster where ".$where." and cluster_status=1 and cluster_approval=1 and timestamp<(UNIX_TIMESTAMP() - 15780000) and userinsert='".$this->session->userdata("kode_uker")."'";
            $cq = $this->db->query($sql)->result_array();
            echo json_encode($cq);
    }
}
?>    