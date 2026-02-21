<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Profesor;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class ProfesorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('es_ES');
        $tipos_identificacion = ['cedula', 'pasaporte', 'carnet', 'permiso'];

        for ($i = 0; $i < 3; $i++) {
            $nombre = $faker->firstName;
            $apellidos = $faker->lastName . ' ' . $faker->lastName;
            $numero_empleado = 'EMP' . date('Y') . str_pad($faker->unique()->numberBetween(1, 9999), 4, '0', STR_PAD_LEFT);
            
            $user = User::create([
                'name' => $nombre . ' ' . $apellidos,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make($numero_empleado),
                'role' => 'profesor',
            ]);

            Profesor::create([
                'user_id' => $user->id,
                'numero_empleado' => $numero_empleado,
                'nombre' => $nombre,
                'apellidos' => $apellidos,
                'tipo_identificacion' => $faker->randomElement($tipos_identificacion),
                'num_identificacion' => $faker->unique()->numerify('########'),
                'especialidad' => $faker->randomElement(['Gramática', 'Conversación', 'Preparación TOEFL', 'Inglés Técnico', 'Inglés para Negocios']),
                'telefono' => $faker->numerify('##########'),
                'url_foto' => null, // Omitiendo foto por simplicidad
                'fecha_contratacion' => $faker->date('Y-m-d', 'now'),
                'activo' => true,
            ]);
        }
    }
}
