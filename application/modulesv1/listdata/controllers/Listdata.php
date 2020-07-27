<?php
/**
*
*
* Diagnosa
*
**/
?>

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Listdata extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url','form','html'));
        $this->load->library('session');
		$this->load->library('Uuid');
        $this->load->module('login');
        $this->load->model('listdata_m');
        $this->login->is_logged_in();
    }

    public function index()
    {
        $data['content'] = 'listdata';
        $data['navbar'] = 'navbar';
        $data['sidebar'] = 'sidebar';
		$data['con']=$this;
        $this->load->view('template', $data);    
    }
	
	
	
	public function update(){
		if ($_POST['type']=='gejala') {
			$data=$this->listdata_m->getlistgejala($_POST['id_data']);
			$data=json_decode(json_encode($data),true);
			$data[0]['penyakit']=$this->listdata_m->getpenyakitforgejala($data[0]['id_gejala']);
			$this->inputgejala($data,true);
		}
		else {
			
			
			$data=$this->listdata_m->getlistpenyakit($_POST['id_data'])->result();
			$data=json_decode(json_encode($data),true);
			// print_r($data);
			$this->inputpenyakit($data,true);
			}
		
		
	}
	
	
	
	public function inputpenyakit($i,$update){
		if ($_POST['nama']==null){
			echo '<!-- form start -->
						<div class="formgejala">
							<div class="row">
								<label for="inputEmail3" class="col-sm-2 control-label">Nama Data Penyakit</label>
								<div class="col-sm-10">
								  <input type="text" class="form-control" name="nama_penyakit" id="nama_penyakit" value="'.$i[0]['nama_penyakit'].'" required>
								</div>
							  </div> 
							</div> 
						<div class="CFgejala">
							  <div class="row">
								<label for="inputEmail3" class="col-sm-2 control-label">Kode Penyakit</label>
								<div class="col-sm-10">
								  <input type="text" class="form-control" name="kode" id="kode" value="'.$i[0]['kode_penyakit'].'" required>
								</div>
							  </div> 
						</div> 
						
						<div class="CFgejala">
							  <div class="row">
								<label for="inputEmail3" class="col-sm-2 control-label">Detail Penyakit </label>
								<div class="col-sm-10">
								  <input type="text" class="form-control" name="detail" id="detail" value="'.$i[0]['detail_penyakit'].'" required>
								</div>
							  </div> 
						</div> 
						
						<div class="CFgejala">
							  <div class="row">
								<label for="inputEmail3" class="col-sm-2 control-label">Solusi </label>
								<div class="col-sm-10">
								  <input type="text" class="form-control" name="solusi" id="solusi" value="'.$i[0]['solusi'].'" required>
								</div>
							  </div> 
						</div> 
						</br>
						'.($update==true ? '<input type="hidden" id="id_penyakit" value="'.$i[0]['id_penyakit'].'">' : "" ).'
						<button type="button" class="btn-flat btn btn-default" data-dismiss="modal">Close</button>
						<button type="button" onclick="push(\'penyakit\');" data-dismiss="modal"  class="btn-flat btn btn-primary">Save changes</button>
						';
			
		}
		else {
			if ($_POST['id']!=null) $this->listdata_m->updatepenyakit();
			else $this->listdata_m->inputpenyakit();
			
			echo $this->getdatapenyakit();
		}
	}
	
	
	public function inputgejala($i,$update){
		if ($_POST['nama']==NULL){
			echo '
						  <!-- form start -->
						<div class="formgejala">
							<div class="row">
								<label for="inputEmail3" class="col-sm-2 control-label">Nama Gejala</label>
								<div class="col-sm-10">
								  <input type="text" class="form-control" name="nama_gejala" id="nama_gejala" value="'.$i['0']['nama_gejala'].'" required>
								</div>
							  </div> 
							</div> 
						
						
						<div class="CFgejala">
							  <div class="row">
								<label for="inputEmail3" class="col-sm-2 control-label">CF </label>
								<div class="col-sm-10">
								  <input type="text" class="form-control" name="CF" id="CF" value="'.$i['0']['CF'].'" required>
								</div>
							  </div> 
						</div> 
						</br>
						'.($update==true ? '<input type="hidden" id="id_gejala" value="'.$i[0]['id_gejala'].'">' : "" ).'
						<div id="formgejala"></div>';
						
						$z=1;
						$l=sizeof($i[0]['penyakit']);
						if ($l==0) echo $this->formpenyakit(1,null,1);
					
						foreach ($i[0]['penyakit'] as $row){
							 echo $this->formpenyakit($z,$row->id_penyakit,$l);
							$z++;
						}
						
						
							 
							  
							  
			echo '
				  <button type="button" class="btn-flat btn btn-default" data-dismiss="modal">Close</button>
				  <button type="button" onclick="push(\'gejala\');" data-dismiss="modal"  class="btn-flat btn btn-primary">Save changes</button>
						';
			
		}
		else {
			if ($_POST['id']!=null) $this->listdata_m->updategejala();
			else $this->listdata_m->inputgejala();
			
			echo $this->getdatagejala();
			
		}
	}
	
	
	
	
	public function delgejala(){
		$this->listdata_m->delgejala();
		$this->getdatagejala();
		
	}
	
	public function delpenyakit(){
		$this->listdata_m->delpenyakit();
		$this->getdatapenyakit();
	}
	
	
	public function getdatapenyakit(){
		$data=$this->listdata_m->getlistpenyakit();
		$i=1;
		echo '
						  <table id="antri2" class="table table-bordered table-striped">
								  <thead>  
									  <tr>
										<th>No</th>
										<th>Nama Penyakit</th>
										
										<th>Solusi</th>
										<th class="text-center">Action</th>
									  </tr>
									</thead>
							  <tbody>';
		foreach ($data->result() as $row){
				echo '<tr>
						<td>'.$i.'</td>
						<td>('.$row->kode_penyakit.') '.$row->nama_penyakit.'</td>
						<td>'.$row->solusi.'</td>
						<td>
							<button type="button" onclick="edit(\''.$row->id_penyakit.'\',\'penyakit\');"  data-toggle="modal"  data-target="#modal" class="btn btn-flat bg-olive"><i class="fa fa-fw fa-edit"></i></button>
							<button type="button" onclick="del(\''.$row->id_penyakit.'\',\'penyakit\');" class="btn btn-flat bg-maroon"><i class="fa fa-fw fa-times"></i></button>
						</td>
					  </tr>';
				$i++;
		}
		echo '</tbody></table>';		
	}
	
	public function formpenyakit($i,$b,$l){
			$penyakit=$this->listdata_m->getlistpenyakit();
			
			if ($i==null){	
					$_POST['sum']=substr(key($_POST), -1);
					$id=$_POST['sum']+1;}	
			else $id=$i;
			
			if ($id<2){
				$string= '<div class="formpenyakit">
						 <div class="row">
							<label for="karyawan" class="col-sm-2 control-label">List penyakit</label> 
							<button class="btn-tambah btn btn-flat btn-warning" onclick="tambahform(\'penyakit\');"> 
						  <i class="fa fa-fw fa-plus"></i></button>
						  ';}
				else $string =  '<div class="row">
							<label for="diagnosa" class="col-sm-2 control-label"></label>
							  <button class="btn-tambah btn btn-flat btn-danger" id="penyakitmin_'.$id.'" onclick="minform(\'penyakit_'.$id.'\');minform(\'penyakitmin_'.$id.'\');"><i class="fa fa-fw fa-minus"></i></button>
								'; 
				$string .='<div class="col-sm-8">
						<select class="form-control" name="penyakit_'.$id.'" id="penyakit_'.$id.'">
						<option value="0">Pilih Penyakit Yang Didapatkan</option>
						';
					foreach ($penyakit->result() as $row){
						if ($b==$row->id_penyakit) $selected='selected'; 
						else $selected='';
						$string .= '<option value="'.$row->id_penyakit.'" '.$selected.'>'.$row->nama_penyakit.'</option>';	
					}			
				$string .='</select>  
							<input type="hidden" name="sumpenyakit" id="sumpenyakit" value="'.$id.'">
								</div>
						</div>';
				if ($l==null && $id<2) $string .= '</div><br>';  
				if ($id==$l) $string .= '</div><br>';
				
				if ($id<2) return $string;
				else echo $string;
		}
		
	


	
	public function getdatagejala(){
		
			echo '
						  <table id="antrian" class="table table-bordered table-striped">
								  <thead>  
									  <tr>
										<th>No</th>
										<th>Nama Gejala</th>
										<th>Nama Penyakit</th>
										<th>CF</th>
										<th class="text-center">Action</th>
									  </tr>
									</thead>
							  <tbody>';
			
			$data['gejala']=$this->listdata_m->getlistgejala();
			// print_r($data);
			$i=0;
			foreach ($data['gejala'] as $row){
			
				$data['gejala'][$i]->penyakit=$this->listdata_m->getpenyakitforgejala($row->id_gejala);
				$i++;
			}
			
			// print_r($data);
			$i=1;
			foreach ($data['gejala'] as $row){
					echo '<tr>
							<td>'.$i.'</td>
							<td>'.$row->nama_gejala.'</td><td>';
						$z=0;
						foreach ($row->penyakit as $row1){
							$z++;
							echo $row1->nama_penyakit;
							if ($z!==sizeof($row->penyakit)) echo ", ";
						}
							
					echo '  </td><td>'.$row->CF.'</td>
							<td class="text-center">
								<button type="button" onclick="edit(\''.$row->id_gejala.'\',\'gejala\');" data-toggle="modal"  data-target="#modal" class="btn btn-flat bg-olive"><i class="fa fa-fw fa-edit"></i></button>
								<button type="button" onclick="del(\''.$row->id_gejala.'\',\'gejala\');"  class="btn btn-flat bg-maroon"><i class="fa fa-fw fa-times"></i></button>
							</td>
						 </tr>';
					$i++;
			}
			echo '</tbody></table>';	
		}
	
	}
?>    