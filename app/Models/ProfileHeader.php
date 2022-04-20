<?php
namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;

class ProfileHeader extends Model
{
    // use HasSlug;
    protected $table = 'profile_header';

    protected $fillable = [
        'profileHeader',
    ];


}
