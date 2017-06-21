<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Emprestimo extends Model
{
    protected $fillable = ['id_livro', 'id_aluno', 'dt_emprestimo', 'dt_devolucao', 'status'];
}
