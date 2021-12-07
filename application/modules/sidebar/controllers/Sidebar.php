

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sidebar extends MX_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function getdataclusterpengajuan(){

        $url = "sidebar/getdataclusterpengajuan";
		$post = Array (
			'approve_level' => $this->session->userdata('approve_level'),
			'kode_kanwil'	=> $this->session->userdata('kode_kanwil'),
			'kode_kanca'	=> $this->session->userdata('kode_kanca'),
			'kode_uker'		=> $this->session->userdata('kode_uker'),
		);
		$post = json_encode($post);
		$data= json_decode($this->sending->send($url, $post), true); 
		echo json_encode($data);
    }

    public function getdatafaq(){
        $url = "sidebar/getdatafaq";
		$post = Array (
			'permission'  => $this->session->userdata('permission')
		);
		$post = json_encode($post);
		$data= json_decode($this->sending->send($url, $post), true); 
		echo json_encode($data);
    }

    public function getDataNotification(){

        $url = "sidebar/getDataNotification";
		$post = Array (
			'permission'  => $this->session->userdata('permission'),
            'kode_kanwil'	=> $this->session->userdata('kode_kanwil'),
			'kode_kanca'	=> $this->session->userdata('kode_kanca'),
			'kode_uker'		=> $this->session->userdata('kode_uker'),
		);
		$post = json_encode($post);
		$data= json_decode($this->sending->send($url, $post), true); 
		echo json_encode($data);
    }
}
?>    