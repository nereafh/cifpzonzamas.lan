<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    //
    static $cods_genero = [
        ''   => '',
        'NV' => 'Novela',
        'SP' => 'Suspense',
        'FA' => 'Fantasía',        // <--- FALTABA ESTE
        'RM' => 'Realismo mágico', // <--- FALTABA ESTE
        'CF' => 'Ciencia ficción', // <--- FALTABA ESTE
        'NC' => 'Novela clásica',  // <--- FALTABA ESTE
        'FS' => 'Ficción social'   // <--- FALTABA ESTE
    ];
}
