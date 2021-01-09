
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