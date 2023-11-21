<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Role::create([
            'role' => 'Admin',
        ]);
        Role::create([
            'role' => 'Konsumen',
        ]);
        Role::create([
            'role' => 'Pemilik',
        ]);

        User::create([
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'role_id' => 1,
        ]);
    }
}
