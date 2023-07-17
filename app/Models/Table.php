<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;
    protected $guarded =[];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function scopeSelection()
    {
        return $this->select(['id' , 'capacity']);
    }
}
