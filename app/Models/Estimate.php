<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Estimate extends Model
{
    use HasFactory, Sortable;

    public function person(){
        return $this->belongsTo(Person::class);
    }

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function estimatedetails(){
        return $this->hasMany(Estimatedetail::class);
    }

    public function receives(){
        return $this->hasMany(Rceive::class);
    }
}
