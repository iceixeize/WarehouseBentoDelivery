<?php

namespace App\Models;
use SoftDeletes;
class PaymentHistory extends MyModel
{
    public $timestamps = false;

    protected $table = 'user';
    protected $primaryKey = 'user_id';
    protected $attributes = []; // define default value
    
    // Mutators
    protected $dates = [
        'date_created',
        'date_pay_credit',
        'transaction_date',
    ]; // additional date attributes to convert columns to instances of Carbon, which extends the PHP
    protected $casts = [];
    protected $appends = []; // append value to JSON (Eloquent > Serialization)
    protected $hidden = []; // hiding attributes from JSON (Eloquent > Serialization)
    

    protected static function boot() {
        parent::boot();

        static::created(function ($model) {
            
        });
        static::updated(function ($model) {
            
        });
        static::deleted(function ($model) {
            
        });
    }

    /*
    |--------------------------------------------------
    | Cache
    |--------------------------------------------------
    */



    /*
    |--------------------------------------------------
    | Static
    |--------------------------------------------------
    */



    /*
    |--------------------------------------------------
    | Function
    |--------------------------------------------------
    */


    
    /*
    |--------------------------------------------------
    | Get
    |--------------------------------------------------
    */



    /*
    |--------------------------------------------------
    | Set
    |-------------------------------------------------
    */



    /*
    |--------------------------------------------------
    | Scope
    |--------------------------------------------------
    */



    /*
    |--------------------------------------------------
    | Relation
    |--------------------------------------------------
    */

    public function paymentRenting()
    {
        return $this->belongsTo('App\Models\PaymentRenting');
    }

    public function actionPayment()
    {
        return $this->belongsTo('App\Models\ActionPayment', 'action_payment_id', 'action_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function packing()
    {
        return $this->belongsTo('App\Models\Packing');
    }

    public function receiveReceipt()
    {
        return $this->belongsTo('App\Models\ReceiveReceipt');
    }

    public function outboundTask()
    {
        return $this->belongsTo('App\Models\OutboundTask');
    }

    public function paymentAdditional()
    {
        return $this->belongsTo('App\Models\PaymentAdditional');
    }

    public function store()
    {
        return $this->belongsTo('App\Models\Store');
    }

    /*
    |--------------------------------------------------
    | Private
    |--------------------------------------------------
    */


}
