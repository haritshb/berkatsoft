<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\SalesOrder;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'description',
        'price'
    ]; 

    public function sales_order()
    {
    	return $this->belongsTo(SalesOrder::class, 'sales_order');
    }
}
