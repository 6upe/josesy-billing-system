<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    protected $fillable = [
        'client_id',
        'date',
        'status',
        'tax_type',
        'tax_amount',
        'total',
        'grand_total',
        'created_by',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_quotation')
                    ->withPivot('quantity', 'total_amount');
    }
}
