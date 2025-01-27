<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status_list extends Model
{
    use HasFactory;

    public function item()
    {
        return $this->HasMany( 'App\Models\Item' , 'status' );
    }
}
