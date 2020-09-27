function te(i) {
  if (i.value === "Ya") {
    $("#pasar_ekspor_tahun").removeAttr("disabled");
    $("#pasar_ekspor_nilai").removeAttr("disabled");
    $("#bfex").removeAttr("disabled");
  } else {
    $("#pasar_ekspor_tahun").attr("disabled", "disabled");
    $("#pasar_ekspor_nilai").attr("disabled", "disabled");
    $("#bfex").attr("disabled", "disabled");
  }
}

function tambahform(id) {
  var count = $("." + id);
  var newid;
  var ccount = count.length == 0 ? 0 : count.length;
  if (count.length == 0) newid = 0;
  else {
    count = count[count.length - 1].id.split("_");
    newid = parseInt(count[1]) + 1;
  }

  switch (id) {
    case "fku":
      if (ccount < 5) vfku(newid);
      break;
    case "fex":
      if (ccount < 3) vfex(newid);
      break;
  }
}

function minform(id) {
  $("#" + id).remove();
}

function readURL(input, j) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    var typeimages = ["jpg", "jpeg", "png", "bmp"];
    if (j == "cku_0") typeimages = ["txt, pdf, word"];
    var typedoc = [
      "text/plain",
      "application/msword",
      "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
    ];
    reader.onload = function (e) {
      // console.log(input.files[0].type.toLowerCase());
      if (
        typeimages.includes(
          input.files[0].type.replace("image/", "").toLowerCase()
        ) == true
      ) {
        $("#sh" + j).attr("src", e.target.result);
        $("#t" + j).attr("value", input.files[0].type.replace("image/", ""));
        processImage(reader.result, input.files[0].type, j);
      } else alert("type file tidak ada yang didukung");
    };

    reader.readAsDataURL(input.files[0]);
  }
}

function processImage(dataURL, fileType, j) {
  var maxWidth = 1920;
  var maxHeight = 1080;
  var image = new Image();
  image.src = dataURL;
  image.onload = function () {
    var width = image.width;
    var height = image.height;
    var shouldResize = width > maxWidth || height > maxHeight;
    if (!shouldResize) {
      document.getElementById("r" + j).value = dataURL.replace(
        /^data:image\/(png|jpg|jpeg);base64,/,
        ""
      );
      return;
    }
    var newWidth;
    var newHeight;
    if (width > height) {
      newHeight = height * (maxWidth / width);
      newWidth = maxWidth;
    } else {
      newWidth = width * (maxHeight / height);
      newHeight = maxHeight;
    }
    var canvas = document.createElement("canvas");
    canvas.width = newWidth;
    canvas.height = newHeight;
    var context = canvas.getContext("2d");
    context.drawImage(this, 0, 0, newWidth, newHeight);
    dataURL = canvas.toDataURL(fileType);
    document.getElementById("r" + j).value = dataURL.replace(
      /^data:image\/(png|jpg|jpeg);base64,/,
      ""
    );
  };
  image.onerror = function () {
    alert("There was an error processing your file!");
  };
}

var valuker = true;
var valhp = true;
var valnik = true;

function getuker(i) {
  var data1 = {
    kode_uker: i,
  };
  $.ajax({
    type: "POST",
    url: "./cluster/cekuker",
    data: data1,
    success: function (smsg) {
      var msg = smsg;
      document.getElementById("hsuk").innerHTML =
        '<label for="thedata" class="col-sm-8 control-label">' +
        msg +
        "</label>";
      console.log(msg);
      valuker = JSON.parse(msg) == "data uker tidak ditemukan" ? false : true;
    },
  });
}

