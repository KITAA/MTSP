<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'membership_id',
        'payment_id',
        'membership_type',
        'status',
        'method',
        'price',
        'currency',
        'name',
        'email',
    ];

    public function membership()
    {
        return $this->belongsTo(Membership::class);
    }
}
