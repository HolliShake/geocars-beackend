<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAccess extends Model
{
    use HasFactory;

    protected $table = 'user_access';
    protected $primaryKey = 'id';
    protected $timestamp = true;

    protected $fillable = [
        'role',
        'action',
        'user_id'
    ];
}
