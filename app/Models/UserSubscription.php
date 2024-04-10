<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSubscription extends Model
{
    use HasFactory;
    protected $table = 'user_subscription';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'subscription_id',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    function subscription() {
        return $this->belongsTo(Subscription::class);
    }

    static
    function canAddCar($user_id) {
        return
    }
}
