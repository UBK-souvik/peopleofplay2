<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class HomePageAwardType extends Model
{
	protected $table ="home_page_award_type";
    protected $fillable = [
        'title', 
        'status'
     ];
}