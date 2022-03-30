<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $casts = [
        'paid' => 'boolean',
    ];

    public function shipment()
    {
        return $this->belongsToMany(Shipment::class,'shipment_orders');
    }
}
