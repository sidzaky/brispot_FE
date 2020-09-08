<?php

/**
 *
 *
 * @autor 
 * @dzaky Hidayat
 *
 **/
?>
 
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Help extends MX_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->module('login');
		$this->login->is_logged_in();
		$this->load->helper(array('url', 'form', 'html'));
	}

	public function index()
	{
		$data['navbar'] = 'navbar';
		$data['sidebar'] = 'sidebar';
		$data['content'] = 'help_v';
		$this->load->view('template', $data);
	}

}
