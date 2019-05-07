<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Category;


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

        $cat = new Category(); $cat->name = 'Paisajes'; $cat->save();
        $cat = new Category(); $cat->name = 'Comida'; $cat->save();
        $cat = new Category(); $cat->name = 'Juguetes'; $cat->save();
        $cat = new Category(); $cat->name = 'Deporte'; $cat->save();
        $cat = new Category(); $cat->name = 'Frases'; $cat->save();
        $cat = new Category(); $cat->name = 'Vida'; $cat->save();
        $cat = new Category(); $cat->name = 'Trabajo'; $cat->save();
        $cat = new Category(); $cat->name = 'Viajes'; $cat->save();
        $cat = new Category(); $cat->name = 'Tech'; $cat->save();
        $cat = new Category(); $cat->name = 'Inteligencia Artificial'; $cat->save();
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
