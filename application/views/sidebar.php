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
          <li><a href="<?php echo base_url(); ?>cluster/approve">Daftar Klaster</a></li>
          <li><a href="<?php echo base_url(); ?>cluster">Pengajuan</a></li>
        </ul>
      </li>
      <!-- <li><a href=""><i class="fa fa-file-text-o"></i> <span>Pengajuan Klaster</span></a></li> -->
      <li><a href="<?php echo base_url(); ?>cluster"><i class="fa fa-book"></i> <span>Laporan</span></a>
      <li>
      <li><a href="<?php echo base_url(); ?>setting"><i class="fa fa-cogs"></i> <span>Pengaturan</span></a>
      <li>
    </ul><!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>