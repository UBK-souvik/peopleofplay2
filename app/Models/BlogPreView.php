<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use DB;

class BlogPreView extends Model
{
    use HasSlug;

    protected $table = "blogs_pre_view";

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'featured_image',
		'featured_image_thumbnail',
        'description',
        'tag',
        'meta_title',
        'meta_description',
        'meta_keyword',
        'added_by',
        'status',
        'feed_id'
    ];

    public static $fillable_shadow = [
        'user_id',
        'category_id',
        'title',
        'featured_image',
        'featured_image_thumbnail',
		'description',
        'tag',
        'meta_title',
        'meta_description',
        'meta_keyword',
        'added_by',
        'status',
        'feed_id'
    ];


    public function getSlugOptions()
    {

        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'category_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
	
	// list of all blogs in the application with images
    public static function get_blog_list_by_image($arr_search_data)
	{
	  $blog_list = DB::table('blogs_pre_view')
			->select('blogs_pre_view.id', DB::raw("blogs_pre_view.title as name"), 'blogs_pre_view.featured_image as image', DB::raw("'blog' as slug_prefix"), DB::raw('8 as type'),  'blogs_pre_view.slug')  
			 ->where('blogs_pre_view.status', 1);
			 
	  return $blog_list;		 
	}
	
	
	// list of all blogs in the application
    public static function get_blog_list_data()
	{
		$blogs = Blog::select(DB::raw('blogs_pre_view.title as text'), 'id')->where('status', 1)->get();//CONCAT_WS
        
		return $blogs;
	}

    
}
