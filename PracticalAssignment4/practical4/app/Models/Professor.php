<?php
//2. Crear el modelo Professor
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstName',
        'lastName',
        'city',
        'address',
        'salary'
    ];
}