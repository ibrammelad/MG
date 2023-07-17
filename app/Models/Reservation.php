<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $guarded =[];

    public function table()
    {
        return $this->belongsTo(Table::class , 'table_id' , 'id');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class , 'customer_id' , 'id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
