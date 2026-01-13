<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Pendaftaran UKM | ITN Malang</title>
  <link rel="stylesheet" href="{{ asset('assets/style.css') }}" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
  <!-- 🔹 Navbar -->
  <header class="navbar">
    <div class="logo">
      <img src="{{ asset('assets/images/logo-itn.png') }}" alt="Logo ITN" />
      <span>Malang</span>
    </div>
    <button class="hamburger-menu" aria-label="Toggle Menu">
      <span></span>
      <span></span>
      <span></span>
    </button>
    <nav class="nav-links">
      <a href="{{ route('home') }}" class="active">Home</a>
      <a href="{{ route('profil') }}">Profil</a>
      <a href="{{ route('form') }}" class="btn-daftar" style="text-decoration:none;">Daftar</a>
    </nav>
  </header>

  <!-- 🔹 Banner -->
  <section class="banner" style="position: relative; overflow: hidden;">
    <div class="banner-content" style="position: relative; z-index: 2;">
      <h1>PENDAFTARAN <span>UKMK</span></h1>
      <p>INSTITUT TEKNOLOGI NASIONAL MALANG<br>Kembangkan Bakat dan Minatmu Bersama Kami</p>
      <a href="#ukm-list" class="btn-explore">Jelajahi UKM</a>
    </div>

    <!-- Background Prestasi (Premium Parallax) -->
    <div class="prestasi-bg">
      <div class="marquee-track scroll-left">
        <div class="marquee-content">
          @foreach($ukms as $ukm)
            @if(!empty($ukm->prestasi) && $ukm->prestasi != '-')
              <span class="prestasi-item">★ {{ $ukm->nama_ukm }}</span>
            @endif
          @endforeach
          @foreach($ukms as $ukm)
            @if(!empty($ukm->prestasi) && $ukm->prestasi != '-')
              <span class="prestasi-item">★ {{ $ukm->nama_ukm }}</span>
            @endif
          @endforeach
        </div>
      </div>

      <div class="marquee-track scroll-right">
        <div class="marquee-content">
          @foreach($ukms as $ukm)
            @if(!empty($ukm->prestasi) && $ukm->prestasi != '-')
              <span class="prestasi-item outline">{{ Str::limit($ukm->prestasi, 40) }}</span>
            @endif
          @endforeach
          @foreach($ukms as $ukm)
            @if(!empty($ukm->prestasi) && $ukm->prestasi != '-')
              <span class="prestasi-item outline">{{ Str::limit($ukm->prestasi, 40) }}</span>
            @endif
          @endforeach
        </div>
      </div>
    </div>
  </section>

  <style>
    .prestasi-bg {
      position: absolute;
      top: -20%;
      left: -10%;
      width: 120%;
      height: 140%;
      z-index: 1;
      pointer-events: none;
      display: flex;
      flex-direction: column;
      justify-content: center;
      gap: 250px;
      /* Gap lebar agar tulisan tengah tidak tertutup */
      transform: rotate(-3deg);
      /* tilt dikurangi dikit */
      opacity: 0.15;
    }

    .marquee-track {
      width: 100%;
      display: flex;
      overflow: hidden;
    }

    .marquee-content {
      display: flex;
      gap: 50px;
      white-space: nowrap;
      min-width: 100%;
    }

    /* Animations */
    .scroll-left .marquee-content {
      animation: scrollLeft 40s linear infinite;
    }

    .scroll-right .marquee-content {
      animation: scrollRight 45s linear infinite;
    }

    @keyframes scrollLeft {
      from {
        transform: translateX(0);
      }

      to {
        transform: translateX(-50%);
      }
    }

    @keyframes scrollRight {
      from {
        transform: translateX(-50%);
      }

      to {
        transform: translateX(0);
      }
    }

    /* Typography Styles */
    .prestasi-item {
      font-size: 3rem;
      font-weight: 900;
      color: #004aad;
      text-transform: uppercase;
      letter-spacing: 2px;
    }

    /* Professional Outline Style */
    .prestasi-item.outline {
      color: transparent;
      -webkit-text-stroke: 2px #004aad;
    }
  </style>

  <!-- 🔹 Daftar UKM -->
  <!-- 🔹 Daftar UKM -->
  <section class="ukm-section" id="ukm-list">
    <div class="ukm-grid">
      @foreach($ukms as $ukm)
        <div class="ukm-card">
          <img src="{{ asset($ukm->gambar) }}" alt="{{ $ukm->nama_ukm }}" class="ukm-image" />
          <button data-desc="{{ $ukm->deskripsi }}" data-jadwal="{{ $ukm->jadwal }}" data-prestasi="{{ $ukm->prestasi }}"
            data-ketua="{{ $ukm->ketua_ukm }}" data-kontak="{{ $ukm->kontak }}">
            {{ $ukm->nama_ukm }}
          </button>
        </div>
      @endforeach
    </div>
  </section>

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

    @if(session('success'))
      Swal.fire({
        title: 'Pendaftaran Berhasil!',
        text: "{{ session('success') }}",
        icon: 'success',
        confirmButtonColor: '#004aad',
        confirmButtonText: 'Selesai'
      });
    @endif

    // UKM Detail Modal Logic
    document.addEventListener('DOMContentLoaded', function () {
      // Create Modal Structure
      const modal = document.createElement('div');
      modal.id = 'ukm-modal';
      modal.innerHTML = `
        <div class="modal-content">
          <span class="close-modal">&times;</span>
          <div class="modal-body">
            <div class="modal-image">
              <img id="modal-img" src="" alt="UKM Image">
            </div>
            <div class="modal-info">
              <h2 id="modal-title">Nama UKM</h2>
              <p id="modal-desc" class="ukm-desc">Deskripsi singkat UKM disini.</p>
              
              <div class="info-grid">
                <div class="info-item">
                  <strong>📅 Jadwal Latihan</strong>
                  <span id="modal-jadwal">-</span>
                </div>
                <div class="info-item">
                  <strong>🏆 Prestasi</strong>
                  <span id="modal-prestasi">-</span>
                </div>
                <div class="info-item">
                  <strong>👤 Ketua UKM</strong>
                  <span id="modal-ketua">-</span>
                </div>
                <div class="info-item">
                  <strong>📞 Kontak</strong>
                  <span id="modal-kontak">-</span>
                </div>
              </div>

              <a href="{{ route('form') }}" class="btn-modal-daftar">Daftar Sekarang</a>
            </div>
          </div>
        </div>
      `;
      document.body.appendChild(modal);

      // Elements
      const modalImg = document.getElementById('modal-img');
      const modalTitle = document.getElementById('modal-title');
      const modalDesc = document.getElementById('modal-desc');
      const modalJadwal = document.getElementById('modal-jadwal');
      const modalPrestasi = document.getElementById('modal-prestasi');
      const modalKetua = document.getElementById('modal-ketua');
      const modalKontak = document.getElementById('modal-kontak');
      const closeBtn = document.querySelector('.close-modal');

      // Add Click Event to all UKM Cards
      const cards = document.querySelectorAll('.ukm-card');
      cards.forEach(card => {
        card.addEventListener('click', function () {
          const img = this.querySelector('.ukm-image').src;
          const btn = this.querySelector('button');
          const title = btn.textContent.trim();

          // Populate Modal
          modalImg.src = img;
          modalTitle.textContent = title;
          modalDesc.textContent = btn.getAttribute('data-desc');
          modalJadwal.textContent = btn.getAttribute('data-jadwal');
          modalPrestasi.textContent = btn.getAttribute('data-prestasi');
          modalKetua.textContent = btn.getAttribute('data-ketua');
          modalKontak.textContent = btn.getAttribute('data-kontak');

          // Show Modal
          modal.classList.add('active');
          document.body.style.overflow = 'hidden'; // Prevent scrolling
        });
      });

      // Close Logic
      closeBtn.addEventListener('click', closeModal);
      modal.addEventListener('click', (e) => {
        if (e.target === modal) closeModal();
      });

      function closeModal() {
        modal.classList.remove('active');
        document.body.style.overflow = '';
      }
    });
  </script>

  <style>
    /* Modal Styles */
    #ukm-modal {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.6);
      z-index: 10000;
      display: flex;
      justify-content: center;
      align-items: center;
      opacity: 0;
      pointer-events: none;
      transition: opacity 0.3s ease;
      backdrop-filter: blur(5px);
      padding: 20px;
    }

    #ukm-modal.active {
      opacity: 1;
      pointer-events: auto;
    }

    .modal-content {
      background: #fff;
      width: 100%;
      max-width: 900px;
      border-radius: 15px;
      overflow: hidden;
      position: relative;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
      transform: translateY(20px);
      transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    #ukm-modal.active .modal-content {
      transform: translateY(0);
    }

    .close-modal {
      position: absolute;
      top: 15px;
      right: 20px;
      font-size: 28px;
      font-weight: bold;
      color: #333;
      cursor: pointer;
      z-index: 10;
      background: rgba(255, 255, 255, 0.8);
      width: 40px;
      height: 40px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.2s;
    }

    .close-modal:hover {
      background: #dc3545;
      color: white;
    }

    .modal-body {
      display: flex;
      flex-direction: row;
    }

    .modal-image {
      flex: 1;
      background: #f0f0f0;
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 300px;
    }

    .modal-image img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .modal-info {
      flex: 1.2;
      padding: 30px;
      display: flex;
      flex-direction: column;
    }

    #modal-title {
      font-size: 1.8rem;
      color: #004aad;
      margin-bottom: 10px;
      margin-top: 0;
      font-weight: 700;
      text-transform: uppercase;
    }

    .ukm-desc {
      color: #555;
      line-height: 1.6;
      margin-bottom: 20px;
      font-size: 0.95rem;
    }

    .info-grid {
      display: grid;
      gap: 15px;
      background: #f8f9fa;
      padding: 15px;
      border-radius: 10px;
      margin-bottom: 25px;
    }

    .info-item {
      display: flex;
      flex-direction: column;
      font-size: 0.9rem;
    }

    .info-item strong {
      color: #004aad;
      margin-bottom: 4px;
    }

    .btn-modal-daftar {
      display: block;
      width: 100%;
      background: #004aad;
      color: white;
      text-align: center;
      padding: 12px;
      border-radius: 8px;
      text-decoration: none;
      font-weight: 600;
      margin-top: auto;
      transition: background 0.3s;
    }

    .btn-modal-daftar:hover {
      background: #0d2c6c;
    }

    /* Make cards look clickable */
    .ukm-card {
      cursor: pointer;
      transition: transform 0.3s;
    }

    .ukm-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    /* Responsive Modal */
    @media (max-width: 768px) {
      .modal-body {
        flex-direction: column;
      }

      .modal-image {
        min-height: 200px;
        max-height: 250px;
      }

      .modal-info {
        padding: 20px;
      }

      #modal-title {
        font-size: 1.4rem;
      }
    }
  </style>
</body>

</html>