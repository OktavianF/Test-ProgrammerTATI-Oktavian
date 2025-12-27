<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WilayahService
{
    /**
     * Base URL untuk API wilayah.id
     */
    private const API_URL = 'https://wilayah.id/api/provinces.json';

    /**
     * Fetch semua data provinsi dari wilayah.id API.
     *
     * @return array
     * @throws \Exception
     */
    public function fetchProvinces(): array
    {
        try {
            $response = Http::timeout(30)->get(self::API_URL);

            if (!$response->successful()) {
                throw new \Exception('Failed to fetch provinces: HTTP ' . $response->status());
            }

            $data = $response->json();

            // API wilayah.id mengembalikan format { "data": [...] }
            if (!isset($data['data']) || !is_array($data['data'])) {
                throw new \Exception('Invalid API response format');
            }

            return $this->transformProvinces($data['data']);
        } catch (\Exception $e) {
            Log::error('WilayahService Error: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Transform data provinsi dari API ke format yang sesuai dengan database.
     *
     * @param array $provinces
     * @return array
     */
    private function transformProvinces(array $provinces): array
    {
        return array_map(function ($province) {
            return [
                'code' => $province['code'] ?? '',
                'name' => $province['name'] ?? '',
            ];
        }, $provinces);
    }
}
