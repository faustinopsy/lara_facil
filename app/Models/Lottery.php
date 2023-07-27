<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Lottery extends Model
{
    use HasFactory;
    public function user()
{
    return $this->belongsTo(User::class);
}
public function delete()
{
    if (Auth::id() != $this->user_id) {
        return false; 
    }

    return parent::delete();
}
}
