<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMateriaRequest extends FormRequest
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
            'nombre' => 'required|string|max:255',
            'nivel' => 'required|in:a1,a2,b1,b2,c1,c2',
            'profesor_id' => 'required|exists:profesors,id',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'activa' => 'boolean',
            'horarios' => 'nullable|array',
            'horarios.*.dia_semana' => 'required_with:horarios|string',
            'horarios.*.hora_inicio' => 'required_with:horarios|date_format:H:i',
            'horarios.*.hora_fin' => 'required_with:horarios|date_format:H:i|after:horarios.*.hora_inicio',
        ];
    }
}
