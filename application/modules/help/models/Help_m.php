

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class help_m extends CI_Model 
{

   
    public function __construct()
    {
            parent::__construct();
            //Load Dependencies
    }
    
    public function get_datafield($status = null)
	{
		$sql  = $this->get_datatables($status);
		$sql .= "  LIMIT " . ($_POST['start'] != 0 ? $_POST['start'] . ', ' : '') . " " . ($_POST['length'] != 0 ? $_POST['length'] : '200');
		
		return $this->db->query($sql);
	}

	var $column_search = array('question', 'answer');
	var $order = array('timestamp' => 'desc');

	public function get_datatables($status = null)
	{
		$i = 0;
        $sql = "select * from faq a
                left join branch b on a.id_user = b.BRANCH where ";
		switch ($this->session->userdata('permission')) {
			case (4):
				$sql .= " true ";
				break;
			default :
				$sql .= " id_user='" . $this->session->userdata("kode_uker") . "' ";
				break;
		}

		// if ($_POST['search']['value'] != "") $sql .= " and ";
		// foreach ($this->column_search as $item) // looping awal
		// {
		// 	if ($_POST['search']['value'] != "") // jika datatable mengirimkan pencarian dengan metode POST
		// 	{
		// 		if ($i === 0) // looping awal
		// 		{
		// 			$sql .= ' (' . $item . ' LIKE "%' . $_POST['search']['value'] . '%" ESCAPE "!" ';
		// 		} else {
		// 			$sql .= ' OR ' . $item . ' LIKE "%' . $_POST['search']['value'] . '%" ESCAPE "!" ';
		// 		}
		// 		if (count($this->column_search) - 1 == $i)
		// 			$sql .= " ) ";
		// 	}
		// 	$i++;
		// }
		$sql .= " order by  timeinput_answer asc, timeinput_question desc ";
		return $sql;
	}

	public function count_all()
	{
		$sql  = $this->get_datatables();
		return  $this->db->query($sql)->num_rows();
    }
    
    public function inputformhelp_m(){
        $_POST['id_help']    = $this->uuid->v4(true);
        $_POST['id_user']    = $this->session->userdata('kode_uker');
        $_POST['timeinput_question'] = time();
        $this->db->insert('faq',$_POST);
    }

    public function answerformhelp_m(){
        $id = $_POST['id_help'];
        $_POST['timeinput_answer'] = time();
        unset ($_POST['id_help']);
        $this->db->where('id_help', $id);
		$this->db->update('faq', $_POST);
    }
}	
	
/* End of file user_m.php */
/* Location: ./application/models/user_m.php */