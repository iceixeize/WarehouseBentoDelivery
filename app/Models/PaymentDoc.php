<?php

namespace App\Models;
use SoftDeletes;
class PaymentDoc extends MyModel
{
    public $timestamps = false;

    protected $table = 'payment_doc';
    protected $primaryKey = 'payment_doc_id';
    protected $attributes = []; // define default value
    
    // Mutators
    protected $dates = [
        'date_created',
        'date_payment',
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

    public function customOrderShipping()
    {
        return $this->hasMany('App\Models\CustomOrderShipping');
    }
    
    public function outboundTask()
    {
        return $this->hasMany('App\Models\OutboundTask');
    }

    public function receiveReceipt()
    {
        return $this->hasMany('App\Models\ReceiveReceipt');
    }

    public function monthlyPaymentDoc()
    {
        return $this->belongsTo('App\Models\MonthlyPaymentDoc');
    }

    public function packing()
    {
        $this->hasMany('App\Models\Packing');
    }

    public function paymentAdditional()
    {
        $this->hasMany('App\Models\PaymentAdditional');
    }

    public function paymentRenting()
    {
        return $this->hasMany('App\Models\PaymentRenting');
    }

    public function warehouseOrder()
    {
        return $this->hasMany('App\Models\WarehouseOrder');
    }
    /*
    |--------------------------------------------------
    | Private
    |--------------------------------------------------
    */


}
