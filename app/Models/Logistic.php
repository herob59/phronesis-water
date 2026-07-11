<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logistic extends Model
{
    protected $fillable = [
        'driver',
        'vehicle',
        'destination',
        'delivery_date',
        'status'
    ];
}