<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSubscriptionInvoice extends Model
{
    protected $fillable = [
        'user_id',
        'payment_status',
        'status'
    ];


}
