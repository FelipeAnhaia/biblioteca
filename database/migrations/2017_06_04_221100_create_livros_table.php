<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLivrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('livros', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 60);
            $table->string('autor', 60);
            $table->string('editora', 60);
            $table->string('pais', 60);
            $table->integer('ano');
            $table->enum('categoria', ['Científico', 'Crônica', 'Didático', 'Bibliográfico', 'Horror']);
            $table->integer('isbn');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('livros');
    }
}
