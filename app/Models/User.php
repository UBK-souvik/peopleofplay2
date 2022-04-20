<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use DB;

class User extends Authenticatable
{
    use Notifiable;
    use HasSlug;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'is_csv_upload', 'csv_key', 'profile_image', 'name', 'gender', 'email', 'hide_email', 'hide_telephone', 'secondary_email', 'dial_code', 'mobile', 'secondary_mobile', 'password', 'remember_token', 'status', 'created_by', 'is_mobile_verified', 'otp', 'otp_generated_at', 'created_at', 'updated_at', 'country_id', 'type_of_industry', 'type_of_user', 'role', 'first_name', 'last_name', 'acronym', 'user_id_number', 'description', 'username', 'postal_address', 'zip_code', 'city', 'state', 'state_business', 'zip_code_business', 'city_business', 'country_id_business', 'website', 'business_address', 'dob', 'dobday', 'dobmonth', 'dobyear', 'stripe_id', 'skills', 'services', 'phone_number', 'secondary_phone_number', 'slug', 'no_of_employees', 'company_category_id', 'newsletter', 'fun_fact1', 'fun_fact2', 'fun_fact3', 'badge_1', 'badge_2', 'badge_3', 'badge_4', 'badge_5', 'badge_1_caption', 'badge_2_caption', 'badge_3_caption', 'badge_4_caption', 'badge_5_caption', 'employees_list', 'company_to_product_to_role', 'user_profile_responses', 'gold', 'virtual_show_room', 'pronoun', 'home_page_slide_show_caption','is_verify_profile','is_front_admin_user','is_news_feeds'
    ];

    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function inventorContactInfo()
    {
        return $this->hasOne(InventorContactInformation::class, 'user_id', 'id');
    }

    public function subscription()
    {
        return $this->hasOne(UserSubscription::class, 'user_id', 'id')->orderBy('id','desc');
    }

    public function galleries()
    {
        return $this->hasMany(UserGallery::class, 'user_id', 'id');
    }

    public function inventorAwards()
    {
        return $this->hasMany(InventorAward::class, 'user_id', 'id');
    }

    public function socialMedia()
    {
        return $this->hasMany(UserSocialMedia::class, 'user_id', 'id');
    }

    public function roles()
    {
        return $this->hasMany(Role::class, 'user_id', 'id');
    }

    public function watchlist()
    {
        return $this->hasMany(Watchlist::class, 'user_id', 'id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'user_id', 'id')->orderBy('sr_no', 'asc');
    }
	
	public function brand_lists()
    {
        return $this->hasMany(BrandList::class, 'user_id', 'id')->orderBy('sr_no', 'asc');
    }
	
	
	public function media_list()
    {
        return $this->hasMany(MediaList::class, 'user_id', 'id')->orderBy('id', 'desc');
    }

    public function getSlugOptions()
    {
        return SlugOptions::create()
            ->generateSlugsFrom(array('first_name', 'last_name'))
            ->saveSlugsTo('slug');
    }
	
	/*public function sluggable() {
        return [
            'slug' => [
                'source' => ['first_name', 'last_name']//['username', 'title']'username', 
            ]
        ];
    }*/


    public function companyCategory()
    {
        return $this->belongsTo(CompanyCategory::class, 'company_category_id', 'id');
    }
	
	public function countrydata()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }
	
	public function countryDataBusiness()
    {
        return $this->belongsTo(Country::class, 'country_id_business', 'id');
    }
	
	// list of all users in the application including free users
	public static function get_total_user_list_by_email()
	{
		//where('status', 1)->
	    $users = User::where('stripe_id', '!=', NULL)->where('stripe_id', '<>',  '')->orderBy('email', 'asc')->groupBy('id')->pluck('email', 'id');	  	  
	    return $users;
	}
	
	public static function get_company_users_list()
	{
		//where('status', 1)->
	    $users = User::where('stripe_id', '!=', NULL)->where('stripe_id', '<>',  '')->where('type_of_user', 2)->where('role', 3)->select(DB::raw("CONCAT(users.first_name,' ',users.last_name) as company_name"), 'id')->get();
	   
        return $users;
	}
	
	public static function get_people_users_list()
	{
		//where('status', 1)->
	    $users = User::where('stripe_id', '!=', NULL)->where('stripe_id', '<>',  '')->where('type_of_user', 2)->where('role', 2)->select(DB::raw("CONCAT(users.first_name,' ',users.last_name) as people_name"), 'id')->get();
        return $users;
	}
	
	public static function get_people_name_by_id($user_id)
	{
		//where('status', 1)->
		if(!empty($user_id))
		{
		   $users = User::where('stripe_id', '!=', NULL)->where('stripe_id', '<>',  '')->where('id', $user_id)->select(DB::raw("CONCAT(users.first_name,' ',users.last_name) as people_name"), 'id')->first();
           return $users;	
		}
	    else			
		{
	       return ''; 		
		}
	}
	
	public static function get_people_search_by_name($searchTerm)
	{
	  /*if($people_id>0)
		{
			$data_list = DB::table('users')
			->select('users.id', DB::raw("CONCAT(users.first_name,' ',users.last_name) as text"))  
			 ->where('users.role', 2)			 
			 //->Orwhere('users.role', 3)
			 ->where('users.type_of_user', 2)
			 ->where('users.id', $people_id)
			 ->get();
		}
		else
		{ */
		   $data_list = DB::table('users')
			->select('users.id', DB::raw("CONCAT(users.first_name,' ',users.last_name) as text"))  
			 ->where('stripe_id', '!=', NULL)
			 ->where('stripe_id', '<>',  '')
			 ->where('users.role', 2)			 
			 //->Orwhere('users.role', 3)
			 ->where('users.type_of_user', 2)
			 ->where(function($q)use ($searchTerm) {
                            	$q->where('users.first_name', 'LIKE', '%'.$searchTerm.'%')
								  ->orWhereRaw("concat(first_name, ' ', last_name) like '%$searchTerm%' ")
							      ->orWhere('users.last_name', 'LIKE', '%' . $searchTerm . '%');
							//$q->where('users.first_name', 'like', '%' . $search_data . '%')
                            //->orWhere('users.last_name', 'like', '%' . $search_data . '%');
                     })->get();	
		//}
		
		return $data_list;
	}
	
	public static function get_company_search_by_name($searchTerm)
	{

	

	   $data_list = DB::table('users')
			->select('users.id', DB::raw('CONCAT(if(first_name is null ,"",first_name),"  ",if(last_name is null ,"",last_name)) as text'))  
			// ->select('users.id', DB::raw('CONCAT(if(first_name is null ,"",first_name)," | ",if(last_name is null ,"",last_name)) as text'))  
            // ->select('users.id', DB::raw("CONCAT(users.first_name) as text"))  
			 ->where('stripe_id', '!=', NULL)
			 ->where('stripe_id', '<>',  '')
			 ->where('users.role', 3)			 
			 //->Orwhere('users.role', 3)
			 ->where('users.type_of_user', 2)
			 ->where(function($q)use ($searchTerm) {
                            	$q->where('users.first_name', 'LIKE', '%'.$searchTerm.'%')
							      ->orWhere('users.last_name', 'LIKE', '%' . $searchTerm . '%');
							//$q->where('users.first_name', 'like', '%' . $search_data . '%')
                            //->orWhere('users.last_name', 'like', '%' . $search_data . '%');
                     })->get();

		return $data_list;
	}

    // list of all paid users in the application
    public static function get_all_user_list_by_email_name()
	{
		//where('status', 1)->		
	    //$users = User::select(DB::raw('CONCAT(first_name," ",last_name," | ",email) as text'), 'id')->get();//CONCAT_WS
		$users = User::select(DB::raw('CONCAT(if(first_name is null ,"",first_name)," | ",if(last_name is null ,"",last_name), "|", email) as text'), 'id')->where('stripe_id', '!=', NULL)->where('stripe_id', '<>',  '')->where('type_of_user', 2)->get();//CONCAT_WS
        
		return $users;
	}

    // list of all company users in the application
    public static function get_company_user_list_by_email_name()
	{
		//where('status', 1)->		
	    //$users = User::select(DB::raw('CONCAT(first_name," ",last_name," | ",email) as text'), 'id')->get();//CONCAT_WS
		$users = User::select(DB::raw('CONCAT(if(first_name is null ," ",first_name)," | ",if(last_name is null ,"",last_name), "|", email) as text'), 'id')->where('stripe_id', '!=', NULL)->where('stripe_id', '<>',  '')->where('role', 3)->get();//CONCAT_WS
        
		return $users;
	}
	
	
	// list of all people users in the application with images
    public static function get_people_user_list_by_image($arr_search_data,$search_data='')
	{
		// echo $search_data; die;
	  $inventor_users = DB::table('users')
			->select('users.id', DB::raw('CONCAT(if(users.first_name is null ,"",users.first_name)," ",if(users.last_name is null ,"",users.last_name)) as name'), 'users.profile_image as image', 'users.role as slug_prefix', DB::raw('1 as type'), 'users.slug')
						 ->where('stripe_id', '!=', NULL)
			 ->where('stripe_id', '<>',  '')
			 ->where('users.role', 2)			 
			 ->where(function($inventors_q)use ($arr_search_data) {
                            	$inventors_q->where('users.type_of_user', 2)
							      ->orWhere('users.type_of_user', 3);
							
                     });
			 if($search_data !='') {
			 	// echo "dsfd"; die;
			   //$inventor_users->where('users.role', 2);
			   $inventor_users->where('first_name', 'like', "%$search_data%");
               $inventor_users->orWhereRaw("concat(first_name, ' ', last_name) like '%$search_data%' ");
               $inventor_users->orWhere('last_name', 'like', "$search_data");
			  // $inventor_users->where('users.first_name', 'like', '%' . $search_data . '%');
			  // $inventor_users->orWhere('users.last_name', 'like', '%' . $search_data . '%');
            }
          //  echo $inventor_users; die;
				
	   return $inventor_users;				 
 	}
	
	// list of all company users in the application with images
    public static function get_company_user_list_by_image($arr_search_data,$search_data='')
	{

	  $company_users = DB::table('users as comp')
			->select('comp.id', DB::raw('CONCAT(if(comp.first_name is null ,"",comp.first_name)," ",if(comp.last_name is null ,"",comp.last_name)) as name'), 'comp.profile_image as image', 'comp.role as slug_prefix', DB::raw('1 as type'),  'comp.slug')  
			 ->where('stripe_id', '!=', NULL)
			 ->where('stripe_id', '<>',  '')
			 ->where('comp.role',3);
		 if($search_data !='') {
		 	// $company_users->where('comp.role',3);
		 	 
			 $company_users->where('comp.first_name', 'like', '%' . $search_data . '%');
			 $company_users->orWhere('comp.last_name', 'like', '%' . $search_data . '%');
            }			 
			// ->where('comp.type_of_user', 2);
			// echo "<pre>"; print_r($company_users); die;
	  return $company_users;		 
	}		 
	
	
	// user details
    public static function get_user_details($user_id)
	{
	  $user_data = DB::table('users')
			->select('users.id', 'users.first_name', 'users.last_name', 'users.name', 'users.email')  
			 ->where('users.id', $user_id)
			 ->orderBy('users.id', 'desc')
			 ->first();
			 
	  return $user_data;		 
	}
}
