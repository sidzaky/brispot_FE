<!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar user panel (optional) -->
          <div class="user-panel">
            <div class="pull-left image">
			
			<img src="<?php echo $this->session->userdata('foto')!=null ? base_url().$this->session->userdata('foto') : base_url().'assets/img/user2-160x160.jpg' ?>"  class="img-circle" alt="User Image"> 
              
            </div>
            <div class="pull-left info">
              <p><?php echo $this->session->username; ?></p>
              <!-- Status -->
              <a href="#"><i class="fa fa-circle text-success"></i> <?php echo $this->session->role; ?></a>
            </div>
          </div>

          <!-- search form (Optional) 
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->

          <!-- Sidebar Menu -->
          <ul class="sidebar-menu" id="sidebar-app">
            <li class="header">NAVIGATION</li>
            <!-- Optionally, you can add icons to the links -->
            <li><a href="<?php echo base_url(); ?>admin"><i class="fa fa-home"></i> <span>Home</span></a></li>
            <li><a href="<?php echo base_url(); ?>instlist"><i class="fa fa-pencil"></i> <span>Instagram User</span></a></li>
			<?php echo ($this->session->userdata('role')=='root' ? '<li><a href="'.base_url().'control"><i class="fa fa-cog"></i> <span>Controll</span></a></li>' : '') ?>
			<li><a href="<?php echo base_url(); ?>admin/logout"><i class="fa fa fa-power-off"></i> <span>Log Out</span></a></li>
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>