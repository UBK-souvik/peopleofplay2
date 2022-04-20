<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    protected $fillable = [
        'question',
        'type',
        'status',
    ];

    public static $fillable_shadow = [
        'question',
        'type',
        'status',
    ];

    public function products()
    {
        return $this->hasMany(PollOption::class, 'poll_id', 'id')->where('type', 1);
    }

    public function events()
    {
        return $this->hasMany(PollOption::class, 'poll_id', 'id')->where('type', 2);
    }
    public function users()
    {
        return $this->hasMany(PollOption::class, 'poll_id', 'id')->where('type', 3);
    }
}
