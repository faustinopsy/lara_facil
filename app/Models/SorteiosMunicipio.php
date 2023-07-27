<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SorteiosMunicipio extends Model
{
    use HasFactory;

    protected $fillable = ['data', 'municipio', 'uf', 'concurso'];
}
