<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'price',
        'quantity',
        'publish',
        'user_id',
        'description',
        'slug',
        'image'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
