<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HolidayTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $holiday = [
            [
                'day'      => '25',
                'month'    => '12',
                'note'     => 'Tahun Baru',
                'by_users' => 1,
            ],
            [
                'day'      => '25',
                'month'    => '12',
                'note'     => 'Tahun Baru Imlek',
                'by_users' => 1,
            ],
            [
                'day'      => '18',
                'month'    => '02',
                'note'     => 'Isra Mikraj Nabi Muhammad SAW',
                'by_users' => 1,
            ],
            [
                'day'      => '22',
                'month'    => '03',
                'note'     => 'Hari Suci Nyepi Tahun Baru Saka',
                'by_users' => 1,
            ],
            [
                'day'      => '07',
                'month'    => '04',
                'note'     => 'Wafat Isa Almasih',
                'by_users' => 1,
            ],
            [
                'day'      => '01',
                'month'    => '05',
                'note'     => 'Hari Buruh Internasional',
                'by_users' => 1,
            ],
            [
                'day'      => '18',
                'month'    => '05',
                'note'     => 'Kenaikan Isa Almasih',
                'by_users' => 1,
            ],
            [
                'day'      => '01',
                'month'    => '06',
                'note'     => 'Hari Lahir Pancasila',
                'by_users' => 1,
            ],
            [
                'day'      => '04',
                'month'    => '06',
                'note'     => 'Hari Raya Waisak',
                'by_users' => 1,
            ],
            [
                'day'      => '29',
                'month'    => '06',
                'note'     => 'Hari Raya Idul Adha',
                'by_users' => 1,
            ],
            [
                'day'      => '19',
                'month'    => '07',
                'note'     => 'Tahun Baru Islam',
                'by_users' => 1,
            ],
            [
                'day'      => '17',
                'month'    => '08',
                'note'     => 'Hari Kemerdekaan RI',
                'by_users' => 1,
            ],
            [
                'day'      => '28',
                'month'    => '09',
                'note'     => 'Maulid Nabi Muhammad SAW',
                'by_users' => 1,
            ],
            [
                'day'      => '25',
                'month'    => '12',
                'note'     => 'Hari Raya Natal',
                'by_users' => 1,
            ],
        ];
        foreach ($holiday as $row) {
            DB::table('holiday')->insert($row);
        }
    }
}
