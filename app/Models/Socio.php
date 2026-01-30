<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // Añade esta

class Socio extends Model {
    use HasFactory;
    protected $fillable = ['nombre', 'dni', 'edad', 'categoria', 'iban']; // Importante para el create/edit

    public static $categorias = [
        'PL' => 'Plata',
        'OR' => 'Oro',
        'PR' => 'Premium'
    ];
}