<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSettingLive extends Model
{
    protected $table = 'site_settings_live';
    
    protected $guarded = [];

    public static function get_keys($key){
        return SiteSettingLive::get()[$key]->meta_value;
    }
}
