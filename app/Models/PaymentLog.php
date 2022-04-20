<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentLog extends Model
{
    protected $fillable = [
        'subscription_id',
        'invoice_id',
		'customer_id',
		'payment_rule',
		'payment_risk_level',
		'payment_message',
		'payment_code',
		'payment_seller_message',
		'payment_network_status',
		'payment_reason',
		'payment_type',
        'status'
    ];

    public static $fillable_shadow = [
        'subscription_id',
        'invoice_id',
		'customer_id',
		'payment_rule',
		'payment_risk_level',
		'payment_message',
		'payment_code',
		'payment_seller_message',
		'payment_network_status',
		'payment_reason',
		'payment_type',
        'status'
    ];
}
