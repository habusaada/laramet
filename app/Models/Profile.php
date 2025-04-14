<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    /** @use HasFactory<\Database\Factories\ProfileFactory> */
    use HasFactory;
    protected $casts = [
        'last_login' => 'datetime',
        'notification_preferences' => 'array',
    ];
    protected $fillable = [
        'user_id',
        'profile_id',
        'phone_number',
        'company_name',
        'company_location',
        'job_title',
        'date_of_birth',
        'gender',
        'profile_image',
        'address',
        'timezone',
        'bio',
        'notification_preferences',
        'status',
        'rejection_reason',
        'is_active',
        'last_login_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
