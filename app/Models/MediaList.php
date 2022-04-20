<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaList extends Model
{
    //
    protected $table = 'media_lists';
	
	protected $fillable = [
        'user_id',
        'title',
        'featured_image',
		'featured_image_thumbnail',
		'url_data',
		'caption',
        'added_by',
        'status',
        'feed_id'
    ];

    public static $fillable_shadow = [
        'user_id',
        'title',
        'featured_image',
		'featured_image_thumbnail',
		'url_data',
		'caption',
        'added_by',
        'status',
        'feed_id'
    ];

}
