<?php

namespace Database\Seeders;

use App\Enums\UserRoles;
use App\Enums\CivilStatus;
use App\Enums\EmploymentStatus;
use App\Enums\Sex;
use App\Models\Employee;
use App\Models\Office;
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

        DB::table('offices')->insert([
            'id' => (string) Str::ulid(),
            'acronym' => 'PHRDO',
            'name' => 'Provincial Human Resource and Development Office',
        ]);

        $picto = Office::where('acronym', 'PICTO')->first();
        $phrdo = Office::where('acronym', 'PHRDO')->first();

        if ($picto) {
            foreach (range(1, 5) as $scannerId) {
                Employee::create([
                    'first_name' => 'User',
                    'last_name' => 'PICTO'.$scannerId,
                    'sex' => Sex::MALE->value,
                    'civil_status' => CivilStatus::SINGLE->value,
                    'office_id' => $picto->id,
                    'employment_status' => EmploymentStatus::REGULAR->value,
                    'registration_date' => now(),
                    'scanner_id' => $scannerId,
                ]);
            }
        }

        if ($phrdo) {
            foreach (range(20, 24) as $scannerId) { // 5 employees: 20..24
                Employee::create([
                    'first_name' => 'User',
                    'last_name' => 'PHRDO'.$scannerId,
                    'sex' => Sex::FEMALE->value,
                    'civil_status' => CivilStatus::SINGLE->value,
                    'office_id' => $phrdo->id,
                    'employment_status' => EmploymentStatus::REGULAR->value,
                    'registration_date' => now(),
                    'scanner_id' => $scannerId,
                ]);
            }
        }
    }
}
