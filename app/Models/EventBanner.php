<?php
namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;

class EventBanner extends Model
{
    // use HasSlug;
    protected $table = 'event_banner';

    protected $fillable = [
        'banner_header',
        'main_image',
    ];

}
