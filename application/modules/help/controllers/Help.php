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
	}

	public function index()
	{
		$data['navbar'] = 'navbar';
		$data['sidebar'] = 'sidebar';
		$data['content'] = 'help_v';
		$this->load->view('template', $data);
		
	}

	public function getdataquestion(){

		$url = "help/getDataQuestion";
		$postData = Array (
			'permission'  => $this->session->userdata('permission'),
			'kode_uker'	  => $this->session->userdata('kode_uker'),
			'get'		  => $this->input->post(),
		);
		$postData = json_encode($postData);
		$list = json_decode($this->sending->send($url, $postData), true); 
		$data = array();
		$no = $this->input->post('start');
		
		foreach ($list['list'] as $q) {
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
			"draw" => $this->input->post('draw'),
			"recordsTotal" => count($list['list']),
			"recordsFiltered" => $list['count'],
			"data" => $data,
		);
		echo json_encode($output);
	}

	public function inputformhelp(){
		$url = "help/postInputformHelp";
		$postData = Array (
			'id_user'	  => $this->session->userdata('kode_uker'),
			'question'		  => $this->input->post('question'),
		);
		$postData = json_encode($postData);
		json_decode($this->sending->send($url, $postData), true); 
	}

	public function answerformhelp(){
		$url = "help/postAnswerFormHelp";
		$postData = Array (
			'id_help'	=> $this->input->post('id_help'),
			'answer'	=> $this->input->post('answer'),
		);
		$postData = json_encode($postData);
		json_decode($this->sending->send($url, $postData), true); 
	}
}
