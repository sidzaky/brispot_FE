<?php

/**
 * @author dzaky
 * @copyright 2018
 */

?>

<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_m extends CI_Model
{

	//protected $collection_name = 'user';

	function login($username, $password)
	{
		$uker = "";
		if ($username != "admin") {
			$uker = " left join branch b on a.username=b.BRANCH ";
		}
		$sql = "select * from user a " . $uker . " where username='" . $username . "' and password='" . $password . "'";

		$query = $this->db->query($sql);

		if ($query->num_rows() == 1) {
			return $query->result();
		} else {
			return null;
		}
	}

	function signup_m()
	{
		$password = md5($_POST['password']);
		$newdata= array(
				'password' 	=> $password,
				'uppwd'		=> '0'
		);
		$this->db->where('id',$this->session->userdata('id'));
		$res = $this->db->update('user',$newdata);


		// $sql = "update user set password='" . $password . "', uppwd='0' where id='" . $this->session->userdata('id') . "'";
        // $res = $this->db->query($sql);

        $sql = "insert into cluster_log values('','".$this->session->userdata('id')."', 'penggantian password pada uker " . $_POST['kode_uker_c'] . " ','".time()."')";
        $this->db->query($sql);
        return !!$res;
	}


	function chpassuker_m()
	{

		if (!isset($_POST['kode_uker_c'])) $id = $this->session->userdata('kode_uker');
		else $id=$_POST['kode_uker_c'];
		$password = md5($_POST['password']);
		$newdata= array(
				'password' 	=> $password
		);
		$this->db->where('username',$id);
		$this->db->update('user',$newdata);
        $sql = "insert into cluster_log values('','".$this->session->userdata('id')."', 'penggantian password pada uker " . $_POST['kode_uker_c'] . "', '".time()."' )";
        $this->db->query($sql);

	}

	function closenotif_m()
	{
		$sql = "update user set notif=0 where id='" . $this->session->userdata('id') . "'";
		$this->db->query($sql);
	}
}
/* End of file user_m.php */
/* Location: ./application/models/user_m.php */