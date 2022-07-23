<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesDet extends Model
{
    use HasFactory;
    protected $fillable = ['sale_id', 'item_id', 'price_tag', 'quantity', 'discount_percentage', 'discount_value', 'discount_price', 'total_amount'];
}
