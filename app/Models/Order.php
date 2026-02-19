<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "orders";

    protected $fillable = ['email', 'address', 'chocolate_id', 'count', 'all_price'];

    function chocolate() {
        return $this->belongsTo(Chocolate::class);
    }
}
