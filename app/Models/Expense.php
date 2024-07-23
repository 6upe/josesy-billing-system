<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_name',
        'supplier_contact',
        'supporting_documents',
        'products_purchased',
        'amount',
        'unit_price',
        'quantity',
        'expense_type',
        'date_of_expense',
        'description',
        'approval_status',
    ];

    // Casting attributes to appropriate types
    protected $casts = [
        'amount' => 'decimal:2',
        'unit_price' => 'decimal:2',
        'quantity' => 'integer',
    ];
}
