<?php

/**
 *
 *
 * @autor 
 * @dzaky Hidayat
 *
 **/
?>
 
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Help extends MX_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->module('login');
		$this->login->is_logged_in();
		$this->load->helper(array('url', 'form', 'html'));

		$this->load->model('help_m');
	}

	public function index()
	{
		$data['navbar'] = 'navbar';
		$data['sidebar'] = 'sidebar';
		$data['content'] = 'help_v';
		$this->load->view('template', $data);
	}

	public function getdataquestion(){

		$list = $this->help_m->get_datafield();
		$data = array();
		$no = $_POST['start'];
		
		foreach ($list->result_array() as $q) {
			$tabel='';
			$tabel= '<table style="border:1px solid;">
						<tr><td>'.$q['question'].'</td></tr>
						<tr><td>'.$q['answer'].'</td></tr>
					</table>';
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $q['BRDESC'];
			$row[] = $tabel;
			$data[] = $row;
		}
		
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $list->num_rows(),
			"recordsFiltered" => $this->help_m->count_all(),
			"data" => $data,
		);
		echo json_encode($output);
	}

	public function inputformhelp(){
		$this->help_m->inputformhelp_m();
	}

}
