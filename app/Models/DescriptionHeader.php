<?php
namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;

class DescriptionHeader extends Model
{
    // use HasSlug;
    protected $table = 'description_header';

    protected $fillable = [
        'description_main_header',
    ];

}
