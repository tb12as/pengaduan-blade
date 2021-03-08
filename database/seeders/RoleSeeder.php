<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = ['admin', 'petugas', 'masyarakat'];

        foreach ($arr as $role ) {
            Role::create([
                'name' => $role,
                'display_name' => ucfirst($role),
            ]);
        }
    }
}
