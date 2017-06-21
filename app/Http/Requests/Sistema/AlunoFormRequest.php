<?php

namespace App\Http\Requests\Sistema;

use Illuminate\Foundation\Http\FormRequest;

class AlunoFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // deixar como true
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    /* Aqui ficaram as regras de validação, quais campos devem ser requeridos e tal...*/
    public function rules()
    {
        return [
             'nome'          => 'required|min:3|max:100'
           , 'sobrenome'     => 'required|min:3|max:100'
           , 'dt_nascimento' => 'required'
           , 'cpf'           => 'required'
           , 'rua'           => 'required'
           , 'numero'        => 'required'
           , 'bairro'        => 'required'
           , 'cep'           => 'required|max:100'
           , 'cidade'        => 'required'
           , 'estado'        => 'required'
           , 'email'         => 'required'
        ];
    }
    
    /* Método criado para personalizar as mensagens de erro */
    public function messages() 
    {
        return [
                'nome.required'       => 'O campo Nome é de preenchimento obrigatório'
              , 'sobrenome.required'  => 'O campo Sobrenome é de preenchimento obrigatório'
              , 'dt_nascimento.required' => 'O Campo Nascimento é de preenchimento obrigatório'
          ];
    }

}
