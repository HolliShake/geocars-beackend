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
        'car_features',
    ];
}
