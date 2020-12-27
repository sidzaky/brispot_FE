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
								e.kode_pos,
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
}
