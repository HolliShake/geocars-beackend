<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarPhoto extends Model
{
    use HasFactory;
    protected $table = 'car_photo';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'path',
        'file',
        'extension',
        'car_id'
    ];
}
