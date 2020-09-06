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
        $data['jenisusaha']=$this->get_jenisusaha();
        $data['jenisusahamap']=$this->get_jenisusahamap();
        $data['kebutuhansarana']=$this->get_kebutuhansarana();
        $data['kebutuhanpendidikan']=$this->get_kebutuhanpendidikan();
        $data['kebutuhanskemakredit']=$this->get_kebutuhanskemakredit();
        $this->load->view('template', $data);    
    }


    public function get_jenisusaha(){
        $data['jenis_usaha'] = $this->setting_m->get_jenisusaha_m();
        return $data;
    }

    public function get_jenisusahamap(){
        $data['jenis_usaha_map'] = $this->setting_m->get_jenisusahamap_m();
        return $data;
    }

    public function get_kebutuhansarana(){
        $data['kebutuhan_sarana'] = $this->setting_m->get_kebutuhansarana_m();
        return $data;
    }

    public function get_kebutuhanpendidikan(){
        $data['kebutuhan_pendidikan'] = $this->setting_m->get_kebutuhanpendidikan_m();
        return $data;
    }

    public function get_kebutuhanskemakredit(){
        $data['kebutuhan_skema_kredit'] = $this->setting_m->get_kebutuhanskemakredit_m();
        return $data;
    }


}
?>    