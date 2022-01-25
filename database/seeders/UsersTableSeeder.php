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
            'name' => 'Usuario',
            'surnames' => 'Invitado',
            'password' => '$2y$10$lPofQAkjhZMpH71arudNW.RojHjXlxhNkoSSzq3Xs2KzlU/VOOkH6',
            'email' => 'user@user.com',
            'dni' => '00000000T',
            'role_id' => '1',
        ]);

        DB::table('users')->insert([
            'id' => '88888',
            'name' => 'Creador',
            'surnames' => 'Creativo',
            'password' => '$2y$10$lPofQAkjhZMpH71arudNW.RojHjXlxhNkoSSzq3Xs2KzlU/VOOkH6',
            'email' => 'creador@creador.com',
            'dni' => '11111111H',
            'role_id' => '2',
        ]);

        DB::table('users')->insert([
            'id' => '99999',
            'name' => 'Administrador',
            'surnames' => 'Admin',
            'password' => '$2y$10$lPofQAkjhZMpH71arudNW.RojHjXlxhNkoSSzq3Xs2KzlU/VOOkH6',
            'email' => 'admin@admin.com',
            'dni' => '22222222Q',
            'role_id' => '3',
        ]);
    }
}
