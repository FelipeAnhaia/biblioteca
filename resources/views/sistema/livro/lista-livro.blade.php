@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"> 
                	<h4 style="display: inline-block;"> Lista de livros </h4>

                	<form class="form-horizontal" method="get" action="{{ url('/buscaLivro') }}" style="float: right; display: inline-block;">
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

					@if( isset($errors) && count($errors) > 0)
					<div class="alert alert-danger">
						@foreach( $errors as $error)
							<p>{{$error}}</p>
						@endforeach
					</div>
					@endif

					<table class="table table-striped">
						<tr>
							<td> <b>Id</b> </td>
							<td> <b>Nome</b> </td>
							<td> <b>Autor</b> </td>
							<td> <b>Editora</b> </td>
							<td> <b>Categoria</b> </td>
							<td> <b>Ações</b> </td>
						</tr>
						@foreach($livros as $livro)
						<tr>
							<td>{{$livro->id}}</td>
							<td>{{$livro->nome}}</td>
							<td>{{$livro->autor}}</td>
							<td>{{$livro->editora}}</td>
							<td>{{$livro->categoria}}</td>
							<td>

								<a href="{{route('rotaLivro.show', $livro->id)}}" class="btn btn-primary">
									Visualizar
								</a>
								<a href="{{ route('rotaLivro.edit', $livro->id) }}" class="btn btn-primary">
									Editar
								</a>

                    			<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirm" style="display: inline;">Excluir</button>

								<div class="modal fade" id="confirm" role="dialog">
								  <div class="modal-dialog modal-md">

								    <div class="modal-content">
								      <div class="modal-body">
								            <p> Tem certeza que deseja excluir o livro: {{ $livro->nome }}</p>
								      </div>
								      <div class="modal-footer">
										<form class="form" method="post" action="{{route('rotaLivro.destroy', $livro->id)}}" style="display: inline;">
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

					{!! $livros->links() !!}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>