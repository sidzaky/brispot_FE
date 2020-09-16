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
                $tableb .= '<tr>';
                $tableb .= '<td rowspan="'.(count($jenis_usaha)+1).'">'.$srow['nama_cluster_jenis_usaha_map'];
                $tableb .= '<button class="btn btn-warning waves-effect waves-light btn-sm" style="float:right;" onclick="getform()" type="button"><i class="fa fa-pencil"></i></button>';
                $tableb .= '</td></tr>';
                $ca++;
                foreach ($jenis_usaha  as $ssrow){
                    $ca++;
                    $tableb .= '<tr><td>';
                    $tableb .= $ssrow['nama_cluster_jenis_usaha'];
                    $tableb .= '<button class="btn btn-warning waves-effect waves-light btn-sm" style="float:right;" onclick="getform()" type="button"><i class="fa fa-pencil"></i></button>';
                    $tableb .= '</td></tr>';
                }
            }
            
            $tablea .= '<tr>';
            $tablea .= '<td rowspan="'.($ca+1).'">'.$row['keterangan_cluster_sektor_usaha'];
            $tablea .= '<button class="btn btn-warning waves-effect waves-light btn-sm" style="float:right;" onclick="getform()" type="button"><i class="fa fa-pencil"></i></button>';
            $tablea .= '</td></tr>';
            $tablea .= $tableb;
        }
        return $tablea;
    }

    public function get_sektorusaha(){
        return $this->setting_m->get_sektorusaha_m();
 
    }
    public function get_jenisusahamap($i){
        return $this->setting_m->get_jenisusahamap_m($i);
    }

    public function get_jenisusaha($i){
        return $this->setting_m->get_jenisusaha_m($i);
    }

   

    public function get_kebutuhansarana(){
        return $this->setting_m->get_kebutuhansarana_m();
    }

    public function get_kebutuhanpendidikan(){
        return $this->setting_m->get_kebutuhanpendidikan_m();
    }

    public function get_kebutuhanskemakredit(){
        return $this->setting->get_kebutuhanskemakredit_m();
    }


}
?>    