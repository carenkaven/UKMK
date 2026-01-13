<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ukm;

class UkmSeeder extends Seeder
{
    public function run(): void
    {
        $ukms = [
            ['nama_ukm' => 'UKM Bola Voli', 'deskripsi' => 'Unit kegiatan mahasiswa bidang olahraga voli.', 'ketua_ukm' => 'Budi Santoso'],
            ['nama_ukm' => 'UKM Taekwondo', 'deskripsi' => 'Unit kegiatan mahasiswa bela diri Taekwondo.', 'ketua_ukm' => 'Siti Aminah'],
            ['nama_ukm' => 'UKM Paduan Suara', 'deskripsi' => 'Unit kegiatan mahasiswa bidang seni tarik suara.', 'ketua_ukm' => 'Rina Wati'],
            ['nama_ukm' => 'UKM Bola Basket', 'deskripsi' => 'Unit kegiatan mahasiswa bidang olahraga basket.', 'ketua_ukm' => 'Ahmad Rizki'],
            ['nama_ukm' => 'UKM Bulu Tangkis', 'deskripsi' => 'Unit kegiatan mahasiswa bidang olahraga bulu tangkis.', 'ketua_ukm' => 'Doni Pradana'],
            ['nama_ukm' => 'UKM FORMAT', 'deskripsi' => 'Forum Mahasiswa Teknik Informatika.', 'ketua_ukm' => 'Eko Prasetyo'],
        ];

        foreach ($ukms as $ukm) {
            Ukm::create($ukm);
        }
    }
}
