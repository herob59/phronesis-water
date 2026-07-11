<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'invoice_no',
        'customer_name',
        'payment_method',
        'grand_total'
    ];

    public function items()
    {
        return $this->hasMany(SaleItem::class);
    }
}
