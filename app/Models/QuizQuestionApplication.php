<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class QuizQuestionApplication extends Model
{
	protected $table = 'quiz_question_applications';
    protected $fillable = [
        'applicant_user_id',
        'ques_id',
		'quiz_id',
		'is_lie',
		'status'
    ];

    public static $fillable_shadow = [
        'applicant_user_id',
        'ques_id',
		'quiz_id',
		'is_lie',
		'status'
    ];
	
}
