<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
        Admin::create([
            'nama_lengkap' => 'Admin Jemaat',
            'email' => 'wentoxwtt@gmail.com',
            'telepon' => '085244140715',
            'username' => 'admin',
            'password' => '123456',
            'role' => 'admin_jemaat',
        ]);
    }
}
