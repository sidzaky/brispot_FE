<?php

/**
 * @author Nicky
 * @copyright 2015
 */

?>

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class listdata_m extends CI_Model 
{
	protected $table_name = 'diagnosa';
   
    public function __construct()
    {
            parent::__construct();
            //Load Dependencies
    }

	public function getbasis(){
		$sql="select * from basis_pengetahuan bp
			  inner join gejala g on bp.id_gejala=g.id_gejala
			  inner join penyakit p on bp.id_penyakit=p.id_penyakit
			  ";
			if ($_POST['id']!=null) $sql .= " where id_diagnosa='".$_POST['id']."'";
		$query = $this->db->query($sql)->result();
		return $query;
	}
	
	public function getlistgejala($i){
		$sql="select * from gejala";
			if ($_POST['id']!=null || $i!=null) $sql .= " where id_gejala='".$_POST['id'].$i."'";
		$query = $this->db->query($sql)->result();
		return $query;
	}
	
	public function getpenyakitforgejala($i){
		$sql="select * from penyakit p
			 inner join basis_pengetahuan bp on bp.id_penyakit=p.id_penyakit
			 where bp.id_gejala='".$i."'";
		$query = $this->db->query($sql)->result();
		return $query;
	}
	
	
	
	public function getlistpenyakit($i){
		$sql="select * from penyakit";
			if ($_POST['id']!=null || $i!=null) $sql .= " where id_penyakit='".$_POST['id'].$i."'";
		$query = $this->db->query($sql);
		return $query;
	}
	
	public function delgejala(){
		$sql="delete from gejala where id_gejala='".$_POST['id']."'";
		$this->db->query($sql);
		
		$sql="delete from basis_pengetahuan where id_gejala='".$_POST['id']."'";
		$this->db->query($sql);
		
	}
	
	public function delpenyakit(){
		$sql="delete from penyakit where id_penyakit='".$_POST['id']."'";
		$this->db->query($sql);
		
		$sql="delete from basis_pengetahuan where id_penyakit='".$_POST['id']."'";
		$this->db->query($sql);
		
	}
	
	public function updatepenyakit(){
		
		$sql="update penyakit set nama_penyakit='".$_POST['nama']."', 
								  kode_penyakit='".$_POST['kode']."', 
								  detail_penyakit='".$_POST['detail']."',
								  solusi='".$_POST['solusi']."'
			  where id_penyakit='".$_POST['id']."'";
		$this->db->query($sql);
	}
	
	public function updategejala(){
		$del="delete from basis_pengetahuan where id_gejala='".$_POST['id']."'";
		$this->db->query($del);
		
		$sql="update gejala set nama_gejala='".$_POST['nama']."', CF='".$_POST['CF']."' where id_gejala='".$_POST['id']."'";
		$this->db->query($sql);
		
		for ($i=0;$i<sizeof($_POST['penyakit']);$i++){
			$this->gejalatobasis($_POST['penyakit'][$i],$_POST['id']);
		}
	}
	
	public function inputpenyakit(){
		$sql="insert into penyakit values ('','".$_POST['nama']."','".$_POST['kode']."','".$_POST['detail']."','".$_POST['solusi']."')";
		$this->db->query($sql);
	}
	
	public function inputgejala(){
		$sql="insert into gejala values ('','".$_POST['nama']."','".$_POST['CF']."')";
		$this->db->query($sql);
		$id=$this->db->insert_id();
		for ($i=0;$i<sizeof($_POST['penyakit']);$i++){
			$this->gejalatobasis($_POST['penyakit'][$i],$id);
		}
	}
	
	public function gejalatobasis($a,$b){
		$sql="insert into basis_pengetahuan values('','".$a."','".$b."')";
		$this->db->query($sql);
		
	}
}

	
	
/* End of file user_m.php */
/* Location: ./application/models/user_m.php */