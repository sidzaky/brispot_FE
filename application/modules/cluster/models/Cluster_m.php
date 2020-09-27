<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cluster_m extends CI_Model
{
	public function get_datafield($status = null, $appr = 0)
	{
		$sql  = $this->get_datatables($status, $appr);
		$sql .= "  LIMIT " . ($_POST['start'] != 0 ? $_POST['start'] . ', ' : '') . " " . ($_POST['length'] != 0 ? $_POST['length'] : '200');
		return $this->db->query($sql);
	}

	var $column_search = array('nama_pekerja', 'personal_number', 'kanwil', 'kanca', 'kode_uker', 'uker', 'kelompok_usaha', 'kelompok_jumlah_anggota', 'lokasi_usaha');
	var $order = array('timestamp' => 'desc');

	public function get_datatables($status = null, $appr = 0)
	{
		$i = 0;
		$sql = "select * from cluster where ";
		switch ($this->session->userdata('permission')) {
			case (4):
				$sql .= " true ";
				break;
			case (3):
				$sql .= " kode_kanwil='" . $this->session->userdata('kode_kanwil') . "' ";
				break;
			case (2):
				$sql .= " kode_kanca='" . $this->session->userdata('kode_kanca') . "' ";
				break;
			case (1):
				$sql .= " kode_uker='" . $this->session->userdata("kode_uker") . "' ";
				break;
		}



		// if ($appr=1) $sql .= " approve ====="; //buat filter status approve

		if ($_POST['search']['value'] != "") $sql .= " and ";
		foreach ($this->column_search as $item) // looping awal
		{
			if ($_POST['search']['value'] != "") // jika datatable mengirimkan pencarian dengan metode POST
			{
				if ($i === 0) // looping awal
				{
					$sql .= ' (' . $item . ' LIKE "%' . $_POST['search']['value'] . '%" ESCAPE "!" ';
				} else {
					$sql .= ' OR ' . $item . ' LIKE "%' . $_POST['search']['value'] . '%" ESCAPE "!" ';
				}
				if (count($this->column_search) - 1 == $i)
					$sql .= " ) ";
			}
			$i++;
		}
		$sql = $sql . ' and cluster_status=1 ' . ($status != null ? " and checker_status=1 and signer_status=1 " : "") . " order by timestamp desc";
		return $sql;
	}

	public function count_all()
	{
		$sql  = $this->get_datatables();
		return  $this->db->query($sql)->num_rows();
	}

    public function get_cluster_sektor_usaha()
	{
		$sql = "select * from cluster_sektor_usaha where status=1";
		return $this->db->query($sql)->result_array();
	}

	public function get_cluster_kebutuhan_pendidikan_pelatihan()
	{
		$sql = "select * from cluster_kebutuhan_pendidikan_pelatihan where status=1";
		return $this->db->query($sql)->result_array();
	}

	public function get_cluster_kebutuhan_sarana()
	{
		$sql = "select * from cluster_kebutuhan_sarana where status=1";
		return $this->db->query($sql)->result_array();
	}

	public function get_cluster_kebutuhan_skema_kredit()
	{
		$sql = "select * from cluster_kebutuhan_skema_kredit where status=1";
		return $this->db->query($sql)->result_array();
	}


	public function getreport_m($harian)
	{
		$where = "";
		switch ($this->session->userdata('permission')) {
			case (4):
				$where .= " where true ";
				break;
			case (3):
				$where .= " where kode_kanwil='" . $this->session->userdata('kode_kanwil') . "' ";
				break;
			default:
				$where .= " where false";
				break;
		}
		if ($harian != "") $where .= " and timestamp>1576085405  ";
		$sql = 'SELECT 	FROM_UNIXTIME( TIMESTAMP, "%H:%i:%s %d %M %Y" ) AS date,
								kanwil,
								kanca,
								kode_kanca,
								uker,
								kode_uker,
								kaunit_nama,
								kaunit_pn,
								CONCAT( "\'", kaunit_handphone ) AS kaunit_handphone,
								nama_pekerja,
								personal_number,
								CONCAT( "\'", handphone_pekerja ) AS handphone_pekerja,
								kelompok_usaha,
								kelompok_jumlah_anggota,
								kelompok_anggota_pinjaman,
								lokasi_usaha,
								e.kode_pos,
								b.nama AS provinsi,
								c.nama AS kabupaten,
								d.nama AS kecamatan,
								e.nama AS kelurahan,
								a.id_cluster_sektor_usaha,
								a.id_cluster_jenis_usaha_map,
								a.id_cluster_jenis_usaha,
								nama_cluster_jenis_usaha,
								nama_cluster_jenis_usaha_map,
								keterangan_cluster_sektor_usaha
								hasil_produk,
								pasar_ekspor,
								pasar_ekspor_tahun,
								pasar_ekspor_nilai,
								kelompok_pihak_pembeli,
								CONCAT( "\'", kelompok_pihak_pembeli_handphone ) AS kelompok_pihak_pembeli_handphone,
								kelompok_suplier_produk,
								CONCAT( "\'", kelompok_suplier_handphone ) AS kelompok_suplier_handphone,
								kelompok_luas_usaha,
								CONCAT( "\'", kelompok_omset ) AS kelompok_omset,
								kelompok_perwakilan,
								kelompok_jenis_kelamin,
								CONCAT( "\'", kelompok_NIK ) AS kelompok_NIK,
								CONCAT( "\'", kelompok_handphone ) AS kelompok_handphone,
								kelompok_perwakilan_tgl_lahir,
								kelompok_perwakilan_tempat_lahir,
								pinjaman,
								CONCAT( "\'", nominal_pinjaman ) AS nominal_pinjaman,
								CONCAT( "\'", norek_pinjaman_bri ) AS norek_pinjaman_bri,
								kebutuhan_skema_kredit,
								kebutuhan_sarana,
								kebutuhan_sarana_lainnya,
								kebutuhan_pendidikan,
								simpanan_bank,
								agen_brilink 
					FROM	cluster a
					left join provinsi b on a.provinsi=b.id
					left join kabupaten_kota c on a.kabupaten=c.id
					left join kecamatan d on a.kecamatan=d.id
					left join kelurahan e on a.kelurahan=e.id 
					left join cluster_sektor_usaha f on f.id_cluster_sektor_usaha=a.id_cluster_sektor_usaha
					left join cluster_jenis_usaha_map g on g.id_cluster_jenis_usaha_map=a.id_cluster_jenis_usaha_map
					left join cluster_jenis_usaha h on h.id_cluster_jenis_usaha=a.id_cluster_jenis_usaha 
					' . $where . ' order by kanwil asc';
		return $this->db->query($sql)->result_array();
	}


	public function cekuker_m()
	{
		$where = "";
		switch ($this->session->userdata('permission')) {
			case (4):
				$where .= " and true ";
				break;
			case (3):
				$where .= " and REGION='" . $this->session->userdata('kode_kanwil') . "' ";
				break;
			case (2):
				$where .= " and MAINBR='" . $this->session->userdata('kode_kanca') . "' ";
				break;
		}

		$query = $this->db->query("select * from branch where BRANCH='" . $_POST['kode_uker'] . "'" . $where);
		if ($query->num_rows() == 1) {
			return $query->result_array();
		} else return false;
	}

	public function getdata_m()
	{
		$query = $this->db->query("select * from cluster where id='" . $_POST['id'] . "'");
		return $query->result_array();
	}

	public function approve()
	{
		if (isset($_POST['id'])) {
			if ($user == "ceker")
				$sql = "update cluster set checker_status=1 where id='" . $_POST['id'] . "'";
			elseif ($user == "singner")
				$sql = "update cluster set signer_status=1 where id='" . $_POST['id'] . "'";
			$this->db->query($sql);
		}
	}

	public function getdatafoto_m($db)
	{
		$query = $this->db->query('select * from ' . $db . ' where id_cluster="' . $_POST['id'] . '"');
		return $query->result_array();
	}

	public function deldata_m()
	{
		if (isset($_POST['id'])) {
			$sql = "update cluster set cluster_status=0 where id='" . $_POST['id'] . "'";
			$this->db->query($sql);
		}
	}
	var $qdataall = array('select   FROM_UNIXTIME(timestamp, "%H:%i:%s %d %M %Y") as date, 
													kanwil, kanca, kode_kanca, uker, kode_uker,kaunit_nama,kaunit_pn,
													CONCAT("\'",kaunit_handphone) as kaunit_handphone,
													nama_pekerja, personal_number, 
													CONCAT("\'",handphone_pekerja) as handphone_pekerja,
													kelompok_usaha, kelompok_jumlah_anggota,kelompok_anggota_pinjaman,lokasi_usaha,
													e.kode_pos,b.nama as provinsi,c.nama as kabupaten,d.nama as kecamatan,e.nama as kelurahan,
													sektor_usaha, jenis_usaha, hasil_produk, jenis_usaha_map, 
													pasar_ekspor,pasar_ekspor_tahun,pasar_ekspor_nilai,kelompok_pihak_pembeli, 
													CONCAT("\'",kelompok_pihak_pembeli_handphone) as  kelompok_pihak_pembeli_handphone,
													kelompok_suplier_produk,				
													CONCAT("\'",kelompok_suplier_handphone)  as kelompok_suplier_handphone,
													kelompok_luas_usaha,CONCAT("\'",kelompok_omset) as  kelompok_omset,
													kelompok_perwakilan,kelompok_jenis_kelamin,
													CONCAT("\'",kelompok_NIK) as kelompok_NIK,
													CONCAT("\'",kelompok_handphone) as kelompok_handphone,
													kelompok_perwakilan_tgl_lahir,kelompok_perwakilan_tempat_lahir,
													pinjaman,CONCAT("\'",nominal_pinjaman) as  nominal_pinjaman, 
													CONCAT("\'",norek_pinjaman_bri) as  norek_pinjaman_bri,
													kebutuhan_skema_kredit,kebutuhan_sarana, kebutuhan_sarana_lainnya, kebutuhan_pendidikan,
													simpanan_bank,agen_brilink from cluster  a
													left join provinsi b on a.provinsi=b.id
													left join kabupaten_kota c on a.kabupaten=c.id
													left join kecamatan d on a.kecamatan=d.id
													left join kelurahan e on a.kelurahan=e.idz');

	public function getdataall_m($harian)
	{
		if ($_POST['kanwil'] == "") {
			if ($this->session->userdata('permission') == 4) {
				$where = " true ";
			}
		} else $where = "kanwil='" . $_POST['kanwil'] . "'";
		if ($harian != null) $where .= " and `timestamp`>1576085405 ";
		$sql = 'SELECT	FROM_UNIXTIME( TIMESTAMP, "%H:%i:%s %d %M %Y" ) AS date,
								kanwil,
								kanca,
								kode_kanca,
								uker,
								kode_uker,
								kaunit_nama,
								kaunit_pn,
								CONCAT( "\'", kaunit_handphone ) AS kaunit_handphone,
								nama_pekerja,
								personal_number,
								CONCAT( "\'", handphone_pekerja ) AS handphone_pekerja,
								kelompok_usaha,
								kelompok_jumlah_anggota,
								kelompok_anggota_pinjaman,
								lokasi_usaha,
								e.kode_pos,
								b.nama AS provinsi,
								c.nama AS kabupaten,
								d.nama AS kecamatan,
								e.nama AS kelurahan,
								keterangan_cluster_sektor_usaha,
								nama_cluster_jenis_usaha_map,
								nama_cluster_jenis_usaha,
								hasil_produk,
								pasar_ekspor,
								pasar_ekspor_tahun,
								pasar_ekspor_nilai,
								kelompok_pihak_pembeli,
								CONCAT( "\'", kelompok_pihak_pembeli_handphone ) AS kelompok_pihak_pembeli_handphone,
								kelompok_suplier_produk,
								CONCAT( "\'", kelompok_suplier_handphone ) AS kelompok_suplier_handphone,
								kelompok_luas_usaha,
								CONCAT( "\'", kelompok_omset ) AS kelompok_omset,
								kelompok_perwakilan,
								kelompok_jenis_kelamin,
								CONCAT( "\'", kelompok_NIK ) AS kelompok_NIK,
								CONCAT( "\'", kelompok_handphone ) AS kelompok_handphone,
								kelompok_perwakilan_tgl_lahir,
								kelompok_perwakilan_tempat_lahir,
								pinjaman,
								CONCAT( "\'", nominal_pinjaman ) AS nominal_pinjaman,
								CONCAT( "\'", norek_pinjaman_bri ) AS norek_pinjaman_bri,
								kebutuhan_skema_kredit,
								kebutuhan_sarana,
								kebutuhan_sarana_lainnya,
								kebutuhan_pendidikan,
								simpanan_bank,
								agen_brilink 
							FROM
								cluster a
								LEFT JOIN provinsi b ON a.provinsi = b.id
								LEFT JOIN kabupaten_kota c ON a.kabupaten = c.id
								LEFT JOIN kecamatan d ON a.kecamatan = d.id
								LEFT JOIN kelurahan e ON a.kelurahan = e.id 
								left join cluster_sektor_usaha f on f.id_cluster_sektor_usaha=a.id_cluster_sektor_usaha
								left join cluster_jenis_usaha_map g on g.id_cluster_jenis_usaha_map=a.id_cluster_jenis_usaha_map
								left join cluster_jenis_usaha h on h.id_cluster_jenis_usaha=a.id_cluster_jenis_usaha 
							WHERE ' . $where . ' order by timestamp desc';
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	/*
		select 	FROM_UNIXTIME(timestamp, '%H:%i:%s %d %M %Y') as date, 
				kanwil, kanca, kode_kanca, uker, kode_uker,kaunit_nama,kaunit_pn,
				CONCAT("'",kaunit_handphone) as kaunit_handphone,
				nama_pekerja, personal_number, 
				CONCAT("'",handphone_pekerja) as handphone_pekerja,
				kelompok_usaha, kelompok_jumlah_anggota,kelompok_anggota_pinjaman,lokasi_usaha,
				e.kode_pos,b.nama,c.nama,d.nama,e.nama,
				sektor_usaha, jenis_usaha, hasil_produk, jenis_usaha_map, 
				pasar_ekspor,pasar_ekspor_tahun,pasar_ekspor_nilai,kelompok_pihak_pembeli, 
				CONCAT("'",kelompok_pihak_pembeli_handphone) as  kelompok_pihak_pembeli_handphone,
				kelompok_suplier_produk,				
				CONCAT("'",kelompok_suplier_handphone)  as kelompok_suplier_handphone,
				kelompok_luas_usaha,CONCAT("'",kelompok_omset) as  kelompok_omset,
				kelompok_perwakilan,kelompok_jenis_kelamin,
				CONCAT("'",kelompok_NIK) as kelompok_NIK,
				CONCAT("'",kelompok_handphone) as kelompok_handphone,
				kelompok_perwakilan_tgl_lahir,kelompok_perwakilan_tempat_lahir,
				pinjaman,CONCAT("'",nominal_pinjaman) as  nominal_pinjaman, 
				CONCAT("'",norek_pinjaman_bri) as  norek_pinjaman_bri,
				kebutuhan_skema_kredit,kebutuhan_sarana, kebutuhan_sarana_lainnya, kebutuhan_pendidikan,
				simpanan_bank,agen_brilink from cluster a
				left join provinsi b on a.provinsi=b.id
				left join kabupaten_kota c on a.kabupaten=c.id
				left join kecamatan d on a.kecamatan=d.id
				left join kelurahan e on a.kelurahan=e.id
				where `timestamp`>1576085405 order BY `timestamp` desc
				*/




	public function updatedata_m($rfex = null, $rfku = null)
	{
		$id = $_POST['id'];
		$_POST['userlatestupdate'] = $this->session->userdata('kode_uker');
		$query = $this->db->query("select * from branch where BRANCH='" . $_POST['kode_uker'] . "'")->result_array();
		$_POST['kanwil'] = $query[0]['RGDESC'];
		$_POST['kanca'] = $query[0]['MBDESC'];
		$_POST['uker'] = $query[0]['BRDESC'];
		$_POST['kode_kanwil'] = $query[0]['REGION'];
		$_POST['kode_kanca'] = $query[0]['MAINBR'];
		$_POST['timestamp'] = time();
		$_POST['cluster_status'] = 1;
		unset($_POST['id']);
		$this->db->where('id', $id);
		$this->db->update('cluster', $_POST);

		if ($rfex != null) {
			$this->db->query('delete from cluster_doc_ekspor where id_cluster="' . $id . '"');
			$this->uploadimage($rfex, $id, 'doc_ekspor');
		}
		if ($rfku != null) {
			$this->db->query('delete from cluster_foto_usaha where id_cluster="' . $id . '"');
			$this->uploadimage($rfku, $id, 'foto_usaha');
		}
	}


	public function insertdata_m($rfex = null, $rfku = null)
	{
		$query = $this->db->query("select * from branch where BRANCH='" . $_POST['kode_uker'] . "'")->result_array();
		$_POST['id'] = $this->uuid->v4(true);
		$_POST['userlatestupdate'] = $this->session->userdata('kode_uker');
		$_POST['kanwil'] = $query[0]['RGDESC'];
		$_POST['kanca'] = $query[0]['MBDESC'];
		$_POST['uker'] = $query[0]['BRDESC'];
		$_POST['kode_kanwil'] = $query[0]['REGION'];
		$_POST['kode_kanca'] = $query[0]['MAINBR'];
		$_POST['timestamp'] = time();

		$this->db->insert('cluster', $_POST);

		if ($rfex != null) $this->uploadimage($rfex, $_POST['id'], 'doc_ekpor');
		if ($rfku != null) $this->uploadimage($rfku, $_POST['id'], 'foto_usaha');
	}

	public function uploadimage($newdata, $newid, $db)
	{
		for ($i = 0; $i < count($newdata); $i++) {
			$data['id_' . $db] = $this->uuid->v4();
			$data['id_cluster'] = $newid;
			$data['timestampt'] = time();
			$data['location'] = $newdata[$i];
			$this->db->insert('cluster_' . $db, $data);
		}
	}

	public function cekkpos_m()
	{
		return $this->db->query("select * from tbl_kodepos where kodepos='" . $_POST['kodepos'] . "'")->result_array();
	}

	public function getprovinsi_m()
	{
		$sql = "select * from provinsi";
		return $this->db->query($sql)->result_array();
	}

	public function getkotakab_m()
	{
		$sql = "select id, provinsi_id, nama from kabupaten_kota where provinsi_id='" . $_POST['provinsi_id'] . "'";
		return $this->db->query($sql)->result_array();
	}

	public function getkecamatan_m()
	{
		$sql = "select id, kabupaten_kota_id, nama from kecamatan where kabupaten_kota_id='" . $_POST['kabupaten_kota_id'] . "'";
		return $this->db->query($sql)->result_array();
	}

	public function getkelurahan_m()
	{
		$sql = "select id, kecamatan_id, kode_pos, nama from kelurahan where kecamatan_id='" . $_POST['kecamatan_id'] . "'";
		return $this->db->query($sql)->result_array();
	}

	/////////////////////////////////////////////////////////////////////////////
	///////////////////////////cluster anggota
	////////////////////////////////////////////////////////////////////////////

	var $column_search_anggota = array('ca_nama', 'ca_nik', 'ca_alamat', 'ca_tanggal_lahir', 'ca_pinjaman', 'ca_handphone');
	var $order_anggota = array('id_ca' => 'asc');

	public function get_datafield_anggota()
	{
		$sql  = $this->get_datatables_anggota();
		$sql .= "  LIMIT " . ($_POST['start'] != 0 ? $_POST['start'] . ', ' : '') . " " . ($_POST['length'] != 0 ? $_POST['length'] : '200');
		return $this->db->query($sql);
	}

	public function get_datatables_anggota()
	{
		$i = 0;
		$sql = "select * from cluster_anggota where id_cluster='" . $_POST['id'] . "'";


		if ($_POST['search']['value'] != "") $sql .= "  and ";
		foreach ($this->column_search_anggota as $item) // looping awal
		{
			if ($_POST['search']['value'] != "") // jika datatable mengirimkan pencarian dengan metode POST
			{
				if ($i === 0) // looping awal
				{
					$sql .= ' (' . $item . ' LIKE "%' . $_POST['search']['value'] . '%" ESCAPE "!" ';
				} else {
					$sql .= ' OR ' . $item . ' LIKE "%' . $_POST['search']['value'] . '%" ESCAPE "!" ';
				}
				if (count($this->column_search_anggota) - 1 == $i)
					$sql .= " ) ";
			}
			$i++;
		}
		return $sql;
	}
	public function count_all_anggota()
	{
		$sql  = $this->get_datatables_anggota();
		return  $this->db->query($sql)->num_rows();
	}

	public function getdata_anggota_m()
	{
		$query = $this->db->query("select * from cluster_anggota where id_ca='" . $_POST['id_ca'] . "'");
		return $query->result_array();
	}

	public function insertdata_anggota_m()
	{
		$_POST['timeinput'] = time();
		$_POST['userlastupdate'] = $this->session->userdata('kode_uker');
		$this->db->insert('cluster_anggota', $_POST);
	}

	public function updatedata_anggota_m()
	{
		$id_ca = $_POST['id_ca'];
		$_POST['timeinput'] = time();
		$_POST['userlastupdate'] = $this->session->userdata('kode_uker');
		unset($_POST['id_ca']);
		$this->db->where('id_ca', $id_ca);
		$this->db->update('cluster_anggota', $_POST);
	}

	public function deldata_anggota_m()
	{
		if (isset($_POST['id_ca'])) {
			$sql = "delete from cluster_anggota where id_ca='" . $_POST['id_ca'] . "'";
			$this->db->query($sql);
		}
	}

	public function inputanggotacsv_m($anggota)
	{
		$pria = array('pria', 'laki-laki', 'lelaki', 'cowok');
		$wanita = array('wanita', 'perempuan', 'gadis', 'cewek');
		for ($i = 0; $i < count($anggota); $i++) {
			$sql = "	insert cluster_anggota (id_cluster,ca_nama,ca_nik,ca_jk,ca_kodepos,ca_pinjaman,ca_simpanan,ca_handphone, timeinput, userlastupdate)  values('" . $_POST['id_cluster'] . "',";
			$z = 0;
			foreach ($anggota[$i] as $row => $val) {
				if ($z == 2) {
					$val = str_replace($pria, "pria", strtolower($val));
					$val = str_replace($wanita, "wanita", strtolower($val));
				}
				$sql .= "'" . $val . "',";
				$z++;
			}
			$sql .= "" . time() . ",'" . $this->session->userdata('kode_uker') . "')";
			$this->db->query($sql);
		}
	}

	function dldataanggota_m($id = null)
	{
		if (isset($_POST['id_cluster'])) $id = $_POST['id_cluster'];
		$sql = "select a.kanwil, a.kanca, a.uker, a.kelompok_usaha, 
                       ca_nama, concat(\"'\", ca_nik), ca_jk, concat(\"'\", ca_kodepos), ca_pinjaman, ca_simpanan, concat(\"'\", ca_handphone ) 
                from cluster_anggota b
                left join cluster a on b.id_cluster=a.id 
                where id_cluster='" . $id . "'";
		return $this->db->query($sql)->result_array();
	}

	function countanggota_m($i)
	{
		$sql = "select count(id_ca) as sum from cluster_anggota where id_cluster='" . $i . "'";
		return $this->db->query($sql)->result_array();
	}

	function get_data_kanwil_m()
	{
		$where = "";
		switch ($this->session->userdata('permission')) {
			case (4):
				$where .= " and true";
				break;
			case (3):
				$where .= " and kode_kanwil='" . $this->session->userdata('kode_kanwil') . "' ";
				break;
		}
		if (isset($_POST['case'])) $where = ' and kode_kanwil="' . $_POST['REGION'] . '"';
		$data = $this->db->query("select DISTINCT(kanwil),kode_kanwil from cluster where kanwil!='' " . $where . " GROUP BY kanwil")->result_array();
		return $data;
	}

	function report_unit_m()
	{
		$where = "";
		switch ($this->session->userdata('permission')) {
			case (4):
				$where .= " and true";
				break;
			case (3):
				$where .= " and REGION='" . $this->session->userdata('kode_kanwil') . "' ";
				break;
		}
		if (isset($_POST['case'])) $where = ' and REGION="' . $_POST['REGION'] . '"';
		$data = $this->db->query("select DISTINCT(REGION),RGDESC,BRANCH,BRDESC,MBDESC from branch where BRDESC like '%unit%'  " . $where)->result_array();
		return $data;
	}

	function report_unit_count_m($j)
	{
		$data = $this->db->query("select kode_uker from cluster where kode_kanwil='" . $j . "' and timestamp>1576085405 order by kode_uker ")->result_array();
		return $data;
	}

	public function getdata_jum()
	{
		$where = "";
		if (isset($_POST['id_cluster_sektor_usaha'])) $where .= "where id_cluster_sektor_usaha='" . $_POST['id_cluster_sektor_usaha'] . "'";
		$q = "select * from cluster_jenis_usaha_map " . $where;
		return $this->db->query($q)->result();
	}

	public function getdata_ju()
	{
		$where = "";
		if (isset($_POST['id_cluster_jenis_usaha_map'])) $where .= " where id_cluster_jenis_usaha_map='" . $_POST['id_cluster_jenis_usaha_map'] . "'";
		$q = "select * from cluster_jenis_usaha " . $where;
		return $this->db->query($q)->result();
	}

	public function getdata_j($i = "")
	{
		if ($i == "") {
			$i = isset($_POST['id_cluster_jenis_usaha']) ? $_POST['id_cluster_jenis_usaha'] : "0";
		}
		$q = "select * from cluster_jenis_usaha where id_cluster_jenis_usaha='" . ($i) . "'";
		return $this->db->query($q)->result_array();
	}

	function getlist_jum()
	{
		$q = "select * from cluster_jenis_usaha_map";
		return $this->db->query($q)->result_array();
	}

	function getClusterInfo($id)
	{
		$q = "select c.id, c.uker, c.kaunit_nama, c.kaunit_handphone, c.kelompok_usaha, c.hasil_produk, c.kelompok_pihak_pembeli, c.kelompok_pihak_pembeli_handphone, c.kelompok_suplier_produk, c.kelompok_suplier_handphone, c.kelompok_jumlah_anggota, c.kelompok_cerita_usaha, c.kelompok_perwakilan, c.kelompok_handphone, c.lokasi_usaha, c.agen_brilink, c.simpanan_bank, c.pinjaman, k.kebutuhan_pendidikan_pelatihan as pelatihan FROM cluster c INNER JOIN cluster_kebutuhan_pendidikan_pelatihan k ON k.id_cluster_kebutuhan_pendidikan_pelatihan = c.kebutuhan_pendidikan WHERE id = '" . $id . "'";
		return $this->db->query($q)->row_array();
	}

	function getClusterPhotos($id)
	{
		$q = "select location as url from cluster_foto_usaha cluster where id_cluster = '" . $id . "'";
		return $this->db->query($q)->result_array();
	}

	function get_cluster_by_kanwil_m($i = null)
	{
		$q = "select id, kelompok_usaha from cluster where cluster_status=1 and kode_kanwil='" . $i . "'";
		return $this->db->query($q)->result_array();
	}

	function report_anggota_m($i = null)
	{
		$q = "SELECT a.kanwil, a.kode_kanwil, a.id, a.kelompok_usaha, count( b.id_ca ) as total_anggota 
            FROM cluster a
            left join cluster_anggota b on a.id=b.id_cluster
            WHERE a.cluster_status=1 and a.kode_kanwil='" . $i . "' group by a.id";
		return $this->db->query($q)->result_array();
	}

	function dl_report_anggota_m($i = null)
	{
		$q = "select  a.kanwil, a.kanca, a.uker, a.kelompok_usaha, 
                    ca_nama, concat(\"'\", ca_nik), ca_jk, concat(\"'\", ca_kodepos), ca_pinjaman, ca_simpanan, concat(\"'\", ca_handphone ) 
            from cluster a
            inner join cluster_anggota b on a.id=b.id_cluster
            where a.cluster_status=1 and a.kode_kanwil='" . $i . "'";
		return $this->db->query($q)->result_array();
	}



	public function get_datafield_custom($status = null, $custom_field = null)
	{
		$sql  = $this->get_datatables_custom($status, $custom_field);
		if ($custom_field != null) {
			$sql .= "  LIMIT " . ($_POST['start'] != 0 ? $_POST['start'] . ', ' : '') . " " . ($_POST['length'] != 0 ? $_POST['length'] : '200');
		} else $sql .= " LIMIT 0";
		return $this->db->query($sql);
	}

	public function get_datatables_custom($status = null, $custom_field = null)
	{
		$i = 0;
		$sql = "select * from cluster where cluster_status=1 ";
		foreach ($custom_field as $row) {
			if (isset($row->df) && $row->df != "") {
				switch ($row->sf) {
					case "sektor":
						$sql .= " and id_cluster_sektor_usaha = '" . $row->df . "' ";
						break;
					case "kategori":
						$sql .=  " and id_cluster_jenis_usaha_map = '" . $row->df . "' ";
						break;
					case "jenis":
						$sql .=  " and id_cluster_jenis_usaha= '" . $row->df . "' ";
						break;
					case "kebutuhan_pendidikan":
						$sql .=  " and kebutuhan_pendidikan= '" . $row->df . "' ";
						break;
					case "kebutuhan_sarana":
						$sql .=  " and kebutuhan_sarana= '" . $row->df . "' ";
						break;
					case "kebutuhan_skema_kredit":
						$sql .=  " and kebutuhan_skema_kredit= '" . $row->df . "' ";
						break;
					case "kode_kanwil":
						$sql .=  " and kode_kanwil= '" . $row->df . "' ";
						break;
					case "kode_kanca":
						if ($row->df != "") {
							$sql .=  " and kode_kanca= '" . $row->df . "' ";
						}
						break;
					case "kode_uker":
						$sql .=  " and kode_uker= '" . $row->df . "' ";
						break;
					default:
						$sql .= '  and  ( ' . $row->sf . ' LIKE "%' . $row->df . '%" ESCAPE "!")';
						break;
				}
				$i++;
			}
		}
		//echo $sql;
		return $sql;
	}

	public function count_all_custom($status = null, $custom_field = null)
	{
		$sql  = $this->get_datatables_custom($status,  $custom_field);
		if ($custom_field == null) {
			$sql .= " Limit 0";
		}
		return  $this->db->query($sql)->num_rows();
	}

	public function get_kanca_m()
	{
		$sql = 'select * from branch where REGION="' . $_POST['kode_kanwil'] . '" and BRUNIT="B" and RGDESC<>MBDESC';
		return $this->db->query($sql)->result_array();
	}

	public function get_unit_m()
	{
		$sql = 'select * from branch where MAINBR="' . $_POST['kode_kanca'] . '" and BRANCH<>"' . $_POST['kode_kanca'] . '"';
		return $this->db->query($sql)->result_array();
	}
}
/* End of file user_m.php */
/* Location: ./application/models/user_m.php */