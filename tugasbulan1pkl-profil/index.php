<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Profil Perusahaan</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="style.css">

    <!-- Manifest -->
  <link rel="manifest" href="manifest.json">

  <!-- Theme Color -->
  <meta name="theme-color" content="#2196f3">

  <!-- Ikon -->
  <link rel="icon" type="image/png" sizes="192x192" href="favicon.ico.jpg">

</head>
<body>
  <h1>Selamat datang di PWA Website</h1>
  <p>Versi ini bisa di-install dan dipakai offline</p>

  <!-- Popup Install -->
  <div id="installPopup" style="display:none; position:fixed; bottom:20px; right:20px; background:white; padding:15px; border-radius:10px; box-shadow:0 2px 10px rgba(0,0,0,0.2); z-index:999;">
    <p>Pasang aplikasi ini di perangkat Anda?</p>
    <button id="installBtn">Pasang</button>
    <button onclick="document.getElementById('installPopup').style.display='none'">Tutup</button>
  </div>

  <!-- JS -->
  <script src="app.js"></script>
</body>
</head>
  <style>
    /* Reset dan font */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body, html {
      height: 100%;
      font-family: 'Roboto', sans-serif;
    }

    /* Hero section */
    .hero {
      position: relative;
      width: 100%;
      height: 100vh;
      background-image: url('aset/bc1.png'); /* Ganti dengan path gambar */
      background-size: cover;
      background-position: center;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
    }

    .hero-content {
      position: relative;
      z-index: 2;
      color: white;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 20px;
      padding: 0 20px;
    }

    .hero-logo {
      max-width: 90%;
      width: 800px;
      height: auto;
    }

    /* Tombol */
    .btn-selengkapnya {
      background-color: #FFD700;
      color: black;
      padding: 12px 25px;
      border-radius: 8px;
      text-decoration: none;
      font-weight: bold;
      transition: background 0.3s ease;
    }

    .btn-selengkapnya:hover {
      background-color: #e5c200;
    }

    /* RESPONSIF */
    @media (max-width: 768px) {
      .hero-logo {
        width: 400px;
      }

      .btn-selengkapnya {
        padding: 10px 20px;
        font-size: 14px;
      }
    }

    @media (max-width: 480px) {
      .hero-logo {
        width: 600px;
      }

      .btn-selengkapnya {
        padding: 8px 16px;
        font-size: 13px;
      }
    }
    .sectioon {
      padding: 60px 20px;
      text-align: center;
      background: #fff;
    }

    .sectioon h2 {
      font-size: 32px;
      margin-bottom: 40px;
    }

    .servicess {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 20px;
      justify-content: center;
    }

    /* Card */
    .card {
      background: #f9f9f9;
      border-radius: 16px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      padding: 30px 20px;
      text-align: center;
    }

    .card i {
      font-size: 36px;
      color: #FFD700;
      margin-bottom: 15px;
    }

    .card h3 {
      font-size: 20px;
      margin-bottom: 10px;
    }

    .card p {
      font-size: 14px;
      color: #555;
      margin-bottom: 20px;
    }

    .btn {
      background-color: #009688;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-weight: bold;
      box-shadow: 0 4px 6px rgba(0,0,0,0.15);
      transition: 0.3s;
    }

    .btn:hover {
      background-color: #00796b;
    }

    /* Warna latar dan padding utama */
    .tentang-full {
      background-color: #f9be3e;
      padding: 50px 20px;
    }

    /* Flex layout */
    .tentang-konten {
     display: flex; /* Membuat gambar & teks sejajar */
      align-items: center; /* Rata vertikal */
      justify-content: space-between;
      gap: 30px; /* Jarak antara teks dan gambar */
      max-width: 1200px;
      margin: auto;
      flex-wrap: wrap; /* Supaya tetap rapi saat layar kecil */
    }

    /* Bagian kiri (teks) */
    .tentang-kiri {
      flex: 1 1 500px;
      color: #000000 ;
      text-align:left;
    }

    .tentang-kiri h2 {
      font-size: 36px;
      font-weight: bold;
    }

    .tentang-kiri h3 {
      font-size: 24px;
      font-weight: bold;
      margin-top: 10px;
      color: #fff;
    }

    .tentang-kiri p {
      font-size: 16px;
      margin-top: 20px;
      line-height: 1.6;
      color: #fff;
    }

    /* Tombol */
    .bton-selengkapnya {
      display: inline-block;
      background-color: #009688;
      color: white;
      padding: 12px 25px;
      text-decoration: none;
      border-radius: 6px;
      font-weight: bold;
      transition: background-color 0.3s ease;
    }

    .bton-selengkapnya:hover {
      background-color: #00796b;
    }

    /* Bagian kanan (gambar) */
    .tentang-kanan {
      flex: 1 1 400px;
      text-align: center;
    }

    .tentang-kanan img {
      max-width: 100%;
      height: auto;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    /* RESPONSIF */
    @media (max-width: 768px) {
      .tentang-konten {
        flex-direction: column;
        text-align: center;
        max-height: none; /* Biar tinggi mengikuti isi saja */
      }

      .tentang-kiri, .tentang-kanan {
        width: 100%;
      }

      .tentang-full {
        padding: 40px 15px;
        min-height: auto; /* ⚠️ Ini penting: batasi tinggi minimum */
      }

      .tentang-full::after {
        content: "";
        display: block;
        height: 10px; /* Tambahkan ruang pemisah bawah */
      }

      .tentang-kiri h2 {
        font-size: 28px;
      }

      .tentang-kiri h3 {
        font-size: 20px;
      }

      .tentang-kiri p {
        font-size: 14px;
      }
    }

    .artikel-section {
      padding: 40px 20px;
      background-color: #f7f7f7;
      overflow: hidden;
    }

    .artikel-section h2 {
      text-align: center;
      margin-bottom: 20px;
      font-size: 32px;
      font-weight: bold;
    }

    .artikel-scroll {
      display: flex;
      gap: 20px;
      padding-bottom: 10px;
      scroll-snap-type: x mandatory;
      overflow-x: auto;
      scroll-behavior: smooth;
    }

    .artikel-scroll::-webkit-scrollbar {
      display: none;
    }

    .artikel-card {
      flex: 0 0 300px;
      background-color: white;
      border-radius: 12px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      scroll-snap-align: start;
      transition: transform 0.3s ease;
    }

    .artikel-card:hover {
      transform: translateY(-5px);
    }

    .artikel-card img {
      width: 100%;
      height: 180px;
      object-fit: cover;
      border-top-left-radius: 12px;
      border-top-right-radius: 12px;
    }

    .artikel-card h3,
    .artikel-card p {
      padding: 0 16px;
      text-align: left;
    }

    .artikel-card h3 {
      margin-top: 16px;
      font-size: 18px;
    }

    .artikel-card p {
      margin-bottom: 16px;
      font-size: 14px;
    }

    /* ===== NAVBAR ===== */
    .navbar {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      padding: 15px 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: linear-gradient(to bottom, rgba(0,0,0,0.6), rgba(0,0,0,0)); /* awal transparan + gradasi */
      transition: background 0.4s ease, padding 0.4s ease, backdrop-filter 0.4s ease;
      z-index: 1000;
    }

    .navbar.scrolled {
      background: #16a085; /* warna solid saat scroll */
      backdrop-filter: blur(8px); /* efek blur */
      padding: 10px 30px;
    }

    .navbar .logo {
      color: white;
      font-weight: bold;
      font-size: 1.2em;
    }

    .navbar .logo span {
      display: block;
      font-weight: normal;
      font-size: 0.8em;
      letter-spacing: 2px;
      text-align:left;
    }

    .navbar ul {
      list-style: none;
      display: flex;
    }

    .navbar ul li {
      margin-left: 20px;
    }

    .navbar ul li a {
      text-decoration: none;
      color: white;
      font-weight: bold;
      transition: color 0.3s ease;
    }

    .navbar ul li a:hover {
      color: #ffcc00;
    }

    /* ===== HAMBURGER ===== */
    .hamburger {
      display: none;
      flex-direction: column;
      cursor: pointer;
      width: 25px;
    }

    .hamburger span {
      background: white;
      height: 3px;
      margin: 4px 0;
      border-radius: 2px;
      transition: all 0.3s ease;
    }

    .hamburger.active span:nth-child(1) {
      transform: rotate(45deg) translate(5px, 5px);
    }
    .hamburger.active span:nth-child(2) {
      opacity: 0;
    }
    .hamburger.active span:nth-child(3) {
      transform: rotate(-45deg) translate(5px, -5px);
    }

    /* ===== RESPONSIVE MENU ===== */
    @media (max-width: 768px) {
      .navbar ul {
        position: fixed;
        top: 0;
        right: 0;
        height: 100vh;
        width: 100%;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        background: #16a085;
        backdrop-filter: blur(5px);
        transform: translateX(100%);
        transition: transform 0.4s ease;
      }

      .navbar ul.show {
        transform: translateX(0);
      }

      .navbar ul li {
        margin: 15px 0;
        opacity: 0;
        transform: translateY(20px);
        animation: fadeInUp 0.5s forwards;
      }

      .navbar ul.show li:nth-child(1) { animation-delay: 0.2s; }
      .navbar ul.show li:nth-child(2) { animation-delay: 0.4s; }
      .navbar ul.show li:nth-child(3) { animation-delay: 0.6s; }
      .navbar ul.show li:nth-child(4) { animation-delay: 0.8s; }
      .navbar ul.show li:nth-child(5) { animation-delay: 1s; }

      @keyframes fadeInUp {
        to {
          opacity: 1;
          transform: translateY(0);
        }
      }

      .hamburger {
        display: flex;
      }
    }

    /* ===== POOTER ===== */
    pooter {
      background-color: #fff;
      padding: 40px 0px 0;
      color: #0d2a54;
      display: block;
      text-align:left
    }

    .pooter-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 30px;
      max-width: 1200px;
      margin: auto;
      align-items: start; /* pastikan semua kolom sejajar di atas */
    }

    /* Ikon sosial */
    .pooter-social {
      display: flex;
      gap: 8px; /* jarak antar ikon */
      flex-wrap: wrap; /* biar responsif di HP */
    }
    /* Kolom pertama */
    .pooter-logo h3 {
      font-weight: bold;
      margin-bottom: 10px;
    }
    .pooter-logo p {
      margin-bottom: 10px;
      line-height: 1.5;
    }
    .pooter-logo i {
      margin-right: 8px;
    }

    /* Judul kolom */
    .pooter-col h4 {
      font-weight: bold;
      margin-bottom: 15px;
    }

    /* Link di pooter */
    .pooter-col ul {
      list-style: none;
    }
    .pooter-col ul li {
      margin-bottom: 8px;
    }
    .pooter-col ul li a {
      text-decoration: none;
      color: #0d2a54;
      transition: 0.3s;
    }
    .pooter-col ul li a:hover {
      color: #ff4c29;
    }

    /* Sosial media */
    .pooter-social a {
      display: inline-block;
      width: 40px;
      height: 40px;
      margin-right: 5px;
      border-radius: 5px;
      text-align: center;
      line-height: 40px;
      color: white;
    }
    .pooter-social a.facebook { background: #3b5998; }
    .pooter-social a.linkedin { background: #0077b5; }
    .pooter-social a.youtube { background: #ff0000; }
    .pooter-social a.email { background: #d44638; }
    .pooter-social a.instagram { background: #c13584; }

    /* Bawah pooter */
    .pooter-bottom {
      background-color: #898989;
      color: white;
      text-align: center;
      padding: 15px 10px;
      font-size: 14px;
      margin-top: 20px;
    }
    .pooter-bottom a {
      color: white;
      text-decoration: none;
      margin: 0 10px;
    }
    .pooter-bottom a:hover {
      text-decoration: underline;
    }

    /* Responsif */
    @media (max-width: 600px) {
      .pooter-social a {
        margin-bottom: 5px;

      }
    }

    @media (max-width: 768px) {
      .pooter {
        text-align: center;
      }
      .pooter .footer-section {
        text-align: center;
      }
      .pooter .footer-section ul {
        padding-left: 0;
      }
      .pooter-container{
        text-align: center;
      }
      .pooter-social{
        align-items: center;
        justify-content: center;
      }
    }

    /* Hero Logo Animation */
    @keyframes heroLogo {
      0% { transform: scale(0.8) rotate(-3deg); opacity: 0; }
      60% { transform: scale(1.05) rotate(1deg); opacity: 1; }
      100% { transform: scale(1) rotate(0); }
    }

    .hero-logo {
      animation: heroLogo 1.5s ease-out forwards;
    }

    /* Button Bounce-In */
    @keyframes bounceUp {
      0% { transform: translateY(50px); opacity: 0; }
      60% { transform: translateY(-10px); opacity: 1; }
      80% { transform: translateY(5px); }
      100% { transform: translateY(0); }
    }

    .card:hover {
      transform: translateY(-10px) scale(1.03);
      box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }

    .card:hover {
      transform: translateY(-10px) scale(1.03);
      box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }

    .reveal {
      position: relative;
      overflow: hidden;
    }

    .reveal img {
      transform: scale(1.2);
      opacity: 0;
      transition: transform 1s ease, opacity 1s ease;
    }

    .reveal.show img {
      transform: scale(1);
      opacity: 1;
    }

    /* Animasi */
    @keyframes slideInUp {
      0% { transform: translateY(50px); opacity: 0; }
      100% { transform: translateY(0); opacity: 1; }
    }

    @keyframes fadeIn {
      0% { opacity: 0; }
      100% { opacity: 1; }
    }

    @keyframes bounceIn {
      0% { transform: scale(0.5); opacity: 0; }
      60% { transform: scale(1.1); opacity: 1; }
      80% { transform: scale(0.9); }
      100% { transform: scale(1); }
    }

    /* Utilitas untuk Animasi saat Scroll */
    .animated {
      animation-duration: 1s;
      animation-fill-mode: both;
      opacity: 0; /* Mulai dengan tidak terlihat */
    }

    .slideInUp {
      animation-name: slideInUp;
    }

    .fadeIn {
      animation-name: fadeIn;
    }

    .artikel-section {
      scroll-behavior: smooth;
    }

    .artikel-scroll {
      scroll-snap-type: x mandatory;
    }

    /* Loader background */
    #loader {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: white;
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 9999;
    }

    /* Logo styling */
    #loader img {
      width: 150px;
      animation: spin 2s linear infinite;
    }

    /* Spin animation */
    @keyframes spin {
      0% { transform: rotate(0deg) scale(1); }
      50% { transform: rotate(180deg) scale(1.1); }
      100% { transform: rotate(360deg) scale(1); }
    }

    /* Hide loader */
    .hidden {
      opacity: 0;
      visibility: hidden;
      transition: opacity 0.5s ease;
    }

    /* ===== STYLE UNTUK WAVE SECTION (Atas) ===== */
    .bgWaveCustom {
      position: relative;
      background-color: #f9be3e; /* Warna background di atas gelombang */
      height: 80px;
      overflow: hidden;
    }

    .bgWaveCustom svg {
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      height: auto;
    }

    /* Warna lapisan gelombang */
    .waveLayer1 {
      fill: #ffc64b;
    }

    .waveLayer2 {
      fill: #fccd68;
    }

    .waveLayer3 {
      fill: #fff;
    }

    /* ===== STYLE UNTUK WAVE SECTION (Bawah Hitam - Bagian yang Dimodifikasi) ===== */
    .bbgWaveCustom { /* Ini adalah gelombang hitam yang di bagian atas konten Anda */
      position: relative;
      background-color: #000000; /* Warna background di atas gelombang */
      height: 80px;
      overflow: hidden;
    }

    .bbgWaveCustom svg {
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      height: auto;
    }

    /* Warna lapisan gelombang */
    .waaveLayer1 {
      fill: #000000;
    }

    .waaveLayer2 {
      fill: #000000;
    }

    .waaveLayer3 {
      fill: #fff;
    }

    /* ===== STYLE WAVE ATAS (gelombang putih terbalik, antara About & Article) ===== */
    .waveUpContainerX {
      position: relative;
      background-color: #ffffff; /* Warna area bawah gelombang */
      height: 250px;
      overflow: hidden;
    }

    .waveUpContainerX svg {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: auto;
      transform: rotate(180deg); /* Balik arah gelombang */
    }

    /* Lapisan warna gelombang */
    .waveUpLayerOneX {
      fill: #1a1a1a;
    }

    .waveUpLayerTwoX {
      fill: #2e2e2e;
    }

    .waveUpLayerThreeX {
      fill: #000000;
    }

    /* ===== STYLE WAVE BAWAH HITAM (DENGAN PENYESUAIAN RESPONSIVE) ===== */
    .aveDownContainerY {
      position: relative;
      background-color: #000000ff; /* Warna area atas gelombang */
      height: 250px;
      overflow: hidden;
    }

    .aveDownContainerY svg {
      position: absolute;
      bottom: 0;
      left: 0;
      width: 200%; /* Lebar dasar untuk animasi agar ilusi pengulangan mulus */
      height: auto;
      /* Animasi gelombang akan ditambahkan hanya pada layar desktop */
    }

    /* Lapisan warna gelombang */
    .aveDownContainerY .aveDownLayerOneY {
      fill: #1a1a1a;
    }

    .aveDownContainerY .aveDownLayerTwoY {
      fill: #2e2e2e;
    }

    .aveDownContainerY .aveDownLayerThreeY {
      fill: #ffffffff;
    }

    /* Keyframes untuk animasi pergerakan gelombang */
    @keyframes waveMoveX {
      0% {
        transform: translateX(0);
      }
      100% {
        transform: translateX(-50%); /* Geser setengah dari lebar asli (sekarang 200%) */
      }
    }

    /* === Media Query untuk Desktop / Layar Lebih Besar === */
    /* Terapkan animasi hanya pada layar yang lebarnya 768px atau lebih */
    @media (min-width: 768px) {
      .aveDownContainerY svg {
        animation: waveMoveX 10s linear infinite; /* Durasi 20s, linear, berulang selamanya */
      }

      .aveDownContainerY svg .aveDownLayerOneY {
        animation-delay: 0s; /* Mulai segera */
      }

      .aveDownContainerY svg .aveDownLayerTwoY {
        animation-delay: -5s; /* Offset waktu untuk pergerakan yang berbeda */
      }

      .aveDownContainerY svg .aveDownLayerThreeY {
        animation-delay: -10s; /* Offset waktu lagi */
      }
    }

    /* === Opsional: Untuk layar kecil (Mobile) jika ingin menonaktifkan animasi === */
    /* Jika Anda ingin gelombang *diam* di mobile, blok kode di bawah ini sudah cukup.
       Jika Anda ingin menghilangkannya atau mengubah tingginya, sesuaikan properti di sini.
    */
    @media (max-width: 767px) {
      .aveDownContainerY svg {
        animation: none; /* Nonaktifkan animasi untuk mobile */
        /* Anda bisa menambahkan penyesuaian tampilan lain di sini jika perlu,
           misalnya mengurangi tinggi atau mengubah lebar agar tidak terlihat aneh tanpa animasi.
           Contoh:
           width: 100%;
           height: 150px; // Jika bentuk aslinya tidak cocok dengan lebar 100% tanpa animasi
        */
      }
    }


    /* ===== SECTION LINGKARAN ANIMASI ===== */
    .circle-section {
      position: relative;
      background: #16a085;
      overflow: hidden;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 80px 20px;
      min-height: 300px;
    }

    /* Lingkaran background */
    .circle-bg {
      position: absolute;
      width: 320px;
      height: 320px;
      border-radius: 50%;
      border: 45px solid rgba(255, 255, 255, 0.2);
      animation: circleMove 3s ease-in-out infinite alternate;
    }

    .circle-left {
      left: -160px;
      top: 50%;
      transform: translateY(-50%);
      animation-delay: 0s;
    }

    .circle-right {
      right: -160px;
      top: 50%;
      transform: translateY(-50%);
      animation-delay: 0.75s;
    }

    @keyframes circleMove {
      0% { transform: translateY(-50%) translateX(0) rotate(0deg); }
      50% { transform: translateY(-55%) translateX(8px) rotate(12deg); }
      100% { transform: translateY(-50%) translateX(-8px) rotate(-12deg); }
    }

    /* Teks */
    .circle-text-box {
      text-align: center;
      z-index: 2;
      opacity: 0;
      transform: translateY(30px);
      animation: circleFadeSlide 1.5s ease-out forwards;
    }

    @keyframes circleFadeSlide {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .circle-title {
      font-size: 2rem;
      font-weight: bold;
      color: #fff;
      margin-bottom: 20px;
    }

    /* Tombol */
    .circle-btn {
      display: inline-block;
      padding: 10px 25px;
      background: #f9be3e;
      color: #000;
      font-size: 1rem;
      font-weight: bold;
      border-radius: 8px;
      text-decoration: none;
      transition: 0.3s;
    }

    .circle-btn:hover {
      background: #e0a832;
    }

    /* Responsif */
    @media (max-width: 768px) {
      .circle-title {
        font-size: 1.5rem;
      }
      .circle-btn {
        font-size: 0.9rem;
        padding: 8px 18px;
      }
      .circle-bg {
        width: 220px;
        height: 220px;
        border-width: 30px;
      }
    }

    @keyframes fadeSlideUp {
  0% {
    opacity: 0;
    transform: translateY(40px);
  }
  100% {
    opacity: 1;
    transform: translateY(0);
  }
}

.animate-item {
  opacity: 0;
  animation: fadeSlideUp 0.8s ease forwards;
}
  </style>
</head>
<body>

<!-- Loader -->
<div id="loader">
  <img src="aset/logo.jpg" alt="Logo">
</div>
<!-- ===== NAVBAR ===== -->
<nav class="navbar">
  <div class="logo">
    SAMPULKREATIV
    <span>TECHNOLOGY</span>
  </div>
  <ul>
    <li><a href="index.php">home</a></li>
    <li><a href="servis.html">services</a></li>
    <li><a href="about.html">Tentang</a></li>
    <li><a href="article.html">Article</a></li>
    <li><a href="coutact.html">contact</a></li>
  </ul>
  <div class="hamburger" id="hamburger">
    <span></span>
    <span></span>
    <span></span>
  </div>
</nav>


<section class="hero" id="home">
  <div class="hero-content">
    <img src="aset/stlogo.png" alt="SampulKreativ Logo" class="hero-logo" />
    <a href="#services" class="btn-selengkapnya">Selengkapnya</a>
  </div>
</section>

<!-- BAGIAN GELOMBANG BAWAH HITAM (DENGAN ANIMASI HANYA DI LAYAR BESAR) -->
<div class="aveDownContainerY">
  <svg viewBox="0 0 1920 200" preserveAspectRatio="none">
    <!-- Bentuk path SVG, disesuaikan agar mulus saat dianimasikan -->
    <!-- Layer 1: Gelombang utama, bergerak lebih cepat -->
    <path class="aveDownLayerOneY" d="M0,100 C300,150 600,50 900,100 S1500,150 1800,100 C1900,90 1920,100 1920,100 L1920,200 L0,200 Z"></path>
    <!-- Layer 2: Gelombang kedua, bergerak sedikit lebih lambat -->
    <path class="aveDownLayerTwoY" d="M0,120 C350,170 650,70 950,120 S1550,170 1850,120 C1950,110 1920,120 1920,120 L1920,200 L0,200 Z"></path>
    <!-- Layer 3: Gelombang ketiga, bergerak paling lambat -->
    <path class="aveDownLayerThreeY" d="M0,140 C400,190 700,90 1000,140 S1600,190 1900,140 C2000,130 1920,140 1920,140 L1920,200 L0,200 Z"></path>
  </svg>
</div>


<section class="sectioon" id="servicess" style="background-color:#f3f3f3;">
  <h2>Layanan Kami</h2>
  <div class="services">
    <div class="card">
      <i class="fas fa-globe"></i>
      <h3>Web Application</h3>
      <p>Pembuatan aplikasi web yang responsif, cepat, dan modern untuk berbagai kebutuhan bisnis.</p>
      <a href="web.html"><button class="btn">Selengkapnya</button></a>
    </div>
    <div class="card">
      <i class="fab fa-android"></i>
      <h3>Android Application</h3>
      <p>Pengembangan aplikasi Android custom dengan performa tinggi dan desain menarik.</p>
      <a href="androidapp.html"><button class="btn">Selengkapnya</button></a>
    </div>
    <div class="card">
      <i class="fab fa-apple"></i>
      <h3>iOS Application</h3>
      <p>Aplikasi iOS profesional untuk perangkat Apple yang stabil dan elegan.</p>
      <a href="appleapp.html"><button class="btn">Selengkapnya</button></a>
    </div>
    <div class="card">
      <i class="fas fa-user-tie"></i>
      <h3>IT Consultant</h3>
      <p>Layanan konsultasi TI untuk solusi teknologi yang efisien dan tepat guna.</p>
      <a href="it.html"><button class="btn">Selengkapnya</button></a>
    </div>
    <div class="card">
      <i class="fas fa-robot"></i>
      <h3>Kecerdasan (AI)</h3>
      <p>Solusi berbasis AI untuk otomatisasi, analisis data, dan peningkatan efisiensi.</p>
      <a href="ai.html"><button class="btn">Selengkapnya</button></a>
    </div>
  </div>
</section>

  <section class="tentang-full" id="about">
    <div class="tentang-konten">
      <div class="tentang-kiri">
        <h2>Tentang Kami</h2>
        <h3>Kami Adalah Konsultan TI yang Mewujudkan Ide Anda</h3>
        <p>
          Sampulkreativ adalah salah satu perusahaan teknologi informasi terkemuka di Indonesia,
          yang mengkhususkan diri dalam pengembangan perangkat lunak web, android, ios, dan multimedia.
          Misi kami adalah meningkatkan daya saing perusahaan di era digital saat ini melalui inovasi yang didukung oleh teknologi.
        </p>
        <a href="about.html" class="bton-selengkapnya">Selengkapnya</a>
      </div>
      <div class="tentang-kanan">
        <img src="aset/gedung.webp" alt="Gambar Kantor">
      </div>
    </div>
  </section>

    <!-- BAGIAN GELOMBANG KUNING (Antara Tentang & Artikel) -->
  <div class="bgWaveCustom">
    <svg viewBox="0 0 1920 200" preserveAspectRatio="none">
      <path class="waveLayer1" d="M0,80 C480,200 1440,0 1920,120 L1920,200 L0,200 Z"></path>
      <path class="waveLayer2" d="M0,100 C600,250 1320,0 1920,150 L1920,200 L0,200 Z"></path>
      <path class="waveLayer3" d="M0,140 C480,60 1440,220 1920,100 L1920,200 L0,200 Z"></path>
    </svg>
  </div>


<section class="artikel-section">
  <h2>Artikel Terbaru</h2>
  <div class="artikel-scroll" id="carousel">
    <div class="artikel-card">
      <img src="aset/poto.jpg" alt="Artikel 1">
      <h3>Menerima Siswa PKL</h3>
      <p>Deskripsi singkat artikel pertama.</p>
    </div>
    <div class="artikel-card">
      <img src="aset/pekerja.jpg" alt="Artikel 2">
      <h3>Lowongan kerjaS</h3>
      <p>Deskripsi singkat artikel kedua.</p>
    </div>
    <div class="artikel-card">
      <img src="aset/magang.jpg" alt="Artikel 3">
      <h3>Menerima magang</h3>
      <p>Deskripsi singkat artikel ketiga.</p>
    </div>
    <div class="artikel-card">
      <img src="aset/admin.png" alt="Artikel 4">
      <h3>LOwongan kerja OB</h3>
      <p>Deskripsi singkat artikel keempat.</p>
    </div>
    <div class="artikel-card">
      <img src="aset/poto.jpg" alt="Artikel 1">
      <h3>Menerima Siswa PKL</h3>
      <p>Deskripsi singkat artikel pertama.</p>
    </div>
  </div>
</section>

<!-- Section Lingkaran Animasi -->
<section class="circle-section">
  <div class="circle-bg circle-left"></div>
  <div class="circle-bg circle-right"></div>
  <div class="circle-text-box">
    <h1 class="circle-title">Mulai Sekarang dan Kembangkan Bisnis Anda Bersama Kami</h1>
    <a href="partnership.php" class="circle-btn">Mulai</a>
  </div>
</section>



<pooter>
  <div class="pooter-container">
    <!-- Logo dan Kontak -->
    <div class="pooter-logo">
      <h3>PT Sampul Kreatif</h3>
      <p>Office No. 3 Point-Lab, Graha Pos Indonesia,<br>
      Jalan Banda 30 Bandung 40115, Indonesia</p>
      <p><i class="fa-solid fa-envelope"></i> cs@sampulkreativ.com</p>
      <p><i class="fa-solid fa-phone"></i> (+62)22 2054 1053</p>
      <p><i class="fa-brands fa-whatsapp"></i> (+62) 811 2141 053</p>
    </div>

    <!-- Profil Kami -->
    <div class="pooter-col">
      <h4>Profil Kami</h4>
      <ul>
        <li><a href="#">Tentang Perusahaan</a></li>
        <li><a href="#">Karier</a></li>
        <li><a href="#">Kontak</a></li>
      </ul>
    </div>

    <!-- Layanan Kami -->
    <div class="pooter-col">
      <h4>Layanan Kami</h4>
      <ul>
        <li><a href="#">Digital Marketing</a></li>
        <li><a href="#">Digital Operations</a></li>
        <li><a href="#">Digital Media Tools</a></li>
        <li><a href="#">Digital Learning</a></li>
      </ul>
    </div>

    <!-- Insight -->
    <div class="pooter-col">
      <h4>Insight</h4>
      <ul>
        <li><a href="#">Blog</a></li>
        <li><a href="#">E-Books</a></li>
        <li><a href="#">Testimoni</a></li>
        <li><a href="#">Portfolio Digital Marketing</a></li>
        <li><a href="#">Portfolio IT Service</a></li>
      </ul>
    </div>

    <!-- Ikuti Kami -->
    <div class="pooter-col">
      <h4>Ikuti Kami</h4>
      <div class="pooter-social">
        <a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a>
        <a href="#" class="linkedin"><i class="fab fa-linkedin-in"></i></a>
        <a href="#" class="youtube"><i class="fab fa-youtube"></i></a>
        <a href="#" class="email"><i class="fa-solid fa-envelope"></i></a>
        <a href="#" class="instagram"><i class="fab fa-instagram"></i></a>
      </div>

      <div style="text-align: center; margin-top: 20px;">
          <p style="font-weight: bold; color: #003366; margin-bottom: 8px;">
              Ayo beri nilai
            </p>
            <a href="review.php" class="btn"
            style="
            background-color:  #fdd835;
            color: white;
            padding: 10px 20px;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            transition: background-color 0.3s ease;" >Beri Penilaian</a>
      </div>
    </div>

  </div>

  <div class="pooter-bottom">
    © Copyright 2022 - PT SampulKreativ |
    <a href="#">Syarat & Ketentuan Layanan</a> |
    <a href="#">Kebijakan Privasi</a>
  </div>
</pooter>

<!-- Tombol scroll to top (pastikan hanya ada satu ID yang sama, atau gunakan class berbeda) -->
<!-- <a href="chatbot.php" class="scroll-top-chat"><i class="fas fa-comment-dots"></i></a> -->
<!-- <a href="#" class="scroll-top-up"><i class="fas fa-chevron-up"></i></a> -->


  <script>
    (function () {
      if (window._pwaScriptLoaded) return;
      window._pwaScriptLoaded = true;

      // Daftarkan Service Worker
      if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('./sw.js')
          .then(() => console.log('Service Worker terdaftar!'))
          .catch(err => console.log('SW gagal:', err));
      }

      // Variabel global
      window.deferredPrompt = null;

      const installPopup = document.getElementById('installPopup');
      const installBtn = document.getElementById('installBtn');

      // Event sebelum install
      window.addEventListener('beforeinstallprompt', (e) => {
        e.preventDefault();
        window.deferredPrompt = e;
        if (installPopup) {
          installPopup.style.display = 'block';
        }
      });

      // Klik tombol install
      if (installBtn) {
        installBtn.addEventListener('click', async () => {
          if (installPopup) installPopup.style.display = 'none';
          if (window.deferredPrompt) {
            window.deferredPrompt.prompt();
            const { outcome } = await window.deferredPrompt.userChoice;
            console.log(`User memilih: ${outcome}`);
            window.deferredPrompt = null;
          }
        });
      }
    })();
    // Navigasi Navbar
    const hamburger = document.getElementById('hamburger');
    const navMenu = document.querySelector('.navbar ul');

    hamburger.addEventListener('click', () => {
      hamburger.classList.toggle('active');
      navMenu.classList.toggle('show');
    });

    window.addEventListener('scroll', () => {
      const navbar = document.querySelector('.navbar');
      if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
      } else {
        navbar.classList.remove('scrolled');
      }
    });

    // Loader
    window.addEventListener("load", () => {
      const loader = document.getElementById("loader");
      if (loader) {
        loader.classList.add("hidden");
        // Opsional: Hapus elemen loader dari DOM setelah selesai untuk performa
        setTimeout(() => {
            loader.remove();
        }, 500); // Cocokkan dengan durasi transisi .hidden
      }
    });

    // Carousel Otomatis (jika diperlukan)
    // const carousel = document.getElementById('carousel');
    // if (carousel) {
    //   let scrollAmount = 0;
    //   const step = 1; // kecepatan geser
    //   const delay = 5; // delay antar scroll
    //   function autoScroll() {
    //     if (carousel.scrollWidth - carousel.clientWidth === scrollAmount) {
    //       scrollAmount = 0; // reset ke awal
    //       carousel.scrollTo({ left: 0, behavior: 'smooth' });
    //     } else {
    //       scrollAmount += step;
    //       carousel.scrollTo({ left: scrollAmount, behavior: 'smooth' });
    //     }
    //   }
    //   setInterval(autoScroll, delay);
    // }

    
  </script>
</body>
</html>

</body>
</html>