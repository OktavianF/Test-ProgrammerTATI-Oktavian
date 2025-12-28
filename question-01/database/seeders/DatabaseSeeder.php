<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Kepala Dinas (Top level - no supervisor)
        $kepalaDinas = User::create([
            'name' => 'Budi Santoso',
            'email' => 'kepala.dinas@pemda.go.id',
            'password' => Hash::make('password'),
            'role' => User::ROLE_KEPALA_DINAS,
            'supervisor_id' => null,
        ]);

        // Create Kepala Bidang 1 (Reports to Kepala Dinas)
        $kepalaBidang1 = User::create([
            'name' => 'Siti Rahayu',
            'email' => 'kepala.bidang1@pemda.go.id',
            'password' => Hash::make('password'),
            'role' => User::ROLE_KEPALA_BIDANG,
            'supervisor_id' => $kepalaDinas->id,
        ]);

        // Create Kepala Bidang 2 (Reports to Kepala Dinas)
        $kepalaBidang2 = User::create([
            'name' => 'Ahmad Wijaya',
            'email' => 'kepala.bidang2@pemda.go.id',
            'password' => Hash::make('password'),
            'role' => User::ROLE_KEPALA_BIDANG,
            'supervisor_id' => $kepalaDinas->id,
        ]);

        // Create Staff 1 (Reports to Kepala Bidang 1)
        User::create([
            'name' => 'Dewi Lestari',
            'email' => 'staff1@pemda.go.id',
            'password' => Hash::make('password'),
            'role' => User::ROLE_STAFF,
            'supervisor_id' => $kepalaBidang1->id,
        ]);

        // Create Staff 2 (Reports to Kepala Bidang 2)
        User::create([
            'name' => 'Eko Prasetyo',
            'email' => 'staff2@pemda.go.id',
            'password' => Hash::make('password'),
            'role' => User::ROLE_STAFF,
            'supervisor_id' => $kepalaBidang2->id,
        ]);

        $this->command->info('Created 5 users with organizational hierarchy:');
        $this->command->info('- Kepala Dinas: kepala.dinas@pemda.go.id');
        $this->command->info('  └── Kepala Bidang 1: kepala.bidang1@pemda.go.id');
        $this->command->info('      └── Staff 1: staff1@pemda.go.id');
        $this->command->info('  └── Kepala Bidang 2: kepala.bidang2@pemda.go.id');
        $this->command->info('      └── Staff 2: staff2@pemda.go.id');
        $this->command->info('Password for all users: password');
    }
}
