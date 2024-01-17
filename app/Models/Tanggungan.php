<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tanggungan extends Model
{
    use HasFactory;

    protected $fillable = [
        'membership_id',
        'fullname',
        'ic',
        'relationship',
    ];

    public function membership()
    {
        return $this->belongsTo(Membership::class);
    }
}
