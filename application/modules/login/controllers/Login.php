<?php
/**
*
*
* Pizza Hut Delivery Controller
*
*
**/
?>
 
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MX_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->helper(array('url','form','html'));
        $this->load->library('session');
        $this->load->model('user_m');
    }
	
	
	
		// public function test(){
				// ini_set('memory_limit', '-1');
				// $sql="select * from cluster where CHAR_LENGTH(kelurahan)>1 and kelurahan REGEXP '^[A-z]+$'";
				// $q=0;
		
				// foreach ($this->db->query($sql)->result_array() as $row){
						// $update="select 
										// a.id as id_kelurahan, a.nama as nama_kelurahan, a.kode_pos,
										// b.id as id_kecamatan, b.nama as nama_kecamatan,
										// c.id as id_kabupaten, c.nama as nama_kabupaten,
										// d.id as id_provinsi, d.nama as nama_provinsi

										// from kelurahan a
										// left join kecamatan b on a.kecamatan_id=b.id
										// left join kabupaten_kota c on b.kabupaten_kota_id=c.id
										// left join provinsi d on c.provinsi_id=d.id
				

						 // where a.nama like '%".$row['kelurahan']."%'  ";
						// $data=$this->db->query($update)->result_array();
						// if (sizeof($data)==1){
							// foreach ($data as $srow){
								
								// echo $srow['nama']."|||".$row['kelurahan']."</br>";
								// $zz="update  provinsi='".$srow['id_provinsi']."', kabupaten='".$srow['id_kabupaten']."', kecamatan='".$srow['id_kecamatan']."', kelurahan='".$srow['id_kelurahan']."', kode_pos='".$srow['kode_pos']."' where  id='".$row['id']."' ";
								// $this->db->query($zz);
								// echo $zz.'</br>';
								// $q++;
							// }
						// }
				// }
			// echo $q;
		// }
	
	
	
	public function index()
	{	
			header('Location: http://www.klasterkuhidupku.com');
			// if ($this->session->userdata('logged_in')!=true){
					// $data['content'] = 'login';
					// $data['navbar'] = null;
					// $data['sidebar'] = null;
					// $this->load->view('template', $data); 
					// //echo "sorry, masih main tenes servernya. doain aja bisa cepet kerja lagi";
				// }
			// else redirect ('http://www.klasterkuhidupku.com',refresh); 
	}
	
	
	
	public function signup(){
			if ($this->session->userdata('logged_in')!=true){
					$data['content'] = 'login';
					$data['navbar'] = null;
					$data['sidebar'] = null;
					$this->load->view('template', $data); 
					//echo "sorry, masih main tenes servernya. doain aja bisa cepet kerja lagi";
				}
			else redirect ('http://www.klasterkuhidupku.com',refresh); 
	}
	
	public function chpassuker(){
		$this->user_m->chpassuker_m();
	}

	function validate(){
		$username   = $this->input->post('username');
		$password   = md5($this->input->post('password'));
	
		$results = $this->user_m->login($username, $password);
		
		if($results != null){
				foreach ($results as $result){
					$sessions   = array(
									
									'kode_kanwil'		=> $result->REGION,
									'kode_kanca'		=> $result->MAINBR,
									'kode_uker' 	   	=> $result->username,
									'name_uker'		=> $result->BRDESC,
									'uppwd'				=> $result->uppwd,
									'permission'		=> $result->permission,
									'notif'				=> $result->notif,
									'logged_in'			=> true
								);
					$this->session->set_userdata($sessions);
				};
            redirect('cluster',refresh);
        }
        else{
            redirect('/index.php'.$this->session->set_flashdata('message', 'kodeuker/password salah'), refresh);
        }     
    }
	
	function closenotif(){
		$this->user_m->closenotif_m();
		$this->session->set_userdata('notif',0);
	}

    function is_logged_in()
    {	
        $logged_in = $this->session->userdata('logged_in');
        if(!isset($logged_in) || $logged_in != true)
        {	
            $link = base_url();
            echo "You don\'t have permission to access this page. <a href=$link>Login</a>";    
            die();      
            //$this->load->view('login_form');
        }
		else {
			if ($this->session->userdata('uppwd')==1) redirect('/login/signup', refresh);
		}
		
		
    }   
    
	
    function logout()
	{
        $items = array('user_id','username','role','logged_in');
		$this->session->unset_userdata($items);
		
        redirect('');
	}
}
