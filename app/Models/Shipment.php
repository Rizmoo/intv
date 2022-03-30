<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function fleet()
    {
        return $this->belongsTo(Fleet::class);
    }


    public function Order()
    {
        return $this->belongsToMany(Order::class, 'shipment_orders');
    }
}