function getform(i = null) {
  document.getElementById('mod-content').style.display="";
  document.getElementById('mod-loading').style.display="none";
  valuker = false;
  $("#sbt").removeAttr("disabled");
  document.getElementById("checkvalidpotensi").checked = false;
  document.getElementById("checkvalidkunjungan").checked = false;
  document.getElementById("fotoklusterusaha").innerHTML = "";
  document.getElementById("fotoverifikasiexpor").innerHTML = "";
  if (i != null) {
    var data1 = {
      id: i,
    };
    $.ajax({
      type: "POST",
      url: "./cluster/getdata_s",
      data: data1,
      success: function (nmsg) {
        var tempdata = JSON.parse(nmsg);
        var msg = tempdata.cluster;
        //data cluster//
        document.getElementById("id").value = msg[0].id;
        document.getElementById("kode_uker").value = msg[0].kode_uker;
        getuker(msg[0].kode_uker);

        document.getElementById("kaunit_nama").value = msg[0].kaunit_nama;
        document.getElementById("kaunit_pn").value = msg[0].kaunit_pn;
        document.getElementById("kaunit_handphone").value =
          msg[0].kaunit_handphone;

        document.getElementById("nama_pekerja").value = msg[0].nama_pekerja;
        document.getElementById("personal_number").value =
          msg[0].personal_number;
        document.getElementById("handphone_pekerja").value =
          msg[0].handphone_pekerja;

        document.getElementById("kelompok_usaha").value = msg[0].kelompok_usaha;
        document.getElementById("kelompok_jumlah_anggota").value =
          msg[0].kelompok_jumlah_anggota;
        document.getElementById("kelompok_perwakilan").value =
          msg[0].kelompok_perwakilan;
        document.getElementById("kelompok_jenis_kelamin").value =
          msg[0].kelompok_jenis_kelamin;

        document.getElementById("kelompok_NIK").value = msg[0].kelompok_NIK;
        document.getElementById("kelompok_perwakilan_tgl_lahir").value =
          msg[0].kelompok_perwakilan_tgl_lahir;
        document.getElementById("kelompok_perwakilan_tempat_lahir").value =
          msg[0].kelompok_perwakilan_tempat_lahir;
        document.getElementById("kelompok_handphone").value =
          msg[0].kelompok_handphone;
        document.getElementById("lokasi_usaha").value = msg[0].lokasi_usaha;

        setprov(msg[0].provinsi);
        getkotakab(msg[0].provinsi, msg[0].kabupaten);
        getkecamatan(msg[0].kabupaten, msg[0].kecamatan);
        getkelurahan(msg[0].kecamatan, msg[0].kelurahan);

        document.getElementById("id_cluster_sektor_usaha").value =
          msg[0].id_cluster_sektor_usaha;
        fjum(msg[0].id_cluster_sektor_usaha, msg[0].id_cluster_jenis_usaha_map);
        fju(msg[0].id_cluster_jenis_usaha_map, msg[0].id_cluster_jenis_usaha);

        document.getElementById("pasar_ekspor").value = msg[0].pasar_ekspor;
        document.getElementById("pasar_ekspor_tahun").value =
          msg[0].pasar_ekspor_tahun;
        document.getElementById("pasar_ekspor_nilai").value =
          msg[0].pasar_ekspor_tahun;

        document.getElementById("kelompok_anggota_pinjaman").value =
          msg[0].kelompok_anggota_pinjaman;
        document.getElementById("hasil_produk").value = msg[0].hasil_produk;
        document.getElementById("kelompok_pihak_pembeli").value =
          msg[0].kelompok_pihak_pembeli;
        document.getElementById("kelompok_pihak_pembeli_handphone").value =
          msg[0].kelompok_pihak_pembeli_handphone;
        document.getElementById("kelompok_suplier_produk").value =
          msg[0].kelompok_suplier_produk;
        document.getElementById("kelompok_suplier_handphone").value =
          msg[0].kelompok_suplier_handphone;
        document.getElementById("kelompok_luas_usaha").value =
          msg[0].kelompok_luas_usaha;
        document.getElementById("kelompok_omset").value = msg[0].kelompok_omset;
        document.getElementById("kelompok_cerita_usaha").value =
          msg[0].kelompok_cerita_usaha;
        document.getElementById("pinjaman").value = msg[0].pinjaman;
        document.getElementById("nominal_pinjaman").value =
          msg[0].nominal_pinjaman;
        document.getElementById("norek_pinjaman_bri").value =
          msg[0].norek_pinjaman_bri;
        document.getElementById("agen_brilink").value = msg[0].agen_brilink;

        document.getElementById("kebutuhan_sarana_milik").value =
          msg[0].kebutuhan_sarana_milik;
        document.getElementById("kebutuhan_sarana").value =
          msg[0].kebutuhan_sarana;
        document.getElementById("kebutuhan_sarana_lainnya").value =
          msg[0].kebutuhan_sarana_lainnya;
        document.getElementById("kebutuhan_skema_kredit").value =
          msg[0].kebutuhan_skema_kredit;

        document.getElementById("kebutuhan_pendidikan").value =
          msg[0].kebutuhan_pendidikan;
        document.getElementById("simpanan_bank").value = msg[0].simpanan_bank;
        // end data cluster//

        for (var i = 0; i < tempdata.rfku.length; i++) {
          vfku(i, tempdata.rfku[i].location);
        }
        for (var i = 0; i < tempdata.rfex.length; i++) {
          vfex(i, tempdata.rfex[i].location);
        }

        $("#modal").show();
      },
    });
  } else {
    var dd = $(".form-control");
    document.getElementById("setuker").innerHTML = "";
    for (var j = 0; j < dd.length; j++) {
      dd[j].value = "";
      valnik = false;
      valhp = false;
      $("#modal").show();
    }
    if (defaultuker != "") valuker = true;
    document.getElementById("kode_uker").value = defaultuker;
    document.getElementById("kelompok_jumlah_anggota").value = "15";
  }
}

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
      $(select).append('<option value=""> Pilih Kategori Usaha</option>');
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
  $(document.getElementById("id_cluster_jenis_usaha")).empty();
}

