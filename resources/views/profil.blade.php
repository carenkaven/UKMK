<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profil UKM | ITN Malang</title>
  <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&display=swap" rel="stylesheet">
  <style>
    /* Global Overrides for Profile Page */
    body {
      font-family: 'Montserrat', sans-serif;
      background-color: #f8faff;
      color: #333;
    }

    /* 🔹 HERO SECTION */
    .profile-hero {
      position: relative;
      background: linear-gradient(135deg, #004aad 0%, #007bff 100%);
      color: white;
      padding: 100px 20px 80px;
      text-align: center;
      overflow: hidden;
      margin-top: -20px; /* Pull up to navbar */
    }

    .profile-hero::after {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }

    .hero-content {
      position: relative;
      z-index: 2;
      max-width: 800px;
      margin: 0 auto;
    }

    .profile-hero h2 {
      font-size: 3.5rem;
      font-weight: 800;
      margin-bottom: 20px;
      letter-spacing: -1px;
      text-transform: uppercase;
      text-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }

    .profile-hero p {
      font-size: 1.2rem;
      line-height: 1.8;
      opacity: 0.9;
      font-weight: 400;
      max-width: 700px;
      margin: 0 auto;
    }

    /* 🔹 CARDS GLOBAL */
    .pro-card {
      background: white;
      border-radius: 20px;
      padding: 40px;
      box-shadow: 0 10px 40px rgba(0, 74, 173, 0.08); /* Soft blue shadow */
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      border: 1px solid rgba(0, 0, 0, 0.02);
      position: relative;
      overflow: hidden;
    }

    .pro-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 20px 60px rgba(0, 74, 173, 0.15);
    }

    /* 🔹 VISI MISI */
    .visi-misi-container {
      max-width: 1200px;
      margin: -60px auto 60px; /* Overlap hero */
      position: relative;
      z-index: 5;
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 30px;
      padding: 0 20px;
    }

    .vm-icon {
      width: 60px;
      height: 60px;
      border-radius: 15px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.8rem;
      margin-bottom: 20px;
    }

    .vm-vision .vm-icon { background: #eef6ff; color: #004aad; }
    .vm-mission .vm-icon { background: #fff8e1; color: #ffc107; }

    .vm-title {
      font-size: 1.5rem;
      font-weight: 700;
      color: #1a1a1a;
      margin-bottom: 15px;
    }

    .vm-text { color: #555; line-height: 1.7; }
    
    .vm-list { list-style: none; padding: 0; }
    .vm-list li {
      position: relative;
      padding-left: 30px;
      margin-bottom: 12px;
      color: #555;
    }
    .vm-list li::before {
      content: '➜';
      position: absolute;
      left: 0;
      color: #ffc107;
      font-weight: bold;
    }

    /* 🔹 SECTION TITLE */
    .section-header {
      text-align: center;
      margin: 80px 0 50px;
    }
    .section-header h3 {
      font-size: 2.2rem;
      font-weight: 800;
      color: #004aad;
      margin-bottom: 15px;
    }
    .section-header p {
      color: #666;
      max-width: 600px;
      margin: 0 auto;
    }

    /* 🔹 GRID LAYOUTS */
    .grid-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 30px;
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 20px 80px;
    }

    /* 🔹 BIDANG CARDS */
    .bidang-card {
      text-align: center;
      padding: 30px;
    }
    .bidang-icon {
      width: 80px;
      height: 80px;
      background: linear-gradient(135deg, #f0f7ff 0%, #ffffff 100%);
      border-radius: 50%;
      margin: 0 auto 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 2.5rem;
      box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }
    .bidang-title { font-size: 1.2rem; font-weight: 700; color: #333; }
    .bidang-desc { color: #777; font-size: 0.9rem; margin-top: 10px; }

    /* 🔹 FASILITAS CARDS */
    .fasilitas-card {
      display: flex;
      align-items: flex-start;
      gap: 20px;
    }
    .fasilitas-icon {
      flex-shrink: 0;
      width: 50px;
      height: 50px;
      background: #eef6ff;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #004aad;
      font-size: 1.4rem;
    }
    .fasilitas-content h4 { margin: 0 0 5px; font-weight: 600; color: #333; }
    .fasilitas-content p { margin: 0; font-size: 0.9rem; color: #666; line-height: 1.5; }

    @media (max-width: 768px) {
      .visi-misi-container { grid-template-columns: 1fr; margin-top: -30px; }
      .profile-hero h2 { font-size: 2.5rem; }
    }
  </style>
</head>

<body>
  <!-- 🔹 Navbar -->
  <header class="navbar">
    <div class="logo">
      <img src="{{ asset('assets/images/logo-itn.png') }}" alt="Logo ITN">
      <span>Malang</span>
    </div>
    <button class="hamburger-menu" aria-label="Toggle Menu">
      <span></span>
      <span></span>
      <span></span>
    </button>
    <nav class="nav-links">
      <a href="{{ route('home') }}">Home</a>
      <a href="{{ route('profil') }}" class="active">Profil</a>
      <a href="{{ route('form') }}" class="btn-daftar" style="text-decoration:none;">Daftar</a>
    </nav>
  </header>

  <!-- 🔹 Hero Section -->
  <div class="profile-hero">
    <div class="hero-content">
      <h2>Pusat Kegiatan Mahasiswa</h2>
      <p>
        Wadah inkubasi kreativitas dan prestasi. Membentuk karakter pemimpin masa depan ITN Malang yang tangguh, inovatif, dan berdaya saing global.
      </p>
    </div>
  </div>

  <!-- 🔹 Visi & Misi (Overlapping Cards) -->
  <div class="visi-misi-container">
    <!-- Visi -->
    <div class="pro-card vm-vision">
      <div class="vm-icon">🌟</div>
      <h3 class="vm-title">Visi Kami</h3>
      <p class="vm-text">
        Menjadi pusat pengembangan potensi mahasiswa yang unggul, inovatif, dan berprestasi dalam skala nasional maupun internasional, berlandaskan nilai-nilai kebangsaan dan semangat kewirausahaan.
      </p>
    </div>

    <!-- Misi -->
    <div class="pro-card vm-mission">
      <div class="vm-icon">🚀</div>
      <h3 class="vm-title">Misi Kami</h3>
      <ul class="vm-list">
        <li>Memfasilitasi pengembangan minat & bakat komprehensif.</li>
        <li>Mendorong prestasi di bidang non-akademik.</li>
        <li>Membangun karakter kepemimpinan & disiplin.</li>
        <li>Menciptakan ekosistem kampus yang inklusif & kreatif.</li>
      </ul>
    </div>
  </div>

  <!-- 🔹 Bidang Kegiatan -->
  <div class="section-header">
    <h3>Bidang Pengembangan</h3>
    <p>Eksplorasi potensi diri Anda melalui berbagai spektrum kegiatan</p>
  </div>

  <div class="grid-container">
    <div class="pro-card bidang-card">
      <div class="bidang-icon">⚽</div>
      <h4 class="bidang-title">Olahraga</h4>
      <p class="bidang-desc">Mengasah fisik dan sportivitas melalui Futsal, Basket, Voli, dan Bela Diri.</p>
    </div>
    <div class="pro-card bidang-card">
      <div class="bidang-icon">🎨</div>
      <h4 class="bidang-title">Seni & Budaya</h4>
      <p class="bidang-desc">Ekspresi artistik melalui Paduan Suara, Tari, Musik, dan Teater.</p>
    </div>
    <div class="pro-card bidang-card">
      <div class="bidang-icon">💡</div>
      <h4 class="bidang-title">Penalaran</h4>
      <p class="bidang-desc">Pengembangan intelektual melalui Robotika, Bahasa Asing, dan Riset Ilmiah.</p>
    </div>
    <div class="pro-card bidang-card">
      <div class="bidang-icon">❤️</div>
      <h4 class="bidang-title">Sosial & Khusus</h4>
      <p class="bidang-desc">Pengabdian masyarakat melalui Pramuka, KSR, Menwa, dan Pecinta Alam.</p>
    </div>
  </div>

  <!-- 🔹 Fasilitas -->
  <div class="section-header" style="margin-top: 20px;">
    <h3>Fasilitas Penunjang</h3>
    <p>Infrastruktur modern untuk mendukung aktivitas mahasiswa</p>
  </div>

  <div class="grid-container">
    @foreach($fasilitas as $item)
      <div class="pro-card fasilitas-card">
        <div class="fasilitas-icon">🏗️</div>
        <div class="fasilitas-content">
          <h4>{{ $item->nama_fasilitas }}</h4>
          <p>{{ $item->deskripsi ?? 'Fasilitas berkualitas tinggi siap digunakan untuk menunjang latihan dan kegiatan rutin UKM.' }}</p>
        </div>
      </div>
    @endforeach
  </div>

  <footer>
    <p>© 2025 Institut Teknologi Nasional Malang | Capstone Kelompok 21</p>
  </footer>

  <script src="{{ asset('assets/script.js') }}"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const hamburger = document.querySelector('.hamburger-menu');
      const navLinks = document.querySelector('.nav-links');
      if (hamburger && navLinks) {
        hamburger.addEventListener('click', function () {
          navLinks.classList.toggle('active');
        });
      }
    });
  </script>
</body>
</html>