<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarPosting extends Model
{
    use HasFactory;
    protected $table = 'car_posting';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'car_id',
        'price',
        'excess_charges',
        'days',
        'post_date',
        'expiry_date',
        'never_expires'
    ];

    protected $casts = [
        'never_expires' => 'boolean',
        'post_date' => 'datetime',
        'expiry_date' => 'datetime',
        'price' => 'double',
        'excess_charges' => 'double',
    ];

    public function car() {
        return $this->belongsTo(Car::class);
    }
}
