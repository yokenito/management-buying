<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    public function estimates(){
        return $this->hasMany(Estimate::class);
    }

    public function receives(){
        return $this->hasMany(Rceive::class);
    }

    public function bills(){
        return $this->hasMany(Bill::class);
    }
}