function fju(i, j = "") {
  var data1 = {
    id_cluster_jenis_usaha_map: i,
  };
  $.ajax({
    type: "POST",
    url: "./cluster/fju",
    data: data1,
    success: function (smsg) {
      var msg = JSON.parse(smsg);
      var select = document.getElementById("id_cluster_jenis_usaha");
      $(select).empty();
      $(select).append('<option value=""> Pilih Jenis Usaha</option>');
      var selected;
      for (var i = 0; i <= msg.length; i++) {
        selected = "";
        if (j != "" && j == msg[i]["id_cluster_jenis_usaha"])
          selected = "selected";
        $(select).append(
          '<option value="' +
            msg[i]["id_cluster_jenis_usaha"] +
            '" ' +
            selected +
            ">" +
            msg[i]["nama_cluster_jenis_usaha"] +
            "</option>"
        );
      }
    },
  });
}

function vfku(newid, rfku = null) {
  $("#fotoklusterusaha").append(
    '<div class="col-sm-4"  id="mfku_' +
      newid +
      '"><div class="input-group"><span class="input-group-btn"><span class="btn btn-default btn-file"><i class="fa fa-upload"></i> Upload ' +
      (newid + 1) +
      '<input class="fku" type="file" id="fku_' +
      newid +
      '"  onchange="readURL(this,\'fku_' +
      newid +
      '\');" > 	 <input type="hidden" name="rfku" id="rfku_' +
      newid +
      '" value=""> <input type="hidden" name="tfku" id="tfku_' +
      newid +
      '" value="">  <input type="hidden" name="idfku" id="idfku_' +
      newid +
      '" value=""> </span><span class="btn btn-default btn-file" onclick="minform(\'mfku_' +
      newid +
      '\');"><i class="fa fa-close"></i>  Hapus</span></span></div><img class="img-upload" id="shfku_' +
      newid +
      '"  src="' +
      (rfku != null ? rfku : "") +
      '"/></div>'
  );
}

function vfex(newid, rfex = null) {
  $("#fotoverifikasiexpor").append(
    '<div class="col-sm-4"  id="mfex_' +
      newid +
      '"><div class="input-group"><span class="input-group-btn"><span class="btn btn-default btn-file"><i class="fa fa-upload"></i> Upload ' +
      (newid + 1) +
      '<input class="fex" type="file" id="fex_' +
      newid +
      '"  onchange="readURL(this,\'fex_' +
      newid +
      '\');" >	 <input type="hidden"  name="rfex" id="rfex_' +
      newid +
      '" value=""> <input type="hidden" name="tfex" id="tfex_' +
      newid +
      '" value="">  <input type="hidden" name="idfex" id="idfex_' +
      newid +
      '" value=""> </span><span class="btn btn-default btn-file" onclick="minform(\'mfex_' +
      newid +
      '\');"><i class="fa fa-close"></i>  Hapus</span></span></div><img class="img-upload" id="shfex_' +
      newid +
      '" src="' +
      (rfex != null ? rfex : "") +
      '"/></div>'
  );
}

