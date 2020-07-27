<body class="hold-transition skin-blue sidebar ">
	<div class="loader"></div>
    <div class="wrapper">

      <!-- Main Header -->
      <header class="main-header">

        <!-- Logo -->
        <a href="index2.html" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>D</b>S</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Insta</b> Bot<br> </span>
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
             
              <!-- User Account Menu -->
           <?php /*   <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="<?php echo base_url()?>admin/logout" class="dropdown-toggle" data-toggle="dropdown">
				<i class="fa fa-power-off"></i>
                </a>
              </li>*/
			  ?>
              <!-- Control Sidebar Toggle Button -->
              <!--<li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>-->
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
					    <form class="form-horizontal" action="<?php echo base_url()?>installer/dataclinic" method="post" enctype="multipart/form-data">
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
	  