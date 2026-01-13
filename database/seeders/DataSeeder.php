<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Fasilitas;
use App\Models\Kriteria;
use App\Models\SubKriteria;
use App\Models\Pendaftaran;
use App\Models\Penilaian;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class DataSeeder extends Seeder
{
    public function run()
    {
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();

        // 1. Seed Fasilitas
        Fasilitas::truncate();
        \App\Models\Pendaftaran::truncate();
        \App\Models\Mahasiswa::truncate();
        \App\Models\Ukm::truncate();
        \App\Models\Admin::truncate();
        Kriteria::truncate();
        SubKriteria::truncate();
        Penilaian::truncate(); // Added truncate for Penilaian

        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();

        $fasilitas = [
            ['nama_fasilitas' => 'Lapangan Voli', 'deskripsi' => 'Lapangan outdoor dengan kondisi baik, tersedia 1 unit.'],
            ['nama_fasilitas' => 'Lapangan Basket', 'deskripsi' => 'Lapangan outdoor standar nasional, tersedia 1 unit.'],
            ['nama_fasilitas' => 'Matras Taekwondo', 'deskripsi' => '20 unit matras untuk latihan bela diri, kondisi cukup.'],
            ['nama_fasilitas' => 'Alat Musik Band', 'deskripsi' => 'Gitar, bass, drum, dan keyboard lengkap untuk latihan.'],
            ['nama_fasilitas' => 'Sound System', 'deskripsi' => '2 speaker aktif dan mixer, perlu perbaikan kabel.'],
            ['nama_fasilitas' => 'Tenda Camping', 'deskripsi' => '5 unit tenda dome kapasitas 4 orang, kondisi baik.'],
        ];
        foreach ($fasilitas as $f) {
            Fasilitas::create($f);
        }

        // 2. Seed Kriteria (SPK usually)

        $kriterias = [
            [
                'nama_kriteria' => 'Prestasi',
                'bobot' => 30,
                // 'jenis' removed as it's not in migration
                'subs' => [
                    ['nama_sub' => 'Internasional', 'nilai' => 100],
                    ['nama_sub' => 'Nasional', 'nilai' => 80],
                    ['nama_sub' => 'Provinsi', 'nilai' => 60],
                    ['nama_sub' => 'Kota/Kabupaten', 'nilai' => 40],
                    ['nama_sub' => 'Tidak Ada', 'nilai' => 20],
                ]
            ],
            [
                'nama_kriteria' => 'Absensi Latihan',
                'bobot' => 25,
                'subs' => [
                    ['nama_sub' => '> 90%', 'nilai' => 100],
                    ['nama_sub' => '80% - 90%', 'nilai' => 80],
                    ['nama_sub' => '70% - 79%', 'nilai' => 60],
                    ['nama_sub' => '60% - 69%', 'nilai' => 40],
                    ['nama_sub' => '< 60%', 'nilai' => 20],
                ]
            ],
            [
                'nama_kriteria' => 'Sikap / Attitude',
                'bobot' => 25,
                'subs' => [
                    ['nama_sub' => 'Sangat Baik', 'nilai' => 100],
                    ['nama_sub' => 'Baik', 'nilai' => 80],
                    ['nama_sub' => 'Cukup', 'nilai' => 60],
                    ['nama_sub' => 'Kurang', 'nilai' => 40],
                    ['nama_sub' => 'Buruk', 'nilai' => 20],
                ]
            ],
            [
                'nama_kriteria' => 'Kelengkapan Administrasi',
                'bobot' => 20,
                'subs' => [
                    ['nama_sub' => 'Lengkap', 'nilai' => 100],
                    ['nama_sub' => 'Kurang Lengkap', 'nilai' => 50],
                    ['nama_sub' => 'Tidak Ada', 'nilai' => 0],
                ]
            ],
        ];

        foreach ($kriterias as $k) {
            $createdKriteria = Kriteria::create([
                'nama_kriteria' => $k['nama_kriteria'],
                'bobot' => $k['bobot']
            ]);

            foreach ($k['subs'] as $sub) {
                SubKriteria::create([
                    'id_kriteria' => $createdKriteria->id_kriteria,
                    'nama_sub' => $sub['nama_sub'],
                    'nilai' => $sub['nilai']
                ]);
            }
        }
        // 3. Seed Admins

        \App\Models\Admin::create([
            'nama_admin' => 'Super Admin',
            'username' => 'admin',
            'password' => bcrypt('admin123'), // Use Hash or bcrypt
        ]);

        // 4. Seed UKM

        $ukms = [
            [
                'nama_ukm' => 'UKM Bola Voli',
                'deskripsi' => 'Mengembangkan bakat dan minat mahasiswa dalam olahraga bola voli serta berpartisipasi dalam kejuaraan tingkat regional dan nasional.',
                'ketua_ukm' => 'Budi Santoso',
                'gambar' => 'assets/images/voli.jpg',
                'jadwal' => 'Selasa & Kamis (16:00 - 18:00) @ Lapangan Voli Kampus 1',
                'prestasi' => 'Juara 2 Liga Mahasiswa Jatim 2024',
                'kontak' => '0812-3456-7890'
            ],
            [
                'nama_ukm' => 'UKM Taekwondo',
                'deskripsi' => 'Melatih fisik dan mental melalui seni bela diri Taekwondo, fokus pada kedisiplinan dan pertahanan diri.',
                'ketua_ukm' => 'Siti Aminah',
                'gambar' => 'assets/images/taekwondo.jpg',
                'jadwal' => 'Senin & Rabu (18:30 - 20:30) @ Aula Kampus 1',
                'prestasi' => 'Emas Porseni 2023',
                'kontak' => '0813-4567-8901'
            ],
            [
                'nama_ukm' => 'UKM Paduan Suara',
                'deskripsi' => 'Wadah bagi mahasiswa yang memiliki bakat menyanyi untuk mengembangkan teknik vokal dan harmonisasi dalam paduan suara.',
                'ketua_ukm' => 'Rina Wati',
                'gambar' => 'assets/images/paduan.jpg',
                'jadwal' => 'Jumat (15:00 - 17:00) @ Ruang Musik Gedung B',
                'prestasi' => 'Gold Medal - FPS ITB 2024',
                'kontak' => '0819-8765-4321'
            ],
            [
                'nama_ukm' => 'UKM Bola Basket',
                'deskripsi' => 'Membangun kerjasama tim dan skill individu dalam olahraga basket yang kompetitif dan suportif.',
                'ketua_ukm' => 'Ahmad Rizki',
                'gambar' => 'assets/images/basket.jpg',
                'jadwal' => 'Senin & Kamis (18:00 - 20:00) @ Lapangan Basket Outdoor',
                'prestasi' => 'Semifinalis Campus League 2024',
                'kontak' => '0821-2345-6789'
            ],
            [
                'nama_ukm' => 'UKM Bulu Tangkis',
                'deskripsi' => 'Kegiatan olahraga bulu tangkis rutin untuk menjaga kebugaran dan mempersiapkan atlet kampus.',
                'ketua_ukm' => 'Doni Pradana',
                'gambar' => 'assets/images/bulutangkis.jpg',
                'jadwal' => 'Rabu (16:00) & Sabtu (09:00) @ GOR ITN',
                'prestasi' => 'Juara 1 Ganda Putra Rektor Cup 2023',
                'kontak' => '0857-1234-5678'
            ],
            [
                'nama_ukm' => 'UKM FORMAT',
                'deskripsi' => 'Forum Mahasiswa Teknik Informatika yang berfokus pada pengembangan skill IT, workshop, dan kompetisi teknologi.',
                'ketua_ukm' => 'Eko Prasetyo',
                'gambar' => 'assets/images/format.png',
                'jadwal' => 'Sabtu (10:00 - 14:00) @ Lab. RPL - Gedung FTI',
                'prestasi' => 'Best Software Engineering TechComp 2024',
                'kontak' => '0811-2233-4455'
            ],
        ];

        $createdUkms = [];
        foreach ($ukms as $u) {
            $createdUkms[] = \App\Models\Ukm::create($u);
        }

        // 5. Seed Mahasiswa

        $mahasiswas = [
            [
                'nama' => 'Andi Pratama',
                'nim' => '20041001',
                'email' => 'andi@mhs.itn.ac.id',
                'telepon' => '081234567890',
                'gender' => 'Laki-laki',
                'agama' => 'Islam',
                'prodi' => 'Teknik Informatika',
                'fakultas' => 'FTI',
                'angkatan' => '2022',
                'password' => bcrypt('12345678'),
            ],
            [
                'nama' => 'Rina Sartika',
                'nim' => '20041002',
                'email' => 'rina@mhs.itn.ac.id',
                'telepon' => '081298765432',
                'gender' => 'Perempuan',
                'agama' => 'Kristen',
                'prodi' => 'Teknik Sipil',
                'fakultas' => 'FTSP',
                'angkatan' => '2023',
                'password' => bcrypt('12345678'),
            ],
            [
                'nama' => 'Budi Santoso',
                'nim' => '20041003',
                'email' => 'budi@mhs.itn.ac.id',
                'telepon' => '082134567891',
                'gender' => 'Laki-laki',
                'agama' => 'Islam',
                'prodi' => 'Teknik Mesin',
                'fakultas' => 'FTI',
                'angkatan' => '2022',
                'password' => bcrypt('12345678'),
            ],
            [
                'nama' => 'Siti Aminah',
                'nim' => '20041004',
                'email' => 'siti@mhs.itn.ac.id',
                'telepon' => '085712345678',
                'gender' => 'Perempuan',
                'agama' => 'Islam',
                'prodi' => 'Arsitektur',
                'fakultas' => 'FTSP',
                'angkatan' => '2023',
                'password' => bcrypt('12345678'),
            ],
            [
                'nama' => 'Kevin Sanjaya',
                'nim' => '20041005',
                'email' => 'kevin@mhs.itn.ac.id',
                'telepon' => '081398765432',
                'gender' => 'Laki-laki',
                'agama' => 'Katolik',
                'prodi' => 'Teknik Geodesi',
                'fakultas' => 'FTSP',
                'angkatan' => '2021',
                'password' => bcrypt('12345678'),
            ],
        ];

        $createdMahasiswas = [];
        foreach ($mahasiswas as $m) {
            $createdMahasiswas[] = \App\Models\Mahasiswa::create($m);
        }

        // 6. Seed Pendaftaran

        if (!empty($createdUkms) && !empty($createdMahasiswas)) {
            // Andi - Voli
            \App\Models\Pendaftaran::create([
                'tanggal_daftar' => date('Y-m-d'),
                'status_verifikasi' => 'Disetujui',
                'id_mahasiswa' => $createdMahasiswas[0]->id_mahasiswa,
                'id_ukm' => $createdUkms[0]->id_ukm, // Voli
            ]);
            // Rina - Taekwondo
            \App\Models\Pendaftaran::create([
                'tanggal_daftar' => date('Y-m-d'),
                'status_verifikasi' => 'Disetujui',
                'id_mahasiswa' => $createdMahasiswas[1]->id_mahasiswa,
                'id_ukm' => $createdUkms[1]->id_ukm, // Taekwondo
            ]);
            // Budi - Paduan Suara
            \App\Models\Pendaftaran::create([
                'tanggal_daftar' => date('Y-m-d'),
                'status_verifikasi' => 'Pending',
                'id_mahasiswa' => $createdMahasiswas[2]->id_mahasiswa,
                'id_ukm' => $createdUkms[2]->id_ukm, // Paduan Suara
            ]);
            // Siti - Basket
            \App\Models\Pendaftaran::create([
                'tanggal_daftar' => date('Y-m-d'),
                'status_verifikasi' => 'Pending',
                'id_mahasiswa' => $createdMahasiswas[3]->id_mahasiswa,
                'id_ukm' => $createdUkms[3]->id_ukm, // Basket
            ]);
            // Kevin - Bulu Tangkis
            \App\Models\Pendaftaran::create([
                'tanggal_daftar' => date('Y-m-d'),
                'status_verifikasi' => 'Disetujui',
                'id_mahasiswa' => $createdMahasiswas[4]->id_mahasiswa,
                'id_ukm' => $createdUkms[4]->id_ukm, // Bulu Tangkis
            ]);
        }

        // 7. Seed Penilaian (SPK)
        $kriterias = Kriteria::with('subkriteria')->get();
        // Use the mahasiswa objects created earlier
        foreach ($createdMahasiswas as $mhs) {
            foreach ($kriterias as $kriteria) {
                // Pick a random sub_kriteria for this validation
                if ($kriteria->subkriteria->count() > 0) {
                    $sub = $kriteria->subkriteria->random();

                    Penilaian::create([
                        'id_mahasiswa' => $mhs->id_mahasiswa,
                        'id_kriteria' => $kriteria->id_kriteria,
                        'id_sub_kriteria' => $sub->id_sub_kriteria,
                        'nilai' => $sub->nilai
                    ]);
                }
            }
        }
    }
}
