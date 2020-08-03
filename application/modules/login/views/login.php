<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <p>Klaster Binaan BRI 0.3</p>
    </div><!-- /.login-logo -->
    <?php $alert = $this->session->flashdata('message'); ?>
    <?php if (!empty($alert))
      echo '<div class="alert alert-danger alert-dismissable">
        <button class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-ban"></i> Alert!</h4>' . $alert . '</div>'; ?>

    <div class="login-box-body">
      <p class="login-box-msg">Sign in to start your session</p>
      <form action="<?php echo base_url() ?>login/validate" method="post">
        <div class="form-group has-feedback">
          <input type="text" class="form-control" placeholder="Kode Uker" name="username">
          <span class="glyphicon glyphicon-gear form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" class="form-control" placeholder="Password" name="password">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
          <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
          </div>
        </div>
      </form>

    </div><!-- /.login-box-body -->
  </div><!-- /.login-box -->