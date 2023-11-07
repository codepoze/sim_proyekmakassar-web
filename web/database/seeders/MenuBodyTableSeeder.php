<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuBodyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menu_bodies = [
            [
                'id_menu_head' => 5,
                'nama'         => 'Kordinator',
                'icon'         => 'list',
                'path'         => '/kordinator',
                'by_users'     => 1,
            ],
            [
                'id_menu_head' => 5,
                'nama'         => 'Anggota',
                'icon'         => 'list',
                'path'         => '/anggota',
                'by_users'     => 1,
            ],
        ];
        foreach ($menu_bodies as $row) {
            DB::table('menu_bodies')->insert($row);
        }
    }
}
