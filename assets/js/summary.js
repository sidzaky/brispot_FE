function fjum(i, j = "") {
  var data1 = {
    id_cluster_sektor_usaha: i,
  };

  $.ajax({
    type: "POST",
    url: "./cluster/fjum",
    data: data1,
    success: function (smsg) {
      var msg = JSON.parse(smsg);
      var select = document.getElementById("id_cluster_jenis_usaha_map");
      $(select).empty();
      $(select).append('<option value="">semua </option>');
      var selected;
      for (var i = 0; i <= msg.length; i++) {
        selected = "";
        if (j != "" && j == msg[i]["id_cluster_jenis_usaha_map"])
          selected = "selected";
        $(select).append(
          '<option value="' +
            msg[i]["id_cluster_jenis_usaha_map"] +
            '" ' +
            selected +
            ">" +
            msg[i]["nama_cluster_jenis_usaha_map"] +
            "</option>"
        );
      }
    },
  });
  if (i==1){
    $('#fperiode_panen').show();
    $('#fkapasitas_produksi').show();
  }
  else {
    $('#fperiode_panen').hide();
    $('#periode_panen').val("");
    $('#fkapasitas_produksi').hide();
    $('#kapasitas_produksi').val("");
  }

  $(document.getElementById("id_cluster_jenis_usaha")).empty();
}
