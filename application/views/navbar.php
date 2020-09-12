<body class="hold-transition skin-black-light sidebar ">
  <div class="loader"></div>
  <div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

      <!-- Logo -->
      <a href="<?php echo site_url(); ?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>KL</b>KL</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Klasterku</b></span>
      </a>

      <!-- Header Navbar -->
      <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>

        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li>
              <a><?php echo Date('d-M-Y'); ?></a>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
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