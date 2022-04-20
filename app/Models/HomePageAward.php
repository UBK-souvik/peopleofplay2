<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class HomePageAward extends Model
{
	protected $table ="home_page_award_list";

    protected $fillable = [
        'type', 'home_caption_one', 'home_caption_two', 'homa_caption_url_one', 'homa_caption_url_two', 'url_caption_three', 'url_caption_four', 'url_caption_five', 'url_caption_six', 'url_caption_seven', 'featured_image', 'status'
     ];
}