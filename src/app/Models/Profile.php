<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_number',
        'address',
        'building',
        'img_url',
    ];

    public function User()
    {
        return $this->belongsTo( 'App\Models\User' );
    }

}
