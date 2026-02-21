<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAlumnoRequest extends FormRequest
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
        // Recuperamos el ID del alumno de la ruta para ignorarlo en el unique
        $alumno = $this->route('alumno');

        return [
            'email' => 'required|email|unique:users,email,' . ($alumno->user_id ?? ''),
            'matricula' => 'required|string|unique:alumnos,matricula,' . ($alumno->id ?? ''),
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'nivel' => 'required|in:a1,a2,b1,b2,c1,c2',
            'genero' => 'nullable|string|max:20',
            'fecha_nacimiento' => 'nullable|date',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string',
            'fecha_inscripcion' => 'nullable|date',
            'profesor_id' => 'nullable|exists:profesors,id',
            'activo' => 'boolean',
        ];
    }
}
