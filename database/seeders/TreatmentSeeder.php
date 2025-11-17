<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Treatment;

class TreatmentSeeder extends Seeder
{
    public function run(): void
    {
        $treatments = [
            [
                'name' => 'Vaksin',
                'description' => 'Pemberian vaksin untuk mencegah penyakit',
                'price' => 150000,
            ],
            [
                'name' => 'Grooming',
                'description' => 'Perawatan kebersihan dan penampilan hewan',
                'price' => 200000,
            ],
            [
                'name' => 'Pemeriksaan',
                'description' => 'Pemeriksaan kesehatan umum hewan',
                'price' => 100000,
            ],
        ];

        foreach ($treatments as $treatment) {
            Treatment::create($treatment);
        }
    }
}
