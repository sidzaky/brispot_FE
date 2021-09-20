

var idjum="";
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

  idjum=i;

  var get = sendajaxreturn(data1, "./dashboard/setmap", 'json');
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
  $('#table-cluster').DataTable().ajax.reload(null, false);
  document.getElementById("listCluster").style.display = "block"; 
  stylemap("Google");
  document.getElementById("selectormap").value="Google";
}


 

var table = $('#table-cluster').DataTable({
  "scrollX": true,
  "scrollY": true,
  "processing": true,
  "serverSide": true,
  "ajax": {
    "url": "./dashboard/setlistjum",
    "type": "POST",
    "data":  {
      "id_cluster_jenis_usaha_map"  : function() { return idjum} ,
      },
    }
});

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





