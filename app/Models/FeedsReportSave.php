<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeedsReportSave extends Model
{
    protected $guarded = [];
    protected $table = 'feeds_report_save';

    protected $fillable = [
        'id','user_id','feed_user','feed_id','news_feed_id','type','reason','status','description','created_at','updated_at'
     ];

    public static function getAppSetting()
    {
        return self::pluck('value', 'attribute')->toArray();
    }
}
