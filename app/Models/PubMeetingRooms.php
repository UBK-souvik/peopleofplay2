<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PubMeetingRooms extends Model
{
    //
    protected $table = 'pub_meeting_rooms';

    protected $fillable = [
        'id','type','heading','url','image','status','created_at','updated_at'
    ];
}
