<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfesorRequest extends FormRequest
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
        $profesor = $this->route('profesore'); // Note: standard Laravel resource uses plural for parameter name, but it depends on Route::resource registration. Let's check. Default is lowercase model name -> 'profesore'

        return [
            'email' => 'required|email|unique:users,email,' . ($profesor->user_id ?? ''),
            'numero_empleado' => 'required|string|unique:profesors,numero_empleado,' . ($profesor->id ?? ''),
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'tipo_identificacion' => 'nullable|string|max:50',
            'num_identificacion' => 'nullable|string|max:50',
            'especialidad' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'url_foto' => 'nullable|url|max:255',
            'fecha_contratacion' => 'nullable|date',
            'activo' => 'boolean',
        ];
    }
}
