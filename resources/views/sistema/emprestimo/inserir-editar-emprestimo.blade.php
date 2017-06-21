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

                    @if( isset($emprestimo[0]) )
                        <form class="form-horizontal" method="post" action="{{route('rotaEmprestimo.update', $emprestimo[0]->id)}}">
                        {!! method_field('PUT') !!}
                    @else
                        <form class="form-horizontal" method="post" action="{{route('rotaEmprestimo.store')}}">
                    @endif

                            {!! csrf_field() !!}

                            <div class="form-group">
                                <label class="control-label col-sm-2" for="id_livro">Livro:</label>
                                <div class="col-sm-5">
                                    <select name="id_livro" class="form-control">
                                        <option value=""> Selecione o livro </option>
                                        @foreach($livros as $livro)
                                            <option value="{{$livro->id}}"
                                                @if( isset($emprestimo[0]) && $emprestimo[0]->id_livro == $livro->id ) 
                                                    selected
                                                @endif
                                                >
                                                {{ $livro->id }} - {{ $livro->nome }} - {{ $livro->editora }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
<!-- 
    Como aqui estou enviando um array resultado de uma busca do meu controller, e não um array pronto como um de categorias que mesmo crio, eu tenho que indicar qual é o indice que quero acessar ou comparar, no caso acima o indice $livro->id.
    Pq se eu não passar, como ele é uma coleção, ele vai entender que estou em busca do objeto todo. 
    $emprestimo[0] está assim, pq é uma coleção, e estou acessando o indice 0 que contém os campos advindos do banco.
 -->

                            <div class="form-group">
                                <label class="control-label col-sm-2" for="id_livro">Aluno:</label>
                                <div class="col-sm-5">
                                    <select name="id_aluno" class="form-control">
                                        <option value=""> Selecione o aluno </option>
                                        @foreach($alunos as $aluno)
                                            <option value="{{ $aluno->id }}"
                                                @if( isset($emprestimo[0]) && $emprestimo[0]->id_aluno == $aluno->id ) 
                                                    selected
                                                @endif
                                                >
                                                {{ $aluno->id }} - {{ $aluno->nome }} - {{ $aluno->sobrenome }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                             <div class="form-group">
                                <label class="control-label col-sm-2" for="dt_emprestimo">Data Emp.:</label>
                                <div class="col-sm-3">
                                     <input type="date" name="dt_emprestimo" placeholder="Data Emp." class="form-control" value="{{$emprestimo[0]->dt_emprestimo or old('dt_emprestimo')}}">
                                </div>

                                <label class="control-label col-sm-3" for="dt_devolucao">Data dev.:</label>
                                <div class="col-sm-3">
                                    <input type="date" name="dt_devolucao" placeholder="Data Dev.:" class="form-control" value="{{$emprestimo[0]->dt_devolucao or old('dt_devolucao')}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-2" for="status">status:</label>
                                <div class="col-sm-5">
                                    <select name="status" class="form-control">
                                        <option value=""> Escolha a status </option>
                                        @foreach($status as $status)
                                            <option value="{{$status}}"
                                                @if( isset($emprestimo[0]) && $emprestimo[0]->status == $status ) 
                                                    selected
                                                @endif
                                                >
                                                {{$status}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary">Enviar</button>
                                    <a href="{{route('rotaEmprestimo.index')}}" class="btn btn-primary">Cancelar</a>
                                </div>
                            </div>
                    </form>                           
                </div>
            </div>
        </div>
    </div>
</div>
@endsection