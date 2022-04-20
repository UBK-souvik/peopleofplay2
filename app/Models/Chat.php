<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    //
    protected $table = 'chats';

    protected $fillable = [
        'id',
        'sender',
        'user_id',
        'receiver',
        'message',
        'IsDeleted',
        'IsRead',
        'created_at',
        'updated_at',
    ];

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
