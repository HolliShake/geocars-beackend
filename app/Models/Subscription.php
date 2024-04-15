<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $table = 'subscription';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'description',
        'price',
        'max_cars',
        'is_analytics_enabled',
        'is_tracking_enabled',
        'is_search_priority',
        'tracking_interval_in_minutes',
    ];

    protected $casts = [
        'price' => 'double',
        'is_analytics_enabled' => 'boolean',
        'is_tracking_enabled' => 'boolean',
        'is_search_priority' => 'boolean',
    ];
}
