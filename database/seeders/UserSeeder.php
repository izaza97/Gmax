<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'superadmin',
            'email' => 'superadmin@test.dev',
            'password' => bcrypt('123qweasd'),
        ]);
        $user->assignRole('superadmin');

        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@test.dev',
            'password' => bcrypt('123qweasd'),
        ]);
        $user->assignRole('admin');

        $user = User::create([
            'name' => 'Operator',
            'email' => 'operator@test.dev',
            'password' => bcrypt('123qweasd'),
        ]);
        $user->assignRole('operator');

        $user = User::create([
            'name' => 'Owner',
            'email' => 'owner@test.dev',
            'password' => bcrypt('123qweasd'),
        ]);
        $user->assignRole('owner');

        // Factory 30 users and assign them role as customer
        User::factory()->count(30)->create()->each(function ($user) {
            $user->assignRole('customer');
            $user->customer()->create();
        });


    }
}
