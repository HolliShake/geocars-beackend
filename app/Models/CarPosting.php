<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarPosting extends Model
{
    use HasFactory;
    protected $table = 'car_posting';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'car_id',
        'price',
        'excess_charges',
        'days',
        'post_date',
        'expiry_date',
        'never_expires'
    ];

    public function car() {
        return $this->belongsTo(Car::class);
    }
}
