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
        'brand_name',
        'price',
        'discription',
        'soldout',
        'status',
        'img_url',
    ];

    public function user()
    {
        return $this->belongsTo( 'App\Models\User' );
    }

    public function status_list()
    {       
        return $this->belongsTo( 'App\Models\Status_list' , 'status' );
    }

    public function scopeKeySearch($query, $keyword)
    {
        if (!empty($keyword)) {
            $query->where('item_name', 'like', '%' . $keyword . '%');
        }
    }
}
