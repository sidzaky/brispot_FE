jQuery(function ($) {
  $(window).on("beforeunload", function () {
    $(window).scrollTop(0);
  });

  $(".navbar-toggle").on("click", function () {
    if ($(this).hasClass("collapsed")) {
      document.querySelector(".navbar-default").style.backgroundColor =
        "#ffffff";
      var menu = document.querySelectorAll(
        "#navbar .navbar-nav li a.text-button"
      );
      menu.forEach(function (item) {
        item.style.color = "#000000";
      });
    } else {
      document.querySelector(".navbar-default").style.backgroundColor =
        "transparent";
    }
  });

  $(window).on("scroll", function () {
    scrolls();
  });

  function scrolls() {
    if (
      document.body.scrollTop > 80 ||
      document.documentElement.scrollTop > 80
    ) {
      // navbar wrapper background
      document.querySelector(".navbar-default").style.backgroundColor =
        "#ffffff";
      // navbar item
      var menu = document.querySelectorAll(
        "#navbar .navbar-nav li a.text-button"
      );
      menu.forEach(function (item) {
        item.style.color = "#000000";
      });
      // navbar item active
      document.querySelector(
        "#navbar .navbar-nav li.active a.text-button"
      ).style.color = "#1f3ab4";
      // navbar brand
      document.querySelector(".navbar-brand").style.color = "#000000";
      // navbar border
      document.querySelector(".navbar-default").style.border =
        "1px solid rgb(239, 239, 239)";
      document.querySelector(".navbar-default").style.boxShadow =
        "0px 1px 12px 1px #e9e9e9";
    } else {
      // navbar wrapper background
      document.querySelector(".navbar-default").style.backgroundColor =
        "transparent";
      // navbar item
      var menu = document.querySelectorAll(
        "#navbar .navbar-nav li a.text-button"
      );
      menu.forEach(function (item) {
        item.style.color = "#ffffff";
      });
      // navbar brand
      document.querySelector(".navbar-brand").style.color = "#ffffff";
      // navbar item active
      document.querySelector(
        "#navbar .navbar-nav li.active a.text-button"
      ).style.color = "#1f3ab4";
      // navbar border
      document.querySelector(".navbar-default").style.boxShadow = "none";
      document.querySelector(".navbar-default").style.border = "none";
    }
  }

  const pemberdayaan = [
    {
      key: "1",
      title: "Pelatihan Cangkul di Sukabumi",
      info: "Peserta pelatihan sebanyak 52 orang",
      tokoh: "Bpk. Supriyanto",
      bisnis:
        "Pelatihan yang diberikan memberikan dampak kualitas produk meningkat dan telah memenuhi standar SNI serta potensi pengembangan pasar untuk memenuhi kebutuhan pacul nasional",
      anggota: 52,
    },
    {
      key: "2",
      title: "Bantuan Sarpras di Kedonganan Bali",
      info: "Bantuan cooler box sebanyak 157 unit",
      tokoh: "I Nyoman Sudiasa",
      bisnis:
        "bantuan kotak pendingin mampu menambah kapasitas usaha menjadi 170 kg. Kotak pendingin juga membuat pedagang ikan bisa menyimpan lebih lama ikan dan hasil laut lainnya",
      anggota: 120,
    },
    {
      key: "3",
      title: "Bantuan Sarpras di Soreang",
      info: "Bantuan homestay",
      tokoh: "Bpk. Nuri",
      bisnis:
        "Setelah diberikan bantuan pembangunan Homestay, Meningkatkan dan mengembangkan potensi eduwisata dengan konsep integrasi Arabika hulu sampai hilir di 4 titik di kawasan Kampung Kopi Malabar. Konsep eduwisata tersebut dapat memudahkan bagi pelajar maupun umum untuk belajar budidaya Kopi",
      anggota: 212,
    },
    {
      key: "4",
      title: "Bantuan Sarpras di Selong Lombok",
      info: "Bantuan spot foto selfie",
      tokoh: "Bpk. Alimin",
      bisnis:
        " Bantuan spot selfie digunakan untuk meningkatkan minat para wisatawan hadir di Selong sekaligus menikmati hidangan lobster",
      anggota: 20,
    },
  ];

  function setCarouselInfo(activeSlide = 1) {
    $(".description > .desc-title").html(pemberdayaan[activeSlide - 1].title);
    $(".description > .desc-tokoh").html(
      `<strong>${pemberdayaan[activeSlide - 1].tokoh} - ${
        pemberdayaan[activeSlide - 1].anggota
      } anggota</strong>`
    );
    $(".description > .desc-info").html(pemberdayaan[activeSlide - 1].info);
    $(".description > .desc-bisnis").html(pemberdayaan[activeSlide - 1].bisnis);
  }

  var activeSlide = $(".carousel .item.active").attr("data-descid");
  setCarouselInfo(activeSlide);

  $("#gallery-carousel").on("slid.bs.carousel", function () {
    var activeSlide = $(".carousel .item.active").attr("data-descid");
    setCarouselInfo(activeSlide);
  });

  $(".nav li").on("click", function () {
    var currentActive = $("li.active");
    currentActive.removeClass("active");
    $(this).addClass("active");
  });
});
