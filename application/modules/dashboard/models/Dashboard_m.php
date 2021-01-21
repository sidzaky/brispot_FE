<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_m extends CI_Model
{
  function getReport($where)
  {
    $sql = '
    select FROM_UNIXTIME
      (timestamp, "%H:%i:%s %d %M %Y") as date, 
      kanwil, 
      kanca, 
      kode_kanca, 
      uker, 
      kode_uker,
      e.kode_pos,
      b.nama as provinsi,
      c.nama as kabupaten,
      d.nama as kecamatan,
      e.nama as kelurahan,
      a.id_cluster_sektor_usaha,
      a.id_cluster_jenis_usaha_map,
      a.id_cluster_jenis_usaha,
	  nama_cluster_jenis_usaha,
	  nama_cluster_jenis_usaha_map
    from cluster a
    left join provinsi b on a.provinsi=b.id
    left join kabupaten_kota c on a.kabupaten=c.id
    left join kecamatan d on a.kecamatan=d.id
    left join kelurahan e on a.kelurahan=e.id 
	left join cluster_sektor_usaha f on f.id_cluster_sektor_usaha=a.id_cluster_sektor_usaha
	left join cluster_jenis_usaha_map g on g.id_cluster_jenis_usaha_map=a.id_cluster_jenis_usaha_map
	left join cluster_jenis_usaha h on h.id_cluster_jenis_usaha=a.id_cluster_jenis_usaha ' . $where ;
    $result = $this->db->query($sql)->result_array();
    return $result;
  }

  function getLoanNeedsReport($active_user)
  {
    $where = $active_user["code"] === "admin" ? true :  $active_user["code"] . " = '" . $active_user["value"] . "'";
    $sql = "select b.kebutuhan_skema_kredit as kredit, COUNT(*) as total FROM cluster a JOIN cluster_kebutuhan_skema_kredit b ON a.kebutuhan_skema_kredit = b.id_cluster_kebutuhan_skema_kredit WHERE a.kebutuhan_skema_kredit IN (
      SELECT * FROM
      (
          SELECT id_cluster_kebutuhan_skema_kredit
          FROM cluster_kebutuhan_skema_kredit
      ) AS subquery
    ) AND $where and timestamp >1576085405 and cluster_status=1 group by a.kebutuhan_skema_kredit order by total DESC";
    $result = $this->db->query($sql)->result_array();
    return $result;
  }

  function getToolNeedsReport($active_user)
  {
    $where = $active_user["code"] === "admin" ? true :  $active_user["code"] . " = '" . $active_user["value"] . "'";
    $sql = "select b.kebutuhan_sarana as sarana, COUNT(*) as total FROM cluster a JOIN cluster_kebutuhan_sarana b ON a.kebutuhan_sarana = b.id_cluster_kebutuhan_sarana WHERE a.kebutuhan_sarana IN (
      SELECT * FROM
      (
          SELECT id_cluster_kebutuhan_sarana
          FROM cluster_kebutuhan_sarana
      ) AS subquery
    ) AND $where and timestamp >1576085405 and cluster_status=1  group by a.kebutuhan_sarana order by total DESC";
    $result = $this->db->query($sql)->result_array();
    return $result;
  }

  function getTrainingNeedsReport($active_user)
  {
    $where = $active_user["code"] === "admin" ? true :  $active_user["code"] . " = '" . $active_user["value"] . "'";
    $sql = "select b.kebutuhan_pendidikan_pelatihan as pendidikan, COUNT(*) as total FROM cluster a JOIN cluster_kebutuhan_pendidikan_pelatihan b ON a.kebutuhan_pendidikan = b.id_cluster_kebutuhan_pendidikan_pelatihan WHERE a.kebutuhan_pendidikan IN (
      SELECT * FROM
      (
          SELECT id_cluster_kebutuhan_pendidikan_pelatihan
          FROM cluster_kebutuhan_pendidikan_pelatihan
      ) AS subquery
    ) AND $where and timestamp >1576085405 and cluster_status=1  group by a.kebutuhan_pendidikan order by total DESC";
    $result = $this->db->query($sql)->result_array();
    return $result;
  }


  public function getreportdashboard_m($harian)
	{
		$where = "";
		switch ($this->session->userdata('permission')) {
			case (4):
				$where .= " where true ";
				break;
			case (3):
				$where .= " where kode_kanwil='" . $this->session->userdata('kode_kanwil') . "' ";
				break;
			case (2):
				$where .= " where kode_kanca='" . $this->session->userdata('kode_kanca') . "' ";
				break;
			case (1):
				$where .= " where kode_uker='" . $this->session->userdata("kode_uker") . "' ";
				break;
    }
    
    $where .=" and cluster_approval = 1 ";
   
    /////////////////dashboar filter/////////////
    // if ($_POST['id_cluster_sektor_usaha']!="") $where .=' and a.id_cluster_sektor_usaha="'. $_POST['id_cluster_sektor_usaha'] .'" ';
    // if ($_POST['id_cluster_jenis_usaha_map']!="") $where .=' and a.id_cluster_jenis_usaha_map="'. $_POST['id_cluster_jenis_usaha_map'] .'" ';
    // if ($_POST['id_cluster_jenis_usaha']!="") $where .=' and a.id_cluster_jenis_usaha="'. $_POST['id_cluster_jenis_usaha'] .'" ';
    // if ($_POST['hasil_produk']!="") $where .=' and a.hasil_produk="'. $_POST['hasil_produk'] .'" ';
    // if ($_POST['varian']!="") $where .=' and a.varian="'. $_POST['varian'] .'" ';
    // if ($_POST['provinsi']!="") $where .=' and a.provinsi="'. $_POST['provinsi'] .'" ';
    // if ($_POST['kabupaten']!="") $where .=' and a.kabupaten="'. $_POST['kabupaten'] .'" ';

    if ($harian != "") $where .= " and timestamp>1576085405  ";

		$sql = 'SELECT 	FROM_UNIXTIME( TIMESTAMP, "%H:%i:%s %d %M %Y" ) AS date,
								lokasi_usaha,
								a.kode_pos,
								b.MAPKODE,
								b.nama AS provinsi,
								c.nama AS kabupaten,
								d.nama AS kecamatan,
								e.nama AS kelurahan,
								a.id_cluster_sektor_usaha,
								a.id_cluster_jenis_usaha_map,
								a.id_cluster_jenis_usaha,
                nama_cluster_jenis_usaha,
								nama_cluster_jenis_usaha_map,
								hasil_produk,
                varian
					FROM	cluster a
					left join provinsi b on a.provinsi=b.id
					left join kabupaten_kota c on a.kabupaten=c.id
					left join kecamatan d on a.kecamatan=d.id
					left join kelurahan e on a.kelurahan=e.id 
					left join cluster_sektor_usaha f on f.id_cluster_sektor_usaha=a.id_cluster_sektor_usaha
					left join cluster_jenis_usaha_map g on g.id_cluster_jenis_usaha_map=a.id_cluster_jenis_usaha_map
					left join cluster_jenis_usaha h on h.id_cluster_jenis_usaha=a.id_cluster_jenis_usaha 
					' . $where ;
    return $this->db->query($sql)->result_array();
  }
  
  public function getsummary(){
    $where = "";
		switch ($this->session->userdata('permission')) {
			case (4):
				$where .= " where true ";
				break;
			case (3):
				$where .= " where kode_kanwil='" . $this->session->userdata('kode_kanwil') . "' ";
				break;
			case (2):
				$where .= " where kode_kanca='" . $this->session->userdata('kode_kanca') . "' ";
				break;
			case (1):
				$where .= " where kode_uker='" . $this->session->userdata("kode_uker") . "' ";
				break;
    }

    $where .=" and cluster_approval = 1 ";

    if ($_POST['id_cluster_sektor_usaha']!="") $where .=' and a.id_cluster_sektor_usaha="'. $_POST['id_cluster_sektor_usaha'] .'" ';
    if ($_POST['id_cluster_jenis_usaha_map']!="") $where .=' and a.id_cluster_jenis_usaha_map="'. $_POST['id_cluster_jenis_usaha_map'] .'" ';
    if ($_POST['id_cluster_jenis_usaha']!="") $where .=' and a.id_cluster_jenis_usaha="'. $_POST['id_cluster_jenis_usaha'] .'" ';
    if ($_POST['hasil_produk']!="") $where .=' and a.hasil_produk="'. $_POST['hasil_produk'] .'" ';
    if ($_POST['varian']!="") $where .=' and a.varian="'. $_POST['varian'] .'" ';
    if ($_POST['provinsi']!="") $where .=' and a.provinsi="'. $_POST['provinsi'] .'" ';
    if ($_POST['kabupaten']!="") $where .=' and a.kabupaten="'. $_POST['kabupaten'] .'" ';
   
    $sql="select  a.id,
                  lokasi_usaha,
                  nama_pekerja,
                  handphone_pekerja,
                  a.kelompok_handphone,
                  a.kelompok_perwakilan,
                  a.kelompok_usaha,
                  a.kelompok_jumlah_anggota,
                  a.kapasitas_produksi,
                  a.kelompok_omset,
                  a.kelompok_luas_usaha,
                  hasil_produk,
                  periode_panen,
                  varian,
                  e.nama as nama_kabupaten,
                  f.nama as nama_kecamatan,
                  g.nama as nama_kelurahan,
                  a.agen_brilink,
                  a.latitude,
                  a.longitude,
                  a.kebutuhan_sarana,
                  a.kebutuhan_pendidikan,
                  a.kebutuhan_skema_kredit,
                  b.kebutuhan_sarana as nama_kebutuhan_sarana,
                  c.kebutuhan_skema_kredit as nama_kebutuhan_skema_kredit,
                  d.kebutuhan_pendidikan_pelatihan as nama_kebutuhan_pendidikan_pelatihan
          from cluster a
          left join cluster_kebutuhan_sarana b on a.kebutuhan_sarana=b.id_cluster_kebutuhan_sarana
          left join cluster_kebutuhan_skema_kredit c on a.kebutuhan_skema_kredit = c.id_cluster_kebutuhan_skema_kredit
          left join cluster_kebutuhan_pendidikan_pelatihan d on a.kebutuhan_pendidikan = d.id_cluster_kebutuhan_pendidikan_pelatihan 
          left join kabupaten_kota e on e.id = a.kabupaten
          left join kecamatan f on f.id = a.kecamatan
          left join kelurahan g on g.id = a.kelurahan
          " .$where;
    return $this->db->query($sql)->result_array();
  }

  public function getprovinsi_m($i=null)
	{
    if (isset($_POST['provinsi'])) $i=$_POST['provinsi'];
		$sql = "select * from provinsi where id='".$i."'";
		return $this->db->query($sql)->result_array();
	}

	public function getkotakab_m($i=null)
	{ 
    if (isset($_POST['kabupaten'])) $i=$_POST['kabupaten'];
		$sql = "select * from kabupaten_kota where id='" . $i. "'";
		return $this->db->query($sql)->result_array();
	}

  function getlist_jum()
	{
		$q = "select * from cluster_jenis_usaha_map where id_cluster_jenis_usaha_map='".$_POST['id_cluster_jenis_usaha_map']."' and status=1";
		return $this->db->query($q)->result_array();
  }
  
  function getmap_m(){
    if ($_POST['kabupaten_kota']!="") $q = "select nama, lat, kabupaten_kota.long from kabupaten_kota where id='".$_POST['kabupaten']."'";
    else $q ="select nama, lat, provinsi.long from provinsi where id='".$_POST['provinsi']."'";

    return $this->db->query($q)->result_array();
  }

  function getfilterprovinsikab_m(){
    $where ="where cluster_approval=1 ";
    switch ($this->session->userdata('permission')) {
      case (4):
        $where .= " and true ";
        break;
      case (3):
        $where .= " and kode_kanwil='" . $this->session->userdata('kode_kanwil') . "' ";
        break;
      default :
        $where .= " and false ";
        break;
    }
    
    if ($_POST['id_cluster_sektor_usaha']!="") $where .=' and a.id_cluster_sektor_usaha="'. $_POST['id_cluster_sektor_usaha'] .'" ';
    if ($_POST['id_cluster_jenis_usaha_map']!="") $where .=' and a.id_cluster_jenis_usaha_map="'. $_POST['id_cluster_jenis_usaha_map'] .'" ';
    if ($_POST['id_cluster_jenis_usaha']!="") $where .=' and a.id_cluster_jenis_usaha="'. $_POST['id_cluster_jenis_usaha'] .'" ';
    if ($_POST['hasil_produk']!="") $where .=' and a.hasil_produk="'. $_POST['hasil_produk'] .'" ';
    if ($_POST['varian']!="") $where .=' and a.varian="'. $_POST['varian'] .'" ';

    $q= "select distinct(kabupaten) as kabupaten_id , b.nama as nama_kabupaten, b.provinsi_id, c.nama as nama_provinsi from cluster a 
         inner join kabupaten_kota b on a.kabupaten=b.id
         inner join provinsi c on b.provinsi_id=c.id
    ". $where;
    return $this->db->query($q)->result_array();

  }

  function get_list_hasil_produk_m(){
    $where ="where cluster_approval=1 ";
  
    switch ($this->session->userdata('permission')) {
      case (4):
        $where .= " and true ";
        break;
      case (3):
        $where .= " and kode_kanwil='" . $this->session->userdata('kode_kanwil') . "' ";
        break;
      default :
        $where .= " and false ";
        break;
    }
    if ($_POST['id_cluster_jenis_usaha']!="") $where .=' and id_cluster_jenis_usaha="'. $_POST['id_cluster_jenis_usaha'] .'" ';
    $q='select distinct(hasil_produk) from cluster '.$where.' and id_cluster_jenis_usaha="'.$_POST['id_cluster_jenis_usaha'].'" and cluster_status=1 order by hasil_produk asc';
   
    return $this->db->query($q)->result_array();
  }
  
  function get_list_varian_m(){
    $where ="where cluster_approval=1 ";
    switch ($this->session->userdata('permission')) {
      case (4):
        $where .= " and true ";
        break;
      case (3):
        $where .= " and kode_kanwil='" . $this->session->userdata('kode_kanwil') . "' ";
        break;
      default :
        $where .= " and false ";
        break;
    }
    if ($_POST['id_cluster_jenis_usaha']!="") $where .=' and id_cluster_jenis_usaha="'. $_POST['id_cluster_jenis_usaha'] .'" ';
    if ($_POST['hasil_produk']!="") $where .=' and hasil_produk="'. $_POST['hasil_produk'] .'" ';
  
    $q='select distinct(varian) from cluster '.$where.' and cluster_status=1 order by hasil_produk asc';
        
    return $this->db->query($q)->result_array();
   
  }

  function getfilterkab_m(){
    $where ="where true and cluster_approval=1 and cluster_status=1";
    switch ($this->session->userdata('permission')) {
      case (4):
        $where .= " and true ";
        break;
      case (3):
        $where .= " and kode_kanwil='" . $this->session->userdata('kode_kanwil') . "' ";
        break;
      default :
        $where .= " and false ";
        break;
    }
    
    if ($_POST['id_cluster_sektor_usaha']!="") $where .=' and a.id_cluster_sektor_usaha="'. $_POST['id_cluster_sektor_usaha'] .'" ';
    if ($_POST['id_cluster_jenis_usaha_map']!="") $where .=' and a.id_cluster_jenis_usaha_map="'. $_POST['id_cluster_jenis_usaha_map'] .'" ';
    if ($_POST['id_cluster_jenis_usaha']!="") $where .=' and a.id_cluster_jenis_usaha="'. $_POST['id_cluster_jenis_usaha'] .'" ';
    if ($_POST['hasil_produk']!="") $where .=' and a.hasil_produk="'. $_POST['hasil_produk'] .'" ';
    if ($_POST['varian']!="") $where .=' and a.varian="'. $_POST['varian'] .'" ';
    if ($_POST['provinsi_id']!="") $where .=' and a.provinsi="'. $_POST['provinsi_id'] .'" ';


    $q= "select distinct(kabupaten) as id , b.nama from cluster a 
         inner join kabupaten_kota b on a.kabupaten=b.id
    ". $where;
    return $this->db->query($q)->result_array();

  }

}
  

