<?php

namespace Database\Seeders;

use App\Models\Province;
use App\Services\WilayahService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class ProvinceSeeder extends Seeder
{
    /**
     * Seed provinces table dengan data dari wilayah.id API.
     */
    public function run(): void
    {
        $wilayahService = new WilayahService();

        try {
            $this->command->info('Fetching provinces from wilayah.id API...');

            $provinces = $wilayahService->fetchProvinces();

            $this->command->info('Found ' . count($provinces) . ' provinces. Seeding...');

            foreach ($provinces as $provinceData) {
                Province::updateOrCreate(
                    ['code' => $provinceData['code']],
                    ['name' => $provinceData['name']]
                );
            }

            $this->command->info('Provinces seeded successfully!');
        } catch (\Exception $e) {
            $this->command->error('Failed to seed provinces: ' . $e->getMessage());
            Log::error('ProvinceSeeder Error: ' . $e->getMessage());
        }
    }
}
