<body class="hold-transition skin-black-light sidebar ">
  <div class="loader"></div>
  <div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

      <!-- Logo -->
      <a href="<?php echo site_url(); ?>" style="background-color:#2d2ded; color:#fffefe; " class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>KL</b>KL</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><img src="<?php echo base_url()?>/assets/img/landing-page/logo_navbar.png" alt="logo-klasterku-hidupku" style="height: 50px"></span>
      </a>

      <!-- Header Navbar -->
      <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" style="color:#fffefe; " data-toggle="offcanvas" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
<style>


  
</style>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li>
              <a style="color:#fffefe;"><?php echo Date('d-M-Y'); ?></a>
            </li>
            <li class="dropdown" id="setnotif">
                <a href="#" style="color:#fffefe; " class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-bell"></i><span id="cNotif" class="label label-warning pull-right"></span></a>
                
            </li>
            
            <li class="dropdown">
              <a href="#"  style="color:#fffefe; " class="dropdown-toggle" data-toggle="dropdown">
                <?php
                echo ($this->session->userdata('name_uker')) ?
                  $this->session->userdata('name_uker') : ($this->session->userdata('kode_uker') === "kanpus" ? "Kantor Pusat" : "Administrator");
                ?>
                <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#" id="showModalChangePassword"><i class="fa fa-key"></i> Ganti Password Uker</a></li>
                <li><a href="<?php echo base_url(); ?>login/logout"><i class="fa fa-power-off"></i> Logout</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </header>