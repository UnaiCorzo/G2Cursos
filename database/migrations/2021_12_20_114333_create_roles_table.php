<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id('id');
            $table->string('name');
            $table->string('description');
            $table->timestamps();
        });
        $data = [['id' => '1',
            'name' => 'usuario',
            'description' => 'Usuario que puede unirse a cursos'], ['id' => '2',
            'name' => 'creador',
            'description' => 'Creador que puede unirse a cursos y poder crearlos'], ['id' => '3',
            'name' => 'administrador',
            'description' => 'Administrador que gestiona el sitio web']];
        DB::table('roles')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
