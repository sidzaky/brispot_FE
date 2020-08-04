jQuery(function ($) {
  $("#showModalChangePassword").on("click", function () {
    var dd = $(".form-control");
    for (var j = 0; j < dd.length; j++) {
      dd[j].value = "";
    }
    $("#modalz").show();
  });

  $("#password").on("change", checkPassword);
  $("#Cpassword").on("change", checkPassword);

  function checkPassword() {
    var pass1 = $("#password").val();
    var pass2 = $("#Cpassword").val();
    if (pass1 !== pass2) {
      document.getElementById("password").style.borderColor = "#E34234";
      document.getElementById("Cpassword").style.borderColor = "#E34234";
      $("#dsubmit").attr("disabled", "disabled");
    } else {
      document.getElementById("password").style.borderColor = "";
      document.getElementById("Cpassword").style.borderColor = "";
      $("#dsubmit").removeAttr("disabled");
    }
  }

  $("#dsubmit").on("click", function (i = false) {
    var data1 = {
      kode_uker_c: $("#kode_uker_c").val(),
      password: $("#password").val(),
    };
    $.ajax({
      type: "POST",
      url: "./login/chpassuker",
      data: data1,
      success: function (smsg) {
        alert("ganti password uker berhasil");
        $("#modalz").hide();
      },
    });
  });
});
