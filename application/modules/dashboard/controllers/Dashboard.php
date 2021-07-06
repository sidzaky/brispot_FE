<?php

/**
 *
 * @author 
 * @Nicky
 *
 **/
?>
 
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MX_Controller
{

  public function __construct()
  {
    parent::__construct();

    $this->load->module('login');
    $this->login->is_logged_in();

    $this->load->helper(array('url', 'form', 'html'));
    $this->load->model('dashboard_m');
    $data["con"] = $this;
  }

  public function index()
  {
    $user = $this->getActiveUser();
    $data['report'] = $this->generateReport($user);
    $data['icons'] =  array(
      "kehutanan" => base_url() . "assets/img/dashboard/kehutanan.png",
      "perikanan" => base_url() . "assets/img/dashboard/perikanan.png",
      "pengolahan" => base_url() . "assets/img/dashboard/pengolahan.png",
      "jasa" => base_url() . "assets/img/dashboard/jasa.png",
      "perdagangan" => base_url() . "assets/img/dashboard/perdagangan.png",
      "pariwisata" => base_url() . "assets/img/dashboard/pariwisata.png",
    );
    $this->load->module('cluster');
    $this->load->model('cluster_m');
    $data['provinsi'] = $this->cluster_m->getprovinsi_m();
    $data['navbar'] = 'navbar';
    $data['sidebar'] = 'sidebar';
    $data['content'] = 'dashboard';
    $this->load->view('template', $data);
  }

  function generateReport($query)
  {
    $where = 'where timestamp >1576085405 and cluster_status=1 ';
    $keyword = 'kanwil';
    if ($this->session->userdata('permission') !== "4") {
      $where = "where " . $query["code"] . " = '" . $query["value"] . "' and timestamp >1576085405 and cluster_status=1  order by " . $query["order"] . " ASC";
      $keyword = $query["order"];
    }
    ini_set('memory_limit', '-1');
    $data = array();
    $query = $this->dashboard_m->getReport($where);
    //karena Mapping belum jelas maka dicheck satu persatu
    if (!empty($query)) {
      foreach ($query as $row) {
        if ($row[$keyword] != false) {
          switch ($row['nama_cluster_jenis_usaha']) {
            case "Pertanian - Pangan":
            case "Pertanian - Holtikultura":
            case "Pertanian - Perkebunan":
            case "Peternakan":
            case "Jasa Pertanian dan Perburuan":
            case "Kehutanan & Penebangan Kayu":
              (isset($data['kehutanan']['total'])) ? $data['kehutanan']['total']++ : $data['kehutanan']['total'] = 1;
              $data['kehutanan']['label'] = 'Pertanian, Perburuan, dan Kehutanan';
              break;
            case "Perikanan":
              (isset($data['perikanan']['total'])) ? $data['perikanan']['total']++ : $data['perikanan']['total'] = 1;
              $data['perikanan']['label'] = 'Perikanan';
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
              (isset($data['pengolahan']['total'])) ? $data['pengolahan']['total']++ : $data['pengolahan']['total'] = 1;
              $data['pengolahan']['label'] = 'Industri Pengolahan';
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
              (isset($data['jasa']['total'])) ? $data['jasa']['total']++ : $data['jasa']['total'] = 1;
              $data['jasa']['label'] = 'Jasa-jasa';
              break;
            case 'Perdagangan Mobil, Sepeda Motor dan Reparasinya':
            case 'Perdagangan Besar dan Eceran, bukan Mobil dan Sepeda':
              (isset($data['perdagangan']['total'])) ? $data['perdagangan']['total']++ : $data['perdagangan']['total'] = 1;
              $data['perdagangan']['label'] = 'Perdagangan';
              break;
            case "Pariwisata":
              (isset($data['pariwisata']['total'])) ? $data['pariwisata']['total']++ : $data['pariwisata']['total'] = 1;
              $data['pariwisata']['label'] = 'Pariwisata';
              break;
          }
        }
      }
    }
    return $data;
  } 

  function persebaranpetakanwil(){
    $this->load->module('cluster');
    $this->load->model('cluster_m');
    ini_set('memory_limit', '-1');
		$data['kanwil'] = array();
		$q = $this->dashboard_m->getreportdashboard_m("");
		$data['listkategori'] = $this->cluster_m->getlist_jum();
		foreach ($q as $row) {
			if ($row['kanwil'] != false) {
				foreach ($data['listkategori'] as $zrow) {
					if ($zrow['id_cluster_jenis_usaha_map'] == $row['id_cluster_jenis_usaha_map']) {
						if (isset($data['kanwil'][$row['kode_kanwil']][$zrow['id_cluster_jenis_usaha_map']])) {
              $data['kanwil'][$row['kode_kanwil']][$zrow['id_cluster_jenis_usaha_map']]++;
            } 
            else {
              $data['kanwil'][$row['kode_kanwil']][$zrow['id_cluster_jenis_usaha_map']] = 1;
            }
					}
				}
			}
    }
    $zz="";
    $i=0;
    foreach ($data["kanwil"] as $key => $values){
        $b="";
        $t=$this->db->query("select distinct(NEWMAPKODE) from branch where REGION ='" .$key. "';")->result_array();
        foreach ($values as $skey => $svalues){
            $u=$this->db->query("select nama_cluster_jenis_usaha_map from cluster_jenis_usaha_map where id_cluster_jenis_usaha_map = '". $skey. "'")->result_array();
            foreach ($u as $su){
              $b.= '<br>'.$su["nama_cluster_jenis_usaha_map"].' : '.$svalues; 
            }
        }
      $zz[$i] = array ($t[0]["NEWMAPKODE"], $b);
      $i++;
    }
    echo json_encode($zz);
  }
 
  function persebaranpetaprovinsi(){ 
    $this->load->module('cluster');
    $this->load->model('cluster_m');
    ini_set('memory_limit', '-1');
    $data['kanwil'] = array();
    $q = $this->dashboard_m->getreportdashboard_m("true");
    $data['listkategori'] = $this->cluster_m->getlist_jum();
		foreach ($q as $row) {
			if ($row['MAPKODE']!="") {
				foreach ($data['listkategori'] as $zrow) {
					if ($zrow['nama_cluster_jenis_usaha_map'] == $row['nama_cluster_jenis_usaha_map']) {
						if (isset($data['kanwil'][$row['MAPKODE']][$zrow['nama_cluster_jenis_usaha_map']])) {
                $data['kanwil'][$row['MAPKODE']][$zrow['nama_cluster_jenis_usaha_map']]++;
            } 
            else {
              $data['kanwil'][$row['MAPKODE']][$zrow['nama_cluster_jenis_usaha_map']] = 1;
            }
					}
				}
			}
    }
    $zz;
    $i=0;
    foreach ($data["kanwil"] as $key => $values){
        $b="";
        $t=$key;
        foreach ($values as $skey => $svalues){
              $b.= '<br>'.$skey.' : '.$svalues; 
        }
      $zz[$i] = array ($t, $b);
      $i++;
    }
    echo json_encode($zz);
  }



  function getActiveUser()
  {
    $user = array();
    switch ($this->session->userdata("permission")) {
      case '1':
        $user["value"] = $this->session->userdata("kode_uker");
        $user["code"] = "kode_uker";
        $user["order"] = "uker";
        break;
      case '2':
        $user["value"] = $this->session->userdata("kode_kanca");
        $user["code"] = "kode_kanca";
        $user["order"] = "kanca";
        break;
      case '3':
        $user["value"] = $this->session->userdata("kode_kanwil");
        $user["code"] = "kode_kanwil";
        $user["order"] = "kanwil";
        break;
      default:
        $user["value"] = "";
        $user["code"] = "admin";
        $user["order"] = "admin";
    }
    return $user;
  }

  function getLoanNeeds()
  {
    $user = $this->getActiveUser();
    $query = $this->dashboard_m->getLoanNeedsReport($user);
    echo json_encode($query);
  }

  function getToolNeeds()
  {
    $user = $this->getActiveUser();
    $query = $this->dashboard_m->getToolNeedsReport($user);
    echo json_encode($query);
  }

  function getTrainingNeeds()
  {
    $user = $this->getActiveUser();
    $query = $this->dashboard_m->getTrainingNeedsReport($user);
    echo json_encode($query);
  }

  function summary(){
    $data['navbar']     = 'navbar';
    $data['sidebar']    = 'sidebar';
    $data['content']    = 'summary'; 
    $data['cluster']    = $this->dashboard_m->getsummary();
    $data['provinsi']   = $this->dashboard_m->getprovinsi_m();
    $data['kabupaten']  = $this->dashboard_m->getkotakab_m();
    $data['komoditas']  = $_POST['hasil_produk'].', '. ($_POST['varian'] == "" ? "Semua Varian" : $_POST['varian']);
    $data['klaster']    = $this->dashboard_m->getlist_jum();
    
    if ($_POST['provinsi']=="" && $_POST['kabupaten']=="") {
      $data['koordinat'][0]['lat']='0.7893';
      $data['koordinat'][0]['long']='113.9213';
      $data['koordinat'][0]['zoom']='4';
    }
    else {
      $data['koordinat']  = $this->dashboard_m->getmap_m();
      $data['koordinat'][0]['zoom']='8';
    }

    // print_r ($data['provinsi']);

    $this->load->module('cluster');
    $this->load->model('cluster_m');
    $kebutuhan_pendidikan = $this->cluster_m->get_cluster_kebutuhan_pendidikan_pelatihan();
    $kebutuhan_sarana     = $this->cluster_m->get_cluster_kebutuhan_sarana();
    $kebutuhan_kredit     = $this->cluster_m->get_cluster_kebutuhan_skema_kredit();

    $data['performance'];
    $i=0;
    foreach ($data['cluster'] as $row ){
        $data['listloc'][$i]['umkm']  = $row['kelompok_usaha'];
        $data['listloc'][$i]['lat']   = $row['latitude'];
        $data['listloc'][$i]['long']  = $row['longitude'];
        $data['listloc'][$i]['count'] = $i;
        $i++;
        $data['performance']['luas_lahan'] += $row['kelompok_luas_usaha'];
        $data['performance']['kapasitas_produksi'] += $row['kapasitas_produksi'];
        if ($row['periode_panen'] !="" ) $data['performance']['panen'][$row['periode_panen']]++;
        foreach ($kebutuhan_pendidikan as $kp){
          if ($row['kebutuhan_pendidikan']==$kp['id_cluster_kebutuhan_pendidikan_pelatihan']) {
            $data['performance']['kp'][$kp['kebutuhan_pendidikan_pelatihan']]++;
          }
        } 
        foreach ($kebutuhan_sarana as $ks){
          if ($row['kebutuhan_sarana']==$ks['id_cluster_kebutuhan_sarana']) {
            $data['performance']['ks'][$ks['kebutuhan_sarana']]++;
          }
        }
        foreach ($kebutuhan_kredit as $kk){
          if ($row['kebutuhan_skema_kredit']==$kk['id_cluster_kebutuhan_skema_kredit']) {
            $data['performance']['kk'][$kk['kebutuhan_skema_kredit']]++;
          }
        }
    }
   $this->load->view('template', $data);
  }

  function getfilterprovinsikab(){
    $d = $this->dashboard_m->getfilterprovinsikab_m();
    $i=0;
    $j=0;
    foreach ($d as $row){
      if (!in_array($row['provinsi_id'], $s, true )){
        $s[]=$row['provinsi_id'];
        $data['provinsi'][$j]['provinsi_id']  = $row['provinsi_id'];
        $data['provinsi'][$j]['nama_provinsi'] = $row['nama_provinsi'];
        $j++;
      }
      $data['kabupaten'][$i]['kabupaten_id']  = $row['kabupaten_id'];
      $data['kabupaten'][$i]['nama_kabupaten']=$row['nama_kabupaten'];
      $i++;
    }
    echo json_encode($data);
  }


  function get_hp(){
    $data = $this->dashboard_m->get_list_hasil_produk_m();
    echo json_encode($data);
  }

  function get_v(){
    $data = $this->dashboard_m->get_list_varian_m();
    echo json_encode($data);
  }

  function getfilterkotakab(){
    $d = $this->dashboard_m->getfilterkab_m();
    $i=0;
    $j=0;
    foreach ($d as $row){
      $data[$i]['id']  = $row['id'];
      $data[$i]['nama']=$row['nama'];
      $i++;
    }
    echo json_encode($data);
  }

  function psummary($pid=null){
    if ($pid!=null){
        $data['navbar']     = 'navbar';
        $data['sidebar']    = 'sidebar';
        $data['content']    = 'psummary'; 
        $data['cluster']    = $this->dashboard_m->getPSummary($pid);
        $data['provinsi']   = $this->dashboard_m->getProvinsiByMapKode_m($pid);
        $data['data_bps']    = $this->dashboard_m->getDataBpsByProvinsi_m($pid);

        
      
        $data['koordinat'][0]['lat']=$data['provinsi'][0]['lat'];
        $data['koordinat'][0]['long']=$data['provinsi'][0]['long'];
        $data['koordinat'][0]['zoom']='7';


        // print_r ($data['provinsi']);

        $this->load->module('cluster');
        $this->load->model('cluster_m');

        $data['performance']=array();
        $data['performance']['luas_lahan']=0;
        $data['performance']['kapasitas_produksi']=0;
        $i=0;
        foreach ($data['cluster'] as $row ){
            $data['listloc'][$i]['umkm']  = $row['kelompok_usaha'];
            $data['listloc'][$i]['lat']   = $row['latitude'];
            $data['listloc'][$i]['long']  = $row['longitude'];
            $data['listloc'][$i]['count'] = $i;
            $i++;
            if (!isset($data['performance']['jenis_usaha'][$row['nama_cluster_jenis_usaha']]['total'])){
              $data['performance']['jenis_usaha'][$row['nama_cluster_jenis_usaha']]['total'] = $row['kapasitas_produksi'];
            }
            else $data['performance']['jenis_usaha'][$row['nama_cluster_jenis_usaha']]['total'] += $row['kapasitas_produksi'];
        }
      $this->load->view('template', $data);
    }
  }


}

