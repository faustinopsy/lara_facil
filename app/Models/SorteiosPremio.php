<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SorteiosPremio extends Model
{
    use HasFactory;

    protected $fillable = ['descricaoFaixa', 'numeroDeGanhadores', 'valorPremio', 'concurso'];
}
