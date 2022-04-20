<?php
namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;

class EventDescription extends Model
{
    // use HasSlug;
    protected $table = 'event_description';

    protected $fillable = [
        'description_header',
        'description_details',
    ];

}
