<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'type', 'price', 'description'
    ];

    
    public function quotations()
    {
        return $this->belongsToMany(Quotation::class, 'product_quotation')
                    ->withPivot('quantity', 'total_amount');
    }
}
