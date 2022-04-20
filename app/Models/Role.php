<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Role extends Model
{
    protected $fillable = [
        'user_id',
		'people_id',
		'company_id',
		'product_id',
        'role',
		'role_type',
        'at',
        'name',
        'description',
        'date_from',
        'date_to',
        'to_day',
        'to_month',
        'to_year',
        'from_day',
        'from_month',
        'from_year',
		'random_unique_timestamp',
		'status'
    ];

    public $fillable_shadow = [
        'user_id',
		'people_id',
		'company_id',
		'product_id',
        'role',
        'role_type',
		'at',
        'name',
        'description',
        'date_from',
        'date_to',
        'to_day',
        'to_month',
        'to_year',
        'from_day',
        'from_month',
        'from_year',
		'random_unique_timestamp',
		'status'
    ];


    public function user_role_name()
    {
        return $this->hasMany(UsersUserRole::class, 'id', 'role');
    }
	
	public function people_data()
    {
		return $this->belongsTo('App\Models\User', 'people_id', 'id');
    }
	
	public function company_data()
    {
		return $this->belongsTo('App\Models\User', 'company_id', 'id');
    }
	
	public function product_data()
    {
		return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }
	
	public static function get_role_data($user_id, $random_time_stamp)
    {
	
	    $role_data_query = Role::select('roles.id','roles.at','roles.to_day', 'roles.to_month','roles.to_year',
		'roles.from_day','roles.from_month','roles.from_year' ,'roles.role','roles.name',
		'roles.people_id','roles.company_id','roles.product_id' ,'roles.description' ,
		DB::raw('CONCAT(people.first_name," ",people.last_name) as people_name'),  
		DB::raw('CONCAT(company.first_name," ",company.last_name) as company_name'), 'products.name as product_name');
		
	    $role_data_query->leftJoin('users as people', 'people.id', '=', 'roles.people_id');		   
	    $role_data_query->leftJoin('users as company', 'company.id', '=', 'roles.company_id');
	    $role_data_query->leftJoin('products', 'products.id', '=', 'roles.product_id');
	   
	    if(!empty($user_id))
	    {
		   $role_data_query->where('roles.user_id', $user_id);
	    }
		
		 if(empty($user_id) && !empty($random_time_stamp))
		 {
			  $role_data_query->where('roles.random_unique_timestamp', $random_time_stamp);
         }
	   
	    $role_data =  $role_data_query->get();
		
		return $role_data;
		
    }	
	
}
