<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statement extends Model
{
    use HasFactory;
    protected $fillable = ['invoice_id', 'total_amount', 'paid_amount', 'balance'];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
