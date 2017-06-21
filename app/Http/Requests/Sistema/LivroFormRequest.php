<?php

namespace App\Http\Requests\Sistema;

use Illuminate\Foundation\Http\FormRequest;

class LivroFormRequest extends FormRequest
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
             'nome'      => 'required|min:3|max:100'
           , 'isbn'      => 'required'
           , 'categoria' => 'required'
           , 'autor'     => 'required'
           , 'editora'   => 'required'
           , 'pais'      => 'required'
           , 'ano'       => 'required'
        
        ];
    }

    public function messages() 
    {
        return [
                'nome.required'      => 'O campo Nome é de preenchimento obrigatório'
              , 'isbn.required'      => 'O campo ISBN é de preenchimento obrigatório'
              , 'categoria.required' => 'O Campo Categoria é de preenchimento obrigatório'
          ];
    }
}