function inputform() {
  if (
    document.getElementById("checkvalidkunjungan").checked == true &&
    document.getElementById("checkvalidpotensi").checked == true
  ) {
    if (valuker == true) {
      var data1 = {};
      var dform = document.getElementsByClassName("dform");
      for (var i = 0; i < dform.length; i++) {
        data1[dform[i].id] = dform[i].value;
      }

      var msg = "";
      msg = reval();

      data1["rfku"] = [];
      data1["tfku"] = [];
      data1["idfku"] = [];
      data1["efku"] = [];
      data1["rfex"] = [];
      data1["tfex"] = [];
      data1["idfex"] = [];
      data1["efex"] = [];

      if ($("input[name='rfku']").length != 0) {
        var rfku = $("input[name='rfku']")[$("input[name='rfku']").length - 1];
        rfku = rfku.id.split("_");
        var valid = 0;
        for (var i = 0; i <= rfku[1]; i++) {
          console.log(i);
          if ($("#rfku_" + i).val() !== "") {
            data1["rfku"][i] = $("#rfku_" + i).val();
            data1["tfku"][i] = $("#tfku_" + i).val();
            data1["efku"][i] = "";
            valid++;
          } else {
            data1["efku"][i] =
              $("#shfku_" + i).attr("src") != ""
                ? $("#shfku_" + i).attr("src")
                : "";
            if (data1["efku"][i] != "") valid++;
          }
        }
        if (valid == 0) msg += "foto kluster usaha minimal ada 1";
      } else msg += "foto kluster usaha minimal ada 1";

      if ($("#pasar_ekspor").val() === "Ya") {
        if ($("input[name='rfex']").length != 0) {
          var rfex = $("input[name='rfex']")[
            $("input[name='rfex']").length - 1
          ];
          rfex = rfex.id.split("_");
          var valid = 0;
          for (var i = 0; i <= rfex[1]; i++) {
            if ($("#rfex_" + i).val() !== "") {
              data1["rfex"][i] = $("#rfex_" + i).val();
              data1["tfex"][i] = $("#tfex_" + i).val();
              data1["efex"][i] = "";
              valid++;
            } else {
              data1["efex"][i] =
                $("#shfex_" + i).attr("src") != ""
                  ? $("#shfex_" + i).attr("src")
                  : "";
              if (data1["efex"][i] != "") valid++;
            }
          }
          if (valid == 0) msg += "foto/gambar dokument minimal ada 1";
        } else msg += "foto/gambar dokument minimal ada 1";
      }

      if (msg == "") {
        $("#sbt").attr("disabled", "disabled");
        document.getElementById('mod-content').style.display="none";
        document.getElementById('mod-loading').style.display="";
        $.ajax({
          type: "POST",
          url: "./cluster/inputdata",
          data: data1,
          success: function (msg) {
            alert("data berhasil diinput");
            $("#sbt").removeAttr("disabled");
            $("#modal").hide();
            $("#table-cluster").DataTable().ajax.reload(null, false);
            $("#mod-content").style.display="";
            $("#mod-loading").style.display="none";
          },
        });
      } else alert(msg);
    } else alert("Data Uker salah");
  } else alert("Harap isi checkbox pertanyaan diatas!!");
}

function cnik(i = null, j = null) {
  var validator = [
    "0000000000000000",
    "1111111111111111",
    "2222222222222222",
    "3333333333333333",
    "4444444444444444",
    "5555555555555555",
    "6666666666666666",
    "7777777777777777",
    "8888888888888888",
    "9999999999999999",
  ];
  // return true;
  if (i != null) {
    if (i.toString().length == 16) {
      if (validator.includes(i.toString) == false) {
        return true;
      } else {
        if (j != null) alert("Data NIK tidak valid");

        return false;
      }
    } else {
      if (j != null) alert("NIK harus 16 digit");

      return false;
    }
  } else return false;
}

