<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'item_name',
        'price',
        'discription',
        'soldout',
        'status',
        'img_url',
    ];

    public function User()
    {
        return $this->belongsTo('App\Models\User');
    }
}
