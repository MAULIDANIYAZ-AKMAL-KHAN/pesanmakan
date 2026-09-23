<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('project:explain', function () {
    $this->info('=== Project Overview ===');
    $this->line('Aplikasi ini adalah sistem pemesanan makanan online dalam Laravel yang terdiri dari sisi customer dan admin.');
    $this->line('');

    $this->info('1. Routing utama');
    $this->line('- routes/web.php: mengatur halaman utama, checkout, dashboard admin, dan CRUD makanan.');
    $this->line('- GET / -> menampilkan katalog menu pelanggan.');
    $this->line('- POST /checkout -> memproses pesanan customer.');
    $this->line('- GET /dashboard -> dashboard admin rekap pesanan.');
    $this->line('- /admin/foods -> resource CRUD makanan untuk admin.');
    $this->line('');

    $this->info('2. Controller utama');
    $this->line('- app/Http/Controllers/OrderController.php: mengelola katalog, checkout, dashboard, dan update status pesanan.');
    $this->line('- app/Http/Controllers/FoodController.php: CRUD menu makanan, upload gambar, validasi input, dan penghapusan file gambar.');
    $this->line('- app/Http/Controllers/ProfileController.php: mengatur profil user dari Laravel Breeze.');
    $this->line('');

    $this->info('3. Model dan struktur data');
    $this->line('- app/Models/Food.php: model untuk tabel foods.');
    $this->line('- app/Models/Order.php: model untuk tabel orders dan relasi ke orderDetails.');
    $this->line('- app/Models/OrderDetail.php: model untuk detail item pesanan dan relasi ke Order dan Food.');
    $this->line('- app/Models/User.php: model autentikasi user default Laravel.');
    $this->line('');

    $this->info('4. Database / migrasi');
    $this->line('- database/migrations/2026_08_27_133455_create_food_table.php: tabel foods.');
    $this->line('- database/migrations/2026_08_27_133455_create_orders_table.php: tabel orders.');
    $this->line('- database/migrations/2026_08_27_133456_create_orderdetails_table.php: tabel order_details.');
    $this->line('');

    $this->info('5. Tampilan / UI');
    $this->line('- resources/views/customer/: tampilan halaman pelanggan seperti katalog menu.');
    $this->line('- resources/views/admin/: tampilan CRUD makanan dan dashboard admin.');
    $this->line('- resources/views/dashboard.blade.php: halaman rekap pesanan admin.');
    $this->line('');

    $this->info('6. Fitur bisnis utama');
    $this->line('- Customer dapat memilih menu, menentukan nomor meja, dan melakukan checkout.');
    $this->line('- Sistem menghitung total harga otomatis dari quantity dan harga tiap makanan.');
    $this->line('- Admin dapat melihat daftar pesanan, memperbarui status, dan mengelola data makanan.');
    $this->line('');

    $this->info('7. Cara menjalankan aplikasi');
    $this->line('1. composer install');
    $this->line('2. cp .env.example .env (atau sesuaikan env Anda)');
    $this->line('3. php artisan key:generate');
    $this->line('4. php artisan migrate');
    $this->line('5. npm install && npm run dev');
    $this->line('6. php artisan serve');
    $this->line('');

    $this->warn('Gunakan perintah ini untuk melihat deskripsi proyek: php artisan project:explain');
})->purpose('Explain the project structure and codebase to the developer.');
