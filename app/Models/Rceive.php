<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rceive extends Model
{
    use HasFactory;

    public function person(){
        return $this->belongsTo(Person::class);
    }

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function receivedetails(){
        return $this->hasMany(Receivedetail::class);
    }

    public function estimate(){
        return $this->belongsTo(Estimate::class);
    }

    public function bills(){
        return $this->hasMany(Bill::class);
    }
}
