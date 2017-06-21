@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>{{ $acao }}</h3></div>
                <div class="panel-body">
                    
                <!--
                    * O nome dos campos 'name', deve ser exatamente o do campo correspondente no banco de dados, dessa forma, ao dar o create no cortroller, ele já mapeia e destina de forma certa o campo a ser preenchido no banco de dados.
                    Exemplo: campo id_aluno, deve ter um input com o mome id_aluno aqui.
                -->
                    <!-- 
                        A variável errors, é interna do Laravel, contém um array de erros. As mensagens de erro podem sersetadas atraves dos rules, ou então usando o formRequest do Laravel, que é a maneira que estou usando no projeto
                    -->
                    @if( isset($errors) && count($errors) >0)
                    <div class="alert alert-danger">
                        @foreach( $errors->all() as $error)
                            <p>{{$error}}</p>
                        @endforeach
                    </div>
                    @endif

                    <!-- Como este form faz as partes de incluir e editar, faço essa verificação para saber para qual rota enviar -->
                    @if( isset($aluno) )
                        <form class="form-horizontal" method="post" action="{{route('rotaAluno.update', $aluno->id)}}">
                        <!-- como o metodo update não funciona com o modo POST, eu tenho que alterar o modo de envio-->
                        {!! method_field('PUT') !!}
                    @else
                        <form class="form-horizontal" method="post" action="{{route('rotaAluno.store')}}">
                    @endif

                    <!--
                            Como para a segurança de dados é necessário enviar por Post, eu tenho que enviar junto um token, e posso setar isso de duas formas:
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            ou
                            {!! csrf_field() !!}
                        -->
                            {!! csrf_field() !!}

                            <div class="form-group">
                                <label class="control-label col-sm-2" for="nome">Nome:</label>
                                <div class="col-sm-8">
                                    <input type="text" name="nome" placeholder="Nome" class="form-control" value="{{$aluno->nome or old('nome')}}">
                                    <!--
                                        Já que este form está sendo usado tanto para o cadastro quanto para a edição, no value temos:
                                        $aluno->nome, para recuiperar o valor na edição, e '{{old('name')}}' que preserva o antigo valor do campo, para quando mandar o form e retornar algum erro.
                                    -->
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-2" for="sobrenome">Sobrenome:</label>
                                <div class="col-sm-8">
                                    <input type="text" name="sobrenome" placeholder="Sobrenome" class="form-control" value="{{$aluno->sobrenome or old('sobrenome')}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-2" for="dt_nascimento">Nascimento:</label>
                                <div class="col-sm-3">
                                    <input type="date" name="dt_nascimento" placeholder="Nascimento" class="form-control" value="{{$aluno->dt_nascimento or old('dt_nascimento')}}" max="10">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-2" for="cpf">CPF:</label>
                                <div class="col-sm-3">
                                    <input type="text" name="cpf" placeholder="CPF" class="form-control" value="{{$aluno->cpf or old('cpf')}}" maxlength="7">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-2" for="rua">Rua:</label>
                                <div class="col-sm-5">
                                    <input type="text" name="rua" placeholder="Rua" class="form-control" value="{{$aluno->rua or old('rua')}}">
                                </div>

                                <label class="control-label col-sm-1" for="numero">Núm.:</label>
                                <div class="col-sm-3">
                                    <input type="number" name="numero" placeholder="Núm." class="form-control" value="{{$aluno->numero or old('numero')}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-2" for="bairro">Bairro:</label>
                                <div class="col-sm-5">
                                    <input type="text" name="bairro" placeholder="Bairro" class="form-control" value="{{$aluno->bairro or old('bairro')}}">
                                </div>

                                <label class="control-label col-sm-1" for="cep">CEP:</label>
                                <div class="col-sm-3">
                                    <input type="text" name="cep" placeholder="CEP" class="form-control" value="{{$aluno->cep or old('cep')}}" maxlength="10">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-2" for="cidade">Cidade:</label>
                                <div class="col-sm-5">
                                    <input type="text" name="cidade" placeholder="Cidade" class="form-control" value="{{$aluno->cidade or old('cidade')}}">
                                </div>

                                <label class="control-label col-sm-1" for="estado">UF:</label>
                                <div class="col-sm-3">
                                    <select name="estado" class="form-control">
                                        <option value=""> Selecione </option>
                                        <option value="AC">Acre</option>
                                        <option value="AL">Alagoas</option>
                                        <option value="AP">Amapá</option>
                                        <option value="AM">Amazonas</option>
                                        <option value="BA">Bahia</option>
                                        <option value="CE">Ceará</option>
                                        <option value="DF">Distrito Federal</option>
                                        <option value="ES">Espírito Santo</option>
                                        <option value="GO">Goiás</option>
                                        <option value="MA">Maranhão</option>
                                        <option value="MT">Mato Grosso</option>
                                        <option value="MS">Mato Grosso do Sul</option>
                                        <option value="MG">Minas Gerais</option>
                                        <option value="PA">Pará</option>
                                        <option value="PB">Paraíba</option>
                                        <option value="PR">Paraná</option>
                                        <option value="PE">Pernambuco</option>
                                        <option value="PI">Piauí</option>
                                        <option value="RJ">Rio de Janeiro</option>
                                        <option value="RN">Rio Grande do Norte</option>
                                        <option value="RS">Rio Grande do Sul</option>
                                        <option value="RO">Rondônia</option>
                                        <option value="RR">Roraima</option>
                                        <option value="SC">Santa Catarina</option>
                                        <option value="SP">São Paulo</option>
                                        <option value="SE">Sergipe</option>
                                        <option value="TO">Tocantins</option>
                                        @if( isset($aluno) )
                                            <option value="{{$aluno->estado}}" selected>{{$aluno->estado}}</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-2" for="email">E-mail:</label>
                                <div class="col-sm-5">
                                    <input type="email" name="email" placeholder="E-mail" class="form-control" value="{{$aluno->email or old('email')}}">
                                </div>
                            </div>
                    
                            <!--
                                <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                  <div class="checkbox">
                                    <label><input type="checkbox"> Remember me</label>
                                  </div>
                                </div>
                                </div>
                                

                                <div class="form-group">
                                    <input type="text" name="number" placeholder="Número" class="form-control" value="{{$aluno->number or old('number')}}">
                                </div>

                                <div class="form-group">
                                    <textarea name="description" placeholder="Descrição" class="form-control">
                                    {{$aluno->description or old('description')}}
                                    </textarea>
                                </div>

                                <button class="btn btn-primary"> Enviar </button>

                              -->
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary">Enviar</button>
                                    <a href="{{route('rotaAluno.index')}}" class="btn btn-primary">Cancelar</a>
                                </div>
                            </div>
                    </form>                           
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
