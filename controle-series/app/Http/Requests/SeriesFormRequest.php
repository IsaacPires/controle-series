<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeriesFormRequest extends FormRequest
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
            'name' => ['required', 'min:3'],
                ];
    }

    public function messages()
    {
        return [
            
            //a chave name.* contemplaria uma mensagem de erro generica
            //para pegar ela de forma geral
            'name.required' => 'O nome da série é obrigatório.',
            'name.min'      => 'O nome deve conter no mínimo1 :min letras.',

        ];
    }
}
