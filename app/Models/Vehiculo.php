<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // Añado


class Vehiculo extends Model
{
    //
    use HasFactory;
    protected $fillable = ['marca', 'modelo', 'matricula', 'combustible', 'estado', 'anho']; // Importante para el create/edit

    public static $combustibles = [
        'DI' => 'Diesel',
        'GA' => 'Gasolina',
        'EL' => 'Electrico'
    ];
    public static $estados = [
        'DI' => 'Disponible',
        'AL' => 'Alquilado',
        'TA' => 'Taller'
    ];
    public static $anhos = [
        '2021' => '2021',
        '2022' => '2022',
        '2023' => '2023'
    ];

}
