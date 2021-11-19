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

class Login extends MX_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->helper(array('url', 'form', 'html'));
    $this->load->library('session');
  }

   public function index()
  {
    if ($this->session->userdata('logged_in') === true) {
      redirect('cluster');
    }
    else redirect(base_url());
  }
 
  public function signup()
  {
    $this->is_logged_in(true);
    $data['content'] = 'signup_v';
    $data['navbar'] = null;
    $data['sidebar'] = null;
    $this->load->view('template', $data);
  }

  function changePasswordFirstTime()
  {
    $this->is_logged_in(true);
    $res = $this->user_m->signup_m();
    if ($res === true) $this->logout();
  }

  public function chpassuker()
  {
    $this->is_logged_in(true);
    $this->user_m->chpassuker_m();
  }

  function validate()
  {
    $get = array (
        "username" => $this->input->post('username'),
        "password" =>  md5($this->input->post('password'))
    );
    $get=json_encode($get);
  
    $url = "login/getvalidate";
    $newdata = $this->sending->send($url, $get);
      
    $results = json_decode ($newdata, true);
  
    if ($results != null) {
      foreach ($results as $result) {
        $sessions   = array(
            'id'              => $result['id'],
            'kode_kanwil'     => (isset($result['REGION']) ? $result['REGION'] : null),
            'kode_kanca'      => (isset($result["MAINBR"]) ? $result["MAINBR"] : null),
            'kode_uker'       => ($result["permission"] < 4 ? $result["BRANCH"] : $result["username"]),
            'name_uker'       => (isset($result["BRDESC"]) ? $result["BRDESC"] : null),
            'uppwd'           => $result["uppwd"],
            'permission'      => $result["permission"],
            'notif'           => $result["notif"],
            'approve_level'   => $result["approve_level"],
            'logged_in'       => true
        );
        $this->session->set_userdata($sessions);
      };
     echo json_encode("true");
    } else {
     echo json_encode("kode uker/password salah");
    }
  }

  function closenotif()
  {
    $this->is_logged_in(true);
    $get = array (
      "id" => $this->session->userdata('id')
    );
    $url = "login/getclosenotif";
    $this->sending->send($url, $get);
    $this->session->set_userdata('notif', 0);
  }

  function is_logged_in($i=null)
  {
    $logged_in = $this->session->userdata('logged_in');
    if (!isset($logged_in) || $logged_in != true) {
      $link = base_url();
      echo "You dont have permission to access this page. <a href=$link>Login</a>";
      die();
    }
    if ($i==null){
      if ($this->session->userdata('uppwd') === "1") redirect('/login/signup');
    }
  }

  function logout()
  {
    $items = array('user_id', 'username', 'role', 'logged_in');
    $this->session->unset_userdata($items);
    redirect('');
  }
}
