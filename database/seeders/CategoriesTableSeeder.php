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
                'name' => 'HTML',
                'color' => '#f06529',
            ],
            [
                'name' => 'CSS',
                'color' => '#2965f1',
            ],
            [
                'name' => 'JavaScript',
                'color' => '#f0db4f',
            ],
            [
                'name' => 'Bootstrap',
                'color' => '#563d7c',
            ],
            [
                'name' => 'jQuery',
                'color' => '#0769ad',
            ],
            [
                'name' => 'Node.js',
                'color' => '#348C31',
            ],
            [
                'name' => 'React',
                'color' => '#0db7ed',
            ],
            [
                'name' => 'Angular',
                'color' => '#fb503b',
            ],
            [
                'name' => 'Vue.js',
                'color' => '#348C31',
            ],
            [
                'name' => 'Git',
                'color' => '#f06529',
            ],
            [
                'name' => 'GitHub',
                'color' => '#000000',
            ],
            [
                'name' => 'GitLab',
                'color' => '#f06529',
            ],
            [
                'name' => 'C',
                'color' => '#333333',
            ],
            [
                'name' => 'C++',
                'color' => '#2965f1',
            ],
            [
                'name' => 'Python',
                'color' => '#0769ad',
            ],
            [
                'name' => 'Java',
                'color' => '#f89820',
            ],
            [
                'name' => 'Go',
                'color' => '#87CEEB',
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
                'name' => 'Oracle',
                'color' => '#87CEEB',
            ],
            [
                'name' => 'JSON',
                'color' => '#348C31',
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
                'name' => 'Azure',
                'color' => '#0078D7',
            ],
            [
                'name' => 'Docker',
                'color' => '#0db7ed',
            ],
            [
                'name' => 'Kubernetes',
                'color' => '#000000',
            ],
        ];

        Category::insert($categories);
    }
}
