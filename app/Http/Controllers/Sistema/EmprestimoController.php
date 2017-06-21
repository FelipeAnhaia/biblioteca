<?php

namespace App\Http\Controllers\Sistema;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Emprestimo;
use App\Http\Requests\Sistema\EmprestimoFormRequest;

// Como vou ter que utilizar os models para passar os valores de livros e alunos para o cadastro de um emprpestimo, para formar um array de seleção, abaixo eu o dou um use neles
use App\Models\Aluno;
use App\Models\livro;

class EmprestimoController extends Controller
{
    
    // Na classe construtora tbm passo os models de aluno e livro, que vão ser uteis nas views de cadastro, para montar o select
    public function __construct(Emprestimo $emprestimo, Aluno $aluno, Livro $livro) {
        $this->emprestimo = $emprestimo;
        $this->aluno = $aluno;
        $this->livro = $livro;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Emprestimo $emprestimo)
    {
        // Utilizo um Inner Join para buscar os dados das outras tabelas.
        $emprestimos = $this->emprestimo->select('emprestimos.*','alunos.nome AS aluno_nome','alunos.sobrenome', 'livros.nome AS livro_nome','livros.editora', 'livros.isbn')
                            ->join('alunos', 'alunos.id', '=', 'emprestimos.id_aluno')
                            ->join('livros', 'livros.id', '=', 'emprestimos.id_livro')
                            ->paginate(4);
                            //->get();
        return view('sistema.emprestimo.lista-emprestimo', compact('emprestimos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Aluno $aluno, Livro $livro)
    {
        $acao = 'Cadastrar empréstimo';
        $status = ['Emprestado', 'Devolvido'];
        // estou criando abaixo para poder fazer um select com os valores
        /* abaixo, ele tbm retorna uma collection, ma como vou fazer um foreach na view, não preciso me preocupar em setar a posição 0*/
        $alunos = $aluno->all();
        $livros = $livro->all();

        return view('sistema.emprestimo.inserir-editar-emprestimo', compact('acao', 'status', 'alunos', 'livros'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmprestimoFormRequest $request)
    {
        $dadosForm = $request->all();
        $insert = $this->emprestimo->create($dadosForm);

        if( $insert ){
          return redirect()->route('rotaEmprestimo.index');
        } else {
          return redirect()->route('rotaEmprestimo.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $emprestimo = $this->emprestimo->select('emprestimos.*','alunos.nome AS aluno_nome','alunos.sobrenome', 'livros.nome AS livro_nome','livros.editora', 'livros.isbn')
                            ->join('alunos', 'alunos.id', '=', 'emprestimos.id_aluno')
                            ->join('livros', 'livros.id', '=', 'emprestimos.id_livro')
                            ->where('emprestimos.id', $id)
                            ->get();
        
        /*
            Eu não entendi o pq. mas quando se utiliza o metodo find, ele retornar um objeto, com o nome que foi setado nomodel, no caso retorna um objeto Empresimo, que contém os dados do banco.
            Mas quando utilizamos o Join acima, ele retorna uma colação (?), e dentro desta coleção, retorna um array, e dntro deste array, na posição 0, retorna o objeto Emprestimo. Entao para acessar as infiormações recuperadas, tenho que fazer: emprestimo[0], na minha view, e dessa forma vou conseguir acessar os campos recuperados do banco.

            no ação de visualizar a lista, index, nãodeu este erro, pq na view, eu faço um foreach, e lá dentro eu consigo recuperar os valores, como neste caso eu não tenho  um foreach, teno que recuperar pelo indice da coleção.
            //dd($emprestimo[0]);
        */
        return view('sistema.emprestimo.visualiza-emprestimo', compact('emprestimo','aluno','livro'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Aluno $aluno, Livro $livro, $id)
    {
        $acao = 'Editar empréstimo';
        $status = ['Emprestado', 'Devolvido'];
        $alunos = $aluno->all();
        $livros = $livro->all();
        $emprestimo = $this->emprestimo->select('emprestimos.*','alunos.nome AS aluno_nome','alunos.sobrenome', 'livros.nome AS livro_nome','livros.editora', 'livros.isbn')
                            ->join('alunos', 'alunos.id', '=', 'emprestimos.id_aluno')
                            ->join('livros', 'livros.id', '=', 'emprestimos.id_livro')
                            ->where('emprestimos.id', $id)
                            ->get();

        return view('sistema.emprestimo.inserir-editar-emprestimo', compact('acao', 'status', 'alunos', 'livros', 'emprestimo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmprestimoFormRequest $request, $id)
    {
        $dadosForm = $request->all();
        $emprestimo = $this->emprestimo->find($id);
        
        $update = $emprestimo->update($dadosForm);

        if($update)
          return redirect()->route('rotaEmprestimo.index');
        else
          return redirect()->route('rotaEmprestimo.edit', $id)
                           ->with(['errors' => 'Falha ao editar']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $emprestimo = $this->emprestimo->find($id);
        $delete = $emprestimo->delete();

        if( $delete )
           return redirect()->route('rotaEmprestimo.index');
        else
          return redirect()->route('rotaEmprestimo.show', $id)
                           ->with(['errors' => 'Falha ao deletar']);
    }

    public function buscaEmprestimo(Request $request, Emprestimo $emprestimo)
    {
        
        $emprestimos = $this->emprestimo->select('emprestimos.*','alunos.nome AS aluno_nome','alunos.sobrenome', 'livros.nome AS livro_nome','livros.editora', 'livros.isbn')
                            ->join('alunos', 'alunos.id', '=', 'emprestimos.id_aluno')
                            ->join('livros', 'livros.id', '=', 'emprestimos.id_livro')
                            ->where('alunos.nome', 'like', '%'.$request->input('nome').'%')
                            ->paginate(4);
        return view('sistema.emprestimo.lista-emprestimo', compact('emprestimos'));
    }
}
