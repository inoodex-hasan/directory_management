<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = ['type', 'paypal_subscription_id', 'expires_at'];
}
