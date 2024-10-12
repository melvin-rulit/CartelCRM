<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (app()->environment() === 'local') {
            $admin = User::where('email', 'admin@crm.dev')->first();
            if (!$admin) {
                User::create(
                    [
                        'first_name' => 'admin',
                        'email'      => 'admin@crm.dev',
                        'role_id'    => User::ROLE_ADMIN,
                        'enabled'    => true,
                        'password'   => Hash::make('password'),
                        'branch_id'  => 1,
                    ]
                )->save();
            }

            $manager = User::where('email', 'manager@crm.dev')->first();
            if (!$manager) {
                User::create(
                    [
                        'first_name' => 'manager',
                        'email'      => 'manager@crm.dev',
                        'password'   => Hash::make('password'),
                        'role_id'    => User::ROLE_MANAGER,
                        'enabled'    => true,
                        'branch_id'  => 1,
                    ]
                )->save();
            }
        }
    }
}
