<?php

namespace Database\Seeders;

use App\Models\Kertas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KertasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $data = [
            ['jenis_kertas' => 'Duplex',        'lokasi' => 'SP'],
            ['jenis_kertas' => 'PE Laminating', 'lokasi' => 'DIP'],
            ['jenis_kertas' => 'Ivory',         'lokasi' => 'SP'],
            ['jenis_kertas' => 'Karton',        'lokasi' => 'SPA'],
            ['jenis_kertas' => 'Core',          'lokasi' => 'SPA'],
        ];

        foreach ($data as $item) {
            Kertas::create($item);
        }
    }
}
