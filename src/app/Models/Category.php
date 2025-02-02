<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function categoryName()
    {
       return  $this->belongsTo('App\Models\Category_list', 'category_id');
    }
}
