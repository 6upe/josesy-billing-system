<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['invoice_id', 'amount', 'created_by',];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function receipt()
    {
        return $this->hasOne(Receipt::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
