<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran UKM | ITN Malang</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&family=Poppins:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root {
            --primary: #004aad;
            --secondary: #007bff;
            --accent: #00d2ff;
            --glass: rgba(255, 255, 255, 0.9);
            --glass-border: rgba(255, 255, 255, 0.4);
            --text-dark: #1a1a1a;
            --text-light: #f5f5f5;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #004aad 0%, #007bff 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            overflow-x: hidden;
        }

        /* Ambient Background shapes */
        .shape {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            z-index: -1;
            opacity: 0.6;
        }

        .shape-1 {
            top: -100px;
            left: -100px;
            width: 400px;
            height: 400px;
            background: #00d2ff;
        }

        .shape-2 {
            bottom: -100px;
            right: -100px;
            width: 300px;
            height: 300px;
            background: #ff007a;
            opacity: 0.4;
        }

        .container {
            width: 100%;
            max-width: 900px;
            background: var(--glass);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            position: relative;
            animation: slideUp 0.8s cubic-bezier(0.2, 0.8, 0.2, 1);
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .header-section {
            background: linear-gradient(90deg, #004aad, #007bff);
            padding: 40px;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .header-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .header-section h1 {
            font-family: 'Montserrat', sans-serif;
            font-weight: 800;
            font-size: 2rem;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }

        .header-section p {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .progress-bar {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
            position: relative;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
        }

        .progress-line {
            position: absolute;
            top: 50%;
            left: 0;
            width: 100%;
            height: 3px;
            background: rgba(255, 255, 255, 0.3);
            z-index: 1;
            transform: translateY(-50%);
        }

        .progress-fill {
            position: absolute;
            top: 50%;
            left: 0;
            height: 3px;
            background: #00d2ff;
            z-index: 1;
            transform: translateY(-50%);
            width: 0%;
            transition: width 0.4s ease;
        }

        .step-item {
            position: relative;
            z-index: 2;
            text-align: center;
            width: 40px;
        }

        .step-circle {
            width: 40px;
            height: 40px;
            background: #003366;
            border: 2px solid rgba(255, 255, 255, 0.5);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: rgba(255, 255, 255, 0.7);
            transition: all 0.3s ease;
            margin: 0 auto;
        }

        .step-item.active .step-circle {
            background: #00d2ff;
            color: #003366;
            border-color: #fff;
            box-shadow: 0 0 15px rgba(0, 210, 255, 0.5);
        }

        .step-label {
            position: absolute;
            width: 120px;
            left: 50%;
            transform: translateX(-50%);
            top: 45px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            opacity: 0.7;
        }

        .step-item.active .step-label {
            opacity: 1;
            color: #fff;
        }

        /* Form Content */
        .form-content {
            padding: 40px;
        }

        .form-step {
            display: none;
            animation: fadeIn 0.5s ease;
        }

        .form-step.active {
            display: block;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .row {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .col {
            flex: 1;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            font-size: 0.9rem;
            color: #444;
        }

        .form-control {
            width: 100%;
            padding: 12px 18px;
            border-radius: 12px;
            border: 2px solid #e0e0e0;
            background: #f9f9f9;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary);
            background: #fff;
            box-shadow: 0 0 0 4px rgba(0, 74, 173, 0.1);
            outline: none;
        }

        /* Customized Radio */
        .radio-wrapper {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .radio-option {
            position: relative;
        }

        .radio-option input {
            display: none;
        }

        .radio-tile {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 20px;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 0.9rem;
            font-weight: 500;
            color: #555;
            background: #fff;
        }

        .radio-option input:checked+.radio-tile {
            border-color: var(--primary);
            background: rgba(0, 74, 173, 0.05);
            color: var(--primary);
            font-weight: 600;
            box-shadow: 0 4px 10px rgba(0, 74, 173, 0.15);
        }

        /* Upload Box */
        .upload-area {
            border: 2px dashed #ccc;
            border-radius: 16px;
            padding: 30px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            background: #f8fbff;
            position: relative;
        }

        .upload-area:hover,
        .upload-area.dragover {
            border-color: var(--primary);
            background: #fff;
        }

        .upload-icon {
            font-size: 2rem;
            margin-bottom: 10px;
            color: #888;
        }

        .file-name {
            display: block;
            margin-top: 10px;
            font-weight: 600;
            color: var(--primary);
        }

        /* Buttons */
        .btn-group {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }

        .btn {
            padding: 12px 30px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
        }

        .btn-prev {
            background: #f0f0f0;
            color: #555;
        }

        .btn-prev:hover {
            background: #e0e0e0;
        }

        .btn-next {
            background: var(--primary);
            color: white;
            box-shadow: 0 4px 15px rgba(0, 74, 173, 0.3);
        }

        .btn-next:hover {
            background: #003885;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 74, 173, 0.4);
        }

        @media (max-width: 768px) {
            .row {
                flex-direction: column;
                gap: 0;
            }

            .container {
                margin: 10px;
                border-radius: 16px;
            }

            .header-section {
                padding: 30px 20px;
            }

            .form-content {
                padding: 25px;
            }
        }
    </style>
</head>

<body>

    <!-- Decorations -->
    <div class="shape shape-1"></div>
    <div class="shape shape-2"></div>

    <div class="container">
        <div class="header-section">
            <a href="{{ route('home') }}"
                style="position: absolute; top: 20px; left: 20px; color: white; text-decoration: none; font-weight: 600; font-size: 0.9rem; background: rgba(255,255,255,0.2); padding: 5px 15px; border-radius: 20px;">
                &larr; Home
            </a>
            <h1>PENDAFTARAN UKM</h1>
            <p>Bergabunglah bersama kami untuk mengembangkan bakat dan minat Anda.</p>

            <div class="progress-bar">
                <div class="progress-line"></div>
                <div class="progress-fill" id="progressFill"></div>

                <div class="step-item active" id="stepIndicator1">
                    <div class="step-circle">1</div>
                    <div class="step-label">Pribadi</div>
                </div>
                <div class="step-item" id="stepIndicator2">
                    <div class="step-circle">2</div>
                    <div class="step-label">Akademik</div>
                </div>
            </div>
        </div>

        <form id="ukmForm" action="{{ route('daftar.post') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-content">
                <!-- STEP 1 -->
                <div class="form-step active" id="step1">
                    <div class="row">
                        <div class="col form-group">
                            <label>Email Mahasiswa</label>
                            <input type="email" name="email" class="form-control" placeholder="nama@student.itn.ac.id"
                                required value="{{ old('email') }}">
                        </div>
                        <div class="col form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" placeholder="Sesuai KTM" required
                                value="{{ old('nama') }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col form-group">
                            <label>No. WhatsApp</label>
                            <input type="tel" name="telepon" class="form-control" placeholder="08..." required
                                value="{{ old('telepon') }}">
                        </div>
                        <div class="col form-group">
                            <label>Jenis Kelamin</label>
                            <div class="radio-wrapper">
                                <label class="radio-option">
                                    <input type="radio" name="gender" value="Laki-Laki" required {{ old('gender') == 'Laki-Laki' ? 'checked' : '' }}>
                                    <span class="radio-tile">♂ Laki-Laki</span>
                                </label>
                                <label class="radio-option">
                                    <input type="radio" name="gender" value="Perempuan" {{ old('gender') == 'Perempuan' ? 'checked' : '' }}>
                                    <span class="radio-tile">♀ Perempuan</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Agama</label>
                        <div class="radio-wrapper">
                            @foreach(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha'] as $agama)
                                <label class="radio-option">
                                    <input type="radio" name="agama" value="{{ $agama }}" required>
                                    <span class="radio-tile">{{ $agama }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="btn-group">
                        <button type="button" class="btn btn-next" onclick="nextStep()">Lanjut &rarr;</button>
                    </div>
                </div>

                <!-- STEP 2 -->
                <div class="form-step" id="step2">
                    <div class="row">
                        <div class="col form-group">
                            <label>NIM (Nomor Induk Mahasiswa)</label>
                            <input type="text" name="nim" class="form-control" placeholder="Contoh: 2118123" required
                                value="{{ old('nim') }}">
                        </div>
                        <div class="col form-group">
                            <label>Angkatan</label>
                            <input type="number" name="angkatan" class="form-control" placeholder="2023" required
                                value="{{ old('angkatan') }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col form-group">
                            <label>Fakultas</label>
                            <select name="fakultas" class="form-control" required>
                                <option value="">-- Pilih Fakultas --</option>
                                <option>FTI (Teknologi Industri)</option>
                                <option>FTSP (Sipil dan Perencanaan)</option>
                            </select>
                        </div>
                        <div class="col form-group">
                            <label>Program Studi</label>
                            <select name="prodi" class="form-control" required>
                                <option value="">-- Pilih Prodi --</option>
                                <option>Teknik Informatika</option>
                                <option>Teknik Mesin</option>
                                <option>Teknik Elektro</option>
                                <option>Teknik Industri</option>
                                <option>Teknik Kimia</option>
                                <option>Teknik Sipil</option>
                                <option>Arsitektur</option>
                                <option>PWK</option>
                                <option>Geodesi</option>
                                <option>Teknik Lingkungan</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Pilih UKM Tujuan</label>
                        <select name="id_ukm" class="form-control" style="font-weight: 600; color: var(--primary);"
                            required>
                            <option value="">-- Silakan Pilih UKM --</option>
                            @foreach($ukms as $ukm)
                                <option value="{{ $ukm->id_ukm }}">{{ $ukm->nama_ukm }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Upload Foto Profil / KTM</label>
                        <div class="upload-area" onclick="document.getElementById('fileInput').click()">
                            <input type="file" name="photo" id="fileInput" hidden accept="image/*"
                                onchange="showFileName(this)">
                            <div class="upload-icon">📂</div>
                            <div>Klik untuk upload file</div>
                            <small style="color: #888;">Format: JPG, PNG (Max 2MB)</small>
                            <span class="file-name" id="fileName"></span>
                        </div>
                    </div>

                    <div class="btn-group">
                        <button type="button" class="btn btn-prev" onclick="prevStep()">&larr; Kembali</button>
                        <button type="submit" class="btn btn-next">Kirim Pendaftaran ✨</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        function nextStep() {
            // Simple validation could go here
            const step1 = document.getElementById('step1');
            const inputs = step1.querySelectorAll('input[required]');
            let valid = true;
            inputs.forEach(input => {
                if (!input.value) valid = false;
            });

            if (!valid) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Mohon lengkapi data pribadi Anda terlebih dahulu!',
                    confirmButtonColor: '#004aad'
                });
                return;
            }

            document.getElementById('step1').classList.remove('active');
            document.getElementById('step2').classList.add('active');

            document.getElementById('stepIndicator2').classList.add('active');
            document.getElementById('progressFill').style.width = '100%';
        }

        function prevStep() {
            document.getElementById('step2').classList.remove('active');
            document.getElementById('step1').classList.add('active');

            document.getElementById('stepIndicator2').classList.remove('active');
            document.getElementById('progressFill').style.width = '0%';
        }

        function showFileName(input) {
            const fileName = input.files[0] ? input.files[0].name : '';
            document.getElementById('fileName').textContent = fileName ? 'File terpilih: ' + fileName : '';
        }

        // Show alerts from backend
        @if(session('success'))
            Swal.fire({
                title: 'Berhasil Mendaftar! 🎉',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonColor: '#004aad'
            });
        @endif
    </script>
</body>

</html>