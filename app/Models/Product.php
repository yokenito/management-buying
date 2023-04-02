<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function estimatedetails(){
        return $this->hasMany(Estimatedetail::class);
    }

    public function receivedetails(){
        return $this->hasMany(Receivedetail::class);
    }
}
