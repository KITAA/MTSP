<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aktiviti extends Model
{
    use HasFactory;

    protected $fillable = [
        'tajuk_aktiviti',
        'gambar_aktiviti',
        'tarikh_aktiviti',
        'masa_mula',
        'masa_tamat',
        'tempat_aktiviti',
        'deskripsi_aktiviti',
        'user_id',
    ];

    protected $casts = [
        'tarikh_aktiviti' => 'date',
    ];
}
