<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar Menu -->
    <ul class="sidebar-menu" id="sidebar-app">
      <!-- Optionally, you can add icons to the links -->
      <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-pie-chart"></i> <span>Dashboard</span></a></li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-check "></i> <span>Klaster</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li active="active"><a href="<?php echo base_url(); ?>cluster/approve">Daftar Klaster</a></li>
          <li><a href="<?php echo base_url(); ?>cluster">Pengajuan</a></li>
          <?php echo ($this->session->userdata('permission')==4 ? '<li><a href="' . base_url() . 'cluster/custom_search">Custom Search</a></li>' : "") ?>
        </ul>
      </li>
      <!-- <li><a href=""><i class="fa fa-file-text-o"></i> <span>Pengajuan Klaster</span></a></li> -->
	  
	  <?php 
		$lilaporan="";
		if ($this->session->userdata('permission')>2){
				$lilaporan= '<li class="treeview">
							<a href="#">
							  <i class="fa fa-book"></i> <span>Laporan Klaster</span>
							  <i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">';
				switch ($this->session->userdata('permission')) {
					case (4):
							$lilaporan .= '<li><a href="'.base_url().'cluster/getreport/">Rekap Total</a></li>
												<li><a href="'.base_url().'cluster/getreport/harian">Rekap harian</a></li>
                                                <li><a href="'.base_url().'cluster/report_unit">Rekap Unit</a></li>
                                                <li><a href="'.base_url().'cluster/report_anggota">Rekap Anggota Klaster</a></li>
												</ul>
											</li>';
						break;
					case (3):
						$lilaporan .= '<li><a href="'.base_url().'cluster/getreport/harian">Rekap harian</a></li>
                                            <li><a href="'.base_url().'cluster/report_unit">Rekap Unit</a></li>
                                            <li><a href="'.base_url().'cluster/report_anggota">Rekap Anggota Klaster</a></li>
												</ul>
											</li>';
						break;
					default : 
						$lilaporan = " ";
					break;
			}
		}
		
		echo $lilaporan;
	  ?>
      <li> 
	  <?php if ($this->session->userdata("permission")==4) echo '<li><a href="'.base_url().'setting"><i class="fa fa-cogs"></i> <span>Pengaturan</span></a><li>' ;?>
    
    </ul><!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>