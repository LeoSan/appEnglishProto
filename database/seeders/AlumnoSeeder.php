<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Alumno;
use App\Models\Materia;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class AlumnoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('es_ES');
        $niveles = ['a1', 'a2', 'b1', 'b2', 'c1', 'c2'];
        $generos = ['Hombre', 'Mujer', 'Otro'];

        // Get all active materias to randomly assign them
        $materias = Materia::where('activa', true)->get();

        for ($i = 0; $i < 10; $i++) {
            $nombre = $faker->firstName;
            $apellidos = $faker->lastName . ' ' . $faker->lastName;
            $matricula = 'ALU' . date('Y') . str_pad($faker->unique()->numberBetween(1, 9999), 4, '0', STR_PAD_LEFT);
            
            $user = User::create([
                'name' => $nombre . ' ' . $apellidos,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make($matricula),
                'role' => 'alumno',
            ]);

            $alumno = Alumno::create([
                'user_id' => $user->id,
                'matricula' => $matricula,
                'nombre' => $nombre,
                'apellidos' => $apellidos,
                'nivel' => $faker->randomElement($niveles),
                'genero' => $faker->randomElement($generos),
                'fecha_nacimiento' => $faker->date('Y-m-d', '-15 years'),
                'telefono' => $faker->numerify('##########'),
                'direccion' => $faker->address,
                'fecha_inscripcion' => now(),
                'activo' => true,
            ]);

            // Assign 1 to 3 random materias if any exist
            if ($materias->count() > 0) {
                $alumno->materias()->attach(
                    $materias->random(rand(1, min(3, $materias->count())))->pluck('id')->toArray()
                );
            }
        }
    }
}
