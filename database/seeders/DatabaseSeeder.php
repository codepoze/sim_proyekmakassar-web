<?php

namespace Database\Seeders;

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
        $this->call([
            RoleTableSeeder::class,
            UserTableSeeder::class,
            MenuHeadTableSeeder::class,
            MenuBodyTableSeeder::class,
            HolidayTableSeeder::class,
        ]);
    }
}
