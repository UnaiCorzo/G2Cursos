<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => '77777',
            'name' => 'Administrador',
            'surnames' => 'Admin',
            'password' => '$2y$10$lPofQAkjhZMpH71arudNW.RojHjXlxhNkoSSzq3Xs2KzlU/VOOkH6',
            'email' => 'admin@admin.com',
            'dni' => '22222222Q',
            'role_id' => '3',
        ]);
    }
}
