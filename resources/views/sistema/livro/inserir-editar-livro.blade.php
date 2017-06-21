@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>{{ $acao }}</h3></div>
                <div class="panel-body">
                    
                    @if( isset($errors) && count($errors) >0)
                    <div class="alert alert-danger">
                        @foreach( $errors->all() as $error)
                            <p>{{$error}}</p>
                        @endforeach
                    </div>
                    @endif

                    @if( isset($livro) )
                        <form class="form-horizontal" method="post" action="{{route('rotaLivro.update', $livro->id)}}">
                        {!! method_field('PUT') !!}
                    @else
                        <form class="form-horizontal" method="post" action="{{route('rotaLivro.store')}}">
                    @endif

                            {!! csrf_field() !!}

                             <div class="form-group">
                                <label class="control-label col-sm-2" for="Nome">Nome:</label>
                                <div class="col-sm-5">
                                     <input type="text" name="nome" placeholder="Nome" class="form-control" value="{{$livro->nome or old('nome')}}">
                                </div>

                                <label class="control-label col-sm-1" for="isbn">ISBN:</label>
                                <div class="col-sm-3">
                                    <input type="text" name="isbn" placeholder="ISBN" class="form-control" value="{{$livro->isbn or old('isbn')}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-2" for="Nome">Categoria:</label>
                                <div class="col-sm-5">
                                    <select name="categoria" class="form-control">
                                        <option value=""> Escolha a Categoria </option>
                                        @foreach($categorias as $categoria)
                                            <option value="{{$categoria}}"
                                                @if( isset($livro) && $livro->categoria == $categoria ) 
                                                    selected
                                                @endif
                                                >
                                                {{$categoria}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-2" for="autor">Autor:</label>
                                <div class="col-sm-5">
                                    <input type="text" name="autor" placeholder="Autor" class="form-control" value="{{$livro->autor or old('autor')}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-2" for="editora">Editora:</label>
                                <div class="col-sm-5">
                                    <input type="text" name="editora" placeholder="Editora" class="form-control" value="{{$livro->editora or old('editora')}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-2" for="País">Páis:</label>
                                <div class="col-sm-5">
                                     <input type="text" name="pais" placeholder="Páis" class="form-control" value="{{$livro->pais or old('pais')}}">
                                </div>

                                <label class="control-label col-sm-1" for="ano">Ano:</label>
                                <div class="col-sm-3">
                                    <input type="text" name="ano" placeholder="Ano" class="form-control" value="{{$livro->ano or old('ano')}}" maxlength="4">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary">Enviar</button>
                                    <a href="{{route('rotaLivro.index')}}" class="btn btn-primary">Cancelar</a>
                                </div>
                            </div>
                    </form>                           
                </div>
            </div>
        </div>
    </div>
</div>
@endsection