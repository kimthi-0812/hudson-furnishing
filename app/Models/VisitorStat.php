<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorStat extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'total_visits',
        'unique_visits',
    ];

    protected $casts = [
        'date' => 'date',
        'total_visits' => 'integer',
        'unique_visits' => 'integer',
    ];
}
