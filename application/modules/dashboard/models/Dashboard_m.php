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
}
