<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = "orders";
    protected $fillable = [
        'service_id',
        'user_id',
        'sprovider_id',
        'order_code',
        'lat',
        'lon',
        'country',
        'city',
        'state',
        'street',
        'suburb',
        'postcode',
        'time',
        'details',
        'status',
        'image',
    ];
    public function service(){
        return $this->belongsTo(Service::class,'service_id','id');
    }
}
