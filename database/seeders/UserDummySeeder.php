<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserDummySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @var array<string, array<string, string>>
     */
    public function run(): void
    {
        $users = [
            RoleEnum::SUPER_ADMIN => [
                'name' => 'Super Admin',
                'email' => 'superadmin@sadevalms.com',
            ],
            RoleEnum::ADMIN => [
                'name' => 'Admin',
                'email' => 'admin@sadevalms.com',
            ],
            RoleEnum::TEACHER => [
                'name' => 'Teacher',
                'email' => 'teacher@sadevalms.com',
            ],
            RoleEnum::STUDENT => [
                'name' => 'Student',
                'email' => 'student@sadevalms.com',
            ],
        ];

        foreach ($users as $role => $attributes) {
            $user = User::firstOrCreate(
                ['email' => $attributes['email']],
                [
                    'name' => $attributes['name'],
                    'password' => Hash::make('password'),
                    'email_verified_at' => now(),
                ]
            );

            $user->assignRole($role);
        }
    }
}
