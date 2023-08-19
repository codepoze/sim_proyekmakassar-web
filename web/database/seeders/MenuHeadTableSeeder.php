<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuHeadTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menu_heads = [
            [
                'nama'         => 'Pengawas',
                'icon'         => 'list',
                'path'         => '/pengawas',
                'status'       => '1',
                'jenis'        => 'multi',
                'by_users'     => 1,
            ],
            [
                'nama'         => 'Perusahaan',
                'icon'         => 'list',
                'path'         => '/perusahaan',
                'status'       => '1',
                'jenis'        => 'single',
                'by_users'     => 1,
            ],
            [
                'nama'         => 'Kegiatan',
                'icon'         => 'list',
                'path'         => '/kegiatan',
                'status'       => '1',
                'jenis'        => 'single',
                'by_users'     => 1,
            ],
            [
                'nama'         => 'Paket',
                'icon'         => 'list',
                'path'         => '/paket',
                'status'       => '1',
                'jenis'        => 'single',
                'by_users'     => 1,
            ],
        ];
        foreach ($menu_heads as $row) {
            DB::table('menu_heads')->insert($row);
        }
    }
}
