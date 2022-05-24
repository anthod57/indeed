<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offers extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'company', 'description', 'type', 'location', 'views', 'salary', 'postedBy'];

    protected $casts = [
        'applied' => 'array'
    ];

    protected $attributes = [
        'applied' => '{
            "users": []
        }'
    ];
}
