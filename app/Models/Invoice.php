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
        'paid_amount',
        'balance',
        'discount',
        'total_amount',
        'comment',
        'created_by',
    ];

    public function quotation()
    {
        return $this->belongsTo(Quotation::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function products()
    {
        return $this->quotation->products();
    }

    
}
