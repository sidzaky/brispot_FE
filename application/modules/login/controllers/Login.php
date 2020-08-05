<?php

/**
 *
 *
 * Pizza Hut Delivery Controller
 *
 *
 **/
?>
 
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MX_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url', 'form', 'html'));
		$this->load->library('session');
		$this->load->model('user_m');
	}

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

	public function signup()
	{
		if ($this->session->userdata('logged_in')!=true){
					$data['content'] = 'login';
					$data['navbar'] = null;
					$data['sidebar'] = null;
					$this->load->view('template', $data); 
					//echo "sorry, masih main tenes servernya. doain aja bisa cepet kerja lagi";
				}
			else redirect ('http://www.klasterkuhidupku.com',refresh); 
	}

	function changePasswordFirstTime()
	{
		$res = $this->user_m->signup_m();
		if ($res === true) $this->logout();
	}

	public function chpassuker()
	{
		$this->user_m->chpassuker_m();
	}

	function validate()
	{
		$username   = $this->input->post('username');
		$password   = md5($this->input->post('password'));

		$results = $this->user_m->login($username, $password);

		if ($results != null) {
			foreach ($results as $result) {
				$sessions   = array(
					'kode_kanwil'		=> $result->REGION,
					'kode_kanca'		=> $result->MAINBR,
					'kode_uker' 	  => $result->username,
					'name_uker'			=> $result->BRDESC,
					'uppwd'					=> $result->uppwd,
					'permission'		=> $result->permission,
					'notif'					=> $result->notif,
					'logged_in'			=> true
				);
				$this->session->set_userdata($sessions);
			};
			redirect('dashboard');
		} else {
			$this->session->set_flashdata('message', 'kodeuker/password salah');
			redirect(site_url());
		}
	}

	function closenotif()
	{
		$this->user_m->closenotif_m();
		$this->session->set_userdata('notif', 0);
	}

	function is_logged_in()
	{
		$logged_in = $this->session->userdata('logged_in');
		if (!isset($logged_in) || $logged_in != true) {
			$link = base_url();
			echo "You don\'t have permission to access this page. <a href=$link>Login</a>";
			die();
		}
		if ($this->session->userdata('uppwd') === "1") redirect('/login/signup');
	}

	function logout()
	{
		$items = array('user_id', 'username', 'role', 'logged_in');
		$this->session->unset_userdata($items);
		redirect('');
	}
}
