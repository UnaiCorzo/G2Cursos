<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Programación',
                'color' => '#000000',
            ],
            [
                'name' => 'Sistemas',
                'color' => '#87CEEB',
            ],
            [
                'name' => 'Redes',
                'color' => '#348C31',
            ],
            [
                'name' => 'HTML',
                'color' => '#f06529',
            ],
            [
                'name' => 'CSS',
                'color' => '#2965f1',
            ],
            [
                'name' => 'Bootstrap',
                'color' => '#563d7c',
            ],
            [
                'name' => 'JavaScript',
                'color' => '#f0db4f',
            ],
            [
                'name' => 'JQUERY',
                'color' => '#0769ad',
            ],
            [
                'name' => 'JAVA',
                'color' => '#f89820',
            ],
            [
                'name' => 'PHP',
                'color' => '#232531',
            ],
            [
                'name' => 'Laravel',
                'color' => '#fb503b',
            ],
            [
                'name' => 'MySQL',
                'color' => '#00758F',
            ],
            [
                'name' => 'Linux',
                'color' => '#333333',
            ],
            [
                'name' => 'Ubuntu',
                'color' => '#DD4814',
            ],
            [
                'name' => 'Windows',
                'color' => '#0078D7',
            ],
            [
                'name' => 'AWS',
                'color' => '#FF9900',
            ],
            [
                'name' => 'Docker',
                'color' => '#0db7ed',
            ],

        ];

        Category::insert($categories);
    }
}
