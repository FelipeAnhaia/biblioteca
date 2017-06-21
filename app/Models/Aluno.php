<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    protected $fillable = ['nome', 'sobrenome', 'dt_nascimento', 'cpf', 'rua', 'bairro', 'numero', 'cep', 'cidade', 'estado', 'email'];
}
