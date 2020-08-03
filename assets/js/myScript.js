jQuery(function ($) {
  $("#showModalChangePassword").on("click", function () {
    var dd = $(".form-control");
    for (var j = 0; j < dd.length; j++) {
      dd[j].value = "";
    }
    $("#modalz").show();
  });

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
