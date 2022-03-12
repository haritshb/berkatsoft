<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\SalesOrder;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'address',
        'phone'
    ]; 

    public function sales_order()
    {
    	return $this->belongsTo(SalesOrder::class, 'sales_order');
    }
}
