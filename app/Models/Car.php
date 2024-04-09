<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $table = 'car';
    protected $primaryKey = 'id';
    protected $fillable = [
        'car_brand',
        'car_model',
        'car_year',
        'car_plate',
        'car_description',
        'car_features', // array|jsonlike
        'units_available',
        'units_left',
        'user_subscription_id'
    ];

    public function car_photo() {
        return $this->hasMany(CarPhoto::class);
    }
}
