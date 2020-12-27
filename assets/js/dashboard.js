jQuery(function ($) {
  var loading = `
  <div class="overlay loading">
    <i class="fa fa-refresh fa-spin"></i>
  </div>`;

  var loanNeedsLoading = true;
  $("#loan-needs").append(loading);
  var toolNeedsLoading = true;
  $("#tool-needs").append(loading);
  var trainingNeedsLoading = true;
  $("#training-needs").append(loading);

  $.ajax({
    url: baseURL + "dashboard/getLoanNeeds",
    dataType: "json",
    type: "POST",
  })
    .done(function (data) {
      loanNeedsLoading = false;
      $("#loan-needs > .loading").remove();
      var loanNeedsList = showNeeds(data, "kredit");
      $("#loan-needs > .box-body").append(loanNeedsList);
    })
    .fail(function (error) {
      loanNeedsLoading = false;
      $("#loan-needs > .loading").remove();
      $("#loan-needs > .box-body").append(
        `<p style="text-align: center">${error}</p>`
      );
      console.log(error);
    });

  $.ajax({
    url: baseURL + "dashboard/getToolNeeds",
    dataType: "json",
    type: "POST",
  })
    .done(function (data) {
      toolNeedsLoading = false;
      $("#tool-needs > .loading").remove();
      var toolNeedsList = showNeeds(data, "sarana");
      $("#tool-needs > .box-body").append(toolNeedsList);
    })
    .fail(function (error) {
      toolNeedsLoading = false;
      $("#tool-needs > .loading").remove();
      $("#tool-needs > .box-body").append(
        `<p style="text-align: center">${error}</p>`
      );
      console.log(error);
    });

  $.ajax({
    url: baseURL + "dashboard/getTrainingNeeds",
    dataType: "json",
    type: "POST",
  })
    .done(function (data) {
      trainingNeedsLoading = false;
      $("#training-needs > .loading").remove();
      var trainingNeedsList = showNeeds(data, "pendidikan");
      $("#training-needs > .box-body").append(trainingNeedsList);
      console.log(data);
    })
    .fail(function (error) {
      trainingNeedsLoading = false;
      $("#training-needs > .loading").remove();
      $("#training-needs > .box-body").append(
        `<p style="text-align: center">${error}</p>`
      );
      console.log(error);
    });

  var showNeeds = function (data, key) {
    const html = `
      <div class="cluster-needs-list">
        ${data
          .map(function (item) {
            return `
            <div class="row">
              <div class="col-md-8">
              ${item[key]}
              </div>
              <div class="col-md-4"><b>${item.total}</b></div>
            </div>  
            `;
          })
          .join("")}
      </div>
    `;
    return html;
  };
});

$(document).ready(function() {setfilter();});

function setfilter(){
  $.ajax({
        type: "POST",
        url: "./dashboard/persebaranpetaprovinsi",
        success: function (msg) {
          Highcharts.mapChart('map', {
                  chart: {
                      map: 'countries/id/id-all'
                  },
                  title: {
                      text: 'Persebaran Klaster BRI berdasarkan Provinsi'
                  },
                  subtitle: {
                      text: 'Source map: <a href="http://code.highcharts.com/mapdata/countries/id/id-all.js">Indonesia</a>'
                  },
                  mapNavigation: {
                      enabled: true,
                      buttonOptions: {
                          verticalAlign: 'bottom'
                      }
                  },
                  series: [{
                      data: JSON.parse(msg!= null ? msg : ''),
                      name: 'Data klaster',
                      states: {
                          hover: {
                              color: '#BADA55'
                          }
                      },
                      dataLabels: {
                          enabled: true,
                          format: '{point.name}'
                      }
                  }]
              })
        }
    });
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
      $(select).append('<option value="">semua </option>');
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

function fhp(i, j = "") {
  var data1 = {
    id_cluster_jenis_usaha : i,
  };
  $.ajax({
    type: "POST",
    url: "./cluster/get_hp",
    data: data1,
    success: function (smsg) {
      var msg = JSON.parse(smsg);
      var select = document.getElementById("hasil_produk");
      $(select).empty();
      $(select).append('<option value="">semua </option>');
      var selected ;;
      for (var i = 0; i <= msg.length; i++) {
        selected = "";
        if (j != "" && j == msg[i]["hasil_produk"]) selected = "selected";
        
        $(select).append(
          '<option value="' +
            msg[i]["hasil_produk"] +
            '" ' +
            selected +
            ">" +
            msg[i]["hasil_produk"] +
            "</option>"
        );
      }
    },
  });
}


function fv(i, j = "") {
  var data1 = {
    bentuk_usaha : i,
  };
  $.ajax({
    type: "POST",
    url: "./cluster/get_v",
    data: data1,
    success: function (smsg) {
      var msg = JSON.parse(smsg);
      var select = document.getElementById("varian");
      $(select).empty();
      $(select).append('<option value="">semua </option>');
      var selected  = "";
      for (var i = 0; i <= msg.length; i++) {
        selected = "";
        if (j != "" && j == msg[i]["varian"])
          selected = "selected";
        $(select).append(
          '<option value="' +
            msg[i]["varian"] +
            '" ' +
            selected +
            ">" +
            msg[i]["varian"] +
            "</option>"
        );
      }
    },
  });
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
    '<select class="form-control" id="kabupaten"><option value="">semua</option>';
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
  document.getElementById("kabupaten").innerHTML = "" + select + "</select>";
}