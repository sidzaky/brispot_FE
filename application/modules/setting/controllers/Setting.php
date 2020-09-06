<?php
/**
*
*
* Diagnosa
*
**/
?>

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url','form','html'));
        $this->load->library('session');
		$this->load->library('Uuid');
        $this->load->module('login');
        $this->load->model('setting_m');
        $this->login->is_logged_in();
        if ($this->session->userdata('permission')<4){
            redirect ('dashboard');
        }
    }

    public function index()
    {
        $data['content'] = 'setting_v';
        $data['navbar'] = 'navbar';
        $data['sidebar'] = 'sidebar';
        $this->load->view('template', $data);    
    }


    public function updateform(){

    }

    public function get_jenisusaha(){
        $data['jenis_usaha'] = $this->setting_m->get_jenisusaha_m();
    }

    public function get_jenisusahamap(){
        $data['jenis_usaha_map'] = $this->setting_m->get_jenisusahamap_m();
    }

    public function get_kebutuhansarana(){
        $data['kebutuhan_sarana'] = $this->setting_m->get_kebutuhansarana_m();
    }

    public function get_kebutuhanpendidikan(){
        $data['kebutuhan_pendidikan'] = $this->setting_m->get_kebutuhanpendidikan_m();
    }

    public function get_kebutuhanskemakredit(){
        $data['kebutuhan_skema_kredit'] = $this->setting->get_kebutuhanskemakredit_m();
    }


}
?>    