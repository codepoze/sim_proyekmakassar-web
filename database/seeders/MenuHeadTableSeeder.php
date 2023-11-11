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
                'nama'         => 'Hari Libur',
                'icon'         => 'list',
                'path'         => '/holiday',
                'status'       => '1',
                'jenis'        => 'single',
                'by_users'     => 1,
            ],
            [
                'nama'         => 'Satuan',
                'icon'         => 'list',
                'path'         => '/satuan',
                'status'       => '1',
                'jenis'        => 'single',
                'by_users'     => 1,
            ],
            [
                'nama'         => 'Penyedia',
                'icon'         => 'list',
                'path'         => '/penyedia',
                'status'       => '1',
                'jenis'        => 'single',
                'by_users'     => 1,
            ],
            [
                'nama'         => 'Konsultan',
                'icon'         => 'list',
                'path'         => '/konsultan',
                'status'       => '1',
                'jenis'        => 'single',
                'by_users'     => 1,
            ],
            [
                'nama'         => 'PPTK',
                'icon'         => 'list',
                'path'         => '/pptk',
                'status'       => '1',
                'jenis'        => 'single',
                'by_users'     => 1,
            ],
            [
                'nama'         => 'Teknis Lapangan',
                'icon'         => 'list',
                'path'         => '/teknislap',
                'status'       => '1',
                'jenis'        => 'multi',
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
