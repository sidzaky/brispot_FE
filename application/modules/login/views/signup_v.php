<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <p>Klaster Binaan BRI</p>
    </div><!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">Silahkan Ganti Password anda Sebelum memulai session</p>
      <form action="<?php echo base_url() ?>login/changePasswordFirstTime" method="post">
        <div class="form-group has-feedback">
          <input type="password" class="form-control" placeholder="Password" name="password" id="password">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" class="form-control" placeholder="Confirm Password" name="Cpassword" id="Cpassword">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
          <div class="col-xs-4">
            <input type="submit" value="Kirim!!" id="dsubmit" class="btn btn-primary btn-block btn-flat" disabled>
          </div><!-- /.col -->
        </div>
      </form>

    </div><!-- /.login-box-body -->
  </div><!-- /.login-box -->