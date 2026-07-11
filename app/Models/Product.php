<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [

        'name',

        'slug',

        'size',

        'category',

        'description',

        'price',

        'stock',

        'reorder_level',

        'image',

        'status',

    ];

        public function category()
    {
        return $this->belongsTo(Category::class);
    }

        public function stock()
    {
        return $this->hasOne(Stock::class);
    }

        protected static function booted()
    {
        static::created(function ($product) {
            $product->stock()->create([
                'quantity' => 0,
                'reorder_level' => 50
            ]);
        });
    }
}
