@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h3> Visualização dos dados de empréstimo </h3></div>
                <div class="panel-body">

					<p><b> Livro: </b> {{ $emprestimo[0]->livro_nome }} - {{ $emprestimo[0]->editora }} - {{ $emprestimo[0]->isbn }} </p>
					<p><b> Aluno: </b> {{ $emprestimo[0]->aluno_nome }} {{ $emprestimo[0]->sobrenome }} </p>
					<p><b> Data empréstimo: </b> {{$emprestimo[0]->dt_emprestimo}} </p>
					<p><b> Data devolução: </b> {{$emprestimo[0]->dt_devolucao}} </p>
					<p><b> Status: </b> {{$emprestimo[0]->status}} </p>
					<hr>
					
					<a href="{{route('rotaEmprestimo.index')}}" class="btn btn-primary">
						Voltar
					</a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection