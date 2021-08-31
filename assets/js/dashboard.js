
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
  var address = "./dashboard/setmap";
  var get = sendajaxreturn(data1, address, 'json');
  const map = new google.maps.Map(document.getElementById("mapid"), {
    zoom: 4.5,
    center: { lat: 0.7893, lng: 113.9213 },
  });

  let infowindow = new google.maps.InfoWindow();

  get.forEach(function (value){
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
}




