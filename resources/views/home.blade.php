@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            
        <!--
            <div class="panel panel-default">
                
                <div class="panel-heading">Lista de empréstimos</div>
                <div class="panel-body">
                    ALTERAR ESTÁ PÁGINA COM UMA FOTO DE FUNDO OU SOMEN TE BOAS VINDAS.....
                </div>
            </div>
        -->
        <div class="bem_vindo">
            <h2>Seja bem-vindo {{ Auth::user()->name }}</h2>
            <h3>Escolha um dos menus acima e comece a utilizar o sistema.</h3>
        </div>

        </div>
    </div>
</div>
@endsection
