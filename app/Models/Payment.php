<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'event_type',
        'payload',
        'payload_id',
    ];

    protected $casts = [
        'payload' => 'array',
    ];
}