function reval() {
  var msg = "";
  msg +=
    validatorreqtext(document.getElementById("kaunit_nama"), iname) == false
      ? "data Nama Kaunit tidak valid \n"
      : "";
  msg +=
    validatorreqnumber(document.getElementById("kaunit_pn")) == false
      ? "data PN Kaunit tidak valid \n"
      : "";
  msg +=
    cekhp(document.getElementById("kaunit_handphone")) == false
      ? "data handphone Kaunit tidak valid \n"
      : "";

  msg +=
    validatorreqtext(document.getElementById("nama_pekerja"), iname) == false
      ? "data nama_pekerja tidak valid \n"
      : "";
  msg +=
    validatorreqnumber(document.getElementById("personal_number")) == false
      ? "data personal_number pekerja tidak valid \n"
      : "";
  msg +=
    cekhp(document.getElementById("handphone_pekerja")) == false
      ? "data handphone_pekerja tidak valid \n"
      : "";

  msg +=
    validatorreqtext(document.getElementById("kelompok_usaha"), iname) == false
      ? "data Kelompok usaha tidak valid \n"
      : "";
  msg +=
    validatorreqnumber(document.getElementById("kelompok_jumlah_anggota")) ==
    false
      ? "data kelompok_jumlah_anggota  tidak valid \n"
      : "";
  msg +=
    validatorreqtext(document.getElementById("hasil_produk"), ischar) == false
      ? "data hasil_produk tidak valid \n"
      : "";

  msg +=
    validatoroptnumber(document.getElementById("pasar_ekspor_tahun")) == false
      ? "data pasar_ekspor_tahun  tidak valid \n"
      : "";
  msg +=
    validatoroptnumber(document.getElementById("pasar_ekspor_nilai")) == false
      ? "data pasar_ekspor_nilai  tidak valid \n"
      : "";
  msg +=
    validatoroptnumber(document.getElementById("kelompok_luas_usaha")) == false
      ? "data kelompok_luas_usaha  tidak valid \n"
      : "";

  msg +=
    validatoropttext(
      document.getElementById("kelompok_pihak_pembeli"),
      ischar
    ) == false
      ? "data kelompok_pihak_pembeli  tidak valid \n"
      : "";
  msg +=
    cekhpnor(document.getElementById("kelompok_pihak_pembeli_handphone")) ==
    false
      ? "data kelompok_pihak_pembeli_handphone tidak valid \n"
      : "";
  msg +=
    validatoropttext(
      document.getElementById("kelompok_suplier_produk"),
      ischar
    ) == false
      ? "data kelompok_suplier_produk  tidak valid \n"
      : "";
  msg +=
    cekhpnor(document.getElementById("kelompok_suplier_handphone")) == false
      ? "data kelompok_suplier_handphone tidak valid \n"
      : "";

  msg +=
    validatorreqtext(
      document.getElementById("kebutuhan_sarana_milik"),
      ischar
    ) == false
      ? "data kebutuhan_sarana_milik tidak valid \n"
      : "";
  msg +=
    validatoropttext(
      document.getElementById("kebutuhan_sarana_lainnya"),
      ischar
    ) == false
      ? "data kebutuhan_sarana_lainnya tidak valid \n"
      : "";

  msg +=
    validatorreqtext(document.getElementById("kelompok_perwakilan"), iname) ==
    false
      ? "data nama ketua kelompok tidak valid \n"
      : "";
  msg +=
    validatorreqtext(document.getElementById("lokasi_usaha"), ischar) == false
      ? "data lokasi_usaha tidak valid \n"
      : "";
  msg +=
    validatorreqtext(
      document.getElementById("kelompok_cerita_usaha"),
      ischar
    ) == false
      ? "Cerita Usaha kosong atau mengandung karakter yang tidak diperbolehkan (!@#$%^&*()+=[]\\';/{}|\":<>?)  \n"
      : "";

  msg +=
    validatorreqtext(document.getElementById("provinsi"), ischar) == false
      ? "data provinsi tidak valid \n"
      : "";
  msg +=
    validatorreqtext(document.getElementById("kabupaten"), ischar) == false
      ? "data kabupaten tidak valid \n"
      : "";
  msg +=
    validatorreqtext(document.getElementById("kecamatan"), ischar) == false
      ? "data kecamatan tidak valid \n"
      : "";
  msg +=
    validatorreqtext(document.getElementById("kelurahan"), ischar) == false
      ? "data kelurahan tidak valid \n"
      : "";
  msg +=
    validatorreqnumber(document.getElementById("kode_pos")) == false
      ? "data kode_pos pekerja tidak valid \n"
      : "";

  msg +=
    cnik(document.getElementById("kelompok_NIK").value) == false
      ? "data kelompok_NIK pekerja tidak valid \n"
      : "";
  msg +=
    validatorreqtext(
      document.getElementById("kelompok_perwakilan_tgl_lahir"),
      ischar
    ) == false
      ? "data kelompok_perwakilan_tgl_lahir pekerja tidak valid \n"
      : "";
  msg +=
    validatorreqtext(
      document.getElementById("kelompok_perwakilan_tempat_lahir"),
      ischar
    ) == false
      ? "data kelompok_perwakilan_tempat_lahir tidak valid \n"
      : "";
  msg +=
    cekhp(document.getElementById("kelompok_handphone")) == false
      ? "data kelompok_handphone tidak valid \n"
      : "";

  msg +=
    validatoroptnumber(document.getElementById("nominal_pinjaman")) == false
      ? "data nominal_pinjaman  tidak valid \n"
      : "";
  msg +=
    validatoroptnumber(document.getElementById("norek_pinjaman_bri")) == false
      ? "data norek_pinjaman_bri  tidak valid \n"
      : "";
  msg +=
    document.getElementById("kelompok_anggota_pinjaman").value == ""
      ? "data kelompok angota pinjaman tidak boleh kosong \n"
      : "";
  msg +=
    document.getElementById("id_cluster_sektor_usaha").value == ""
      ? "data sektor usaha tidak boleh kosong \n"
      : "";
  msg +=
    document.getElementById("id_cluster_jenis_usaha_map").value == ""
      ? "data kategori Jenis usaha tidak boleh kosong \n"
      : "";
  msg +=
    document.getElementById("id_cluster_jenis_usaha").value == ""
      ? "data Jenis usaha tidak boleh kosong \n"
      : "";
  msg +=
    document.getElementById("pasar_ekspor").value == ""
      ? "data Pasar Ekspor tidak boleh kosong\n"
      : "";
  msg +=
    document.getElementById("kebutuhan_sarana").value == ""
      ? "data  Kebutuhan Sarana tidak boleh kosong\n"
      : "";
  msg +=
    document.getElementById("kebutuhan_pendidikan").value == ""
      ? "data Kebutuhan pendidikan tidak boleh kosong\n"
      : "";
  msg +=
    document.getElementById("kebutuhan_skema_kredit").value == ""
      ? "data Skema Kredit  tidak boleh kosong\n"
      : "";
  msg +=
    document.getElementById("kelompok_jenis_kelamin").value == ""
      ? "data  Jenis Kelamin ketua/Perwakilan usaha tidak boleh kosong\n"
      : "";
  msg +=
    document.getElementById("pinjaman").value == ""
      ? "data punya Pinjaman tidak boleh kosong\n"
      : "";
  msg +=
    document.getElementById("simpanan_bank").value == ""
      ? "data  simpanan tidak boleh kosong\n"
      : "";
  msg +=
    document.getElementById("agen_brilink").value == ""
      ? "data agen brilink tidak boleh kosong\n"
      : "";
  return msg;
}

