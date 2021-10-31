<?php

/**
 *
 *
 * Login Controller
 *
 *
 **/
?>
 
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MX_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->helper(array('url', 'html'));
  }

  public function index()
  {
    if ($this->session->userdata('logged_in') === true) {
      redirect('dashboard');
    }
    else {
      $sql="select * from cluster_landing_page";
      $data["hlp"] = $this->db->query($sql)->result_array();
      $this->load->view('home',$data);
    }
  }


}
