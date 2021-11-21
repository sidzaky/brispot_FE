

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url','form','html'));
        $this->load->library('session');
        $this->load->module('login');  
        $this->login->is_logged_in();
      
        
    }

    public function index()
    {
        if ($this->session->userdata('permission')<4){
            redirect ('dashboard');
        }
        $data['content'] = 'setting_v';
        $data['navbar'] = 'navbar';
        $data['sidebar'] = 'sidebar';
        $data['con']    = $this;
        $this->load->view('template', $data);    
    }

    public function get_setting_content(){
        $this->load->view('setting_content');
    }

    public function get_sektor_usaha(){
        $url = "setting/getSektorUsaha";
    	$data['sektor_usaha'] = json_decode($this->sending->send($url), true); 
        $this->load->view('setting_sektor_usaha_v',$data);
    }

    
    public function up_sektor_usaha(){
        $url = "setting/upSektorUsaha";
        $postData = Array (
			'idsu' => $this->input->post('idsu'),
            'issu' => $this->input->post('issu')
		);
		$postData = json_encode($postData);
    	json_decode($this->sending->send($url, $postData), true); 
        unset($_POST);
        $this->get_sektor_usaha();
    }

    public function dis_sektor_usaha(){
        $url = "setting/disSektorUsaha";
        $postData = Array (
			'idsu' => $this->input->post('idsu')
		);
		$postData = json_encode($postData);
    	json_decode($this->sending->send($url, $postData), true); 
        unset($_POST);
        $this->get_sektor_usaha();
    }


    public function get_jenis_usaha_map(){

        $url = "setting/getJenisUsahaMap";
    	$data = json_decode($this->sending->send($url), true); 
        $this->load->view('setting_jenis_usaha_map_v',$data);
    }

    public function up_jenis_usaha_map(){
        $url = "setting/upJenisUsahaMap";
        $postData = Array (
			'idsu' => $this->input->post('idsu'),
            'idjum' => $this->input->post('idjum'),
            'isjum' => $this->input->post('isjum'),
		);
		$postData = json_encode($postData);
    	json_decode($this->sending->send($url, $postData), true); 
        unset($_POST);
        $this->get_jenis_usaha_map();
    }


    public function dis_jenis_usaha_map(){
        $url = "setting/disJenisUsahaMap";
        $postData = Array (
            'idjum' => $this->input->post('idjum')
		);
		$postData = json_encode($postData);
    	json_decode($this->sending->send($url, $postData), true); 
        unset($_POST);
        $this->get_jenis_usaha_map();
    }

    public function get_jenis_usaha(){
        $url = "setting/getJenisUsaha";
    	$data = json_decode($this->sending->send($url), true); 
        $this->load->view('setting_jenis_usaha_v',$data);
    }

    public function up_jenis_usaha(){
        $url = "setting/upJenisUsaha";
        $postData = Array (
			'idsu' => $this->input->post('idsu'),
            'idjum' => $this->input->post('idjum'),
            'idju' => $this->input->post('idju'),
            'isju' => $this->input->post('isju'),

		);
		$postData = json_encode($postData);
    	json_decode($this->sending->send($url, $postData), true); 
        unset($_POST);
        $this->get_jenis_usaha();
    }

    public function dis_jenis_usaha(){
        $url = "setting/disJenisUsaha";
        $postData = Array (
            'idju' => $this->input->post('idju'),
		);
		$postData = json_encode($postData);
    	json_decode($this->sending->send($url, $postData), true); 
        unset($_POST);
        $this->get_jenis_usaha();
    }

    public function get_kebutuhan_pendidikan_pelatihan(){
        $url = "setting/getKebutuhanPendidikanPelatihan";
    	$data = json_decode($this->sending->send($url), true); 
        $this->load->view('setting_kebutuhan_pendidikan_pelatihan_v',$data);
    }


    public function up_kebutuhan_pendidikan_pelatihan(){
        $url = "setting/upKebutuhanPendidikanPelatihan";
        $postData = Array (
            'idpp' => $this->input->post('idpp'),
            'ispp' => $this->input->post('ispp'),
		);
		$postData = json_encode($postData);
    	json_decode($this->sending->send($url, $postData), true); 
        unset($_POST);
        $this->get_kebutuhan_pendidikan_pelatihan();
    }

    public function dis_kebutuhan_pendidikan_pelatihan(){
        $url = "setting/disKebutuhanPendidikanPelatihan";
        $postData = Array (
            'idpp' => $this->input->post('idpp'),
		);
		$postData = json_encode($postData);
    	json_decode($this->sending->send($url, $postData), true); 
        unset($_POST);
        $this->get_kebutuhan_pendidikan_pelatihan();
    }

    public function get_kebutuhan_sarana(){
        $url = "setting/getKebutuhanSarana";
        $data = json_decode($this->sending->send($url), true); 
        $this->load->view('setting_kebutuhan_sarana_v',$data);
    }
    public function up_kebutuhan_sarana(){
        $url = "setting/upKebutuhanSarana";
        $postData = Array (
            'idks' => $this->input->post('idks'),
            'isks' => $this->input->post('isks'),
		);
		$postData = json_encode($postData);
    	json_decode($this->sending->send($url, $postData), true); 
        unset($_POST);
        $this->get_kebutuhan_sarana();
    }

    public function dis_kebutuhan_sarana(){
        $url = "setting/disKebutuhanSarana";
        $postData = Array (
            'idks' => $this->input->post('idks'),
            'isks' => $this->input->post('isks'),
		);
		$postData = json_encode($postData);
    	json_decode($this->sending->send($url, $postData), true); 
        unset($_POST);
        $this->get_kebutuhan_sarana();
    }

    public function get_kebutuhan_skema_kredit(){
        $url = "setting/getKebutuhanSkemaKredit";
        $data = json_decode($this->sending->send($url), true); 
        $this->load->view('setting_kebutuhan_skema_kredit_v',$data);
    }

    
    public function up_kebutuhan_skema_kredit(){
        $url = "setting/upKebutuhanSkemaKredit";
        $postData = Array (
            'idsk' => $this->input->post('idsk'),
            'issk' => $this->input->post('issk'),
		);
		$postData = json_encode($postData);
    	json_decode($this->sending->send($url, $postData), true); 
        unset($_POST);
        $this->get_kebutuhan_skema_kredit();
    }

     
    public function dis_kebutuhan_skema_kredit(){
        $url = "setting/disKebutuhanSkemaKredit";
        $postData = Array (
            'idsk' => $this->input->post('idsk'),
		);
		$postData = json_encode($postData);
    	json_decode($this->sending->send($url, $postData), true); 
        unset($_POST);
        $this->get_kebutuhan_skema_kredit();
    }

    public function get_data_bps(){
        $url = "setting/getDataBPS";
        $data = json_decode($this->sending->send($url), true); 
        $this->load->view('setting_data_bps_v',$data);
    }

    public function up_data_bps(){
        $url = "setting/upDataBPS";
        $postData = Array (
            'id' => $this->input->post('id'),
            'id_provinsi' => $this->input->post('id_provinsi'),
            'idju' => $this->input->post('idju'),
            'value' => $this->input->post('value'),
		);
		$postData = json_encode($postData);
    	json_decode($this->sending->send($url, $postData), true); 
        unset($_POST);
        $this->get_data_bps();
    }

    
    public function dis_data_bps(){
        $url = "setting/disDataBPS";
        $postData = Array (
            'id' => $this->input->post('id')
		);
		$postData = json_encode($postData);
    	json_decode($this->sending->send($url, $postData), true); 
        unset($_POST);
        $this->get_data_bps();
    }

    
    public function get_data_akuisisi(){
        $url = "setting/getDataAkuisisi";
        $data['data_akuisisi'] = json_decode($this->sending->send($url), true);
        $this->load->view('setting_data_akuisisi_v',$data);
    }

    public function up_data_akuisisi(){
        $url = "setting/upDataAkuisisi";
        $postData = Array (
            'setdata' => $this->input->post('setdata'),
            'value' => $this->input->post('value'),

		);
		$postData = json_encode($postData);
    	json_decode($this->sending->send($url, $postData), true); 
        unset($_POST);
        $this->get_data_akuisisi();
    }

    public function get_jumlah_data_rekening(){
        $url = "setting/getJumlahDataRekening";
        $data = json_decode($this->sending->send($url), true);
        $this->load->view('setting_data_rekening_v',$data);
    }

    
    public function up_jumlah_data_rekening(){
        $url = "setting/upJumlahDataRekening";
        $postData = Array (
            'setdata' => $this->input->post('setdata'),
            'value' => $this->input->post('value'),

		);
		$postData = json_encode($postData);
    	json_decode($this->sending->send($url, $postData), true); 
        unset($_POST);
        $this->get_jumlah_data_rekening();
    }

    
    public function get_data_qris(){
        $url = "setting/getDataQris";
        $data = json_decode($this->sending->send($url), true);
        $this->load->view('setting_qris_v',$data);
    }

    public function up_qriss(){
        $url = "setting/upQriss";
        $postData = Array (
            'setdata' => $this->input->post('setdata'),
            'value' => $this->input->post('value'),

		);
		$postData = json_encode($postData);
    	json_decode($this->sending->send($url, $postData), true); 
        unset($_POST);
        $this->get_data_qris();
    }

    public function get_data_brilink(){

        $url = "setting/getDataBrilink";
        $data = json_decode($this->sending->send($url), true);
        $this->load->view('setting_brilink_v',$data);
    }

    public function up_brilink(){
        $url = "setting/upDataBrilink";
        $postData = Array (
            'setdata' => $this->input->post('setdata'),
            'value' => $this->input->post('value'),

		);
		$postData = json_encode($postData);
    	json_decode($this->sending->send($url, $postData), true); 
        unset($_POST);
        $this->get_data_brilink();
    }

    

    public function get_data_stroberi(){
        $url = "setting/getDataStroberi";
        $data = json_decode($this->sending->send($url), true);
        $this->load->view('setting_stroberi_v',$data);
    }

    public function up_stroberi(){
        $url = "setting/upDataStroberi";
        $postData = Array (
            'setdata' => $this->input->post('setdata'),
            'value' => $this->input->post('value'),
		);
		$postData = json_encode($postData);
    	json_decode($this->sending->send($url, $postData), true); 
        unset($_POST);
        $this->get_data_stroberi();
    }

    public function get_carousel_lp(){
        $url = "setting/getDataCarouselLP";
        $data = json_decode($this->sending->send($url), true);
        $this->load->view('setting_carousel_lp_v',$data);
    }

    public function del_carousel_lp(){
        $url = "setting/delCarouselLP";
        $postData = Array (
            'id' => $this->input->post('id'),
		);
		$postData = json_encode($postData);
    	json_decode($this->sending->send($url, $postData), true); 
        unset($_POST);
        $this->get_carousel_lp();
    }

     public function up_carousel_lp(){
        $src = $this->camphotoupload($this->input->post("setdata"));

        $url = "setting/upCarouselLP";
        $postData = Array (
            'src' => $src,
		);
		$postData = json_encode($postData);
    	json_decode($this->sending->send($url, $postData), true); 
        unset($_POST);
        $this->get_carousel_lp();
    }

     ///////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////OLD/////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////

    public function get_data_financial(){
        $data['akuisisi_simpanan']=$this->setting_m->get_sektorusaha_m();
        $data['akuisisi_pinjaman']=$this->setting_m->get_sektorusaha_m();
        $data['']=$this->setting_m->get_jenisusahamap_m();
        $data['jenis_usaha']= $this->setting_m->get_jenisusaha_m();
        $this->load->view('setting_jenis_usaha_v',$data);
    }

   

    
   

    

  

   


  
   



  

    private function camphotoupload($i = null, $j = null)
	{
		$encoded_data = $i;
		$binary_data = base64_decode($encoded_data);
		$url = "assets/img/landing-page/" . uniqid(rand()) . '.jpg';
		$result = file_put_contents($url, $binary_data);
		if (!$result) die("Could not save image!  Check file permissions.");
		else return $url;
	}


    
}
?>    