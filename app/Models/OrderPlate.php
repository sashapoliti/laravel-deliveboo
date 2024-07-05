<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\Plate;
use Illuminate\Database\Eloquent\Relations\Pivot; 

class OrderPlate extends Pivot
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'plate_id',
        'quantity',
        'price',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function plate()
    {
        return $this->belongsTo(Plate::class);
    }

}
