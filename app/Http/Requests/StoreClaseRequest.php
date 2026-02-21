<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'materia_id' => 'required|exists:materias,id',
            'nivel' => 'required|in:a1,a2,b1,b2,c1,c2',
            'etiqueta' => 'nullable|string|max:50',
            'titulo' => 'required|string|max:255',
            'contenido' => 'nullable|string',
            
            // Validación de elementos Multimedia anidados
            'multimedia' => 'nullable|array',
            'multimedia.*.titulo' => 'required_with:multimedia.*.url|string|max:255',
            'multimedia.*.url' => 'required_with:multimedia.*.titulo|url|max:255',
            'multimedia.*.descripcion' => 'nullable|string',
            'multimedia.*.tipo' => 'nullable|string|max:50',
        ];
    }

    /**
     * Custom error messages for nested arrays
     */
    public function messages(): array
    {
        return [
            'multimedia.*.titulo.required_with' => 'El título del recurso multimedia es requerido si se proporcionó un enlace.',
            'multimedia.*.url.required_with' => 'El enlace del recurso multimedia es requerido si se proporcionó un título.',
            'multimedia.*.url.url' => 'El formato del enlace multimedia no es válido.',
        ];
    }
}
