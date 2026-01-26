<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    //
    static $cods_genero = [
         '' => ''
        ,'NV' => 'Novela'
        ,'SP' => 'Suspense'
    ];
}
