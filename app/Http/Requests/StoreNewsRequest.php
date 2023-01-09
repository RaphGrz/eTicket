<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewsRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
                'title' => ['required', 'max:100'],
                'content' => ['required'],
                'date' => ['required', 'date']
            ];
    }
    
    public function messages()
    {
        return [
                'title.required' => 'Il faut spécifier un titre',
                'title.max' => 'Le titre ne doit pas contenir plus de 100 caractères',
                'content.required' => 'Il faut spécifier un contenu',
                'date.required' => 'Il faut spécifier une date',
                'date.date' => 'Le format de la date est incorrect'
            ];
    }

    public function attributes()
    {
        return [
                'title' => 'titre',
                'content' => 'content',
                'date' => 'date'  
            ];
    }

}
