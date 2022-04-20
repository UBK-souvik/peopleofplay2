<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    protected $table = 'messages';

    protected $fillable = [
        'id',
        'sender',
        'receiver',
        'IsRead',
        'IsDeleted',
        'created_at',
        'updated_at',
    ];

    public function chat()
    {
        return $this->hasMany('App\Models\Chat');
    }

    public function unread_chat()
    {
        return $this->hasOne('App\Models\Chat')->where('IsRead', 0);
    }

    public function send()
    {
        return $this->belongsTo('App\Models\User', 'sender');
    }
    public function received()
    {
        return $this->belongsTo('App\Models\User', 'receiver');
    }
    public function tenant()
    {
        return $this->belongsTo('App\User', 'tenant_id');
    }

}
