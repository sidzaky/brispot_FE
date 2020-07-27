<?php
/**
*
*
* @autor 
* @dzaky Hidayat
*
**/
?>
 
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cluster extends MX_Controller {

	public function __construct() {
        parent::__construct();
		
		$this->load->module('login'); 
		$this->login->is_logged_in();
		
		$this->load->model('cluster_m');
        $this->load->helper(array('url','form','html'));
    }
	
	public function index(){
		$data['content']='cluster_v';
		$this->load->view('template',$data);
		
	}
	
	public function getdata(){
		$list = $this->cluster_m->get_datafield();
        $data = array();
        $no = $_POST['start'];
        foreach ($list->result_array() as $field) {
			$del='<button class="btn btn-danger waves-effect waves-light btn-sm" onclick="deldata(\''.$field['id'].'\')" type="button" ><i class="fa fa-close"></i>Hapus</button>';
			
			$no++;
            $row = array();
			$row[] = $no;
			$row[] = $field['kanwil'];
			$row[] = $field['kanca'];
			$row[] = $field['uker'];
			// $row[] = $field['nama_pekerja'].'</br>'.'('.$field['personal_number'].')';
			$row[] = $field['kelompok_usaha'];
			$row[] = $field['kelompok_jumlah_anggota'];
			$row[] = $field['jenis_usaha'];
			$row[] = $field['hasil_produk'];
			$row[] = '<button class="btn btn-success waves-effect waves-light btn-sm" onclick="getform(\''.$field['id'].'\')" type="button" ><i class="fa fa-pencil"></i>Update</button>'.($this->session->userdata('permission')==4 ? $del : '');
			$data[] = $row;
		}
		$output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $list->num_rows(),
            "recordsFiltered" => $this->cluster_m->count_all(),
            "data" => $data,
        );
        echo json_encode($output);
	}
	
	public function deldata(){
		$this->cluster_m->deldata_m();
	}
	
	public function cekuker(){
		if ($_POST['kode_uker']!=""){
			$data=$this->cluster_m->cekuker_m();
			if ($data!=false){
					echo json_encode($data[0]['BRDESC']);
			}
			else echo json_encode("data uker tidak ditemukan");
		}
	}
	
	
	public function getdata_s(){
		if (isset($_POST['id'])){
				
				echo json_encode($this->cluster_m->getdata_m());
		}
	}
	
	public function inputdata(){
		switch ($_POST['jenis_usaha']) {
			case "Pertanian - Pangan" : 
			case "Pertanian - Hortikultura": 
			case "Pertanian - Perkebunan": 
				$_POST['jenis_usaha_map']="Pertanian";
				break;
			case "Peternakan" :	
				$_POST['jenis_usaha_map']="Peternakan";
				break;
			case "Perikanan" : 
				$_POST['jenis_usaha_map']="Perikanan";
				break;	
			case "Industri Makanan & Minuman" : 
				$_POST['jenis_usaha_map']="Industri Makanan & Minuman";
				break;
			case "Perdagangan Besar dan Eceran, bukan Mobil dan Sepeda" : 
				$_POST['jenis_usaha_map']="Perdagangan Besar dan Eceran, bukan Mobil dan Sepeda";
				break;
			case "Pariwisata" : 
				$_POST['jenis_usaha_map']="Pariwisata";
				break;
			default : 
				$_POST['jenis_usaha_map']="Lainnya";
				break;
		}
		
		$query=$this->cluster_m->cekuker_m();
		$_POST['kanwil']=$query[0]['RGDESC'];
		$_POST['kanca']=$query[0]['MBDESC'];
		$_POST['uker']=$query[0]['BRDESC'];
		$_POST['timestamp']=time();
		
		
		
		if ($_POST['id']!="") {
				$this->cluster_m->updatedata_m();
				echo "udpate";
		}
		else {
			$this->cluster_m->insertdata_m();
			echo "insert";
		}
	}
	
	
	public function getreport($harian=""){
		ini_set('memory_limit', '-1');
		$data['kanwil']=array();
		$q=$this->cluster_m->getreport_m($harian);
		$data['total']['Pariwisata']=0;
		//karena Mapping belum jelas maka dicheck satu persatu
		foreach ($q as $row){
			if ($row['kanwil']!=""){
				switch ($row['jenis_usaha']) {
						case "Pertanian - Pangan" : 
						case "Pertanian - Hortikultura": 
						case "Pertanian - Perkebunan": 
							$data['kanwil'][$row['kanwil']]['Pertanian']++;
							$data['total']['Pertanian']++;
							break;
						case "Peternakan" :
							$data['kanwil'][$row['kanwil']]['Peternakan']++;
							$data['total']['Peternakan']++;
							break;
						case "Perikanan" : 
							$data['kanwil'][$row['kanwil']]['Perikanan']++;
							$data['total']['Perikanan']++;
							break;	
						case "Industri Makanan & Minuman" : 
							$data['kanwil'][$row['kanwil']]['Industri Makanan & Minuman']++;
							$data['total']['Industri Makanan & Minuman']++;
							break;
						case "Perdagangan Besar dan Eceran, bukan Mobil dan Sepeda" : 
							$data['kanwil'][$row['kanwil']]['Perdagangan Besar dan Eceran, bukan Mobil dan Sepeda']++;
							$data['total']['Perdagangan Besar dan Eceran, bukan Mobil dan Sepeda']++;
							break;
						case "Pariwisata" :
							$data['kanwil'][$row['kanwil']]['Pariwisata']++;
							$data['total']['Pariwisata']++;
							break;
						default : 
							$data['kanwil'][$row['kanwil']]['Lainnya']++;
							$data['total']['Lainnya']++;
							break;
				}
			}
		}
		$data['harian']=$harian;
		$data['content']='cluster_report_v';
		$this->load->view('template',$data);
	}
	
	
	public function dldata($harian=null){
		ini_set('memory_limit', '-1');
			$headerexcel[0]=array (	'No', 'Waktu Input', 'kanwil', 'kanca', 
												"Kode Kanca", "Uker","Kode Uker","Nama Kaunit","PN Kaunit","Handphone Kaunit","Nama Mantri","PN Mantri","Handphone Mantri",
												"Nama Kelompok Usaha","Jumlah Anggota (orang)","Pinjaman anggota Kelompok","Lokasi Usaha","Kode Pos","Provinsi","Kabupaten/Kota","Kecamantan","Kelurahan",
												"Sektor Usaha","Jenis Usaha","Hasil Produk","Kategori Usaha", "Group Usaha", "Pasar Ekspor","Tahun Pasar Ekspor", 
												"Pihak Pembeli Produk/Jasa yang Dihasilkan", "Handphone Pihak Pembeli", "Suplier Bahan Baku Produk/Jasa yang Dihasilkan", "Handphone Suplier",
												"Luas Lahan/Tempat Usaha (m2)", "Omset Usaha Perbulan (total Kelompok - Rp)",
												"Nama Ketua Kelompok","Jenis Kelamin","NIK","Handphone Ketua Kelompok","Tanggal Lahir","Tempat lahir",
												"Punya Pinjaman", "Nominal Pinjaman BRI", "Norek Pinjaman BRI", "Kebutuhan Kredit",
												"Kebutuhan Sarana", "Kebutuhan Sarana Lainnya", "Kebutuhan Pendidikan",
												"Simpanan Bank", "Agen Brilink"); 
		
			$data=$this->cluster_m->getdataall_m($harian);
			$no=1;
			$z=1;
			foreach ($data as $cell ){
					$col=0;
					$headerexcel[$z][$col]=$no;
					foreach (array_keys($cell) as $key){
						$col++;
						$cell[$key]=str_replace(';',' ',$cell[$key]);
						$headerexcel[$z][$col]=$cell[$key];
					}
				$z++;
				$no++;
			}	
			
			echo json_encode($headerexcel);
	}
	
	
	public function cekkpos(){
		
		if ($_POST['kodepos']!=""){
			$data=$this->cluster_m->cekkpos_m();
			if ($data!=false){
					echo json_encode($data[0]);
			}
			else echo json_encode("false");
		}
		
		
	}
	
	
}
