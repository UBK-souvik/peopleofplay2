<?php
namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;

class EventYear extends Model
{
    // use HasSlug;
    protected $table = 'event_profiles';

    protected $fillable = [
        'profileName',
        'main_image',
        'profileUrl',
        'profileSubtitle',
    ];

    // public function getSlugOptions()
    // {
    //     return SlugOptions::create()
    //         ->generateSlugsFrom('name')
    //         ->saveSlugsTo('slug');
    // }

    // public function category()
    // {
    //     return $this->belongsTo(EventCategory::class, 'category_id', 'id');
    // }

    // public function subCategory()
    // {
    //     return $this->belongsTo(EventCategory::class, 'sub_category_id', 'id');
    // }

    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'user_id', 'id');
    // }

    // public function media()
    // {
    //     return $this->hasMany(EventMedia::class, 'event_id', 'id');
    // }

    // public function awards()
    // {
    //     return $this->hasMany(EventAward::class, 'event_id', 'id');
    // }

    // public function socialMedia()
    // {
    //     return $this->hasMany(EventSocialMedia::class, 'event_id', 'id');
    // }
}
