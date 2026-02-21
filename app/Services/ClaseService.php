<?php

namespace App\Services;

use App\Models\Clase;
use App\Models\Multimedia;
use Illuminate\Support\Facades\DB;
use Exception;

class ClaseService
{
    /**
     * Create a new Clase and its associated Multimedia records.
     *
     * @param array $data
     * @return Clase
     * @throws Exception
     */
    public function createClase(array $data): Clase
    {
        DB::beginTransaction();
        try {
            // 1. Crear la Clase (Maestro)
            $clase = Clase::create([
                'profesor_id' => $data['profesor_id'],
                'nivel' => $data['nivel'],
                'etiqueta' => $data['etiqueta'] ?? null,
                'titulo' => $data['titulo'],
                'contenido' => $data['contenido'],
            ]);

            // 2. Crear los registros Multimedia (Detalle) si existen
            if (!empty($data['multimedia']) && is_array($data['multimedia'])) {
                foreach ($data['multimedia'] as $mediaItem) {
                    if (!empty($mediaItem['url']) && !empty($mediaItem['titulo'])) {
                        Multimedia::create([
                            'clase_id' => $clase->id,
                            'titulo' => $mediaItem['titulo'],
                            'descripcion' => $mediaItem['descripcion'] ?? null,
                            'tipo' => $mediaItem['tipo'] ?? 'enlace',
                            'url' => $mediaItem['url'],
                        ]);
                    }
                }
            }

            DB::commit();

            return $clase;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Update an existing Clase and its associated Multimedia records.
     *
     * @param Clase $clase
     * @param array $data
     * @return Clase
     * @throws Exception
     */
    public function updateClase(Clase $clase, array $data): Clase
    {
        DB::beginTransaction();
        try {
            // 1. Actualizar la Clase (Maestro)
            $clase->update([
                'profesor_id' => $data['profesor_id'],
                'nivel' => $data['nivel'],
                'etiqueta' => $data['etiqueta'] ?? null,
                'titulo' => $data['titulo'],
                'contenido' => $data['contenido'],
            ]);

            // 2. Gestionar los registros Multimedia (Sincronización manual simple)
            // Una estrategia común en frontend dinámico es borrar los existentes e insertar los nuevos
            // que vinieron en el request (o sincronizar por IDs, pero borrar e insertar es más seguro y atómico 
            // para colecciones pequeñas sin historial crítico individual).
            
            $clase->multimedias()->delete(); // Borramos todos los anteriores

            // Insertamos los nuevos/actualizados
            if (!empty($data['multimedia']) && is_array($data['multimedia'])) {
                foreach ($data['multimedia'] as $mediaItem) {
                    if (!empty($mediaItem['url']) && !empty($mediaItem['titulo'])) {
                        Multimedia::create([
                            'clase_id' => $clase->id,
                            'titulo' => $mediaItem['titulo'],
                            'descripcion' => $mediaItem['descripcion'] ?? null,
                            'tipo' => $mediaItem['tipo'] ?? 'enlace',
                            'url' => $mediaItem['url'],
                        ]);
                    }
                }
            }

            DB::commit();

            return $clase;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Delete a Clase (Cascade will delete Multimedia if set, or we do it manually).
     *
     * @param Clase $clase
     * @return bool
     * @throws Exception
     */
    public function deleteClase(Clase $clase): bool
    {
        DB::beginTransaction();
        try {
            // Eliminar dependencias primero de forma explícita por seguridad si no hay CASCADE en BD
            $clase->multimedias()->delete();
            
            // Eliminar la clase base
            $clase->delete();

            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
