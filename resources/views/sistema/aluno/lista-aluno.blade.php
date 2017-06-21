@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"> 
                	<h4 style="display: inline-block;"> Lista de alunos </h4>

                	<!--
						Como não aceita passar o action por 'Route', envio por URL, {{ url('/buscaAluno') }}, e no por get, como delcarei na rota.
                	-->
					<form class="form-horizontal" method="get" action="{{ url('/buscaAluno') }}" style="float: right; display: inline-block;">
						<div class="form-group">
                            <label class="control-label col-sm-3" for="nome">Pesquisar:</label>
                            <div class="col-sm-6">
                                <input type="text" name="nome" placeholder="Nome" class="form-control" value="">
                            </div>
							<button class="btn col-sm-2" id="pesquisar"> ok </button>
                        </div>
					</form>

                </div>

                <div class="panel-body">

	                <!--
						A varíavel $errors é criada no controller, e passada um array com os possiveis erros, que eu seto, caso tenha da oum erro.
	                -->
					@if( isset($errors) && count($errors) > 0)
					<div class="alert alert-danger">
						@foreach( $errors as $error)
							<p>{{$error}}</p>
						@endforeach
					</div>
					@endif

					<table class="table table-striped">
						<tr>
							<td> <b>id</b> </td>
							<td> <b>Nome</b> </td>
							<td> <b>Email</b> </td>
							<td> <b>Ações</b> </td>
						</tr>
						@foreach($alunos as $aluno)
						<tr>
							<td>{{$aluno->id}}</td>
							<td>{{$aluno->nome}} {{$aluno->sobrenome}}</td>
							<td>{{$aluno->email}}</td>
							<td>
								<!-- cjhama a rota nomeadade rotaAluno e chamar o metodo show nela -->
								<a href="{{route('rotaAluno.show', $aluno->id)}}" class="btn btn-primary">
									Visualizar
								</a>
								<!--
								para editar posso usar: 
									{{ route('rotaAluno.edit', $aluno->id) }}
								ou
									{{ url("/sistema/alunos/{$aluno->id}/edit") }}" // eu acho que assim se estivesse usando o get, e nõa o resource
								-->
								<a href="{{ route('rotaAluno.edit', $aluno->id) }}" class="btn btn-primary">
									Editar
								</a>
								

								<!-- Como para excluir ele não faz por POST ou GET, eu tenhoque definir o tipo dele, neste caso o delete, e deve ser passado um token junto -->
								<!--
								<form class="form" method="post" action="{{route('rotaAluno.destroy', $aluno->id)}}" style="display: inline;">
									{!! method_field('DELETE') !!}
									{!! csrf_field() !!}
									<button class="btn btn-danger"> Excluir </button>
								</form>	
								-->

                    			<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirm" style="display: inline;">Excluir</button>

								<div class="modal fade" id="confirm" role="dialog">
								  <div class="modal-dialog modal-md">

								    <div class="modal-content">
								      <div class="modal-body">
								            <p> Tem certeza que deseja excluir o Aluno: {{ $aluno->nome }} {{ $aluno->sobrenome }}</p>
								      </div>
								      <div class="modal-footer">
										<form class="form" method="post" action="{{route('rotaAluno.destroy', $aluno->id)}}" style="display: inline;">
												{!! method_field('DELETE') !!}
												{!! csrf_field() !!}
												<button class="btn btn-danger" id="delete"> Confirmar </button>
											</form>	
								        <button type="button" data-dismiss="modal" class="btn btn-default">Cancelar</button>
								      </div>
								    </div>
								  </div>
								</div>

							</td>
						</tr>
						@endforeach
					</table>

					<!-- Modo para chamar a paginação -->
					{!! $alunos->links() !!}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>