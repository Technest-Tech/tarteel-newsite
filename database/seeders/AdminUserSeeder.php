<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

/**
 * Creates the single admin account from the ADMIN_* variables in .env.
 *
 * Re-running this seeder is safe: an existing account keeps its password, so a
 * deploy can never silently reset the credentials the academy is already using.
 */
class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $email = config('tarteel.admin.email');
        $password = config('tarteel.admin.password');

        $existing = User::where('email', $email)->first();

        if ($existing) {
            $this->command?->info("Admin account already exists for {$email}. Password left unchanged.");

            return;
        }

        if (blank($password)) {
            $this->command?->error('ADMIN_PASSWORD is not set in .env — no admin account was created.');

            return;
        }

        User::create([
            'name' => config('tarteel.admin.name'),
            'email' => $email,
            'password' => $password,
        ]);

        $this->command?->info("Admin account created for {$email}.");
    }
}
