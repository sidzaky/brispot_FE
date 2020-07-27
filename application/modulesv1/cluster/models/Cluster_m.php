

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cluster_m extends CI_Model 
{
		
		public function get_datafield(){
			$sql  = $this->get_datatables();
			$sql .= "  LIMIT ".($_POST['start']!=0 ? $_POST['start'].', ' : '' )." ". ($_POST['length']!=0 ? $_POST['length'] : '200' );
			
		
			return $this->db->query($sql);
		}
		
		var $column_search = array('nama_pekerja','personal_number','kanwil','kanca','kode_uker','uker','kelompok_usaha','kelompok_jumlah_anggota','lokasi_usaha','sektor_usaha','jenis_usaha','hasil_produk');
		var $order = array('id' => 'asc');
		
		public function get_datatables(){
			$i=0;
			$sql="select * from cluster where "; 
			switch ($this->session->userdata('permission')) {
				case (4) :
					$sql .=" true ";
					break;
				case (3) :
					$sql .=" kode_kanwil='".$this->session->userdata('kode_kanwil')."' ";
					break;
				case (2) :
					$sql .=" kode_kanca='".$this->session->userdata('kode_kanca')."' ";
					break;
				case (1) :
					$sql .=" kode_uker='".$this->session->userdata("kode_uker")."' ";
					break;
			}
			
			
			if ($_POST['search']['value']!="") $sql.="  and ";
			foreach ($this->column_search as $item) // looping awal
			{
				if($_POST['search']['value']!="") // jika datatable mengirimkan pencarian dengan metode POST
					{	
						if($i===0) // looping awal
						{	
							$sql .= ' ('.$item.' LIKE "%'.$_POST['search']['value'].'%" ESCAPE "!" ';
						}
						else
						{
							$sql .= ' OR '.$item.' LIKE "%'.$_POST['search']['value'].'%" ESCAPE "!" ';
						}
						if(count($this->column_search) - 1 == $i) 
							$sql .= " ) ";
					}
				$i++;
			}
			
			return $sql ;
		}
		public function count_all()
		{	
			$sql  = $this->get_datatables();
			return  $this->db->query($sql)->num_rows();
		}	
		
		
		public function getreport_m($harian){
			$where="";
			switch ($this->session->userdata('permission')) {
				case (4) :
					$where .=" where true ";
					break;
				case (3) :
					$where .=" where kode_kanwil='".$this->session->userdata('kode_kanwil')."' ";
					break;
			}
			if ($harian!="") $where .=" and timestamp>1576085405  ";
			$sql='select FROM_UNIXTIME(timestamp, "%H:%i:%s %d %M %Y") as date, 
													kanwil, kanca, kode_kanca, uker, kode_uker,kaunit_nama,kaunit_pn,
													CONCAT("\'",kaunit_handphone) as kaunit_handphone,
													nama_pekerja, personal_number, 
													CONCAT("\'",handphone_pekerja) as handphone_pekerja,
													kelompok_usaha, kelompok_jumlah_anggota,kelompok_anggota_pinjaman,lokasi_usaha,kode_pos,provinsi,kabupaten,kecamatan,kelurahan,sektor_usaha, jenis_usaha, hasil_produk, jenis_usaha_map, 
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
													simpanan_bank,agen_brilink from cluster '.$where.' order by kanwil asc';
			return $this->db->query($sql)->result_array();
		}
		
		
		public function cekuker_m(){
			$where="";
			switch ($this->session->userdata('permission')) {
				case (4) :
					$where .=" and true ";
					break;
				case (3) :
					$where .=" and REGION='".$this->session->userdata('kode_kanwil')."' ";
					break;
				case (2) :
					$where .=" and MAINBR='".$this->session->userdata('kode_kanca')."' ";
					break;
			}
			
			$query=$this->db->query("select * from branch where BRANCH='".$_POST['kode_uker']."'".$where);
			if($query->num_rows()==1){ 
				return $query->result_array();
			}
			else return false;
		}
		
		public function getdata_m(){
			$query=$this->db->query("select * from cluster where id='".$_POST['id']."'");
			return $query->result_array();
		}
		
		public function deldata_m(){
			if (isset($_POST['id'])) {
				$sql="delete from cluster where id='".$_POST['id']."'";
				$this->db->query($sql);
			}
		}
		var $qdataall=array('select FROM_UNIXTIME(timestamp, "%H:%i:%s %d %M %Y") as date, 
													kanwil, kanca, kode_kanca, uker, kode_uker,kaunit_nama,kaunit_pn,
													CONCAT("\'",kaunit_handphone) as kaunit_handphone,
													nama_pekerja, personal_number, 
													CONCAT("\'",handphone_pekerja) as handphone_pekerja,
													kelompok_usaha, kelompok_jumlah_anggota,kelompok_anggota_pinjaman,lokasi_usaha,kode_pos,provinsi,kabupaten,kecamatan,kelurahan,sektor_usaha, jenis_usaha, hasil_produk, jenis_usaha_map, 
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
													simpanan_bank,agen_brilink from cluster');
		
		public function getdataall_m($harian){
			// print_r ($_POST);
			if ($_POST['kanwil']==""){
				if ($this->session->userdata('permission')==4){
					$where=" true ";
				}
			}
			else $where= "kanwil='".$_POST['kanwil']."'" ;
			if ($harian!=null) $where .=" and `timestamp`>1576085405 ";
			$sql='select FROM_UNIXTIME(timestamp, "%H:%i:%s %d %M %Y") as date, 
													kanwil, kanca, kode_kanca, uker, kode_uker,kaunit_nama,kaunit_pn,
													CONCAT("\'",kaunit_handphone) as kaunit_handphone,
													nama_pekerja, personal_number, 
													CONCAT("\'",handphone_pekerja) as handphone_pekerja,
													kelompok_usaha, kelompok_jumlah_anggota,kelompok_anggota_pinjaman,lokasi_usaha,kode_pos,provinsi,kabupaten,kecamatan,kelurahan,sektor_usaha, jenis_usaha, hasil_produk, jenis_usaha_map, 
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
													simpanan_bank,agen_brilink from cluster where '.$where.' order by timestamp desc';
			$query=$this->db->query($sql);
			return $query->result_array();
		}
		
		////////////////////////////////////////////////////for safety
		/*
			select 	id, FROM_UNIXTIME(timestamp, '%H:%i:%s %d %M %Y') as date, 
				kanwil, kanca, kode_kanca, uker, kode_uker,kaunit_nama,kaunit_pn,
				CONCAT("'",kaunit_handphone) as kaunit_handphone,
				nama_pekerja, personal_number, 
				CONCAT("'",handphone_pekerja) as handphone_pekerja,
				kelompok_usaha, kelompok_jumlah_anggota,kelompok_anggota_pinjaman,lokasi_usaha,kode_pos,provinsi,kabupaten,kecamatan,kelurahan,sektor_usaha, jenis_usaha, hasil_produk, jenis_usaha_map, 
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
				simpanan_bank,agen_brilink from cluster
				where `timestamp`>1576085405 order BY `timestamp` desc
		*//////////////////////////////////////////////////////////////////////
		
		public function updatedata_m(){
			$id=$_POST['id'];
			$_POST['userlatestupdate']=$this->session->userdata('kode_uker');
			$query=$this->db->query("select * from branch where BRANCH='".$_POST['kode_uker']."'")->result_array();
			$_POST['kanwil']=$query[0]['RGDESC'];
			$_POST['kanca']=$query[0]['MBDESC'];
			$_POST['uker']=$query[0]['BRDESC'];
			$_POST['kode_kanwil']=$query[0]['REGION'];
			$_POST['kode_kanca']=$query[0]['MAINBR'];
			
			$_POST['timestamp']=time();
			unset($_POST['id']);
			$this->db->where('id',$id);
			$this->db->update('cluster',$_POST);
		}
		
		
		public function insertdata_m(){
			$query=$this->db->query("select * from branch where BRANCH='".$_POST['kode_uker']."'")->result_array();
			$_POST['userlatestupdate']=$this->session->userdata('kode_uker');
			$_POST['kanwil']=$query[0]['RGDESC'];
			$_POST['kanca']=$query[0]['MBDESC'];
			$_POST['uker']=$query[0]['BRDESC'];
			$_POST['kode_kanwil']=$query[0]['REGION'];
			$_POST['kode_kanca']=$query[0]['MAINBR'];
			
			$_POST['timestamp']=time();
			$this->db->insert('cluster',$_POST);
		}
		
		public function cekkpos_m(){
			return $this->db->query("select * from tbl_kodepos where kodepos='".$_POST['kodepos']."'")->result_array();
		}


}
/* End of file user_m.php */
/* Location: ./application/models/user_m.php */