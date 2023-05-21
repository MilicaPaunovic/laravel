<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'minimum_price',
        'start_datetime',
        'end_datetime',
    ];

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

     
    public function bids()
    {
        return $this->hasMany(Bid::class);
    }



    
}
