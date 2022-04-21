<?php
namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;

//marketing-pr-event Section three model
class SectionFour extends Model
{
    // use HasSlug;
    protected $table = 'section_four';

    protected $fillable = [
        'profileHeader',
    ];


}
