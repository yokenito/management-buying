<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    public function rceive(){
        return $this->belongsTo(Rceive::class);
    }

    public function person(){
        return $this->belongsTo(Person::class);
    }
}
