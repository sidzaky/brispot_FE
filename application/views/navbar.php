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

    <div class="modal" id="settingcabang" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Detil Pasien</h4>
          </div>
          <div class="modal-body">
            <form class="form-horizontal" action="<?php echo base_url() ?>installer/dataclinic" method="post" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nama</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama" id="nama" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Alamat</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="alamat" id="alamat" required>
                  </div>
                </div>
                <input type="submit" name="submit" value="Simpan" class="btn btn-flat btn-primary btn-block">
              </div>
            </form>
          </div>


          <div class="modal-footer">
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->