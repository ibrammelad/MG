<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function table()
    {
        return $this->belongsTo(Table::class , 'table_id');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class , 'customer_id');
    }

    public function reservation()
    {
        return $this->belongsTo(Reservation::class , 'reservation_id');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
