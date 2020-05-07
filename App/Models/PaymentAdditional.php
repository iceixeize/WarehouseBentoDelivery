<?php

namespace App\Models;
use SoftDeletes;
use App\Scopes\DeletedScope;

class PaymentAdditional extends MyModel
{
    public $timestamps = false;
    const CREATED_AT = 'date_created';

    protected $table = 'payment_addtional';
    protected $primaryKey = 'payment_addtional_id';
    protected $attributes = []; // define default value
    
    // Mutators
    protected $dates = []; // additional date attributes to convert columns to instances of Carbon, which extends the PHP
    protected $casts = [];
    protected $appends = []; // append value to JSON (Eloquent > Serialization)
    protected $hidden = []; // hiding attributes from JSON (Eloquent > Serialization)
    

    protected static function boot() {
        parent::boot();
        static::addGlobalScope(new DeletedScope);

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

    public function store()
    {
        return $this->belongsTo('App\Models\Store');
    }

    public function paymentDoc()
    {
        return $this->belongsTo('App\Models\PaymentDoc');
    }

    public function createdUser()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'created_user_id');
    }

    public function receiveReceipt()
    {
        return $this->belongsTo('App\Models\ReceiveReceipt', 'receive_id', 'receive_receipt_id');
    }

    public function outboundTask()
    {
        return $this->belongsTo('App\Models\OutboundTask');
    }

    public function warehouseOrder()
    {
        return $this->belongsTo('App\Models\WarehouseOrder');
    }

    public function paymentRenting()
    {
        return $this->belongsTo('App\Models\PaymentRenting');
    }

    public function paymentHistory()
    {
        return $this->belongsTo('App\Models\PaymentHistory');
    }

    /*
    |--------------------------------------------------
    | Private
    |--------------------------------------------------
    */


}
