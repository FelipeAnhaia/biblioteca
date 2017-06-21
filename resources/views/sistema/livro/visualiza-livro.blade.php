@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h3> Visualização dos dados do livro </h3></div>
                <div class="panel-body">

					<p><b> livro: </b> {{$livro->nome}} </p>
					<p><b> ISBN: </b> {{$livro->isbn}} </p>
					<p><b> Categoria: </b> {{$livro->categoria}} </p>
					<p><b> Autor: </b> {{$livro->autor}} </p>
					<p><b> Editora: </b> {{$livro->editora}} </p>
					<p><b> País: </b> {{$livro->pais}} </p>
					<p><b> Ano: </b> {{$livro->ano}} </p>
					<hr>
					
					<a href="{{route('rotaLivro.index')}}" class="btn btn-primary">
						Voltar
					</a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection