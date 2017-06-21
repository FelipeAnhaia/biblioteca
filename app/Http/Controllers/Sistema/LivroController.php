<?php

namespace App\Http\Controllers\Sistema;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Livro;
use App\Http\Requests\Sistema\LivroFormRequest;

class LivroController extends Controller
{
    
    public function __construct(Livro $livro) {
        $this->livro = $livro;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Livro $livro)
    {
        //$livros = $this->livro->all(); 
        $livros = $this->livro->paginate(4);
        return view('sistema.livro.lista-livro', compact('livros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $acao = 'Cadastrar aluno';
        $categorias = ['Científico', 'Crônica', 'Didático', 'Bibliográfico', 'Horror'];
        return view('sistema.livro.inserir-editar-livro', compact('acao', 'categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LivroFormRequest $request)
    {
        $dadosForm = $request->all();
        $insert = $this->livro->create($dadosForm);

        if( $insert ){
          return redirect()->route('rotaLivro.index');
        } else {
          return redirect()->route('rotaLivro.create');
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
        $livro = $this->livro->find($id);
        return view('sistema.livro.visualiza-livro', compact('livro'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $acao = 'Editar livro';
        $livro = $this->livro->find($id);
        $categorias = ['Científico', 'Crônica', 'Didático', 'Bibliográfico', 'Horror'];
        return view('sistema.livro.inserir-editar-livro', compact('acao','livro', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LivroFormRequest $request, $id)
    {
        $dadosForm = $request->all();
        $livro = $this->livro->find($id);
        
        $update = $livro->update($dadosForm);

        if($update)
          return redirect()->route('rotaLivro.index');
        else
          return redirect()->route('rotaLivro.edit', $id)
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
        $livro = $this->livro->find($id);
        $delete = $livro->delete();

        if( $delete )
           return redirect()->route('rotaLivro.index');
        else
          return redirect()->route('rotaLivro.show', $id)
                           ->with(['errors' => 'Falha ao deletar']);
    }

    public function buscaLivro(Request $request, Livro $livro)
    {
        $livros = $this->livro->where('nome', 'like', '%'.$request->input('nome').'%')->paginate(4);
        return view('sistema.livro.lista-livro', compact('livros'));
    }
}