var iname = "!@#$%^&*()+=-[]\\';,/{}|0123456789\":<>?";
var ischar = "!@#$%^&*()+=[]\\';/{}|\":<>?";

///z for value, y for select iname char, x if call from input then alert from id, w if optional
function validatorreqtext(z, y, x = null) {
  if (z.value.length != 0) {
    var dfalse = 0;
    for (var i = 0; i < z.value.length; i++) {
      if (y.indexOf(z.value.charAt(i)) != -1) dfalse++;
    }
    if (dfalse == 0) return true;
    else {
      if (x != null)
        alert(
          "Data " +
            x +
            " Tidak Valid (mengandung karakter yang tidak diperbolehkan)"
        );
      return false;
    }
  } else {
    if (x != null) alert("Data " + x + " tidak boleh kosong");
    return false;
  }
}

function validatoropttext(z, y, x = null) {
  if (z.value.length != 0) {
    var dfalse = 0;
    for (var i = 0; i < z.value.length; i++) {
      if (y.indexOf(z.value.charAt(i)) != -1) dfalse++;
    }
    if (dfalse == 0) return true;
    else {
      if (x != null)
        alert(
          "Data " +
            x +
            " Tidak Valid (mengandung karakter yang tidak diperbolehkan)"
        );
      return false;
    }
  }
  return true;
}
///i for value, j if call from input, k if optional

