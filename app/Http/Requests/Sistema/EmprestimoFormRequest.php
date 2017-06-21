<?php

namespace App\Http\Requests\Sistema;

use Illuminate\Foundation\Http\FormRequest;

class EmprestimoFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
          return [
             'id_livro'     => 'required'
           , 'id_aluno'     => 'required'
           , 'dt_emprestimo' => 'required'
           , 'dt_devolucao'  => 'required'
           , 'status'    => 'required'           
        ];
    }

    public function messages() 
    {
        return [
                'id_livro.required'      => 'O campo Livro é de preenchimento obrigatório'
              , 'id_aluno.required'      => 'O campo Aluno é de preenchimento obrigatório'
              , 'dt_emprestimo.required' => 'O Campo Data empréstimo é de preenchimento obrigatório'
              , 'dt_devolucao.required' => 'O Campo Data devolução é de preenchimento obrigatório'
              , 'status.required' => 'O Campo Status empréstimo é de preenchimento obrigatório'
          ];
    }
}