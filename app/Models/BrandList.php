<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use DB;

class BrandList extends Model
{
    use HasSlug;

    protected $fillable = [
        'user_id',
        'main_image',
        'brand_list_id_number',
        'name',
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
        'status',
        'alternate_names',
        'fun_fact1',
        'fun_fact2',
        'fun_fact3',
        'price'
    ];

    public static function validateBrandList()
    {
        return [
            // 'main_image' => 'required_without:brand_list_id|file',
            'brand_list_id' => 'nullable|exists:brand_lists,id',
            'product' => 'array',
            'brand_list.brand_list_id_number' => 'required',
            // 'product.user_id' => 'required',
            'brand_list.name' => 'required',
            //'product.brand' => 'required',
            //'product.company' => 'required',
            'brand_list.group_id' => 'required',
            // 'product.ratings' => 'required',
            // 'product.buy' => 'required',
            'brand_list.description' => 'required',
            'gallery' => 'array',
            'gallery.*' => 'file',
            // 'classification' => 'required',
            'category1' => 'required',
            //'sub_category1' => 'required',
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
            /*'collaborator.image' => 'required_without:brand_list_id|array',
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
        return $this->hasMany(BrandListCategory::class,'brand_list_id','id');
    }

    public function additionalSuggestion()
    {
        return $this->hasOne(BrandListAdditionalSuggestion::class, 'brand_list_id', 'id');
    }

    public function classification()
    {
        return $this->hasOne(BrandListClassification::class, 'brand_list_id', 'id');
    }

    public function buyFrom()
    {
        return $this->hasOne(BrandListBuyFrom::class, 'brand_list_id', 'id');
    }

    public function gallery()
    {
        return $this->hasMany(BrandListGallery::class, 'brand_list_id', 'id');
    }

    public function communityStats()
    {
        return $this->hasMany(BrandListCommunityStat::class, 'brand_list_id', 'id');
    }

    public function statics()
    {
        return $this->hasOne(BrandListStatistic::class, 'brand_list_id', 'id');
    }

    public function other()
    {
        return $this->hasOne(BrandListOther::class, 'brand_list_id', 'id');
    }

    public function collaborators()
    {
        return $this->hasMany(BrandListCollaborator::class,'brand_list_id','id');
    }

    public function socialMedia()
    {
        return $this->hasMany(BrandListSocialMedia::class,'brand_list_id','id');
    }

    public function officialLinks()
    {
        return $this->hasMany(BrandListOfficialLink::class,'brand_list_id','id');
    }

    public function videos()
    {
        return $this->hasMany(BrandListVideo::class,'brand_list_id','id');

    }

    public function created_byy()
    {
        return $this->belongsTo(User::class,'user_id', 'id');
    }

    public function category1()
    {
        return $this->hasMany(BrandListCategory::class,'brand_list_id','id');
    }
	
	public static function get_brand_list_search_by_name($searchTerm)
	{
	   $data_list = DB::table('brand_lists')
			->select('brand_lists.id', DB::raw("brand_lists.name as text"))  
			 ->where(function($q)use ($searchTerm) {
                            	$q->where('brand_lists.name', 'LIKE', '%'.$searchTerm.'%');
			 })->get();
					 
		return $data_list;
	}
	
	public static function get_brand_list_by_image($slug_prefix_list)
	 {
	   $brand_lists = DB::table('brand_lists')
			->select('brand_lists.id'
			  ,'brand_lists.name'
			  ,'brand_lists.main_image as image', DB::raw("'".$slug_prefix_list[7][0]['slug_prefix']."' as slug_prefix"), DB::raw('7 as type'), 'brand_lists.slug');
			//->where('products.name', 'like', '%' . $search_data . '%');
			
		return $brand_lists;	
			
     }
}