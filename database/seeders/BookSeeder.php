<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('books')->insert([
            [
                'title'   => 'Kamu Tidak Istimewa',
                'author'  => 'Natasha Rizky',
                'publish' => Carbon::create(2024, 1, 18),
            ],
            [
                'title'   => 'Laut Bercerita',
                'author'  => 'Leila Salikha Chudori',
                'publish' => Carbon::create(2017, 10, 25),
            ],
            [
                'title'   => 'Laskar Pelangi',
                'author'  => 'Andrea Hirata',
                'publish' => Carbon::create(2011, 5, 10),
            ],
        ]);
    }
}
