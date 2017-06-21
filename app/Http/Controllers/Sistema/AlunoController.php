<?php

namespace App\Http\Controllers\Sistema;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Estou chamando o Model Aluno, para poder utilizar ele abaixo.
use App\Models\Aluno;

//Usando a validação do FormRequest
use App\Http\Requests\Sistema\AlunoFormRequest;

class AlunoController extends Controller
{

    // crio uma varíavel que irpa armazenar o retorno do objeto aluno, dessa forma não preciso ficar instanvciando em cada metodo a chamada dela, pq será passado na chamda da função
    private $aluno;

    public function __construct(Aluno $aluno) {
        $this->aluno = $aluno;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    // Abaixo ele é feito dessa forma pegando por parametro, pq eu não preciso instanciar a classe aluno toda vez que for usar, isso é possivel pois estou dando um use láem cima, e criando no contrutor
    public function index(Aluno $aluno)
    {
        
        // estou armazenado todos os dados de aluno
        //$alunos = $this->aluno->all(); 

        // Como vou usar a paginação, abaixo é a mesma coisa que o all, porém, com paginação
        $alunos = $this->aluno->paginate(4);

        // abaixo está passando pegando o retorno de uma view, e passando uma instancia de aluno, com o retorno de todos os dados.
        // para poder fazer a listagem.
        return view('sistema.aluno.lista-aluno', compact('alunos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /* Método responsável por mostrar o formulário de cadastro*/
    public function create()
    {
        $acao = 'Cadastrar aluno';
        return view('sistema.aluno.inserir-editar-aluno', compact('acao'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /* Este é o método responsável por armazenar os dados no banco*/
    //public function store(Request $request) // como estou usando os metodos de validação da classe FormRequest, eu ~~ao uso mais o request assim, mas eu chamo a classe nova
    //public function store(\App\Http\Requests\Sistema\AlunoFormRequest $request)
    // a chamada acima está passando todo o caminho da classe, porém pra simplificar, posso utilizar o use no cabeçalho, e usar a chamada da forma abaixo
    public function store(AlunoFormRequest $request)
    {
        $dadosForm = $request->all();
        $insert = $this->aluno->create($dadosForm);
        if( $insert ){
          // Abaixo estou redirecioando para que depois de inserido volte a este controller, para o metodo index, ou seja, vai ir pra pagina inicial do site.
          return redirect()->route('rotaAluno.index');
          // Ou return redirect('/painel/produtos')->route();
        } else {
          return redirect()->route('rotaAluno.create');
          // Ou return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*Este metódo vai chamar uma view parea mostar os dados do aluno, de visualização */
    public function show($id)
    {
        // recupera um aluno pela sua id, e passa os valores recuperado do banco como parametro
        $aluno = $this->aluno->find($id);
        return view('sistema.aluno.visualiza-aluno', compact('aluno'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /* Edit, é o metodo responsável por chamar a view que mostra o form de edição*/
    public function edit($id)
    {
        $acao = 'Editar aluno';
        $aluno = $this->aluno->find($id);
        return view('sistema.aluno.inserir-editar-aluno', compact('acao','aluno'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /* É o metódo responsável por realizar o update no banco de dados*/
    public function update(AlunoFormRequest $request, $id)
    {
        $dadosForm = $request->all();
        $aluno = $this->aluno->find($id);
        
        $update = $aluno->update($dadosForm);

        if($update)
          return redirect()->route('rotaAluno.index');
        else
          return redirect()->route('rotaAluno.edit', $id)
                           ->with(['errors' => 'Falha ao editar']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /* Método que exclui do banco */
    public function destroy($id)
    {
        $aluno = $this->aluno->find($id);
        $delete = $aluno->delete();

        if( $delete )
           return redirect()->route('rotaAluno.index');
        else
          return redirect()->route('rotaAluno.show', $id)
                           ->with(['errors' => 'Falha ao deletar']);
    }

    public function buscaAluno(Request $request, Aluno $aluno)
    {
        $alunos = $this->aluno->where('nome', 'like', '%'.$request->input('nome').'%')->paginate(4);
        return view('sistema.aluno.lista-aluno', compact('alunos'));
    }
}
