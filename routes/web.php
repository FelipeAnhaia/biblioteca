<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// alterar para quando estiver logado ele caia na view de listas já, ou ter uma tela inicia lde boa vindas no ssitema...
Route::get('/', 'HomeController@index')->middleware('auth');

Route::group(['namespace' => 'Sistema', 'middleware' => 'auth'], function (){
	// A primeira parte é a chamda da URL, a segunda é o metodo que vai ser chamado no meu controller
	// Route::get('/contato', 'SiteController@contato');

	// Por algum motivo, e eu não sei, as rotas do tipo resource, não precisam ter após elas, a chamada do '@metodo'
	// e aqui, eu somente dou um nome para a minha rota
	Route::resource('/rotaAluno', 'AlunoController');
	// se eu fizer a chamada acima de rotaAluno na URL do navegador, ele vai chamar o metodo index

	// Os metodos que compõe o controller, podem ser chamados depois através da url, em um link a href, como abaixo
	// {{route('rotaAluno.create')}} -> rotaAluno é o noma da rota, e create o metodo do controller

	// abaixo é um exemplo de rota usando o get, que vai chamar a função index, diferente da resource
	//Route::get('/aluno/listar', 'Sistema\AlunoController@index');

	Route::resource('/rotaLivro', 'LivroController');
	Route::resource('/rotaEmprestimo', 'EmprestimoController');

	/*
		Por algum motivo, as rotas resource, não aceitam a criação com passagem de parametro de um metodo, que não seja as que foram criadas com o artisan
		Então criei 3 rotas e metodos de busca no controller de cada.
	*/
	Route::get('/buscaAluno', 'AlunoController@buscaAluno');
	Route::get('/buscaLivro', 'LivroController@buscaLivro');
	Route::get('/buscaEmprestimo', 'EmprestimoController@buscaEmprestimo');

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/*
Abaixo as diferentes formas de fazer com que sempre chame uma página de autenticação, antes do sistema

//Route::get('/', 'HomeController@index');

//Route::get('/', 'HomeController@index')->middleware('auth');

Route::group(['middleware' => 'auth'], function (){ //posso ter um namespace antes
	Route::get('/', function () { return view('welcome');});
});

*/