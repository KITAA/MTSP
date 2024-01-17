<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infaq extends Model
{
    use HasFactory;
    
    protected $fillable = [ 'email', 'donationAmount', 'status', 'session_id'];
}

