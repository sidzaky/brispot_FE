
function initMap() {
  const map = new google.maps.Map(document.getElementById("mapid"), {
    zoom: 4.5,
    center: { lat: 0.7893, lng: 113.9213 },
  });
}

const shape = {
  coords: [1, 1, 1, 20, 18, 20, 18, 1],
  type: "poly",
};

function setmap(i){
 
  var data1 = {
    'id_cluster_jenis_usaha_map': i
  };
  var get = sendajaxreturn(data1, "./dashboard/setmap", 'json');
  // var desc = sendajaxreturn(data1, "./dashboard/getdesc", 'json');
  const map = new google.maps.Map(document.getElementById("mapid"), {
    zoom: 4.5,
    center: { lat: 0.7893, lng: 113.9213 },
  });

  let infowindow = new google.maps.InfoWindow();

  get.cluster.forEach(function (value){
      var marker = new google.maps.Marker({
          position: { lat: parseFloat(value.latitude), lng: parseFloat(value.longitude) },
          map,
          icon: {
            url: "http://maps.google.com/mapfiles/ms/icons/green-dot.png",
            scaledSize: new google.maps.Size(44, 44),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(44, 44),
            labelOrigin: new google.maps.Point(22, 18),
          },
          zIndex: get.length,
        });
      marker.setOpacity(.75);
      google.maps.event.addListener(marker, 'click', function() {
        infowindow.setContent(value.kelompok_usaha + "</br>" + value.kelompok_jumlah_anggota + " Anggota");
        infowindow.open(map, marker);
      });
      google.maps.event.addListener(map, 'click', function() {
        infowindow.close();
      });
  });
  // var b="";
  // var html="";
  // get.cluster.forEach(function (value){
  //    if (b == ""){
  //       b = value.nama_cluster_jenis_usaha_map;
  //       html = ` <li class="treeview">
  //                   <a href="#">
  //                     <i class="fa fa-bar-chart"></i> <span>`+value.nama_cluster_jenis_usaha_map+`</span>
  //                     <i class="fa fa-angle-left pull-right"></i>
  //                   </a>
  //                   <ul class="treeview-menu menu-open">         
  //                           <li></li>`

  //    }

  // });

 
  var table = $('#table-cluster').DataTable();
  var i=0;
  table.clear();
  get.newlist.forEach(function (value){
    i++;
    table.row.add([ i, 
                    value.kelompok_usaha, 
                    value.nama_pekerja, 
                    value.handphone_pekerja,
                    value.nama_kabupaten,
                    value.nama_kelurahan,
                    value.nama_kecamatan,
                    value.kelompok_perwakilan,
                    value.kelompok_handphone,
                    value.kelompok_jumlah_anggota                  
                  ])
    .draw('false');
  });
  document.getElementById("listCluster").style.display = "block"; 
  

  // desc.forEach(function (value){
  //   document.getElementById("jum_title").innerHTML =  value.nama_cluster_jenis_usaha_map;
  //   document.getElementById("jum_deskripsi").innerHTML =  value.detail;
  // });
  stylemap("Google");
  document.getElementById("selectormap").value="Google";
}

function stylemap(i){
  if (i == "Google"){
    document.getElementById("byGoogleMap").style.display = "block"; 
    document.getElementById("byProvinsi").style.display = "none"; 
  }
  else {
    document.getElementById("byGoogleMap").style.display = "none"; 
    document.getElementById("byProvinsi").style.display = "block"; 
  }
}

$(document).ready(function() {setfilter();});


function setfilter(){
  $.ajax({
        type: "POST",
        url: "./dashboard/persebaranpetaprovinsi",
        success: function (msg) {
          Highcharts.mapChart('mapidbyhighchart', {
                  chart: {
                      map: 'countries/id/id-all'
                  },
                  title: false,
                  subtitle: false,
                  mapNavigation: {
                      enabled: true,
                      buttonOptions: {
                          verticalAlign: 'bottom'
                      }
                  },
                  plotOptions: {
                    series: {
                        point: {
                            events: {
                                click: function () { 
                                  window.open( './dashboard/psummary/' + this["hc-key"]);
                                }
                            }
                        }
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





