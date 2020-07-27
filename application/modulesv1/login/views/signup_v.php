<body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <p>Klaster Binaan BRI</p>
      </div><!-- /.login-logo --> 
      <div class="login-box-body">
        <p class="login-box-msg">Silahkan Ganti Password anda Sebelum memulai session</p>
        <form action="<?php echo base_url()?>login/signup" method="post">
          <div class="form-group has-feedback">
            <input type="password" onchange="myFunction();" class="form-control" placeholder="Password" name="password" id="password" >
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div> 
		  <div class="form-group has-feedback">
            <input type="password" onchange="myFunction();" class="form-control" placeholder="Confirm Password" name="Cpassword" id="Cpassword">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-4">
				<button type="submit" id="submit" class="btn btn-primary btn-block btn-flat" disabled>Kirim!!</button>
            </div><!-- /.col -->
          </div>
        </form>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
	
	<script>
		function myFunction() {
				var pass1 = $("#password").val();
				var pass2 = $("#Cpassword").val();
				if (pass1 !== pass2) {
					document.getElementById("password").style.borderColor = "#E34234";
					document.getElementById("Cpassword").style.borderColor = "#E34234";
					$("#submit").attr("disabled", "disabled");
				}
				else {
					document.getElementById("password").style.borderColor = "";
					document.getElementById("Cpassword").style.borderColor = "";
					$("#submit").removeAttr("disabled");
				}
			}
	
	</script>