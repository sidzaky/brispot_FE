<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Klaster Binaan BRI v0.2</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link async href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/home.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>/assets/js/home.js"></script>
</head>

<body>
  <nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#"><img src="<?php echo base_url() ?>assets/img/landing-page/logo_spaced.png" alt="logo-klasterku-hidupku" /></a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right">
          <li class="active"><a class="text-button" href="#home">Beranda</a></li>
          <li><a class="text-button" href="#about">Definisi</a></li>
          <li><a class="text-button" href="#galeri">Portofolio</a></li>
          <li><button onclick="(function(){location.href = '<?php echo base_url() ?>login'})()" class="btn btn-primary navbar-btn btn-bri">Login</button></li>
        </ul>
      </div>
      <!--/.nav-collapse -->
    </div>
  </nav>
  <div class="content">
    <div class="jumbotron" id="home">
      <div class="container">
        <div class="hero row">
          <div class="col-md-6 hero-heading">
            <h1 class="title">Klasterku Hidupku</h1>
            <p>Mewujudkan bisnis mikro yang berkelanjutan melalui klasterisasi usaha</p>
          </div>
        </div>
      </div>
    </div>
    <section id="about">
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-md-offset-2 text-center">
            <div class="section-header">
              <h1 class="section-heading">Klaster Usaha</h1>
              <p class="section-subheading center-block">kelompok usaha yang terbentuk berdasarkan kesamaan kepentingan, kondisi lingkungan,
                dan/atau keakraban untuk meningkatkan dan mengembangkan usaha anggota</p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <div class="card">
              <img class="card-image" src="<?php echo base_url() ?>assets/img/landing-page/penjualan-kolektif.png" alt="penjualan-kolektif" />
              <h2 class="card-header">Pemasaran Produk</h2>
              <p class="card-description">Pemasaran produk & jasa BRI yang efektif dan
                efisien melalui pendekatan kelompok/klaster</p>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card">
              <img class="card-image" src="<?php echo base_url() ?>assets/img/landing-page/finansial-advisor.png" alt="financial-advisor" />
              <h2 class="card-header">Financial Advisor</h2>
              <p class="card-description">Tenaga
                pemasar dapat menjadi financial advisor (konsultan keuangan) dan partner diskusi bagi nasabah UMKM</p>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card">
              <img class="card-image" src="<?php echo base_url() ?>assets/img/landing-page/pemasar.png" alt="tenaga-pemasar" />
              <h2 class="card-header">Menjadi Pemasar</h2>
              <p class="card-description">Pengalaman baik yang dialami oleh pelaku usaha
                menjadi peluang untuk disampaikan kepada pelaku usaha lainnya</p>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card">
              <img class="card-image" src="<?php echo base_url() ?>assets/img/landing-page/potensi.png" alt="kemudahan-identifikasi" />
              <h2 class="card-header">Kemudahan Identifikasi</h2>
              <p class="card-description">Memudahkan tenaga pemasar mengidentifikasi Klaster Usaha dalam lingkungannya</p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section id="kelola-klaster">
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-md-offset-2 text-center">
            <div class="section-header">
              <h1 class="section-heading">Pengelolaan Klaster Usaha</h1>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-8 col-md-offset-2">
            <div id="timeline-content">
              <ul class="timeline">
                <li class="event klaster-event" data-date="">
                  <h3>Klaster Usaha</h3>
                </li>
                <li class="event kunjungan-event" data-date="">
                  <h3>Kunjungan Identifikasi</h3>
                  <p>Membantu membentuk paguyuban/kelompok</p>
                </li>
                <li class="event data-event" id="date" data-date="">
                  <h3>Pencatatan</h3>
                  <p>Input data ke aplikasi <a href="https://www.klasterkuhidupku.com">klasterkuhidupku.com</a></p>
                </li>

                <li class="event identifikasi-event" data-date="">

                  <h3>Identifikasi Klaster Usaha</h3>

                  <p>Identifikasi usaha dan anggota meliputi
                    <p />
                    <ol>
                      <li>anggota</li>
                      <li>jumlah pinjaman</li>
                      <li>jumlah simpanan</li>
                      <li>Agen BRILink</li>
                      <li>Asuransi Mikro</li>
                      <li>Fasilitas bank lainnya</li>
                    </ol>
                </li>
                <li class="event pemberdayaan-event" data-date="">

                  <h3>Pemberdayaan</h3>

                  <ol>
                    <li>Literasi & pelatihan</li>
                    <li>Bantuan sarana & prasarana</li>
                    <li>Financial Advisory</li>
                  </ol>
                </li>
                <li class="event eksekusi-event" data-date="">

                  <h3>Eksekusi Target Bisnis</h3>
                  <p>Data NIK klaster usaha masuk dalam BRISpot</p>
                </li>
                <li class="event evaluasi-event" data-date="">

                  <h3>Monitoring & Evaluasi</h3>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section id="galeri">
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-md-offset-2 text-center">
            <div class="section-header">
              <h1 class="section-heading">Pemberdayaan</h1>
              <p class="section-subheading center-block">Aktivitas bisnis maupun
                sosial yang bertujuan untuk meningkatkan pengetahuan maupun kapasitas usaha.</p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-7">
            <div id="gallery-carousel" class="carousel slide" data-ride="carousel">
              <!-- Indicators -->
              <ol class="carousel-indicators">
                <li data-target="#gallery-carousel" data-slide-to="0" class="active"></li>
                <li data-target="#gallery-carousel" data-slide-to="1"></li>
                <li data-target="#gallery-carousel" data-slide-to="2"></li>
                <li data-target="#gallery-carousel" data-slide-to="3"></li>
              </ol>

              <!-- Wrapper for slides -->
              <div class="carousel-inner" role="listbox">
                <div class="item active" data-descid="1">
                  <img src="<?php echo base_url() ?>assets/img/landing-page/cangkul.png" alt="pelatihan-cangkul">
                </div>
                <div class="item" data-descid="2">
                  <img src="<?php echo base_url() ?>assets/img/landing-page/cooler-box.png" alt="bantuan-cooler-box">
                </div>
                <div class="item" data-descid="3">
                  <img src="<?php echo base_url() ?>assets/img/landing-page/homestay.png" alt="homestay">
                </div>
                <div class="item" data-descid="4">
                  <img src="<?php echo base_url() ?>assets/img/landing-page/spot-foto-selfie.png" alt="spot-foto-selfie">
                </div>
              </div>

              <!-- Controls -->
              <a class="left carousel-control" href="#gallery-carousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="right carousel-control" href="#gallery-carousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
          </div>
          <div class="col-md-5">
            <div class="description">
              <h3 class="desc-title">Lorem</h3>
              <h5 class="desc-tokoh"></h5>
              <p class="desc-info">Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur placeat ut inventore nemo vel? Natus dignissimos consequuntur assumenda iste esse sequi ex inventore blanditiis corrupti iure? Repudiandae possimus nemo ipsa.</p>
              <p class="desc-bisnis">Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur placeat ut inventore nemo vel? Natus dignissimos consequuntur assumenda iste esse sequi ex inventore blanditiis corrupti iure? Repudiandae possimus nemo ipsa.</p>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <footer id="footer">
    <div class="container">
      <div class="row" style="padding: 3rem 0;">
        <div class="col-md-4"></div>
        <div class="col-md-4"></div>
        <div class="col-md-4">
          <address>
            <strong>Alamat</strong><br>
            Jl. Jend. Sudirman No.Kav 44-46, RT.14/RW.1<br>
            Bendungan Hilir, Tanah Abang<br>
            Kota Jakarta Pusat<br>
            Daerah Khusus Ibukota Jakarta, 10210<br>
          </address>
        </div>
      </div>
      <div class="row tail">
        <div class="col-md-6">
          <div class="copyright">©2020 by KlasterkuHidupku. All Right Reserved</div>
        </div>
        <div class="col-md-6">
          <div class="icon-attribution pull-right">Icons made by various <a href="#" data-toggle="modal" data-target="#attributionModal">artists</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div>
        </div>
      </div>
    </div>
  </footer>
  <div class="modal fade" id="attributionModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Icons Attribution</h4>
        </div>
        <div class="modal-body">
          <div>Icons made by <a href="https://www.flaticon.com/authors/gregor-cresnar" title="Gregor Cresnar">Gregor Cresnar</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div>
          <div>Icons made by <a href="https://www.flaticon.com/authors/xnimrodx" title="xnimrodx">xnimrodx</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div>
          <div>Icons made by <a href="https://www.flaticon.com/authors/eucalyp" title="Eucalyp">Eucalyp</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div>
          <div>Icons made by <a href="https://www.flaticon.com/authors/geotatah" title="geotatah">geotatah</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div>
          <div>Icons made by <a href="https://www.flaticon.com/authors/freepik" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div>
          <div>Icons made by <a href="https://www.flaticon.com/authors/smalllikeart" title="smalllikeart">smalllikeart</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
</body>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</html>