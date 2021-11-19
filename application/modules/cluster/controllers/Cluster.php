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

class Cluster extends MX_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->module('login');
		$this->login->is_logged_in();
		$this->load->helper(array('url', 'form', 'html'));
    }
    
    ////////////////////////////////////////////////////////////
    /////////////////get pengajuan klaster usaha////////////////
    ////////////////////////////////////////////////////////////

	public function index()
	{	
		$data['navbar'] = 'navbar';
        $data['sidebar'] = 'sidebar';


		$url = "cluster/getClusterSektorUsaha";
		$data['cluster_sektor_usaha'] = json_decode($this->sending->send($url), true); 
	
		$url = "cluster/getprovinsi";
		$data['provinsi'] = json_decode($this->sending->send($url), true); 


		$url = "cluster/getClusterKebutuhanPendidikanPelatihan";
		$data['cluster_kebutuhan_pendidikan_pelatihan'] = json_decode($this->sending->send($url), true); 

		$url = "cluster/getClusterKebutuhanSarana";
		$data['cluster_kebutuhan_sarana'] = json_decode($this->sending->send($url), true); 

		$url = "cluster/getClusterKebutuhanSkemaKredit";
		$data['cluster_kebutuhan_skema_kredit'] = json_decode($this->sending->send($url), true); 

		$url = "cluster/getDataKanwil";
		$postKanwil = Array (
			'permission'  => $this->session->userdata('permission'),
			'kode_kanwil' => $this->session->userdata('kode_kanwil'),
		);
		$postKanwil = json_encode($postKanwil);
		$data['kanwil'] = json_decode($this->sending->send($url, $postKanwil), true); 

		// $data['kanwil'] = $this->cluster_m->get_data_kanwil_m();
		$data['content'] = $this->session->userdata('kode_uker') == 'kanpus' ? 'cluster_kanpus_v' : 'cluster_v';
		// $data['provinsi'] = $this->cluster_m->getprovinsi_m();
		$this->load->view('template', $data);
	}

	public function get_kanca()
	{
		$url = "cluster/getDataKanca";
		$postKanwil = Array (
			'permission'  => $this->session->userdata('permission'),
			'postKodeKanwil' => $this->input->post('kode_kanwil')
		);
		$postKanwil = json_encode($postKanwil);
		$dataKanca = json_decode($this->sending->send($url, $postKanwil), true); 
		echo json_encode($dataKanca);
	}

	public function get_unit()
	{
		$url = "cluster/getDataUnit";
		$postKanca = Array (
			'permission'  => $this->session->userdata('permission'),
			'postKodeKanca' => $this->input->post('kode_kanca')
		);
		$postKanca = json_encode($postKanca);
		$dataUnit = json_decode($this->sending->send($url, $postKanca), true); 
		echo json_encode($dataUnit);
	}

	function fjum()
	{
		$url = "cluster/getJenisUsahaMapBySektorUsaha";
		$dataJUM = json_decode($this->sending->send($url), true); 
		echo json_encode($dataJUM);
	}

	function fju()
	{
		$url = "cluster/getJenisUsahaByJenisUsahaMap";
		$dataJU = json_decode($this->sending->send($url), true); 
		echo json_encode($dataJU);
	}

	function get_sarana()
	{
		$url = "cluster/getClusterKebutuhanSarana";
		$dataJU = json_decode($this->sending->send($url), true); 
		echo json_encode($dataJU);
	}
	
	function get_kredit()
	{
		$url = "cluster/getClusterKebutuhanSkemaKredit";
		$dataSkemaKredit = json_decode($this->sending->send($url), true); 
		echo json_encode($dataSkemaKredit);

	}
	public function getdata()
	{
		$dataTable=$this->input->post();
		$dataTable['custom_field'] = json_decode($dataTable['custom_field']);
		$url = "cluster/getDataField";
		$postDataFields = Array (
			'dataTable'		=> $dataTable,
			'status'		=> false,
			'permission'  	=> $this->session->userdata('permission'),
			'approve_level' => $this->session->userdata('approve_level'),
			'kode_kanwil'	=> $this->session->userdata('kode_kanwil'),
			'kode_kanca'	=> $this->session->userdata('kode_kanca'),
			'kode_uker'		=> $this->session->userdata('kode_uker'),
			'approved'		=> false,
		);

		$postDataFields = json_encode($postDataFields);
		$list = json_decode($this->sending->send($url, $postDataFields), true);

		$data = array();
		$no = $this->input->post('start');

		$urlCountAnggota = "cluster/getCountAnggota";
		$urlJenisUsahaById = "cluster/getJenisUsahaById";
		$urlGetClusterChecker = "cluster/getUkerByBranch";
		$urlGetClusterSigner = "cluster/getUkerByBranch";
		$urlCountDataField = "cluster/getCountDataField";

		foreach ($list as $field) {

			$postCountDataAnggota = Array (
				'id'		=> $field['id'],
			);
			$postCountDataAnggota = json_encode($postCountDataAnggota);
			$totalanggota = json_decode($this->sending->send($urlCountAnggota, $postCountDataAnggota), true);

			$postJenisUsahaById = Array (
				'id'		=> $field['id_cluster_jenis_usaha'],
			);
			$postJenisUsahaById = json_encode($postJenisUsahaById);
			$jenis_usaha = json_decode($this->sending->send($urlJenisUsahaById, $postJenisUsahaById), true);

			$status=$field["checker_status"]=="" ? "check" : "sign";
            $colstatus  = "";
			$ca 	    = '<button class="btn btn-info waves-effect waves-light btn-sm btn-block" name="id" value="' . $field['id'] . '" type="submit" ><i class="fa fa-users"></i> Anggota</button>';
			$upload     = '<button class="btn btn-primary waves-effect waves-light btn-sm btn-block" onclick="upform(\'' . $field['id'] . '\')" type="button" ><i class="fa fa-upload"></i> Upload</button>';
            $info	    = '<button class="btn btn-default waves-effect waves-light btn-sm btn-block" onclick="showClusterInfo(\'' . $field['id'] . '\')" type="button"><i class="fa fa-info"></i> Info</button>';
            $appr       = '<button class="btn btn-success waves-effect waves-light btn-sm btn-block" onclick="setappr(\'' . $field['id'] . '\' , \''.$status.'\' );" type="button" ><i class="fa fa-check"></i> Setuju </button>';
            $reject     = '<button class="btn btn-warning waves-effect waves-light btn-sm btn-block" onclick="modalreject(\'' . $field['id'] . '\' , \''.$status.'\' );" type="button" ><i class="fa fa-check"></i> Tolak </button>';

			$postClusterChekcer = Array (
				'kode_uker'	=> $field['checker_user_update'],
				'permission'  			=> $this->session->userdata('permission'),
			);
			$postClusterChekcer = json_encode($postClusterChekcer);
			$checker_username 	= $field['checker_user_update'] !== "" ? json_decode($this->sending->send($urlGetClusterChecker, $postClusterChekcer), true) : "";
			

			$postClusterSigner = Array (
				'kode_uker'			=> $field['signer_user_update'],
				'kode_kanwil'		=> $this->session->userdata('kode_kanwil'),
				'kode_kanca'		=> $this->session->userdata('kode_kanca'),
				'kode_uker'			=> $this->session->userdata('kode_uker'),
			);
			$postClusterSigner = json_encode($postClusterSigner);
			$signer_username 	= $field['signer_user_update'] !== "" ? json_decode($this->sending->send($urlGetClusterSigner, $postClusterSigner), true) : "";
			


			if ($field['kode_uker'] == $this->session->userdata('kode_uker')   || $field['userinsert'] == $this->session->userdata('kode_uker')){
				$update     = '<button class="btn btn-success waves-effect waves-light btn-sm btn-block" onclick="getform(\'' . $field['id'] . '\');" type="button" ><i class="fa fa-pencil"></i> Update</button>';
			}
			else {
				if ($this->session->userdata('permission')>2){
					$update     = '<button class="btn btn-success waves-effect waves-light btn-sm btn-block" onclick="getform(\'' . $field['id'] . '\');" type="button" ><i class="fa fa-pencil"></i> Update</button>';
				}
				else {
					$update ="";
				}
			}
			$del 	    = '<button class="btn btn-danger waves-effect waves-light btn-sm btn-block" onclick="deldata(\'' . $field['id'] . '\')" type="button" ><i class="fa fa-close"></i> Hapus</button>';
			//exection button//

	///////////////////// button for MCS /////////////////////////////////
		
			if ($field["checker_status"]!=""){
				if ($field["checker_status"]=='1'){
					if ($field["signer_status"]!=""){
						if ($field["signer_status"]==0) $colstatus = " Pengajuan ditolak Divisi SEI </br>". $field['reject_reason'];
					}
					else {
						switch ($this->session->userdata['approve_level']) {
							case (0) :
							case (1) :
								$colstatus = "Pengajuan telah diriview oleh " . $checker_username[0]['BRDESC'] . " </br> Menunggu Divisi SEI ";
							break;

							case (2) :  
								$colstatus =  "Pengajuan telah diriview oleh " . $checker_username[0]['BRDESC']. " </br> " .  $appr . $reject ;
							break;
						}
					}
				}
				else {
					if (isset($checker_username[0]['BRDESC'])) $colstatus =" Pengajuan ditolak oleh ". $checker_username[0]['BRDESC'] ."</br>". $field['reject_reason'];
					else  $colstatus =" Pengajuan ditolak,  </br>". $field['reject_reason'];
				}
			}
			else {
				switch ($this->session->userdata['approve_level']) {
					case (0) :
					case (2) :
						$colstatus = " Pengajuan sedang menunggu Checker ";
					break;
					case (1) :  
						$colstatus = $appr . $reject ;
					break;
				}
			}

    ///////////////////// End button for MCS /////////////////////////////////
			$action     =  $info . $ca . ($this->session->userdata('kode_uker') == 'kanpus' ? '' : $update . $del);
			

	///////////////////////check for local heroes/////////////////////////////
	$actionLH='<button class="btn btn-info waves-effect waves-light btn-sm btn-block" onclick="showClusterLHInfo(\'' . $field['id'] . '\')" type="button"><i class="fa fa-info"></i> Info Local Heroes</button>';;
		if ($this->session->userdata['approve_level'] == 2) {
			switch ($field["lh_flag"]){
				case (null) :
					$actionLH .= '<button class="btn btn-success waves-effect waves-light btn-sm btn-block" onclick="setApproveLh(\''.$field["id"].'\',\'approve\')" type="button" ><i class="fa fa-check"></i> Setuju</button>';
					$actionLH .= '<button class="btn btn-warning waves-effect waves-light btn-sm btn-block" onclick="setApproveLh(\''.$field["id"].'\',\'reject\')" type="button" ><i class="fa fa-close"></i> Ditolak</button>';
					break ;
				case (1) :
					$actionLH .= 'Disetujui';
					break ;
				case (0) :
					$actionLH .= 'Ditolak';
					break ;
			}
		}
	///////////////////////end check for local heroes//////////////////////////////////////
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field['kanwil'];
			$row[] = $field['kanca'];
			$row[] = $field['uker'];
			$row[] = $field['kelompok_usaha'] . ( $field['lh_flag'] == 1 ? '<i class="fa fa-check" style="color:green"></i>' : '');
			$row[] = $field['kelompok_jumlah_anggota'] . " / " . $totalanggota[0]['sum'];
			$row[] = count($jenis_usaha) > 0 ? $jenis_usaha[0]['nama_cluster_jenis_usaha'] : $field['id_cluster_jenis_usaha'];
			$row[] = $field['hasil_produk'];
			if ($this->session->userdata['approve_level'] == 2) $row[]= $actionLH;
            $row[] = $colstatus;
            $row[] = '<form action="cluster/cluster_anggota" target="_blank" method="POST"><input type="hidden" name="kelompok_usaha" value="' . $field['kelompok_usaha'] . '">' . $action . '</form>';
			$data[] = $row;
		}
		$output = array(
			"draw" => $this->input->post('draw'),
			"recordsTotal" => count($list),
			"recordsFiltered" => json_decode($this->sending->send($urlCountDataField, $postDataFields), true),
			"data" => $data,
		);
		echo json_encode($output);
	}


	function getClusterInfo()
	{
		$id = $this->input->post("id");
		if (isset($id)) {
			$url = "cluster/getClusterInfo";
			$postClusterInfo = Array (
				'id'=> $id
			);
			$postClusterInfo = json_encode($postClusterInfo);
			$clusterInfo 	= json_decode($this->sending->send($url, $postClusterInfo), true);
			$clusterInfo["uker"] = empty($clusterInfo["uker"]) ? "-" : $clusterInfo["uker"];
			$clusterInfo["kaunit_nama"] = empty($clusterInfo["kaunit_nama"]) ? "-" : $clusterInfo["kaunit_nama"];
			$clusterInfo["kaunit_handphone"] = empty($clusterInfo["kaunit_handphone"]) ? "-" : $clusterInfo["kaunit_handphone"];
			$clusterInfo["nama_pekerja"] = empty($clusterInfo["nama_pekerja"]) ? "-" : $clusterInfo["nama_pekerja"];
			$clusterInfo["handphone_pekerja"] = empty($clusterInfo["handphone_pekerja"]) ? "-" : $clusterInfo["handphone_pekerja"];
			$clusterInfo["kelompok_usaha"] = empty($clusterInfo["kelompok_usaha"]) ? "-" : $clusterInfo["kelompok_usaha"];
			$clusterInfo["kelompok_pihak_pembeli"] = empty($clusterInfo["kelompok_pihak_pembeli"]) ? "-" : $clusterInfo["kelompok_pihak_pembeli"];
			$clusterInfo["kelompok_pihak_pembeli_handphone"] = empty($clusterInfo["kelompok_pihak_pembeli_handphone"]) ? "-" : $clusterInfo["kelompok_pihak_pembeli_handphone"];
			$clusterInfo["kelompok_suplier_produk"] = empty($clusterInfo["kelompok_suplier_produk"]) ? "-" : $clusterInfo["kelompok_suplier_produk"];
			$clusterInfo["kelompok_suplier_handphone"] = empty($clusterInfo["kelompok_suplier_handphone"]) ? "-" : $clusterInfo["kelompok_suplier_handphone"];
			$clusterInfo["kelompok_jumlah_anggota"] = empty($clusterInfo["kelompok_jumlah_anggota"]) ? "-" : $clusterInfo["kelompok_jumlah_anggota"];
			$clusterInfo["kelompok_cerita_usaha"] = empty($clusterInfo["kelompok_cerita_usaha"]) ? "-" : $clusterInfo["kelompok_cerita_usaha"];
			$clusterInfo["kelompok_perwakilan"] = empty($clusterInfo["kelompok_perwakilan"]) ? "-" : $clusterInfo["kelompok_perwakilan"];
			$clusterInfo["kelompok_handphone"] = empty($clusterInfo["kelompok_handphone"]) ? "-" : $clusterInfo["kelompok_handphone"];
			$clusterInfo["lokasi_usaha"] = empty($clusterInfo["lokasi_usaha"]) ? "-" : $clusterInfo["lokasi_usaha"];
			$clusterInfo["agen_brilink"] = empty($clusterInfo["agen_brilink"]) ? "-" : $clusterInfo["agen_brilink"];
			$clusterInfo["simpanan_bank"] = empty($clusterInfo["simpanan_bank"]) ? "-" : $clusterInfo["simpanan_bank"];
			$clusterInfo["pinjaman"] = empty($clusterInfo["pinjaman"]) ? "-" : $clusterInfo["pinjaman"];
			$clusterInfo["varian"] = empty($clusterInfo["varian"]) ? "-" : $clusterInfo["varian"];
			$clusterInfo["kapasitas_produksi"] = empty($clusterInfo["kapasitas_produksi"]) ? "-" : $clusterInfo["kapasitas_produksi"];
			$clusterInfo["periode_panen"] = empty($clusterInfo["periode_panen"]) ? "-" : $clusterInfo["periode_panen"];
			$clusterInfo["satuan_produksi"] = empty($clusterInfo["satuan_produksi"]) ? "-" : $clusterInfo["satuan_produksi"];
			$clusterInfo["longitude"] = $clusterInfo["longitude"] =="" ? "-" : $clusterInfo["longitude"];
			$clusterInfo["latitude"] = $clusterInfo["latitude"] =="" ? "-" : $clusterInfo["latitude"];
			$url = "cluster/getClusterPhotos";
			$clusterPhotos = json_decode($this->sending->send($url, $postClusterInfo), true);
			$url = "cluster/getClusterLhPhotos";
			$clusterLhPhotos = json_decode($this->sending->send($url, $postClusterInfo), true);
			$clusterInfo["photos"] = $clusterPhotos;
			$clusterInfo["LhPhotos"] = $clusterLhPhotos;
			echo json_encode($clusterInfo);
		}
	}

	public function cluster_anggota()
	{
		if ($this->input->post('id')!=null) {
			$id = $this->input->post("id");
			$url="cluster/getClusterInfo";
			$postDetilCluster = Array (
				'id'		=> $id,
			);
			$postDetilCluster = json_encode($postDetilCluster);
			$cluster = json_decode($this->sending->send($url, $postDetilCluster), true);

			$data['id']				= $cluster['id'];
			$data['kelompok_usaha']	= $cluster['kelompok_usaha'];
			$data['approval']		= $cluster['cluster_approval'];
			
			$data['content'] = 'cluster_anggota';
			$data['navbar'] = 'navbar';
			$data['sidebar'] = 'sidebar';
			$this->load->view('template', $data);
		} else {
			echo "<script>alert('ups, ada kesalahan')</script>";
			redirect('cluster', 'refresh');
		}
	}

	public function deldata()
	{
		$url="cluster/delCluster";
		$postDelCluster = Array (
			'idcluster'		=> $this->input->post('id'),
			'iduser'	=> $this->session->userdata('id')
		);
		$postDelCluster = json_encode($postDelCluster);
		$data=json_decode($this->sending->send($url, $postDelCluster), true);
	}

	public function cekuker()
	{
		if ($this->input->post('kode_uker') != "") {
			$url="cluster/getUkerByKodeUker";
			$postGetDataUker = Array (
				'kode_uker'		=> $this->input->post('kode_uker'),
				'permission'	=> $this->session->userdata('permission'),
			);
			$postGetDataUker = json_encode($postGetDataUker);
			$data=json_decode($this->sending->send($url, $postGetDataUker), true);
			if ($data != false) {
				echo json_encode($data[0]['BRDESC']);
			} else echo json_encode("data uker tidak ditemukan");
		}
	}



	public function getprovinsi()
	{
		$url = "cluster/getProvinsi";
		$data=json_decode($this->sending->send($url), true);
		echo json_encode($data);
	}

	public function getkotakab($select = null)
	{
		$url="cluster/getDataKotaKab";
		$postGetData = Array (
			'provinsi_id'		=> $this->input->post('provinsi_id'),
		);
		$postGetData = json_encode($postGetData);
		echo $this->sending->send($url, $postGetData);
	}

	public function getkecamatan()
	{
		$url="cluster/getDataKecamatan";
		$postGetData = Array (
			'kabupaten_kota_id'		=> $this->input->post('kabupaten_kota_id'),
		);
		$postGetData = json_encode($postGetData);
		echo $this->sending->send($url, $postGetData);
	}
	public function getkelurahan()
	{
		$url="cluster/getDataKelurahan";
		$postGetData = Array (
			'kecamatan_id'		=> $this->input->post('kecamatan_id'),
		);
		$postGetData = json_encode($postGetData);
		echo $this->sending->send($url, $postGetData);
	}

	public function inputdata()
	{
		$rfku = null;
		$rfex = null;
		$rflh = null;
		
		if (count($this->input->post('efku')) > 0) {
			$z = 0;
			for ($i = 0; $i < count($this->input->post('efku')); $i++) {
				
				if (isset($_POST['rfku'])){
					if ($this->input->post('rfku')[$i] != "") {
						$rfku[$z] = $this->camphotoupload($this->input->post('rfku')[$i], $this->input->post('tfku')[$i]);
						$z++;
					}
				} else {
					if ($this->input->post('efku')[$i] != "") {
						$rfku[$z] = $this->input->post('efku')[$i];
						$z++;
					}
				}
				echo $z;
			}
			unset($_POST['rfku']);
			unset($_POST['tfku']);
			unset($_POST['efku']);
		}

		if (isset($_POST['efex'])){
			if (count($_POST['efex']) > 0) {
				$z = 0;
				for ($i = 0; $i < count($_POST['efex']); $i++) {
					if ($_POST['rfex'][$i] != "") {
						$rfex[$z] = $this->camphotoupload($_POST['rfex'][$i], $_POST['tfex'][$i]);
						$z++;
					} else {
						if ($_POST['efex'][$i] != "") {
							$rfex[$z] = $_POST['efex'][$i];
							$z++;
						}
					}
					echo $z;
				}
				unset($_POST['rfex']);
				unset($_POST['tfex']);
				unset($_POST['efex']);
			}
		}

		
		if (isset($_POST['eflh'])){
		
			if (count($_POST['eflh']) > 0) {
				$z = 0;
				for ($i = 0; $i < count($_POST['eflh']); $i++) {
					if ($_POST['rflh'][$i] != "") {
						$rflh[$z] = $this->camphotoupload($_POST['rflh'][$i], $_POST['tflh'][$i]);
						$z++;
					} else {
						if ($_POST['eflh'][$i] != "") {
							$rflh[$z] = $_POST['eflh'][$i];
							$z++;
						}
					}
					echo $z;
				}
				unset($_POST['rflh']);
				unset($_POST['tflh']);
				unset($_POST['eflh']);
			}
		}

		
		$postData = Array (
			'rfex'			=> $rfex,
			'rfku'			=> $rfku,
			'rflh'			=> $rflh,
			'data'			=> $this->input->post(),
			'kode_uker'		=> $this->session->userdata('kode_uker'),
			'permission'  	=> $this->session->userdata('permission'),
			'kode_kanwil'	=> $this->session->userdata('kode_kanwil'),
			'kode_kanca'	=> $this->session->userdata('kode_kanca'),
			'userid'		=> $this->session->userdata('id')
		);
		$postData = json_encode($postData);
		if ($this->input->post('id') != "") {
			$url="cluster/updateCluster";
			echo json_decode($this->sending->send($url, $postData), true);
		
		} else {
			$url="cluster/insertCluster";
			echo $url;
			echo json_decode($this->sending->send($url, $postData), true);
		}
	}


	public function getdata_s()
	{
		if (isset($_POST['id'])) {
			
			$postData = Array (
				'id' => $this->input->post('id')
			);
			$postData = json_encode($postData);
			
			$url = "cluster/getClusterByForm";
			$data['cluster'] = json_decode($this->sending->send($url, $postData), true);

			$url = "cluster/getClusterFotoUsaha";
			$data['rfku'] = json_decode($this->sending->send($url, $postData), true);
			
			$url = "cluster/getClusterDocEkspor";
			$data['rfex'] = json_decode($this->sending->send($url, $postData), true);
			
			$url = "cluster/getClusterFotoLocalHeroes";
			$data['rflh'] = json_decode($this->sending->send($url, $postData), true);
			echo json_encode($data);
		}
		
	}

	function get_hp(){
		$url = "cluster/getClusterHasilProduk";
		$postData = Array (
			'id_cluster_jenis_usaha' => $this->input->post('id_cluster_jenis_usaha')
		);
		$postData = json_encode($postData);
		echo $this->sending->send($url, $postData);
	}

	function get_v(){
		$url = "cluster/getClusterVarian";
		$postData = Array (
			'hasil_produk' => $this->input->post('hasil_produk')
		);
		$postData = json_encode($postData);
		echo $this->sending->send($url, $postData);
	}

	public function setapproved(){
		if ($this->input->post('id')!=null){
			$url = "cluster/postClusterApproval";
			$postData = Array (
				'id' 		=> $this->input->post('id'),
				'status' 	=> $this->input->post('status'),
				'kode_uker' =>  $this->session->userdata('kode_uker')
			);
			$postData = json_encode($postData);
			echo $this->sending->send($url, $postData);
		}
	}

	public function setreject(){
		$url = "cluster/postClusterReject";
		$postData = Array (
			'id' 				=> $this->input->post('id'),
			'status' 			=> $this->input->post('status'),
			'reject_reason' 	=> $this->input->post('reject_reason'),
			'kode_uker' 		=>  $this->session->userdata('kode_uker')
		);
		$postData = json_encode($postData);
		echo $this->sending->send($url, $postData);
	}

	function getClusterLHInfo()
	{
		$id = $this->input->post("id");
		if (isset($id)) {
			$postData = Array (
				'id' => $this->input->post('id')
			);
			$postData = json_encode($postData);
			
			$url = "cluster/getClusterLocalHeroes";
			$clusterInfo = json_decode($this->sending->send($url, $postData), true);

			$clusterInfo["kelompok_usaha"] = empty($clusterInfo["kelompok_usaha"]) ? "-" : $clusterInfo["kelompok_usaha"];
			$clusterInfo["kelompok_jumlah_anggota"] = empty($clusterInfo["kelompok_jumlah_anggota"]) ? "-" : $clusterInfo["kelompok_jumlah_anggota"];
			$clusterInfo["kelompok_perwakilan"] = empty($clusterInfo["kelompok_perwakilan"]) ? "-" : $clusterInfo["kelompok_perwakilan"];
			$clusterInfo["lokasi_usaha"] = empty($clusterInfo["lokasi_usaha"]) ? "-" : $clusterInfo["lokasi_usaha"];
			$url = "cluster/getClusterFotoLocalHeroes";
			$clusterPhotos =  json_decode($this->sending->send($url, $postData), true);
			$clusterInfo["photos"] = $clusterPhotos;
			echo json_encode($clusterInfo);
		}
	}

	public function getdata_anggota()
	{

		$url = "cluster/getDataFieldClusterAnggota";
		$urlcount="cluster/getCountDataFieldClusterAnggota";
		$postData = Array (
			'post' 		=> $this->input->post(),
			'kode_uker' =>  $this->session->userdata('kode_uker')
		);
		$postData = json_encode($postData);
		$list = json_decode ($this->sending->send($url, $postData),true);


		$data = array();
		$no = $this->input->post('start');
		foreach ($list as $field) {
			$del = '<button class="btn bg-maroon waves-effect waves-light btn-sm" onclick="deldata_anggota(\'' . $field['id_ca'] . '\')" type="button" ><i class="fa fa-close"></i> Hapus</button>';
			$update = '<button class="btn btn-success waves-effect waves-light btn-sm" onclick="getform_anggota(\'' . $field['id_ca'] . '\')" type="button" ><i class="fa fa-pencil"></i> Update</button>';
			$action = ($this->session->userdata('kode_uker') == 'kanpus' ? '' : $update . $del);
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field['ca_nama'];
			$row[] = "-";
			$row[] = "-";
			$row[] = $field['ca_jk'];
			$row[] = $field['ca_kodepos'];
			$row[] = $field['ca_pinjaman'];
			$row[] = $field['ca_simpanan'];
			$row[] = "-";
			$row[] = $action;
			$data[] = $row;
		}
		
		$output = array(
			"draw" => $this->input->post('draw'),
			"recordsTotal" => count($list),
			"recordsFiltered" => json_decode($this->sending->send($urlcount, $postData),true),
			"data" => $data,
		);
		echo json_encode($output);
	}


	public function cekkpos()
	{
		if ($this->input->post('kodepos') != "") {

			$url = "cluster/getDataKodePos";
			$postData = Array (
				'kodepos' 		=> $this->input->post('kodepos'),
			);
			$postData = json_encode($postData);
			$data = json_decode ($this->sending->send($url, $postData),true);
			if ($data != false) {
				echo json_encode($data[0]);
			} else echo json_encode("false");
		}
	}


	public function cekKtpAnggota(){
		if ($this->input->post('ktp') != "") {

			$url = "cluster/getClusterDataAnggotaByNIK";
			$postData = Array (
				'ktp' 		=> $this->input->post('ktp'),
			);
			$postData = json_encode($postData);
			$data = json_decode ($this->sending->send($url, $postData),true);

			if ($data[0]['result'] == 0) {
				echo json_encode("true");
			} else echo json_encode("false");
		}
	}


	
	public function inputdata_anggota()
	{
		$postData = Array (
			'data'		=> $this->input->post(),
			'kode_uker' => $this->session->userdata('kode_uker'),
			'id'		=> $this->session->userdata('id'),
		);
		$postData = json_encode($postData);

		if ($this->input->post('id_ca') != "") {
			$url = "cluster/updateClusterAnggota";
			json_decode ($this->sending->send($url, $postData),true);
			echo "udpate";
		} else {
			$url = "cluster/insertClusterAnggota";
			$data = json_decode ($this->sending->send($url, $postData),true);
			echo $data;
		}
		
	}


	public function deldata_anggota()
	{
		if ($this->input->post('id_ca') != "") {
			$url = "cluster/delClusterAnggota";
			$postData = Array (
				'id' 		=> $this->session->userdata('id'),
				'id_ca'		=> $this->input->post('id_ca'),
			);
			$postData = json_encode($postData);
			json_decode ($this->sending->send($url, $postData),true);
			return true;
		}
		else return false;
	}

	
	public function getdata_anggota_s()
	{
		if ($this->input->post('id_ca') != "") {
			$url = "cluster/getClusterAnggotaById";
			$postData = Array (
				'id_ca'		=> $this->input->post('id_ca'),
			);
			$postData = json_encode($postData);
			$data = json_decode ($this->sending->send($url, $postData),true);
			echo json_encode($data);
		}
		else return false;	
	}

	public function approve()
	{
        $data['navbar'] = 'navbar';
        $data['sidebar'] = 'sidebar';
		
		$url = "cluster/getClusterSektorUsaha";
		$data['cluster_sektor_usaha'] = json_decode($this->sending->send($url), true); 

			
		$url = "cluster/getprovinsi";
		$data['provinsi'] = json_decode($this->sending->send($url), true); 

		$url = "cluster/getClusterKebutuhanPendidikanPelatihan";
		$data['cluster_kebutuhan_pendidikan_pelatihan'] = json_decode($this->sending->send($url), true); 

		$url = "cluster/getClusterKebutuhanSarana";
		$data['cluster_kebutuhan_sarana'] = json_decode($this->sending->send($url), true); 

		$url = "cluster/getClusterKebutuhanSkemaKredit";
		$data['cluster_kebutuhan_skema_kredit'] = json_decode($this->sending->send($url), true); 

		$data['content'] = $this->session->userdata('kode_uker') == 'kanpus' ? '' : 'cluster_approve_v';
		
		$this->load->view('template', $data);
    }

	public function get_clusterapproved(){

		$dataTable=$this->input->post();
       	$url = "cluster/getDataField";
		$urlCountAnggota = "cluster/getCountAnggota";
		$urlJenisUsahaById = "cluster/getJenisUsahaById";
		$urlGetClusterChecker = "cluster/getUkerByBranch";
		$urlGetClusterSigner = "cluster/getUkerByBranch";
		$urlCountDataField = "cluster/getCountDataField";
		$postDataFields = Array (
			'dataTable'		=> $dataTable,
			'status'		=> true,
			'permission'  	=> $this->session->userdata('permission'),
			'approve_level' => $this->session->userdata('approve_level'),
			'kode_kanwil'	=> $this->session->userdata('kode_kanwil'),
			'kode_kanca'	=> $this->session->userdata('kode_kanca'),
			'kode_uker'		=> $this->session->userdata('kode_uker'),
			'approved'		=> true,
		);

		$postDataFields = json_encode($postDataFields);
		$list = json_decode($this->sending->send($url, $postDataFields), true);

		$no = $this->input->post('start');
		$data = array();
		foreach ($list as $field) {

			$postCountDataAnggota = Array (
				'id'		=> $field['id'],
			);
			$postCountDataAnggota = json_encode($postCountDataAnggota);
			$totalanggota = json_decode($this->sending->send($urlCountAnggota, $postCountDataAnggota), true);
			
			$postJenisUsahaById = Array (
				'id'		=> $field['id_cluster_jenis_usaha'],
			);
			$postJenisUsahaById = json_encode($postJenisUsahaById);
			$jenis_usaha = json_decode($this->sending->send($urlJenisUsahaById, $postJenisUsahaById), true);

			$info		= '<button class="btn btn-default waves-effect waves-light btn-sm btn-block" onclick="showClusterInfo(\'' . $field['id'] . '\')" type="button"><i class="fa fa-info"></i> Info</button>';
			$ca 	    = '<button class="btn btn-info waves-effect waves-light btn-sm btn-block" name="id" value="' . $field['id'] . '" type="submit" ><i class="fa fa-users"></i> Anggota</button>';

			

			if ($field['kode_uker'] == $this->session->userdata('kode_uker') || $field['userinsert'] == $this->session->userdata('kode_uker') ){
				$update     = '<button class="btn btn-success waves-effect waves-light btn-sm btn-block" onclick="getform(\'' . $field['id'] . '\');" type="button" ><i class="fa fa-pencil"></i> Update</button>';
			}
			else {
				if ($this->session->userdata('permission')>3){
					$update     = '<button class="btn btn-success waves-effect waves-light btn-sm btn-block" onclick="getform(\'' . $field['id'] . '\');" type="button" ><i class="fa fa-pencil"></i> Update</button>';
				}
				else {
					$update ="";
				}
			}
			$del 	    = '<button class="btn btn-danger waves-effect waves-light btn-sm btn-block" onclick="deldata(\'' . $field['id'] . '\')" type="button" ><i class="fa fa-close"></i> Hapus</button>';
			$action     =  $info . $ca . ($this->session->userdata('kode_uker') == 'kanpus' ? '' : $update.$del);

			$actionLH='<button class="btn btn-info waves-effect waves-light btn-sm btn-block" onclick="showClusterLHInfo(\'' . $field['id'] . '\')" type="button"><i class="fa fa-info"></i> Info Local Heroes</button>';;
			if ($this->session->userdata['approve_level'] == 2) {
				switch ($field["lh_flag"]){
					case (null) :
						$actionLH .= '<button class="btn btn-success waves-effect waves-light btn-sm btn-block" onclick="setApproveLh(\''.$field["id"].'\',\'approve\')" type="button" ><i class="fa fa-check"></i> Setuju</button>';
						$actionLH .= '<button class="btn btn-warning waves-effect waves-light btn-sm btn-block" onclick="setApproveLh(\''.$field["id"].'\',\'reject\')" type="button" ><i class="fa fa-close"></i> Ditolak</button>';
						break ;
					case (1) :
						$actionLH .= 'Disetujui';
						break ;
					case (0) :
						$actionLH .= 'Ditolak';
						break ;
				}
			}

			$late=($field["timestamp"] < time()-15780000 ? '<i class="fa fa-warning" style="color:orange"></i> <p style="display:none;"> warning </p>' : "");


			$no++; 
			$row = array();
			$row[] = $no . $late ;
			$row[] = $field['kanwil'];
			$row[] = $field['kanca'];
			$row[] = $field['uker'];
			$row[] = $field['kelompok_usaha'] . ( $field['lh_flag'] == 1 ? '<i class="fa fa-check" style="color:green"></i>' : '');
			$row[] = $field['kelompok_jumlah_anggota'] . " / " . $totalanggota[0]['sum'];
			$row[] = count($jenis_usaha) > 0 ? $jenis_usaha[0]['nama_cluster_jenis_usaha'] : $field['id_cluster_jenis_usaha'];
			$row[] = $field['hasil_produk'];
			if ($this->session->userdata['approve_level'] == 2) $row[]= $actionLH;
			$row[] = '<form action="cluster/cluster_anggota" target="_blank" method="POST"><input type="hidden" name="kelompok_usaha" value="' . $field['kelompok_usaha'] . '">' . $action . '</form>';
			$data[] = $row;
		}

		$output = array(
			"draw" => $this->input->post('draw'),
			"recordsTotal" => count($list),
			"recordsFiltered" => json_decode($this->sending->send($urlCountDataField, $postDataFields), true),
			"data" => $data,
		);
		echo json_encode($output);
	}



	public function getreport($harian = "")
	{
		
		$url = "cluster/getReportCluster";
		$postData = Array (
			'permission'  	=> $this->session->userdata('permission'),
			'kode_kanwil'	=> $this->session->userdata('kode_kanwil'),
			'kode_kanca'	=> $this->session->userdata('kode_kanca'),
			'kode_uker'		=> $this->session->userdata('kode_uker'),
		);
		$postData = json_encode($postData);
		$get = json_decode($this->sending->send($url, $postData), true);
		$data['kanwil'] = $get['kanwil'];
		$data['listkategori'] = $get['listkategori'];
		$data['total']	= $get['total'];

		$data['harian'] = $harian;
		$data['navbar'] = 'navbar';
		$data['sidebar'] = 'sidebar';
		$data['content'] = 'cluster_report_v';
		$this->load->view('template', $data);
	}



	public function report_kanca()
	{
		
		$url = "cluster/getReportClusterForKanca";
		$postData = Array (
			'permission'  	=> $this->session->userdata('permission'),
			'kode_kanwil'	=> $this->session->userdata('kode_kanwil'),
			'kode_kanca'	=> $this->session->userdata('kode_kanca'),
			'kode_uker'		=> $this->session->userdata('kode_uker'),
		);
		$postData = json_encode($postData);
		$get = json_decode($this->sending->send($url, $postData), true);

		$pdata['data'] = $get['data'];
		$pdata['navbar'] = 'navbar';
		$pdata['sidebar'] = 'sidebar';
		$pdata['content'] = 'cluster_report_kanca_v';
		$this->load->view('template', $pdata);
	}

	public function report_anggota()
	{
		$url = "cluster/getReportClusterAnggota";
		$postData = Array (
			'permission'  	=> $this->session->userdata('permission'),
			'kode_kanwil'	=> $this->session->userdata('kode_kanwil'),
			'kode_kanca'	=> $this->session->userdata('kode_kanca'),
			'kode_uker'		=> $this->session->userdata('kode_uker'),
		);
		$postData = json_encode($postData);
		$pdata['anggota'] = json_decode($this->sending->send($url, $postData), true);
		$pdata['navbar'] = 'navbar';
		$pdata['sidebar'] = 'sidebar';
		$pdata['content'] = 'cluster_report_anggota_v';
		$this->load->view('template', $pdata);
	}

	public function report_local_heroes()
	{
		$url = "cluster/getReportClusterLocalHeroes";
		$postData = Array (
			'permission'  	=> $this->session->userdata('permission'),
			'kode_kanwil'	=> $this->session->userdata('kode_kanwil'),
			'kode_kanca'	=> $this->session->userdata('kode_kanca'),
			'kode_uker'		=> $this->session->userdata('kode_uker'),
			'case'			=> $this->input->post('case'),
			'REGION'			=> $this->input->post('REGION')
		);
		$postData = json_encode($postData);
		$pdata['klaster'] = json_decode($this->sending->send($url, $postData), true);

		$pdata['navbar'] = 'navbar';
		$pdata['sidebar'] = 'sidebar';
		$pdata['content'] = 'cluster_report_local_heroes_v';
		$this->load->view('template', $pdata);
	}

	public function dldata()
	{
		$url = "cluster/getDownloadReportCluster";
		$postData = Array (
			'permission'  	=> $this->session->userdata('permission'),
			'kode_kanwil'	=> $this->session->userdata('kode_kanwil'),
			'kode_kanca'	=> $this->session->userdata('kode_kanca'),
			'kode_uker'		=> $this->session->userdata('kode_uker'),
			'kanwil'			=> $this->input->post('kanwil'),
		);
		$postData = json_encode($postData);
		echo $this->sending->send($url, $postData);
	}


	public function dlDataPengajuan()
	{
		$url = "cluster/getDownloadClusterPengajuan";
		$postData = Array (
			'permission'  	=> $this->session->userdata('permission'),
			'kode_kanwil'	=> $this->session->userdata('kode_kanwil'),
			'kode_kanca'	=> $this->session->userdata('kode_kanca'),
			'kode_uker'		=> $this->session->userdata('kode_uker'),
			'kanwil'			=> $this->input->post('kanwil'),
		);
		$postData = json_encode($postData);
		echo $this->sending->send($url, $postData);
	}

	public function dldataanggota()
	{	

	}


	public function dldatareportanggota()
	{
		$url = "cluster/getDownloadReportClusterAnggota";
		$postData = Array (
			'permission'  	=> $this->session->userdata('permission'),
			'kode_kanwil'	=> $this->input->post('kode_kanwil'),
		);
		$postData = json_encode($postData);
		echo $this->sending->send($url, $postData);
	}

	public function dldatareportlocalheroes()
	{

		$url = "cluster/getDownloadReportClusterLocalHeroes";
		$postData = Array (
			'permission'  	=> $this->session->userdata('permission'),
			'kode_kanwil'	=> $this->input->post('kode_kanwil'),
		);
		$postData = json_encode($postData);
		echo $this->sending->send($url, $postData);
	}














	
	////////////////////////////////////////////////////////////
	///////////////////////////OLD//////////////////////////////
	////////////////////////////////////////////////////////////


	public function report_kanca_detail()
	{
		$pdata = array();
		$data['kanwil'] = array();
		$z = array();
		foreach ($this->cluster_m->get_data_kanwil_m() as $row) {
			foreach ($this->cluster_m->report_kc_count_m($row['kode_kanwil']) as $srow) {
				if (!isset($z[$row['kode_kanwil']][$srow['kode_kanca']])) $z[$row['kode_kanwil']][$srow['kode_kanca']] = 0;
				$z[$row['kode_kanwil']][$srow['kode_kanca']]++;
			};
		}
		$i = 1;
		$table = "";
		foreach ($this->cluster_m->report_kc_m() as $srow) {
			if (!isset($z[$srow['REGION']][$srow['BRANCH']])) {
				if ($_POST['case'] == 'kosong') {
					$table .= '<tr><td>' . $i . '</td>
										<td>' . $srow['BRDESC'] . '</td>
										<td>0</td></tr>';
					$i++;
				}
			} else if ($z[$srow['REGION']][$srow['BRANCH']] < 3) {
				if ($_POST['case'] == 'sebagian') {
					$table .= '<tr><td>' . $i . '</td>
										<td>' . $srow['BRDESC'] . '</td>
										<td>' . $z[$srow['REGION']][$srow['BRANCH']] . '</td></tr>';
					$i++;
				}
			} else if ($z[$srow['REGION']][$srow['BRANCH']] >= 1) {
				if ($_POST['case'] == 'terisi') {
					$table .= '<tr><td>' . $i . '</td>
										<td>' . $srow['BRDESC'] . '</td>
										<td>' . $z[$srow['REGION']][$srow['BRANCH']] . '</td></tr>';
					$i++;
				}
			}
		}
		echo '<table class="table table-striped table-bordered" style="width:100%">
						<thead>
							<tr>
								<th>No</th>
								<th>Kanca</th>
								<th>Total Isian</th>
							</tr>
						</thead>
						<tbody>' . $table . '
						</tbody>
					 </table>';
	}

















	

	



	

	public function countpengajuan(){
		$data = $this->cluster_m->get_datafield()->num_rows();
		return $data;
	}

	
   
    ////////////////////////////////////////////////////////////
    /////////////////end pengajuan klaster usaha ///////////////
    ////////////////////////////////////////////////////////////


    ////////////////////////////////////////////////////////////
    /////////////////get approved klaster usaha ////////////////
    ////////////////////////////////////////////////////////////


    
   

	
    ////////////////////////////////////////////////////////////
    /////////////////end get approved klaster usaha ////////////
    ////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////
    /////////////////start Input data klaster////// ////////////
    ////////////////////////////////////////////////////////////
  

	

	

	



	public function approveLh(){
		$this->cluster_m->approveLh_m();
	}

	////////////////////////////////////////////////////////////
    /////////////////end input data klaster /////// ////////////
    ////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////
    /////////////////start get report Data klaster ////////////
    ////////////////////////////////////////////////////////////




	
	public function report_unit()
	{
		$pdata = array();
		$data['kanwil'] = array();
		$z = array();
		foreach ($this->cluster_m->get_data_kanwil_m() as $row) {
			foreach ($this->cluster_m->report_unit_count_m($row['kode_kanwil']) as $srow) {
				(isset($z[$row['kode_kanwil']][$srow['kode_uker']])) ? $z[$row['kode_kanwil']][$srow['kode_uker']]++ : $z[$row['kode_kanwil']][$srow['kode_uker']] = 1;
			};
		}
		$i = 0;
		foreach ($this->cluster_m->report_unit_m() as $srow) {
			$pdata['data'][$srow['REGION']]['RGDESC'] = $srow['RGDESC'];
			$pdata['data'][$srow['REGION']]['REGION'] = $srow['REGION'];
			if (!isset($z[$srow['REGION']][$srow['BRANCH']])) {
				(isset($pdata['data'][$srow['REGION']]['kosong'])) ? $pdata['data'][$srow['REGION']]['kosong']++ : $pdata['data'][$srow['REGION']]['kosong'] = 1;
			} else {
				if ($z[$srow['REGION']][$srow['BRANCH']] == 1) {
					(isset($pdata['data'][$srow['REGION']]['isi_sebagian'])) ? $pdata['data'][$srow['REGION']]['isi_sebagian']++ : $pdata['data'][$srow['REGION']]['isi_sebagian'] = 1;
				}
				if ($z[$srow['REGION']][$srow['BRANCH']] > 1) {
					(isset($pdata['data'][$srow['REGION']]['terisi'])) ? $pdata['data'][$srow['REGION']]['terisi']++ : $pdata['data'][$srow['REGION']]['terisi'] = 1;
				}
			}
			$i++;
		}
		$pdata['navbar'] = 'navbar';
		$pdata['sidebar'] = 'sidebar';
		$pdata['content'] = 'cluster_report_unit_v';
		$this->load->view('template', $pdata);
	}

	public function report_unit_detail()
	{
		$pdata = array();
		$data['kanwil'] = array();
		$z = array();
		foreach ($this->cluster_m->get_data_kanwil_m() as $row) {
			foreach ($this->cluster_m->report_unit_count_m($row['kode_kanwil']) as $srow) {
				if (!isset($z[$row['kode_kanwil']][$srow['kode_uker']])) $z[$row['kode_kanwil']][$srow['kode_uker']] = 0;
				$z[$row['kode_kanwil']][$srow['kode_uker']]++;
			};
		}
		$i = 1;
		$table = "";
		foreach ($this->cluster_m->report_unit_m() as $srow) {
			if (!isset($z[$srow['REGION']][$srow['BRANCH']])) {
				if ($_POST['case'] == 'kosong') {
					$table .= '<tr><td>' . $i . '</td>
										<td>' . $srow['MBDESC'] . '</td>
										<td>' . $srow['BRDESC'] . '</td>
										<td>0</td></tr>';
					$i++;
				}
			} else if ($z[$srow['REGION']][$srow['BRANCH']] == 1) {
				if ($_POST['case'] == 'sebagian') {
					$table .= '<tr><td>' . $i . '</td>
										<td>' . $srow['MBDESC'] . '</td>
										<td>' . $srow['BRDESC'] . '</td>
										<td>' . $z[$srow['REGION']][$srow['BRANCH']] . '</td></tr>';
					$i++;
				}
			} else if ($z[$srow['REGION']][$srow['BRANCH']] > 1) {
				if ($_POST['case'] == 'terisi') {
					$table .= '<tr><td>' . $i . '</td>
										<td>' . $srow['MBDESC'] . '</td>
										<td>' . $srow['BRDESC'] . '</td>
										<td>' . $z[$srow['REGION']][$srow['BRANCH']] . '</td></tr>';
					$i++;
				}
			}
		}
		echo '<table class="table table-striped table-bordered" style="width:100%">
						<thead>
							<tr>
								<th>No</th>
								<th>Kanca</th>
								<th>Unit</th>
								<th>Total Isian</th>
							</tr>
						</thead>
						<tbody>' . $table . '
						</tbody>
					 </table>';
	}

	

	



	

	

	



	
	////////////////////////////////////////////////////////////
    ///////////////////////end report //////////////////////////
    ////////////////////////////////////////////////////////////


	

	
	/////////////////////////////////////////////////////////////////////////////
	///////////////////////////cluster anggota
	////////////////////////////////////////////////////////////////////////////////////////////////////////////

	

	

	
	public function inputanggotacsv()
	{
		$anggota = json_decode($_POST['anggota'], true);
		$this->cluster_m->inputanggotacsv_m($anggota);
	}


	public function custom_search()
	{
		$data['kanwil'] = $this->cluster_m->get_data_kanwil_m();
		$data['navbar'] = 'navbar';
		$data['sidebar'] = 'sidebar';
		$data['content'] = 'cluster_custom_search_v';
		$this->load->view('template', $data);
	}

	public function getdatacustom($status = null)
	{
		if ($this->session->userdata('permission') >= 3) {
			$list = $this->cluster_m->get_datafield_custom($status, json_decode($_POST['custom_field']));
			$data = array();
			$no = $_POST['start'];
			foreach ($list->result_array() as $field) {
				$totalanggota = $this->cluster_m->countanggota_m($field['id']);
				$jenis_usaha  = $this->cluster_m->getdata_j($field['id_cluster_jenis_usaha']);
				$del = '<button class="btn btn-danger waves-effect waves-light btn-sm btn-block" onclick="deldata(\'' . $field['id'] . '\')" type="button" ><i class="fa fa-close"></i> Hapus</button>';
				$ca  = '<button class="btn btn-info waves-effect waves-light btn-sm btn-block" name="id" value="' . $field['id'] . '" type="submit" ><i class="fa fa-users"></i> Anggota</button>';
				$update = '<button class="btn btn-success waves-effect waves-light btn-sm btn-block" onclick="getform(\'' . $field['id'] . '\')" type="button" ><i class="fa fa-pencil"></i> Update</button>';
				$upload = '<button class="btn btn-primary waves-effect waves-light btn-sm btn-block" onclick="upform(\'' . $field['id'] . '\')" type="button" ><i class="fa fa-upload"></i> Upload</button>';
				$info	= '<button class="btn btn-info waves-effect waves-light btn-sm btn-block" onclick="infocluster(\'' . $field['id'] . '\')" type="button" ><i class="fa fa-Info"></i> Info</button>';
				$action = $ca . ($this->session->userdata('kode_uker') == 'kanpus' ? '' : $update . $del);
				$no++;
				$row = array();
				$row[] = $no;
				$row[] = $field['kanwil'];
				$row[] = $field['kanca'];
				$row[] = $field['uker'];
				$row[] = $field['kelompok_usaha'];
				$row[] = $field['kelompok_jumlah_anggota'] . " / " . $totalanggota[0]['sum'];
				$row[] = count($jenis_usaha) > 0 ? $jenis_usaha[0]['nama_cluster_jenis_usaha'] : $field['id_cluster_jenis_usaha'];
				$row[] = $field['hasil_produk'];
				if ($status == null) {
					$row[] = "status on progress";
					$row[] = '<form action="cluster/cluster_anggota" target="_blank" method="POST"><input type="hidden" name="kelompok_usaha" value="' . $field['kelompok_usaha'] . '">' . $action . '</form>';
				} else {
					$row[] = $info;
				}
				$data[] = $row;
			}
			$output = array(
				"draw" => $_POST['draw'],
				"recordsTotal" => $list->num_rows(),
				"recordsFiltered" => $this->cluster_m->count_all_custom($status,  json_decode($_POST['custom_field'])),
				"data" => $data,
			);
			echo json_encode($output);

		} else redirect('dashboard');
	}



	

	function get_pendidikan()
	{
		$data = $this->cluster_m->get_cluster_kebutuhan_pendidikan_pelatihan();
		echo json_encode($data);
	}

	

	

	

	


	
	public function cekKtpCluster(){
		if ($_POST['ktp'] != "") {
			$data = $this->cluster_m->cekKtpCluster_m();
			if ($data[0]['result'] == 0) {
				echo json_encode("true");
			} else echo json_encode("false");
		}
	}
	
	private function camphotoupload($i = null, $j = null)
	{
		$encoded_data = $i;
		$binary_data = base64_decode($encoded_data);
		$url = "images/" . uniqid(rand()) . '.' . $j;
		//$_POST["foto"]=$url;
		//file_put_contents('http://www.ninadentalcare.com/'.$url, $binary_data);
		$result = file_put_contents($url, $binary_data);
		if (!$result) die("Could not save image!  Check file permissions.");
		else return './' . $url;
	}

	

	
	
	//////////////////cleansing data////////////////////
	// function clq(){
	// 	$q="select * from cluster_cek";
	// 	$s="";
	// 	$n=0;
	// 	$t=0;
	// 	$r=0;
	// 	foreach ($this->db->query($q)->result_array() as $row){
	// 		echo "id : ". $row['id'] ." || ".$row['kelompok_usaha'].' || '.$row['ketua_klaster'].' || '.$row['NIK'].' </br>';
	// 		$nq='select * from cluster_backup where kelompok_NIK like "%'.$row['NIK'].'%" and kelompok_handphone like "%'.$row['hp_ketua_kaster'].'%" and cluster_status=1 ';
	// 		$z=0;
	// 		foreach ($this->db->query($nq)->result_array() as $srow){
	// 			$this->db->insert('cluster',$srow);
	// 			// $this->db->query("delete from cluster where id='".$srow['id']."'");

	// 			echo 'id : '.$srow['id'].' || '.$srow['kelompok_usaha'].' || '.$srow['kelompok_perwakilan'].' || '.$srow['kelompok_NIK'].'</br>';
	// 			$z++;
	// 		}
	// 		if ($z==0) {
	// 			$t++;
	// 			$s .='no data with id '.$row['id'].'</br>';
	// 		}
			
	// 		elseif ($z==1){
	// 			$n++;
	// 			// $s .='data found id '.$row['id'].'</br>';
	// 		}
	// 		else {
	// 			$r++;
	// 			$s .='data duplicate '.$row['id'].'</br>';
	// 		}
	// 		echo '<hr></br>';
	// 	}
	// 	echo $n.'</br>';
	// 	echo $r.'</br>';
	// 	echo $t.'</br>';
	// 	echo $s;
	
	// }

	// /////////////////////set approve data///////////////////
		// function clap(){
		// 	$time=time();
		// 	$q="select * from cluster";
		// 	$r="SELECT a.username, b.REGION, b.BRDESC FROM user a 
		// 		left join branch b on a.username=b.BRANCH
		// 		where permission=3";
		// 	$r=$this->db->query($r)->result_array();
		// 	foreach ($this->db->query($q)->result_array()  as $row){
		// 		$kodekanwil="";
		// 		foreach ($r as $srow){
		// 				if ($srow['REGION'] == $row['kode_kanwil']) $kodekanwil=$srow['username'];
		// 		}
		// 		echo $nq;
		// 		$nq="update cluster set 
		// 				checker_status=1,
		// 				checker_user_update='".$kodekanwil."',
		// 				signer_status=1,
		// 				signer_user_update=2,
		// 				cluster_approval=1 
		// 				where id='".$row['id']."'";
		// 		$this->db->query($nq);
				
		// 	}
		// }
	
	

    // public function reqdenied(){
    //     $sql="	SELECT b.id, ca_nik, COUNT(ca_nik) as counting
	// 			FROM cluster_anggota a left join cluster b on a.id_cluster=b.id
	// 		  	where b.cluster_status=1 and cluster_approval=0 
	// 			GROUP BY ca_nik";
		
	// 	$status  = "reject_reason=' Terdapat duplikasi NIK pada list anggota klaster', ";
	// 	$status .= "checker_status=0, ";
	// 	$status .= "signer_status =0, ";
	// 	$status .= "checker_user_update = '". $this->session->userdata('kode_uker')."', ";
	// 	$status .= "signer_user_update = '". $this->session->userdata('kode_uker')."' ";

    //     foreach ($this->db->query($sql)->result_array() as $row){
	// 			echo $row['ca_nik']."</br>";
	// 			if ($row['counting'] > 1){
	// 				$z="update cluster set ".$status." where id='".$row['id']. "'";
	// 				$this->db->query($z);
	// 				echo $z."</br>";
	// 			}
    //         }
    //     }
}
