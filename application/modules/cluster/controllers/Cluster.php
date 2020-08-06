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

		$this->load->model('cluster_m');
		$this->load->helper(array('url', 'form', 'html'));
	}

	public function index()
	{
		$data['navbar'] = 'navbar';
		$data['sidebar'] = 'sidebar';
		$data['content'] = $this->session->userdata('kode_uker') == 'kanpus' ? 'cluster_kanpus_v' : 'cluster_v';
		$data['provinsi'] = $this->cluster_m->getprovinsi_m();
		$this->load->view('template', $data);
	}

	public function getdata()
	{
		$list = $this->cluster_m->get_datafield();
		$data = array();
		$no = $_POST['start'];
		foreach ($list->result_array() as $field) {
			$totalanggota = $this->cluster_m->countanggota_m($field['id']);
	
			$jenis_usaha = $this->cluster_m->getdata_j($field['id_cluster_jenis_usaha']);
			
			$del = '<button class="btn btn-danger waves-effect waves-light btn-sm btn-block" onclick="deldata(\'' . $field['id'] . '\')" type="button" ><i class="fa fa-close"></i> Hapus</button>';
			$ca = '<button class="btn btn-info waves-effect waves-light btn-sm btn-block" name="id" value="' . $field['id'] . '" type="submit" ><i class="fa fa-users"></i> Anggota</button>';
			$update = '<button class="btn btn-success waves-effect waves-light btn-sm btn-block" onclick="getform(\'' . $field['id'] . '\')" type="button" ><i class="fa fa-pencil"></i> Update</button>';
			$upload = '<button class="btn btn-primary waves-effect waves-light btn-sm btn-block" onclick="upform(\'' . $field['id'] . '\')" type="button" ><i class="fa fa-upload"></i> Upload</button>';
			$action = '' . $ca . ($this->session->userdata('kode_uker') == 'kanpus' ? '' : $update . $del) . '';
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field['kanwil'];
			$row[] = $field['kanca'];
			$row[] = $field['uker'];
			$row[] = $field['kelompok_usaha'];
			$row[] = $field['kelompok_jumlah_anggota'] . " / " . $totalanggota[0]['sum'];
			$row[] = count($jenis_usaha)>0 ? $jenis_usaha[0]['nama_cluster_jenis_usaha'] : $field['id_cluster_jenis_usaha'];
			$row[] = $field['hasil_produk'];
			$row[] = "status on progress";
			$row[] = '<form action="cluster/cluster_anggota" target="_blank" method="POST"><input type="hidden" name="kelompok_usaha" value="' . $field['kelompok_usaha'] . '">' . $action . '</form>';
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

	public function deldata()
	{
		$this->cluster_m->deldata_m();
	}

	public function cekuker()
	{
		if ($_POST['kode_uker'] != "") {
			$data = $this->cluster_m->cekuker_m();
			if ($data != false) {
				echo json_encode($data[0]['BRDESC']);
			} else echo json_encode("data uker tidak ditemukan");
		}
	}


	public function getdata_s()
	{
		if (isset($_POST['id'])) {
			$data['cluster'] = $this->cluster_m->getdata_m();
			$data['rfku'] = $this->cluster_m->getdatafoto_m('cluster_foto_usaha');
			$data['rfex'] = $this->cluster_m->getdatafoto_m('cluster_doc_ekspor');
			echo json_encode($data);
		}
	}

	function fjum()
	{
		if (isset($_POST['id_cluster_sektor_usaha'])) {
			$data = $this->cluster_m->getdata_jum();
			echo json_encode($data);
		}
	}

	function fju()
	{
		if (isset($_POST['id_cluster_jenis_usaha_map'])) {
			$data = $this->cluster_m->getdata_ju();
			echo json_encode($data);
		}
	}

	public function inputdata()
	{
		
		$rfku = null;
		$rfex = null;

		if (count($_POST['efku']) > 0) {
			$z = 0;
			for ($i = 0; $i < count($_POST['efku']); $i++) {

				if ($_POST['rfku'][$i] != "") {
					$rfku[$z] = $this->camphotoupload($_POST['rfku'][$i], $_POST['tfku'][$i]);
					$z++;
				} else {
					if ($_POST['efku'][$i] != "") {
						$rfku[$z] = $_POST['efku'][$i];
						$z++;
					}
				}
				echo $z;
			}
			unset($_POST['rfku']);
			unset($_POST['tfku']);
			unset($_POST['efku']);
		}

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

		if ($_POST['id'] != "") {
			$this->cluster_m->updatedata_m($rfex, $rfku);
			echo "update";
		} else {
			$this->cluster_m->insertdata_m($rfex, $rfku);
			echo "insert";
		}
	}


	public function getreport($harian = "")
	{
		ini_set('memory_limit', '-1');
		$data['kanwil'] = array();
		$q = $this->cluster_m->getreport_m($harian);

		$data['total']['Pariwisata'] = 0;
		//karena Mapping belum jelas maka dicheck satu persatu
		foreach ($q as $row) {
			if ($row['kanwil'] != false) {
				switch ($row['jenis_usaha']) {
					case "Pertanian - Pangan":
					case "Pertanian - Holtikultura":
					case "Pertanian - Perkebunan":
					case "Peternakan":
					case "Jasa Pertanian dan Perburuan":
					case "Kehutanan & Penebangan Kayu":
						(isset($data['kanwil'][$row['kanwil']]['PERTANIAN, PERBURUAN, DAN KEHUTANAN'])) ? $data['kanwil'][$row['kanwil']]['PERTANIAN, PERBURUAN, DAN KEHUTANAN']++ : $data['kanwil'][$row['kanwil']]['PERTANIAN, PERBURUAN, DAN KEHUTANAN'] = 1;
						(isset($data['total']['PERTANIAN, PERBURUAN, DAN KEHUTANAN'])) ? $data['total']['PERTANIAN, PERBURUAN, DAN KEHUTANAN']++ : $data['total']['PERTANIAN, PERBURUAN, DAN KEHUTANAN'] = 1;
						break;
					case "Perikanan":
						(isset($data['kanwil'][$row['kanwil']]['Perikanan'])) ? $data['kanwil'][$row['kanwil']]['Perikanan']++ : $data['kanwil'][$row['kanwil']]['Perikanan'] = 1;
						(isset($data['total']['Perikanan'])) ? $data['total']['Perikanan']++ : $data['total']['Perikanan'] = 1;
						break;
					case 'Pertambangan Minyak & Gas Bumi':
					case 'Pertambangan Batubara & Lignit':
					case 'Pertambangan Biji Logam':
					case 'Pertambangan & Penggalian Lainnya':
					case 'Industri Batubara & Pengilangan Migas':
					case 'Industri Makanan & Minuman':
					case 'Pengolahan Tembakau':
					case 'Industri Tekstil dan Pakaian Jadi':
					case 'Industri Kulit, Barang dari Kulit dan Alas Kaki':
					case 'Industri Kayu, Barang dari Kayu, Gabus dan Barang Anyaman dari Bambu, Rotan dan sejenisnya':
					case 'Industri Kertas dan Barang dari kertas, Percetakan dan Reproduksi Media Rekaman':
					case 'Industri Kimia, Farmasi dan Obat Tradisional':
					case 'Industri Karet, Barang dari Karet dan Plastik':
					case 'Industri Barang Galian bukan logam':
					case 'Industri Logam Dasar':
					case 'Industri Barang dari Logam, Komputer, Barang Elektronik, Optik dan Peralatan Listrik':
					case 'Industri Mesin dan Perlengkapan':
					case 'Industri Alat Angkutan':
					case 'Industri Furnitur':
					case 'Industri Pengolahan Lainnya, Jasa Reparasi dan Pemasangan Mesin dan Peralatan':
						(isset($data['kanwil'][$row['kanwil']]['INDUSTRI PENGOLAHAN'])) ? $data['kanwil'][$row['kanwil']]['INDUSTRI PENGOLAHAN']++ : $data['kanwil'][$row['kanwil']]['INDUSTRI PENGOLAHAN'] = 1;
						(isset($data['total']['INDUSTRI PENGOLAHAN'])) ? $data['total']['INDUSTRI PENGOLAHAN']++ : $data['total']['INDUSTRI PENGOLAHAN'] = 1;
						break;
					case 'Pengadaan Listrik dan Gas':
					case 'Pengadaan Gas dan Produksi Es':
					case 'Pengadaan Air, Pengelolaan Sampah, Limbah dan Daur Ulang':
					case 'Konstruksi':
					case 'Transportasi Angkutan Rel':
					case 'Transportasi Angkutan Darat':
					case 'Transportasi Angkutan Laut':
					case 'Transportasi Angkutan Sungai, Danau & Penyeberangan':
					case 'Transportasi Angkutan Udara':
					case 'Pergudangan dan Jasa Penunjang Angkutan, Pos dan Kurir':
					case 'Penyediaan Akomodasi dan makan minum':
					case 'Informasi dan Komunikasi':
					case 'Jasa Keuangan dan Asuransi':
					case 'Real Estate':
					case 'Jasa Perusahaan':
					case 'Administrasi Pemerintahan, Pertahanan dan Jaminan Sosial Wajib':
					case 'Jasa Pendidikan':
					case 'Jasa Kesehatan dan Kegiatan Lainnya':
					case 'Jasa Lainnya':
						(isset($data['kanwil'][$row['kanwil']]['JASA-JASA'])) ? $data['kanwil'][$row['kanwil']]['JASA-JASA']++ : $data['kanwil'][$row['kanwil']]['JASA-JASA'] = 1;
						(isset($data['total']['JASA-JASA'])) ? $data['total']['JASA-JASA']++ : $data['total']['JASA-JASA'] = 1;
						break;
					case 'Perdagangan Mobil, Sepeda Motor dan Reparasinya':
					case 'Perdagangan Besar dan Eceran, bukan Mobil dan Sepeda':
						(isset($data['kanwil'][$row['kanwil']]['PERDAGANGAN'])) ? $data['kanwil'][$row['kanwil']]['PERDAGANGAN']++ : $data['kanwil'][$row['kanwil']]['PERDAGANGAN'] = 1;
						(isset($data['total']['PERDAGANGAN'])) ? $data['total']['PERDAGANGAN']++ : $data['total']['PERDAGANGAN'] = 1;
						break;
					case "Pariwisata":
						(isset($data['kanwil'][$row['kanwil']]['Pariwisata'])) ? $data['kanwil'][$row['kanwil']]['Pariwisata']++ : $data['kanwil'][$row['kanwil']]['Pariwisata'] = 1;
						(isset($data['total']['Pariwisata'])) ? $data['total']['Pariwisata']++ : $data['total']['Pariwisata'] = 1;
						break;
				}
			}
		}
		$data['harian'] = $harian;
		$data['navbar'] = '';
		$data['sidebar'] = '';
		$data['content'] = 'cluster_report_v';
		$this->load->view('template', $data);
	}


	public function dldata($harian = null)
	{
		ini_set('memory_limit', '-1');
		$headerexcel[0] = array(
			'No', 'Waktu Input', 'kanwil', 'kanca',
			"Kode Kanca", "Uker", "Kode Uker", "Nama Kaunit", "PN Kaunit", "Handphone Kaunit", "Nama Mantri", "PN Mantri", "Handphone Mantri",
			"Nama Kelompok Usaha", "Jumlah Anggota (orang)", "Pinjaman anggota Kelompok", "Lokasi Usaha", "Kode Pos", "Provinsi", "Kabupaten/Kota", "Kecamantan", "Kelurahan",
			"Sektor Usaha", "Jenis Usaha", "Hasil Produk", "Jenis Usaha Map", "Pasar Ekspor", "Tahun Pasar Ekspor", "Nilai Pasas Ekspor", "Pihak Pembeli Produk/Jasa yang Dihasilkan", "Handphone Pihak Pembeli", "Suplier Bahan Baku Produk/Jasa yang Dihasilkan", "Handphone Suplier",
			"Luas Lahan/Tempat Usaha (m2)", "Omset Usaha Perbulan (total Kelompok - Rp)",
			"Nama Ketua Kelompok", "Jenis Kelamin", "NIK", "Handphone Ketua Kelompok", "Tanggal Lahir", "Tempat lahir",
			"Punya Pinjaman", "Nominal Pinjaman BRI", "Norek Pinjaman BRI", "Kebutuhan Kredit",
			"Kebutuhan Sarana", "Kebutuhan Sarana Lainnya", "Kebutuhan Pendidikan",
			"Simpanan Bank", "Agen Brilink"
		);

		$data = $this->cluster_m->getdataall_m($harian);
		$no = 1;
		$z = 1;
		foreach ($data as $cell) {
			$col = 0;
			$headerexcel[$z][$col] = $no;
			foreach (array_keys($cell) as $key) {
				$col++;
				$cell[$key] = str_replace(';', ' ', $cell[$key]);
				$cell[$key] = str_replace(',', ' ', $cell[$key]);
				$headerexcel[$z][$col] = $cell[$key];
			}
			$z++;
			$no++;
		}

		echo json_encode($headerexcel, true);
	}


	public function cekkpos()
	{
		if ($_POST['kodepos'] != "") {
			$data = $this->cluster_m->cekkpos_m();
			if ($data != false) {
				echo json_encode($data[0]);
			} else echo json_encode("false");
		}
	}

	public function getprovinsi()
	{
		$data = $this->cluster_m->getprovinsi_m();
		echo json_encode($data);
	}

	public function getkotakab($select=null)
	{
		$datakota = $this->cluster_m->getkotakab_m();
		echo json_encode($datakota);
	}

	public function getkecamatan()
	{
		$datakecamatan = $this->cluster_m->getkecamatan_m();
		echo json_encode($datakecamatan, true);
	}
	public function getkelurahan()
	{
		$datakelurahan = $this->cluster_m->getkelurahan_m();
		echo json_encode($datakelurahan);
	}

	/////////////////////////////////////////////////////////////////////////////
	///////////////////////////cluster anggota
	////////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function cluster_anggota()
	{
		if (isset($_POST['id'])) {
			$data['kelompok_usaha'] = $_POST['kelompok_usaha'];
			$data['id'] = $_POST['id'];
			$data['content'] = 'cluster_anggota';
			$data['navbar'] = '';
			$data['sidebar'] = '';
			$this->load->view('template', $data);
		} else {
			echo "<script>alert('ups, ada kesalahan')</script>";
			redirect('cluster', 'refresh');
		}
	}

	public function getdata_anggota()
	{

		$list = $this->cluster_m->get_datafield_anggota();
		$data = array();
		$no = $_POST['start'];
		foreach ($list->result_array() as $field) {
			$del = '<button class="btn bg-maroon waves-effect waves-light btn-sm" onclick="deldata_anggota(\'' . $field['id_ca'] . '\')" type="button" ><i class="fa fa-close"></i> Hapus</button>';
			$update = '<button class="btn btn-success waves-effect waves-light btn-sm" onclick="getform_anggota(\'' . $field['id_ca'] . '\')" type="button" ><i class="fa fa-pencil"></i> Update</button>';
			$action = ($this->session->userdata('kode_uker') == 'kanpus' ? '' : $update . $del);

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field['ca_nama'];
			$row[] = $field['ca_nik'];
			$row[] = $field['ca_jk'];
			$row[] = $field['ca_kodepos'];
			$row[] = $field['ca_pinjaman'];
			$row[] = $field['ca_simpanan'];
			$row[] = $field['ca_handphone'];
			$row[] = $action;
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $list->num_rows(),
			"recordsFiltered" => $this->cluster_m->count_all_anggota(),
			"data" => $data,
		);
		echo json_encode($output);
	}

	public function getdata_anggota_s()
	{
		if (isset($_POST['id_ca'])) {
			echo json_encode($this->cluster_m->getdata_anggota_m());
		}
	}

	public function inputdata_anggota()
	{
		if ($_POST['id_ca'] != "") {
			$this->cluster_m->updatedata_anggota_m();
			echo "udpate";
		} else {
			$this->cluster_m->insertdata_anggota_m();
			echo "insert";
		}
	}

	public function deldata_anggota()
	{
		$this->cluster_m->deldata_anggota_m();
	}

	public function inputanggotacsv()
	{
		$anggota = json_decode($_POST['anggota'], true);
		$this->cluster_m->inputanggotacsv_m($anggota);
	}

	public function dldataanggota()
	{
		$headerexcel[0] = array('No', 'Nama Anggota', 'NIK', 'Jenis Kelamin', "Kode Pos", "Pinjaman", "Simpanan", "Handphone");

		$data = $this->cluster_m->dldataanggota_m();
		$no = 1;
		$z = 1;
		foreach ($data as $cell) {
			$col = 0;
			$headerexcel[$z][$col] = $no;
			foreach (array_keys($cell) as $key) {
				$col++;
				$headerexcel[$z][$col] = $cell[$key];
			}
			$z++;
			$no++;
		}

		echo json_encode($headerexcel);
	}

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
		$pdata['navbar'] = "";
		$pdata['sidebar'] = "";
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
				$z[$row['kode_kanwil']][$srow['kode_uker']]++;
			};
		}
		$i = 1;
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





	// private function filephotoupload(){

	// $type = explode('.', $_FILES["foto"]["name"]);
	// $type = $type[count($type)-1];
	// $url = "images/".uniqid(rand()).'.'.$type;
	// //$_POST["foto"]=$url;
	// move_uploaded_file($_FILES["foto"]["tmp_name"], $url);
	// if(is_uploaded_file($_FILES["foto"]["tmp_name"])){
	// if(move_uploaded_file($_FILES["foto"]["tmp_name"], $url)){
	// return $url;
	// }
	// }
	// }


	// function migrate(){
		// ini_set('memory_limit', '-1');
		
		// $query="select * from cluster";
		// $su=$this->db->query("select * from cluster_sektor_usaha")->result_array();
		// $jum=$this->db->query("select * from cluster_jenis_usaha_map")->result_array();
		// $ju=$this->db->query("select * from cluster_jenis_usaha")->result_array();
		// foreach ($this->db->query($query)->result_array() as $q){
				// foreach ($su as $rsu ){
					// $isu="";
					// if ($rsu['keterangan_cluster_sektor_usaha']==$q['id_cluster_sektor_usaha']) {
							// $isu=$rsu['id_cluster_sektor_usaha'];
							// break;
					// }
				// }
				// foreach ($jum as $rjum ){
					// $ijum="";
					// if ($rjum['nama_cluster_jenis_usaha_map']==$q['id_cluster_jenis_usaha_map']) {
							// $ijum=$rjum['id_cluster_jenis_usaha_map'];
							// break;
					// }
				// }
				// foreach ($ju as $rju ){
					// $iju="";
					// if ($rju['nama_cluster_jenis_usaha']==$q['id_cluster_jenis_usaha']) {
							// $iju=$rju['id_cluster_jenis_usaha'];
							// break;
					// }
				// }
			
				// echo "update cluster set id_cluster_sektor_usaha='".$isu."', id_cluster_jenis_usaha_map='".$ijum."', id_cluster_jenis_usaha='".$iju."' where id='".$q['id']."'; </br>";
		// }
		
		
		
	// }

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
}
