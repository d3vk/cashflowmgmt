<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = [
            [
                'name' => 'Gaji Kantor',
                'type' => 'pemasukan',
            ],
            [
                'name' => 'Penjualan Saham',
                'type' => 'pemasukan',
            ],
            [
                'name' => 'Hasil Pertanian',
                'type' => 'pemasukan',
            ],
            [
                'name' => 'Keperluan Rumah',
                'type' => 'pengeluaran',
            ],
            [
                'name' => 'Kebutuhan Pangan',
                'type' => 'pengeluaran',
            ],
            [
                'name' => 'Perawatan Diri',
                'type' => 'pengeluaran',
            ],
            [
                'name' => 'Konsumsi Lain-lain',
                'type' => 'pengeluaran',
            ],
            [
                'name' => 'Langganan',
                'type' => 'pengeluaran',
            ],
            [
                'name' => 'Hutang/Cicilan',
                'type' => 'pengeluaran',
            ],
            ];

            foreach ($category as $key => $value) {
                Category::create($value);
                
            }
    }
}
