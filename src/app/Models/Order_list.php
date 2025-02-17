<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_list extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'item_id',
        'purchase_method',
        'price',
        'post_number',
        'address',
        'building',
        'order_state',
    ];

    public function item()
    {
        return  $this->hasOne('App\Models\Item', 'id', 'item_id');
    }
}
