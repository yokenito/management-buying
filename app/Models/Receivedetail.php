<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receivedetail extends Model
{
    use HasFactory;

    public function receive(){
        return $this->belongsTo(Estimate::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
