<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'id_role'  => 1,
                'nama'     => 'Administrator',
                'role'     => 'admin',
                'by_users' => 1,
            ],
            [
                'id_role'  => 2,
                'nama'     => 'KPA',
                'role'     => 'kpa',
                'by_users' => 1,
            ],
            [
                'id_role'  => 3,
                'nama'     => 'PPTK',
                'role'     => 'pptk',
                'by_users' => 1,
            ],
            [
                'id_role'  => 4,
                'nama'     => 'Kordinator Teknis Lapangan',
                'role'     => 'kord_teknislap',
                'by_users' => 1,
            ],
            [
                'id_role'  => 5,
                'nama'     => 'Anggota Teknis Lapangan',
                'role'     => 'ang_teknislap',
                'by_users' => 1,
            ],
        ];

        foreach ($roles as $role) {
            DB::table('roles')->insert($role);
        }
    }
}
