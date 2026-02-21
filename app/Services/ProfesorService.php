<?php

namespace App\Services;

use App\Models\Profesor;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Exception;

class ProfesorService
{
    /**
     * Create a new Profesor and its associated User.
     *
     * @param array $data
     * @return Profesor
     * @throws Exception
     */
    public function createProfesor(array $data): Profesor
    {
        DB::beginTransaction();
        try {
            // 1. Crear usuario: email y password por defecto es el numero de empleado
            $user = User::create([
                'name' => $data['nombre'] . ' ' . $data['apellidos'],
                'email' => $data['email'],
                'password' => Hash::make($data['numero_empleado']),
                'role' => 'profesor',
            ]);

            // 2. Crear profesor
            $activo = isset($data['activo']) ? ($data['activo'] == true || $data['activo'] == 1) : false;

            $profesor = Profesor::create([
                'user_id' => $user->id,
                'numero_empleado' => $data['numero_empleado'],
                'nombre' => $data['nombre'],
                'apellidos' => $data['apellidos'],
                'tipo_identificacion' => $data['tipo_identificacion'] ?? null,
                'num_identificacion' => $data['num_identificacion'] ?? null,
                'especialidad' => $data['especialidad'] ?? null,
                'telefono' => $data['telefono'] ?? null,
                'url_foto' => $data['url_foto'] ?? null,
                'fecha_contratacion' => $data['fecha_contratacion'] ?? null,
                'activo' => $activo,
            ]);

            DB::commit();

            return $profesor;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Update an existing Profesor and its associated User.
     *
     * @param Profesor $profesor
     * @param array $data
     * @return Profesor
     * @throws Exception
     */
    public function updateProfesor(Profesor $profesor, array $data): Profesor
    {
        DB::beginTransaction();
        try {
            // Actualizar usuario asociado si existe
            if ($profesor->user) {
                $profesor->user->update([
                    'name' => $data['nombre'] . ' ' . $data['apellidos'],
                    'email' => $data['email'],
                ]);
            }

            // Actualizar profesor
            $activo = isset($data['activo']) ? ($data['activo'] == true || $data['activo'] == 1) : false;

            $profesor->update([
                'numero_empleado' => $data['numero_empleado'],
                'nombre' => $data['nombre'],
                'apellidos' => $data['apellidos'],
                'tipo_identificacion' => $data['tipo_identificacion'] ?? null,
                'num_identificacion' => $data['num_identificacion'] ?? null,
                'especialidad' => $data['especialidad'] ?? null,
                'telefono' => $data['telefono'] ?? null,
                'url_foto' => $data['url_foto'] ?? null,
                'fecha_contratacion' => $data['fecha_contratacion'] ?? null,
                'activo' => $activo,
            ]);

            DB::commit();

            return $profesor;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Delete a Profesor and its associated User if it's not an admin.
     *
     * @param Profesor $profesor
     * @return bool
     * @throws Exception
     */
    public function deleteProfesor(Profesor $profesor): bool
    {
        DB::beginTransaction();
        try {
            $user = $profesor->user;
            
            // Si el profesor tiene clases asignadas, podríamos evitar la eliminación o poner en null,
            // pero por defecto Laravel restringe por Foreign Keys si Cascade no está configurado.
            // Asumiremos que Cascade Delete está configurado o lo manejamos manualmente si fuera necesario.
            
            $profesor->delete();
            
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
