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
        $data['con']    = $this;
        $this->load->view('template', $data);    
    }


    public function updateform(){

    }

    public function get_datausaha(){
        $sektor_usaha = $this->get_sektorusaha();
        $tablea="";
        $ca=0;
        foreach ($sektor_usaha as $row){
            $tableb="";
            $jenis_usaha_map = $this->get_jenisusahamap($row['id_cluster_sektor_usaha']);
            foreach ($jenis_usaha_map as $srow){
                $jenis_usaha = $this->get_jenisusaha($srow['id_cluster_jenis_usaha_map']);
                $tableb .= '<tr><td rowspan="'.(count($jenis_usaha)+1).'">'.$srow['nama_cluster_jenis_usaha_map'].'<button class="btn btn-success waves-effect waves-light btn-sm" style="float:right;" onclick="getform()" type="button"><i class="fa fa-plus"></i> edit</button></td></tr>';
                $ca++;
                foreach ($jenis_usaha  as $ssrow){
                    $ca++;
                    $tableb .= '<tr><td>'.$ssrow['nama_cluster_jenis_usaha'].'<button class="btn btn-success waves-effect waves-light btn-sm" style="float:right;" onclick="getform()" type="button"><i class="fa fa-plus"></i> edit</button></td></tr>';
                }
            }
            
            $tablea .= '<tr><td rowspan="'.($ca+1).'">'.$row['keterangan_cluster_sektor_usaha'].'<button class="btn btn-success waves-effect waves-light btn-sm" style="float:right;" onclick="getform()" type="button"><i class="fa fa-plus"></i> edit</button></td></tr>'.$tableb;
        }
        return $tablea;
    }

    public function setting_content(){
        $this->load->view('setting_content');
    }

    public function get_sektor_usaha(){
        $data['sektor_usaha']=$this->setting_m->get_sektorusaha_m();
        $this->load->view('setting_sektor_usaha_v',$data);
    }
    public function get_jenis_usaha_map(){
        $data['jenis_usaha_map']=$this->setting_m->get_jenisusahamap_m();
        $this->load->view('setting_jenis_usaha_map_v',$data);
    }

    public function get_jenis_usaha(){
       $data['jenis_usaha']= $this->setting_m->get_jenisusaha_m($i);
        $this->load->view('setting_jenis_usaha_v',$data)
    }

    public function get_kebutuhan_sarana(){
        $data['kebutuhan_sarana']=$this->setting_m->get_kebutuhansarana_m();
        $this->load->view('setting_kebutuhan_sarana_v',$data)
    }

    public function get_kebutuhan_pendidikan_pelatihan(){
        $data['kebutuhan_pendidikan_pelatihan']=$this->setting_m->get_kebutuhanpendidikan_m();
        $this->load->view('setting_kebutuhan_pendidikan_pelatihan_v',$data)
    }

    public function get_kebutuhan_skema_kredit(){
        $data['kebutuhan_skema_kredit']=$this->setting->get_kebutuhanskemakredit_m();
        $this->load->view('setting_kebutuhan_skema_kredit_v',$data)
    }


}
?>    