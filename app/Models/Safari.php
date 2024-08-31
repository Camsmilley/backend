<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Safari extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'min_guests',
        'time_estimate',
        'location',
        'price',
        'image',
        'description',
        'inclusions',
        'exclusions',
        'additional_info',
    ];
}