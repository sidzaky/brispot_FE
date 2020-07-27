<?php 
$this->load->view('adminheader'); 

if ($content!='login'){
	$this->load->view($navbar);
	$this->load->view($sidebar);
}
if( $content != null )
	{
		$this->load->view($content);
	}
	
if ($content!='login') $this->load->view('adminfooter'); 



?>


