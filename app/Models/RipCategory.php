<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use App\Models\Wiki;
use DB;

class RipCategory extends Model
{
    use HasSlug;
    protected $fillable = [
        'name',
        'slug',
        'description',
        'status'
    ];

    public static $fillable_shadow = [
        'name',
        'slug',
        'description',
        'status'
    ];


    public function getSlugOptions()
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }


        public static function getName($id)
    {
        // echo $id; die;
       return DB::table('rip_categories')->where('id',$id)->first(['name'])->name;
    }

     public static function checkDelete($id)
    {
       $data = DB::table('rips')->where('category_id',$id)->get();
       if(!empty($data) && count($data)>0){
        return true;
       }
       return false;
    }
}