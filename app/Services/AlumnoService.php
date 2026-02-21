<?php

namespace App\Services;

use App\Models\Alumno;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Exception;

class AlumnoService
{
    /**
     * Create a new Alumno and its associated User.
     *
     * @param array $data
     * @return Alumno
     * @throws Exception
     */
    public function createAlumno(array $data): Alumno
    {
        DB::beginTransaction();
        try {
            // 1. Crear usuario
            $user = User::create([
                'name' => $data['nombre'] . ' ' . $data['apellidos'],
                'email' => $data['email'],
                'password' => Hash::make($data['matricula']), // Contraseña por defecto: matrícula
                'role' => 'alumno',
            ]);

            // 2. Crear alumno
            $activo = isset($data['activo']) ? ($data['activo'] == true || $data['activo'] == 1) : false;

            $alumno = Alumno::create([
                'user_id' => $user->id,
                'profesor_id' => $data['profesor_id'] ?? null,
                'matricula' => $data['matricula'],
                'nombre' => $data['nombre'],
                'apellidos' => $data['apellidos'],
                'nivel' => $data['nivel'],
                'genero' => $data['genero'] ?? null,
                'fecha_nacimiento' => $data['fecha_nacimiento'] ?? null,
                'telefono' => $data['telefono'] ?? null,
                'direccion' => $data['direccion'] ?? null,
                'fecha_inscripcion' => $data['fecha_inscripcion'] ?? null,
                'activo' => $activo,
            ]);

            DB::commit();

            return $alumno;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Update an existing Alumno and its associated User.
     *
     * @param Alumno $alumno
     * @param array $data
     * @return Alumno
     * @throws Exception
     */
    public function updateAlumno(Alumno $alumno, array $data): Alumno
    {
        DB::beginTransaction();
        try {
            // Actualizar usuario
            if ($alumno->user) {
                $alumno->user->update([
                    'name' => $data['nombre'] . ' ' . $data['apellidos'],
                    'email' => $data['email'],
                ]);
            }

            // Actualizar alumno
            $activo = isset($data['activo']) ? ($data['activo'] == true || $data['activo'] == 1) : false;

            $alumno->update([
                'profesor_id' => $data['profesor_id'] ?? null,
                'matricula' => $data['matricula'],
                'nombre' => $data['nombre'],
                'apellidos' => $data['apellidos'],
                'nivel' => $data['nivel'],
                'genero' => $data['genero'] ?? null,
                'fecha_nacimiento' => $data['fecha_nacimiento'] ?? null,
                'telefono' => $data['telefono'] ?? null,
                'direccion' => $data['direccion'] ?? null,
                'fecha_inscripcion' => $data['fecha_inscripcion'] ?? null,
                'activo' => $activo,
            ]);

            DB::commit();

            return $alumno;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Delete an Alumno and its associated User if not admin.
     *
     * @param Alumno $alumno
     * @return bool
     * @throws Exception
     */
    public function deleteAlumno(Alumno $alumno): bool
    {
        DB::beginTransaction();
        try {
            $user = $alumno->user;
            $alumno->delete();
            
            if ($user && $user->role !== 'admin') {
                $user->delete();
            }

            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
