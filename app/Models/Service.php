<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $table = "services";
    protected $fillable = [];
    public function category(){
        return $this->belongsTo(ServiceCategory::class,'service_category_id','id');
    }
    public function users(){
        return $this->belongsToMany(User::class,'user_service');
    }
}
