<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrandListAdditionalSuggestion extends Model
{
    protected $fillable = [
        'user_id',
        'brand_list_id',
        'poll_number_value',
        'language_dependence',
    ];
}
