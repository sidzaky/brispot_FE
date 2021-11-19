function showClusterLHInfo(id) {
  $("#cluster-info-modal").modal("show");
  var baseHTML = $("#cluster-info-modal .modal-body");
  baseHTML.html(`
      <div class="center-wrapper">
      <p>...loading</p>
      </div>
    `);
  $.ajax({
    type: "POST",
    url: "./cluster/getClusterLHInfo",
    data: { id: id },
    success: function (data) {
      const info = JSON.parse(data);
      baseHTML.html(` <div class="row">
      <div class="col-md-12 info-heading">
      <h2>${info.kelompok_usaha}</h2>
      <h4>Anggota : ${info.kelompok_jumlah_anggota} orang
      </h4>
      <h4>Ketua: ${info.kelompok_perwakilan} / ${
        info.kelompok_handphone
        }</h4>
            <h5>${info.lokasi_usaha}</h5>
            </div>
          </div>
        <div class="row">
          <div class="col-md-12">
            <p><strong>Cerita Local Heroes</strong></p>
            <p>${info.lh_inisiatif}</p>
          </div>
        </div>					
        <hr>
      ${info.photos.length > 0 ? `
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
              <img class="center-block" src="`+baseURL+`${photo.url}" alt="photo-${index}">
              </div>
            `;
            })}
          </div>
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
      </div> `
      : `<div class="row">
          <div class="col-md-12">
          <h3 align="center" style="color:red;"><strong>Galeri Terkait UMKM Belum Ada</strong></h3>
          </div>
          </div>
        ` 
      }`);
      $("#carousel-cluster-photos .item").first().addClass("active");
      $("#carousel-cluster-photos .carousel-indicators > li").first().addClass("active");
    }
  });
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
                  <h4>Anggota : ${info.kelompok_jumlah_anggota} orang
                  </h4>
                  <h4>Ketua: ${info.kelompok_perwakilan} / ${info.kelompok_handphone}</h4>
                  <h5>${info.lokasi_usaha}</h5>
                </div>
              </div>
              <br/>
              <div class="row">
                <div class="col-md-4">
                  <dl>
                    <dt class="list-space">BRI Unit</dt>
                    <dd>${info.uker}</dd>
                    <dt class="list-space">Ketua Unit</dt>
                    <dd>${info.kaunit_nama} : ${info.kaunit_handphone}</dd>
                    <dt class="list-space">Mantri Unit</dt>
                    <dd>${info.nama_pekerja} : ${info.handphone_pekerja}</dd>
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
              <hr>
              <div class="row">
                <div class="col-md-6">
                  <dt class="list-space">Cerita Usaha</dt>
                  <p>${info.kelompok_cerita_usaha}</p>
                </div>
                <div class="col-md-6">
                  <div class="col-sm-6">
                    <dt class="list-space">Produk : varian</dt>
                    <dd>${info.hasil_produk} : ${info.varian}</dd>
                  </div>
                  <div class="col-sm-6">
                    <dt class="list-space">Luas Usaha </dt>
                    <dd>${info.kelompok_luas_usaha} M<sup>2</sup> </dd>
                  </div>
                  <div class="col-sm-6">
                    <dt class="list-space">Kapasitas Produksi</dt>
                    <dd>${info.kapasitas_produksi} ${info.satuan_produksi}  </dd>
                  </div>
                  <div class="col-sm-6">
                    <dt class="list-space">Periode Panen</dt>
                    <dd>${info.periode_panen}</dd>
                  </div>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-4">
                  <p><strong>Kebutuhan Pelatihan</strong></p>
                  <ul>
                    <li>${info.pelatihan}</li>
                  </ul>
                </div>
                <div class="col-md-4">
                <p><strong>Kebutuhan Prasarana</strong></p>
                <ul>
                  <li>${info.sarana}</li>
                </ul>
                </div>
                <div class="col-md-4">
                <p><strong>Kebutuhan Skema Kredit</strong></p>
                <ul>
                  <li>${info.skema_kredit}</li>
                </ul>
                </div>
              </div>
              <hr>
            
              ${info.photos.length > 0 ? `
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
                                <img class="center-block" src="`+baseURL+`${photo.url}" alt="photo-${index}">
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
                </div> `
                : `<div class="row">
                      <div class="col-md-12">
                        <h3 align="center" style="color:red;"><strong>Galeri Terkait UMKM Belum Ada</strong></h3>
                        </div>
                       </div>
                    ` 
              }
              <hr>
              <div class="row">
                  <div class="col-md-12"> 
                      <h3 align="center" id="mapinfojudul"></h3>
                      <div id="mapinfo"></div>   
                  </div>
                </div> 
          `);
        $("#carousel-cluster-photos .item").first().addClass("active");
        $("#carousel-cluster-photos .carousel-indicators > li").first().addClass("active");
        
        if (info.latitude!="-" || info.longitude!="-"){
              const nkoord = { lat: parseFloat(info.latitude)  , lng: parseFloat(info.longitude) };
              const nmap = new google.maps.Map(document.getElementById("mapinfo"), {
                zoom: 14,
                center: nkoord,
              });
              // Create the initial InfoWindow.
              let infoWindow = new google.maps.InfoWindow({
                content: "lokasi UMKM",
                position: nkoord,
              });
              infoWindow.open(nmap);
              document.getElementById("mapinfojudul").innerHTML='Lokasi UMKM ' + info.kelompok_usaha;
        }
        else {
          document.getElementById("mapinfojudul").innerHTML='Lokasi UMKM belum ditentukan';
        }
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