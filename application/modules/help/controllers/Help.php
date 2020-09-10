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
			$tabel= '<table class="table table-striped">
						<tr><td><b>Pertanyaan</b></td><td align="right">'.date('d, M-Y ', $q['timeinput_question']) .'</td></tr>
						<tr><td colspan="2"><p id="q_'.$q['id_help'].'">'.$q['question'].'</p></td></tr>
						'.($q['answer']!="" ? '<tr><td>Jawaban</td><td align="right">'.date('d, M-Y ', $q['timeinput_answer']) .'</td></tr> <tr><td colspan="2">'.$q['answer'].'</td></tr>' : '').'
						</table>';
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $q['BRDESC'];
			$row[] = $tabel;
			if ($this->session->userdata('permission') == 4){
				$row[] = ($q['answer'] !="" ? '<button class="btn btn-success waves-effect waves-light btn-sm btn-block" type="button" ><i class="fa fa-check"></i> Check </button> ': '<button class="btn btn-info waves-effect waves-light btn-sm btn-block" onclick="answer(\'' . $q['id_help'] . '\')" type="button" ><i class="fa fa-pencil"></i> Jawab </button>');
			}
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

	public function answerformhelp(){
		$this->help_m->answerformhelp_m();
	}
}