function validatorreqnumber(i, j = null, k = null) {
  if (i.value.length != 0) {
    var number = /^[0-9]+$/;
    var res = i.value.substring(0, 2);

    if (!i.value.match(number)) {
      if (j != null) alert("data " + j + " tidak valid");
      return false;
    } else if (i.value.length == 0) {
      if (j != null) alert("data " + j + " tidak valid");
      return false;
    } else return true;
  } else {
    if (j != null) alert("data " + j + " tidak boleh kosong");
    return false;
  }
}

function validatoroptnumber(i, j = null, k = null) {
  if (i.value.length != 0) {
    var number = /^[0-9]+$/;
    var res = i.value.substring(0, 2);

    if (!i.value.match(number)) {
      if (j != null) alert("data " + j + " tidak valid");
      return false;
    } else if (i.value.length == 0) {
      if (j != null) alert("data " + j + " tidak valid");
      return false;
    } else return true;
  } else return true;
}

function cekhp(i, j = null) {
  if (j == null) i = i.value;
  //console.log(i);
  var number = /^[0-9]+$/;
  var res = i.substring(0, 2);
  if (i == null || i == "") {
    if (j != null) alert("nomer handphone tidak boleh kosong");
    return false;
  } else if (!i.match(number)) {
    if (j != null) alert("nomer handphone  harus angka");
    return false;
  } else if (i.length < 8) {
    if (j != null) alert("nomor handphone tidak valid");
    return false;
  } else if (res != "08") {
    if (j != null) alert(j + " Harus diawali 08");
    return false;
  } else return true;
}

function cekhpnor(i, j = null) {
  if (i.value.length != 0) {
    var number = /^[0-9]+$/;
    var res = i.value.substring(0, 2);
    if (!i.value.match(number)) {
      if (j != null) alert("nomer handphone harus angka");
      return false;
    } else if (i.value.length < 8) {
      if (j != null) alert("nomor handphone tidak valid");
      return false;
    } else if (res != "08") {
      if (j != null) alert(j + " Harus diawali 08");
      return false;
    } else return true;
  } else return true;
}

function deldata(i) {
  if (confirm("Apakah anda yakin akan menghapus data ini?")) {
    var data1 = {
      id: i,
    };
    $.ajax({
      type: "POST",
      url: "./cluster/deldata",
      data: data1,
      success: function (msg) {
        alert("data berhasil dihapus");
        $("#table-cluster").DataTable().ajax.reload(null, false);
      },
    });
  }
}

function setprov(i) {
  $("#provinsi").val(i);
}

function getkotakab(i, j = null) {
  var data1 = {
    provinsi_id: i,
  };
  var address = "./cluster/getkotakab";
  var get = sendajaxreturn(data1, address, "json");
  var select =
    '<select class="form-control dform  required" onchange="getkecamatan(this.value)" id="kabupaten"><option></option>';
  get.forEach(function (e) {
    select +=
      "<option value='" +
      e.id +
      "' " +
      (j != null ? (j == e.id ? "selected" : "") : "") +
      ">" +
      e.nama +
      "</option>";
  });
  document.getElementById("selkab").innerHTML = "" + select + "</select>";
}

function getkecamatan(i, j = null) {
  var data1 = {
    kabupaten_kota_id: i,
  };
  var address = "./cluster/getkecamatan";
  var get = sendajaxreturn(data1, address, "json");
  var select =
    '<select class="form-control dform  required" onchange="getkelurahan(this.value)" id="kecamatan"><option></option>';
  get.forEach(function (e) {
    select +=
      "<option value='" +
      e.id +
      "' " +
      (j != null ? (j == e.id ? "selected" : "") : "") +
      ">" +
      e.nama +
      "</option>";
  });
  document.getElementById("selkec").innerHTML = "" + select + "</select>";
}

function getkelurahan(i, j = null) {
  var data1 = {
    kecamatan_id: i,
  };
  var address = "./cluster/getkelurahan";
  var get = sendajaxreturn(data1, address, "json");
  var select =
    '<select class="form-control dform  required" onchange="setkdpos(this)" id="kelurahan"><option></option>';
  get.forEach(function (e) {
    select +=
      "<option value='" +
      e.id +
      "' " +
      (j != null ? (j == e.id ? "selected" : "") : "") +
      " kdpos='" +
      e.kode_pos +
      "'>" +
      e.nama +
      "</option>";
    if (j != null && j == e.id) setkdpos("", e.kode_pos);
  });
  document.getElementById("selkel").innerHTML = "" + select + "</select>";
}

