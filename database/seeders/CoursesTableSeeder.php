<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('courses')->insert([
            'name' => 'Laravel desde 0',
            'location' => '43.326636999999984 -1.9698139999999942',
            'price' => '67.99',
            'description' => 'En este curso daremos Laravel desde 0',
            'image' => 'image.png',
            'teacher_id' => '77777',
        ]);

    }
}
