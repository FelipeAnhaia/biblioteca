<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmprestimosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emprestimos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_livro')->unsigned();
            $table->foreign('id_livro')->references('id')->on('livros')->onDelete('cascade');;
            $table->integer('id_aluno')->unsigned();
            $table->foreign('id_aluno')->references('id')->on('alunos')->onDelete('cascade');;
            $table->string('dt_emprestimo', 60);
            $table->string('dt_devolucao', 60);
            $table->enum('status', ['Emprestado', 'Devolvido']);
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
        Schema::dropIfExists('emprestimos');
    }
}
