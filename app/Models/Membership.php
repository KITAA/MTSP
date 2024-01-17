<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'fullname',
        'email',
        'ic',
        'address',
        'phone',
        'emergency_no',
        'status',
        'membershipDuration',
    ];

    public function tanggungan()
    {
        return $this->hasMany(Tanggungan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }
}
