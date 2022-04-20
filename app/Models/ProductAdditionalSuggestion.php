<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAdditionalSuggestion extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'poll_number_value',
        'language_dependence',
    ];
}