function setkdpos(i, j = null) {
  var element = j == null ? $("option:selected", i).attr("kdpos") : j;
  document.getElementById("kode_pos").innerHTML = element;
  document.getElementById("kode_pos").value = element;
}

function showClusterInfo(id) {
  $("#cluster-info-modal").modal("show");
  var baseHTML = $("#cluster-info-modal .modal-body");
  baseHTML.html(`
        <div class="center-wrapper">
          <p>...loading</p>
        </div>
      `);
  $.ajax({
    type: "POST",
    url: "./cluster/getClusterInfo",
    data: { id: id },
    success: function (data) {
      const info = JSON.parse(data);
      baseHTML.html(`
            <div class="row">
              <div class="col-md-12 info-heading">
                <h2>${info.kelompok_usaha}</h2>
                <h4>Produk : ${info.hasil_produk}</h4>
                <h4>Anggota : ${info.kelompok_jumlah_anggota} orang
                </h4>
                <h4>Ketua: ${info.kelompok_perwakilan} / ${
        info.kelompok_handphone
      }</h4>
                <h5>${info.lokasi_usaha}</h5>
              </div>
            </div>
            <br/>
            <div class="row">
              <div class="col-md-4">
                <dl>
                  <dt class="list-space">Ketua Unit</dt>
                  <dd>${info.kaunit_nama}</dd>
                  <dt class="list-space">BRI Unit</dt>
                  <dd>${info.uker}</dd>
                  <dt class="list-space">Kontak Kantor Unit</dt>
                  <dd>${info.kaunit_handphone}</dd>
                </dl>
              </div>
              <div class="col-md-4">
                <dl>
                  <dt class="list-space">Supplier</dt>
                  <dd>${info.kelompok_suplier_produk} : ${
        info.kelompok_suplier_handphone
      }</dd>
                  <dt class="list-space">Offtaker</dt>
                  <dd>${info.kelompok_pihak_pembeli} : ${
        info.kelompok_pihak_pembeli_handphone
      }</dd>
                </dl>
              </div>
              <div class="col-md-4">
                <dl>
                  <dt class="list-space">Agen BRI Link</dt>
                  <dd>${info.agen_brilink}</dd>
                  <dt class="list-space">Pinjaman</dt>
                  <dd>${info.pinjaman}</dd>
                  <dt class="list-space">Simpanan</dt>
                  <dd>${info.simpanan_bank}</dd>
                </dl>
              </div>
            </div>
            <br/>
            <div class="row">
              <div class="col-md-12">
                <p>${info.kelompok_cerita_usaha}</p>
              </div>
            </div>
            <br/>
            <div class="row">
              <div class="col-md-12">
                <p><strong>Kebutuhan Pelatihan</strong></p>
                <ul>
                  <li>${info.pelatihan}</li>
                </ul>
              </div>
            </div>
            <br/>
            ${
              info.photos.length > 0
                ? `
              <div class="row">
                <div class="col-md-12">
                <p><strong>Galeri</strong></p>
                <div id="carousel-cluster-photos" class="carousel slide" data-ride="carousel">
                
                  <ol class="carousel-indicators">
                    ${info.photos.map(function (photo, index) {
                      return `
                        <li data-target="#carousel-cluster-photos" data-slide-to="${index}"></li>
                      `;
                    })}
                  </ol>
    
                  <!-- Wrapper for slides -->
                  <div class="carousel-inner" role="listbox">
                    ${info.photos.map(function (photo, index) {
                      return `
                        <div class="item">
                          <img class="center-block" src="${photo.url}" alt="photo-${index}">
                        </div>
                      `;
                    })}
                  </div>
    
                  <!-- Controls -->
                  <a class="left carousel-control" href="#carousel-cluster-photos" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="right carousel-control" href="#carousel-cluster-photos" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>
                </div>
              </div>
            `
                : ``
            }
        `);
      $("#carousel-cluster-photos .item").first().addClass("active");
      $("#carousel-cluster-photos .carousel-indicators > li")
        .first()
        .addClass("active");
    },
    error: function (error) {
      console.log(error);
      baseHTML.html(`
            <div class="center-wrapper">
              <p>Terjadi Kesalahan</p>
            </div>
          `);
    },
  });
}
