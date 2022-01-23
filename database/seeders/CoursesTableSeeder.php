<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Course;
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
        $id = DB::table('courses')->insertGetId([
            'name' => 'Laravel desde 0',
            'location' => '43.326636999999984;-1.9698139999999942',
            'price' => '67.99',
            'description' => 'En este curso daremos Laravel desde 0',
            'image' => 'laravel.png',
            'teacher_id' => '77777',
        ]);

        $course = Course::find($id);
        $course->categories()->attach(Category::find(19));
        $course->categories()->attach(Category::find(18));

        $id = DB::table('courses')->insertGetId([
            'name' => 'CSS Grid',
            'price' => '0',
            'description' => 'Con esta tecnología podrás realizar layouts modernos y atractivos con facilidad. Conviértete en pro, pásate a CSS Grid',
            'image' => 'css_grid.jpg',
            'teacher_id' => '77777',
        ]);

        $course = Course::find($id);
        $course->categories()->attach(Category::find(2));
        $course->categories()->attach(Category::find(1));

        $id = DB::table('courses')->insertGetId([
            'name' => 'Docker',
            'location' => '43.326636999999984;-1.9698139999999942',
            'price' => '97.99',
            'description' => 'Aprende como desplegar tus proyectos con Docker, una tecnología muy demandada y usada por las empresas',
            'image' => 'docker.jpeg',
            'teacher_id' => '77777',
        ]);

        $course = Course::find($id);
        $course->categories()->attach(Category::find(23));
        $course->categories()->attach(Category::find(24));
        $course->categories()->attach(Category::find(25));

        $id = DB::table('courses')->insertGetId([
            'name' => 'Angular',
            'price' => '24.99',
            'description' => 'Angular es un framework frontend que te facilitará tus desarrollos aplicando componentes y módulos',
            'image' => 'angular_js.png',
            'teacher_id' => '77777',
        ]);

        $course = Course::find($id);
        $course->categories()->attach(Category::find(8));
        $course->categories()->attach(Category::find(3));

        $id = DB::table('courses')->insertGetId([
            'name' => 'Git y GitHub',
            'price' => '59.90',
            'description' => 'En este curso te enseñaremos cómo gestionar las versiones de tus proyectos tanto localmente (Git), como remotamente (GitHub)',
            'image' => 'git_github.png',
            'teacher_id' => '77777',
        ]);

        $course = Course::find($id);
        $course->categories()->attach(Category::find(10));
        $course->categories()->attach(Category::find(11));

        $id = DB::table('courses')->insertGetId([
            'name' => 'Vanilla JS ',
            'price' => '67.99',
            'description' => 'Aprende a programar eventos, validaciones, animaciones y mucho más con el lenguaje Javascript puro',
            'image' => 'javascript.jpg',
            'teacher_id' => '77777',
        ]);

        $course = Course::find($id);
        $course->categories()->attach(Category::find(3));

        $id = DB::table('courses')->insertGetId([
            'name' => 'HTML básico',
            'location' => '43.326636999999984;-1.9698139999999942',
            'price' => '19.99',
            'description' => '¿Estás empezando en el mundo del desarrollo web? Este es tu curso, en él aprenderemos los conceptos básicos del lenguaje de marcas HTML',
            'image' => 'html.jpg',
            'teacher_id' => '77777',
        ]);

        $course = Course::find($id);
        $course->categories()->attach(Category::find(1));
        $course->categories()->attach(Category::find(2));

        $id = DB::table('courses')->insertGetId([
            'name' => 'Java',
            'location' => '43.326636999999984;-1.9698139999999942',
            'price' => '95.99',
            'description' => 'En este curso nos adentraremos en el apasionante lenguaje Java. POO, bases de datos y swing serán los principales temas que aprenderemos',
            'image' => 'java.jpg',
            'teacher_id' => '77777',
        ]);

        $course = Course::find($id);
        $course->categories()->attach(Category::find(16));
        $course->categories()->attach(Category::find(20));

        $id = DB::table('courses')->insertGetId([
            'name' => 'Bootstrap',
            'price' => '0',
            'description' => 'Aprende a maquetar tus webs de una manera sencilla con la librería Bootstrap. Con ella podrás diseñar layouts responsive, crear animaciones y mucho más',
            'image' => 'bootstrap.png',
            'teacher_id' => '77777',
        ]);

        $course = Course::find($id);
        $course->categories()->attach(Category::find(4));
        $course->categories()->attach(Category::find(2));
        $course->categories()->attach(Category::find(3));

        

    }
}
