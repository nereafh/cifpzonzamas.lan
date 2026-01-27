<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Libro;

class LibroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // MUY IMPORTANTE: Limpiar la tabla antes de empezar para que no queden restos
        DB::table('libros')->truncate();

        DB::table('libros')->insert([
            [
                'titulo'    => 'Harry Potter y la piedra filosofal',
                'autor'     => 'JK Rowling',
                'anho'      => '2021',
                'genero'    => 'FA',
                'descripcion' => 'La piedra filosofal',
                'created_at' => now(), // AÑADE ESTO
                'updated_at' => now()  // AÑADE ESTO
            ],
            [
                'titulo'    => 'El señor de los anillos',
                'autor'     => 'J.R.R. Tolkien',
                'anho'      => '2018',
                'genero'    => 'FA',
                'descripcion' => 'La comunidad del anillo',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'titulo'    => 'Cien años de soledad',
                'autor'     => 'Gabriel García Márquez',
                'anho'      => '2020',
                'genero'    => 'RM',
                'descripcion' => 'Una saga familiar en Macondo',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'titulo'    => '1984',
                'autor'     => 'George Orwell',
                'anho'      => '2022',
                'genero'    => 'CF',
                'descripcion' => 'Una distopía totalitaria',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'titulo'    => 'Don Quijote de la Mancha',
                'autor'     => 'Miguel de Cervantes',
                'anho'      => '2017',
                'genero'    => 'NC',
                'descripcion' => 'Las AVs de un caballero loco',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'titulo'    => 'Matar a un ruiseñor',
                'autor'     => 'Harper Lee',
                'anho'      => '2024',
                'genero'    => 'FS',
                'descripcion' => 'Un juicio en el sur de Estados Unidos',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
