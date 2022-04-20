<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = [
        'status',
		'destination_id',
		'assign_product_id',
		'assign_profile_id',
		'notes_1',
		'notes_2',
		'notes_3',
		'created_at',
		'updated_at'
    ];

    public static $fillable_shadow = [
        'status',
		'destination_id',
		'assign_product_id',
		'assign_profile_id',
		'notes_1',
		'notes_2',
		'notes_3',
		'created_at',
		'updated_at'
    ];
	
	public static function validateNotes()
    {
        return [
            
        ];
    }
	
	public function product_data()
    {
        return $this->belongsTo(Product::class, 'assign_product_id', 'id');
    }
	
	public function user_data()
    {
        return $this->belongsTo(User::class, 'assign_profile_id', 'id');
    }
	
}
