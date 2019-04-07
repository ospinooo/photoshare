<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
        });

        DB::table('categories')->insert(array('name' => 'Paisajes'));
        DB::table('categories')->insert(array('name' => 'Comida'));
        DB::table('categories')->insert(array('name' => 'Juguetes'));
        DB::table('categories')->insert(array('name' => 'Deporte'));
        DB::table('categories')->insert(array('name' => 'Frases'));
        DB::table('categories')->insert(array('name' => 'Vida'));
        DB::table('categories')->insert(array('name' => 'Trabajo'));
        DB::table('categories')->insert(array('name' => 'Viajes'));
        DB::table('categories')->insert(array('name' => 'Tech'));
        DB::table('categories')->insert(array('name' => 'Inteligencia Artificial'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
