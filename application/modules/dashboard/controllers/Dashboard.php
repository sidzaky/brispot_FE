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
    $data['navbar'] = 'navbar';
    $data['sidebar'] = 'sidebar';
    $data['content'] = 'dashboard';
    $this->load->view('template', $data);
  }

  function generateReport($query)
  {
    $where = 'where timestamp >1576085405 ';
    $keyword = 'kanwil';
    if ($this->session->userdata('permission') !== "4") {
      $where = "where " . $query["code"] . " = '" . $query["value"] . "' and timestamp >1576085405 order by " . $query["order"] . " ASC";
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
}
