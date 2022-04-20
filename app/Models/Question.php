<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Question extends Model
{
    protected $fillable = [
        'user_id',
        'ques_1_val',
		'ques_2_val',
		'ques_3_val',
		'ques_4_val',
		'which_is_lie',
        'status'
    ];

    public static $fillable_shadow = [
        'user_id',
        'ques_1_val',
		'ques_2_val',
		'ques_3_val',
		'ques_4_val',
		'which_is_lie',
        'status'
    ];
	
	public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
