<?php
namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;

//marketing-pr-event Section three Profile model
class SectionFourProfile extends Model
{
    // use HasSlug;
    protected $table = 'section_four_profile';

    protected $fillable = [
        'profileName',
        'main_image',
        'profileUrl',
        'profileSubtitle',

    ];


}
