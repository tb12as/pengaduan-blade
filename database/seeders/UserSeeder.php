<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('1234'),
            'username' => 'admin',
        ]);
        $admin->attachRole('admin');

        $masyarakat = User::create([
            'name' => 'Masyarakat',
            'email' => 'masyarakat@gmail.com',
            'password' => bcrypt('1234'),
            'username' => 'masyarakat',
        ]);
        $masyarakat->attachRole('masyarakat');
    }
}
