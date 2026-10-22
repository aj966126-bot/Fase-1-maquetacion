<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use RuntimeException;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $email = config('admin.email');
        $password = config('admin.password');

        if (! is_string($email) || $email === '' || ! is_string($password) || $password === '') {
            throw new RuntimeException('Set ADMIN_EMAIL and ADMIN_PASSWORD in the local .env before seeding the admin user.');
        }

        User::updateOrCreate(
            ['email' => $email],
            [
                'name' => config('admin.name', 'PymeGest Admin'),
                'password' => $password,
                'email_verified_at' => now(),
            ],
        );
    }
}
