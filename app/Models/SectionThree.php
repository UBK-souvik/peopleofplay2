<?php
namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;

//marketing-pr-event Section three model
class SectionThree extends Model
{
    // use HasSlug;
    protected $table = 'section_three';

    protected $fillable = [
        'profileHeader',
    ];


}
