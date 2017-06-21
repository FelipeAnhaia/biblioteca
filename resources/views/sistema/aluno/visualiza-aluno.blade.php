@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h3> Visualização dos dados do aluno </h3></div>
                <div class="panel-body">

					<p><b> Aluno: </b> {{$aluno->nome}} </p>
					<p><b> Sobrenome: </b> {{$aluno->sobrenome}} </p>
					<p><b> Data de nascimento: </b> {{$aluno->dt_nascimento}} </p>
					<p><b> CPF: </b> {{$aluno->cpf}} </p>
					<p><b> Rua: </b> {{$aluno->rua}} </p>
					<p><b> Bairro: </b> {{$aluno->bairro}} </p>
					<p><b> Número: </b> {{$aluno->numero}} </p>
					<p><b> CEP: </b> {{$aluno->cep}} </p>
					<p><b> Cidade: </b> {{$aluno->cidade}} </p>
					<p><b> Estado: </b> {{$aluno->estado}} </p>
					<p><b> Email: </b> {{$aluno->email}} </p>

					<hr>
					
					<a href="{{route('rotaAluno.index')}}" class="btn btn-primary">
						Voltar
					</a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection