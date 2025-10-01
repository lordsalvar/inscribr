<?php

namespace Database\Seeders;

use App\Enums\UserRoles;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@local.dev',
            'password' => Hash::make('password'),
            'role' => UserRoles::ADMIN,
        ]);

        DB::table('offices')->insert([
            'id' => (string) Str::ulid(),
            'acronym' => 'PICTO',
            'name' => 'Provincial Information and Communication Technology Office',
        ]);
    }
}
