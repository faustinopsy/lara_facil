<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lotofacil extends Model
{
    use HasFactory;

    protected $fillable = ['Concurso', 'B1', 'B2', 'B3', 'B4', 'B5', 'B6', 'B7', 'B8', 'B9', 'B10', 'B11', 'B12', 'B13', 'B14', 'B15', 'data', 'acumulado'];

    public function getNumbers()
    {
        $numbers = [];
    
        for ($i = 1; $i <= 15; $i++) {
            $numbers[] = $this["B$i"];
        }
    
        return $numbers;
    }
    
}
