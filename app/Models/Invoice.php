<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'quotation_id',
        'date',
        'due_date',
        'status',
        'total_amount',
        'paid_amount',
        'balance',
        'discount',
        'comment',
    ];

    public function quotation()
    {
        return $this->belongsTo(Quotation::class);
    }

    public function products()
    {
        return $this->quotation->products();
    }
}