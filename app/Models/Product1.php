<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use DB;

class Product extends Model
{
    use HasSlug;

    protected $fillable = [
        'user_id',
        'main_image',
        'product_id_number',
        'name',
		'home_caption_one',
		'home_caption_two',
        'brand',
        'countries_sold',
        'group_id',
        'company',
		'launched_date',
        'ratings',
        'age',
        'add_to_collection',
        'community',
        'audience',
        'log_play',
        'minimum_age',
        'maximum_age',
        'complexity_rating',
        'my_rating',
        'year_launched',
        'buy',
        'like',
        'subscribe',
        'description',
        'comments',
        'setting_for_play',
        'interest',
        'number_of_players',
        'playing_time',
        'difficulty',
        'environmentally_friendly',
        'frustration_free_packaging',
        'is_home_page',
		'status',
        'alternate_names',
        'fun_fact1',
        'fun_fact2',
        'fun_fact3',
        'price'
    ];

    public static function validateProduct()
    {
        return [
            // 'main_image' => 'required_without:product_id|file',
            'product_id' => 'nullable|exists:products,id',
            'product' => 'array',
            'product.product_id_number' => 'required',
            // 'product.user_id' => 'required',
            'product.name' => 'required',
            //'product.brand' => 'required',
            //'product.company' => 'required',
            'product.group_id' => 'required',
            // 'product.ratings' => 'required',
            // 'product.buy' => 'required',
            'product.description' => 'required',
            'gallery' => 'array',
            'gallery.*' => 'file',
            // 'classification' => 'required',
            'category1' => 'required',
            'sub_category1' => 'required',
            'socials.*' => 'sometimes|nullable|url',
            'official_links.*' => 'sometimes|nullable|url',


            // 'categories' => 'required|array',
            // 'classification.category_id' => 'required|exists:categories,id',
            // 'classification.sub_category' => 'required|exists:categories,id',
            // 'classification.toy_type' => 'required',
            //'classification.inventor' => 'required',
            // 'classification.team' => 'required',
            // 'classification.launched' => 'required',
            'buy_from.*.type' => 'required',
            // // 'buy_from.*.suggested_retail' => 'required',
            'buy_from.*.ebay' => 'sometimes|nullable|url',
            // 'buy_from.*.amazon_caption' => 'required',
			'buy_from.*.amazon' => 'sometimes|nullable|url',			
            'buy_from.*.pop' => 'sometimes|nullable|url',

            'main_image' =>  'max:2048', 
            /*'collaborator.image' => 'required_without:product_id|array',
            'collaborator.name' => 'required|array',
            'collaborator.role' => 'required|array',*/
            
            // 'community_stats.own' => 'required',
            // 'community_stats.for_trade' => 'required',
            // 'community_stats.wishlist' => 'required',
            // 'community_stats.want_it_trade' => 'required',
            // 'community_stats.has_part' => 'required',
            // 'community_stats.wants_part' => 'required',
            
            // 'stats.rating' => 'required',
            // 'stats.page_views' => 'required',
            // 'stats.standard_deviation' => 'required',
            // 'stats.number_of_ratings' => 'required',
            // 'stats.overall_rank' => 'required',
            // 'stats.all_time_plays' => 'required',
            // 'stats.party_rank' => 'required',
            // 'stats.this_month' => 'required',
            // 'stats.own' => 'required',
            // 'stats.for_trade' => 'required',
            // 'stats.wishlist' => 'required',
            // 'stats.previously_owned' => 'required',
            // 'stats.want_it_trade' => 'required',
            // 'stats.has_part' => 'required',
            // 'stats.wants_part' => 'required',
            // 'stats.comments' => 'required',
            
            'other.in_depth_review',
            // 'other.ratings',
            // 'other.forum',
            // 'other.forum_categories'
        ];
    }

    public function getSlugOptions()
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function categories()
    {
        return $this->hasMany(ProductCategory::class,'product_id','id');
    }

    public function additionalSuggestion()
    {
        return $this->hasOne(ProductAdditionalSuggestion::class, 'product_id', 'id');
    }

    public function classification()
    {
        return $this->hasOne(ProductClassification::class, 'product_id', 'id');
    }

    public function buyFrom()
    {
        return $this->hasOne(ProductBuyFrom::class, 'product_id', 'id');
    }

    public function gallery()
    {
        return $this->hasMany(ProductGallery::class, 'product_id', 'id');
    }

    public function communityStats()
    {
        return $this->hasMany(ProductCommunityStat::class, 'product_id', 'id');
    }

    public function statics()
    {
        return $this->hasOne(ProductStatistic::class, 'product_id', 'id');
    }

    public function other()
    {
        return $this->hasOne(ProductOther::class, 'product_id', 'id');
    }

    public function collaborators()
    {
        return $this->hasMany(ProductCollaborator::class,'product_id','id');
    }

    public function socialMedia()
    {
        return $this->hasMany(ProductSocialMedia::class,'product_id','id');
    }

    public function officialLinks()
    {
        return $this->hasMany(ProductOfficialLink::class,'product_id','id');
    }

    public function videos()
    {
        return $this->hasMany(ProductVideo::class,'product_id','id');

    }

    public function created_byy()
    {
        return $this->belongsTo(User::class,'user_id', 'id');
    }
	
	public function brand_list()
    {
        return $this->belongsTo(BrandList::class,'brand', 'id');
    }
	
	public function companydata()
    {
        return $this->belongsTo(User::class,'company', 'id');
    }

    public function category1()
    {
        return $this->hasMany(ProductCategory::class,'product_id','id');
    }
	
	public static function get_product_search_by_name($searchTerm)
	{
	   $data_list = DB::table('products')
			->select('products.id', DB::raw("products.name as text"))  
			 ->where(function($q)use ($searchTerm) {
                            	$q->where('products.name', 'LIKE', '%'.$searchTerm.'%');
			 })->get();
					 
		return $data_list;
	}
	
	public static function get_product_list_dropdown()
	{
	   $data_list = DB::table('products')
			->select('products.id', DB::raw("products.name as text"))  
			->where('products.status', '=', 1)
			->get();
					 
		return $data_list;
	}
	
	 public static function get_product_list_by_image($slug_prefix_list)
	 {
	   $products = DB::table('products')
			->select('products.id'
			  ,'products.name'
			  ,'products.main_image as image', DB::raw("'".$slug_prefix_list[2][0]['slug_prefix']."' as slug_prefix"), DB::raw('2 as type'), 'products.slug');
			//->where('products.name', 'like', '%' . $search_data . '%');
			
		return $products;	
			
     }

     public static function get_toy_product_list_by_image($slug_prefix_list)
	 {
	   $toy_products = DB::table('products')
			->select('products.id'
			  ,'products.name'
			  ,'products.main_image as image', DB::raw("'".$slug_prefix_list[2][0]['slug_prefix']."' as slug_prefix"), DB::raw('2 as type'), 'products.slug')
			->where('products.group_id', '=', 1);
			
		return $toy_products;	
			
     }

     public static function get_game_product_list_by_image($slug_prefix_list)
	 {
	   $game_products = DB::table('products')
			->select('products.id'
			  ,'products.name'
			  ,'products.main_image as image', DB::raw("'".$slug_prefix_list[2][0]['slug_prefix']."' as slug_prefix"), DB::raw('2 as type'), 'products.slug')
			->where('products.group_id', '=', 2);
			
		return $game_products;	
			
     } 	 
}
