<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;
    protected $table = 'sales';
    protected $fillable = ['code_sale', 'date_sale', 'customer_id', 'subtotal', 'discount', 'shipping_cost', 'total_payment'];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
    public function salesDet()
    {
        return $this->hasMany(SalesDet::class, 'sale_id', 'id');
    }
}
