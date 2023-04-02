<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    public function estimates(){
        return $this->hasMany(Estimate::class);
    }

    public function receives(){
        return $this->hasMany(Rceive::class);
    }
}
