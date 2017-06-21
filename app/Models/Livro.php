<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    protected $fillable = ['nome', 'autor', 'editora', 'pais', 'ano', 'categoria', 'isbn'];
}
