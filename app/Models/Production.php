<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Production extends Model
{
    protected $table = 'production';

    protected $fillable = [
          
            'product_id',
            'quantity',
            'created_at'
          

    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
