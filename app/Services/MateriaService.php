<?php

namespace App\Services;

use App\Models\Materia;
use App\Models\Horario;
use Illuminate\Support\Facades\DB;
use Exception;

class MateriaService
{
    /**
     * Crea una nueva Materia y sus Horarios asociados.
     */
    public function createMateria(array $data): Materia
    {
        DB::beginTransaction();

        try {
            $materiaData = [
                'nombre' => $data['nombre'],
                'nivel' => $data['nivel'],
                'profesor_id' => $data['profesor_id'],
                'fecha_inicio' => $data['fecha_inicio'],
                'fecha_fin' => $data['fecha_fin'] ?? null,
                'activa' => isset($data['activa']) ? (bool) $data['activa'] : true,
            ];

            $materia = Materia::create($materiaData);

            // Crear los horarios asociados si existen
            if (!empty($data['horarios']) && is_array($data['horarios'])) {
                foreach ($data['horarios'] as $horarioData) {
                    $materia->horarios()->create([
                        'dia_semana' => $horarioData['dia_semana'],
                        'hora_inicio' => $horarioData['hora_inicio'],
                        'hora_fin' => $horarioData['hora_fin'],
                    ]);
                }
            }

            DB::commit();

            return $materia;

        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Actualiza una Materia existente y sincroniza sus Horarios.
     */
    public function updateMateria(Materia $materia, array $data): Materia
    {
        DB::beginTransaction();

        try {
            $materiaData = [
                'nombre' => $data['nombre'],
                'nivel' => $data['nivel'],
                'profesor_id' => $data['profesor_id'],
                'fecha_inicio' => $data['fecha_inicio'],
                'fecha_fin' => $data['fecha_fin'] ?? null,
                'activa' => isset($data['activa']) ? (bool) $data['activa'] : true,
            ];

            $materia->update($materiaData);

            // Sincronizar horarios: Borrar todos y recrear (estrategia sencilla y segura para Master-Detail)
            $materia->horarios()->delete();

            if (!empty($data['horarios']) && is_array($data['horarios'])) {
                foreach ($data['horarios'] as $horarioData) {
                    $materia->horarios()->create([
                        'dia_semana' => $horarioData['dia_semana'],
                        'hora_inicio' => $horarioData['hora_inicio'],
                        'hora_fin' => $horarioData['hora_fin'],
                    ]);
                }
            }

            DB::commit();

            return $materia;

        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Elimina una Materia (los horarios se borran automáticamente por OnDelete Cascade).
     */
    public function deleteMateria(Materia $materia): bool
    {
        return $materia->delete();
    }
}
