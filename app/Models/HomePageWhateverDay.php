<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class HomePageWhateverDay extends Model
{
    protected $fillable = [
        'home_caption_one',
        'home_caption_two',
        'product_id',
		'date_to_be_published',
		'created_at',
		'updated_at',
        'status',
    ];
	
	
	public function product_data()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
	
	public static function get_happy_whatever_day($slug='')
	{
		$str_current_date = date('Y-m-d');
		
		$hpd =DB::table('home_page_whatever_days')
                ->join('products','products.id', '=', 'home_page_whatever_days.product_id')
                ->where('home_page_whatever_days.status', 1)
                ->where('products.slug', $slug)
				->whereDate('date_to_be_published', $str_current_date)
				->select('home_page_whatever_days.home_caption_one','home_page_whatever_days.home_caption_two','home_page_whatever_days.id','products.main_image','products.slug')
                ->orderBy('home_page_whatever_days.id','desc');
                if(!empty($slug)){
                    $hpd->where('products.slug', $slug);
                }
                $home_product_data = $hpd->first();
        			
        if(empty($home_product_data->id))
		{			
	 	   $hpd =DB::table('home_page_whatever_days')
                ->join('products','products.id', '=', 'home_page_whatever_days.product_id')
                ->where('home_page_whatever_days.status', 1)
				->select('home_page_whatever_days.home_caption_one','home_page_whatever_days.home_caption_two','home_page_whatever_days.id','products.main_image','products.slug');
                if(!empty($slug)){
                    $hpd->where('products.slug', $slug);
                }else{
                    $hpd->inRandomOrder();
                }
			    $hpd->limit(10)
				->orderBy('home_page_whatever_days.id','desc');
                $home_product_data = $hpd->first();
			
         }				
		
        return 	$home_product_data;				
	}
}
