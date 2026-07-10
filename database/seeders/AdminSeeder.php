<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@maxbat.com'],
            [
                'name'     => 'MaxBat Admin',
                'email'    => 'admin@maxbat.com',
                'password' => Hash::make('Admin@2026'),
                'role'     => 'admin',
            ]
        );

        $this->command->info('Admin user created: admin@maxbat.com / Admin@2026');
    }
}
