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
        'expense_type',
        'date_of_expense',
        'description',
        'created_by',
    ];

    // Casting attributes to appropriate types
    protected $casts = [
        'amount' => 'decimal:2',
    ];
}
