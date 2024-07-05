<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
    
    public function plates()
    {
        return $this->belongsToMany(Plate::class, 'order_plate', 'order_id', 'plate_id')->withPivot('quantity', 'price');
    }
}

