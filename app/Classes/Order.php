<?php

namespace App\Classes;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Order extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItems::class);
    }

}
