<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('foods')->insert([
            [
                'name' => 'Mie Goreng Jawa',
                'category' => 'Makanan',
                'price' => 16000,
                'description' => 'Mie goreng dengan bumbu rempah khas jawa, acar timun , kerupuk',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sate Ambal',
                'category' => 'Makanan',
                'price' => 25000,
                'description' => 'Sate ambal dengam bumbu tempe tumbuk berempah yang manis gurih',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tempe Mendoan',
                'category' => 'Cemilan',
                'price' => 10000,
                'description' => 'Tempe mendoan dengan bumbu cocolan sambal kecap khas jawa',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dawet Ireng',
                'category' => 'Minuman',
                'price' => 8000,
                'description' => 'Dawet ireng dengan cendol berwarna hitam pekat alami diperoleh dari abu bakar merang yang di padukan dengan kuah santan dan gula jawa',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kopi Jetak',
                'category' => 'Minuman',
                'price' => 5000,
                'description' => 'Kopi jetak memakai biji kopi yang digoreng sangrai bersama sedikit minyak kelapa',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}