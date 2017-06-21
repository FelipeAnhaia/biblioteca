<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlunosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alunos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 60);
            $table->string('sobrenome', 60);
            $table->string('dt_nascimento', 10);
            
            $table->integer('cpf');
            $table->string('rua', 60);
            $table->string('bairro', 60);
            $table->integer('numero');
            $table->string('cep', 10);
            $table->string('cidade', 60);
            $table->string('estado', 2);
            $table->string('email', 60)->unique();
            $table->timestamps();
        });

/*
            $table->boolean('active');
            $table->string('image', 200)->nullable();
            $table->enum('category', ['eletronicos', 'moveis', 'limpeza', 'banho']);
            $table->text('description');
            $table->string('email')->unique();
            $table->string('password');
*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alunos');
    }
}

