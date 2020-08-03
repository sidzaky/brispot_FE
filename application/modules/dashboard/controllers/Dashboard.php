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

class Dashboard extends MX_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->module('login');
    $this->login->is_logged_in();

    $this->load->helper(array('url', 'html'));
    $this->load->model('dashboard_m');
  }

  public function index()
  {
    $data['content'] = 'dashboard';
    $data['navbar'] = 'navbar';
    $data['sidebar'] = 'sidebar';
    $this->load->view('template', $data);
  }
}
