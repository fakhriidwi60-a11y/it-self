<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Problem;
use App\Models\Solution;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@itselfservice.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'status' => 'active',
            ]
        );

        $categories = [
            'Jaringan' => 'Masalah terkait koneksi internet, Wi-Fi, dan jaringan',
            'Hardware' => 'Masalah terkait perangkat keras seperti printer, komputer, laptop',
            'Software' => 'Masalah terkait aplikasi dan software',
            'Email' => 'Masalah terkait email dan komunikasi',
        ];

        $categoryModels = [];
        foreach ($categories as $name => $description) {
            $categoryModels[$name] = Category::updateOrCreate(['name' => $name], ['description' => $description]);
        }

        $problems = [
            [
                'category' => 'Jaringan',
                'title' => 'Tidak bisa terhubung ke Wi-Fi',
                'description' => 'Koneksi Wi-Fi tidak dapat terhubung ke jaringan',
                'solution_title' => 'Cek koneksi Wi-Fi',
                'steps' => "1. Pastikan Wi-Fi router menyala\n2. Restart perangkat\n3. Forget network dan reconnect\n4. Cek password Wi-Fi",
                'notes' => 'Pastikan dalam jangkauan sinyal',
            ],
            [
                'category' => 'Hardware',
                'title' => 'Printer tidak bisa mencetak',
                'description' => 'Printer tidak merespons perintah cetak',
                'solution_title' => 'Restart Printer',
                'steps' => "1. Matikan printer\n2. Tunggu 10 detik\n3. Nyalakan kembali\n4. Cek kabel USB/koneksi jaringan",
                'notes' => 'Cek juga level tinta dan kertas',
            ],
            [
                'category' => 'Software',
                'title' => 'Aplikasi tidak bisa dibuka',
                'description' => 'Aplikasi gagal saat diluncurkan',
                'solution_title' => 'Reinstall Aplikasi',
                'steps' => "1. Uninstall aplikasi\n2. Download versi terbaru\n3. Install ulang aplikasi\n4. Restart komputer",
                'notes' => 'Pastikan komputer memenuhi spesifikasi',
            ],
            [
                'category' => 'Email',
                'title' => 'Tidak bisa mengirim email',
                'description' => 'Email gagal terkirim ke penerima',
                'solution_title' => 'Cek konfigurasi email',
                'steps' => "1. Verifikasi alamat email penerima\n2. Cek koneksi internet\n3. Cek ukuran lampiran\n4. Hubungi admin IT jika masih gagal",
                'notes' => 'Pastikan tidak melebihi batas pengiriman',
            ],
        ];

        foreach ($problems as $item) {
            $problem = Problem::updateOrCreate(
                ['title' => $item['title']],
                [
                    'category_id' => $categoryModels[$item['category']]->id,
                    'description' => $item['description'],
                ]
            );

            Solution::updateOrCreate(
                ['problem_id' => $problem->id, 'title' => $item['solution_title']],
                ['steps' => $item['steps'], 'notes' => $item['notes']]
            );
        }
    }
}
