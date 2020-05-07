<?php

namespace App\Models;
use SoftDeletes;
use App\Scopes\DeletedScope;

class CustomOrderShipping extends MyModel
{
    // public $timestamps = false;
    const CREATED_AT = 'date_create';
    const UPDATED_AT = 'date_modified';
    const DELETED_AT = 'date_cancelled';

    protected $table = 'custom_order_shipping';
    protected $primaryKey = 'custom_order_shipping_id';
    protected $attributes = []; // define default value
    
    // Mutators
    protected $dates = [
        'date_shipping',
    ]; // additional date attributes to convert columns to instances of Carbon, which extends the PHP
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

    public function warehouse()
    {
        return $this->belongsTo('App\Models\Warehouse');
    }

    public function paymentDoc()
    {
        return $this->belongsTo('App\Models\PaymentDoc');
    }

    public function store()
    {
        return $this->belongsTo('App\Models\Store');
    }

    public function shippingProvider()
    {
        return $this->belongsTo('App\Models\ShippingProvider');
    }

    public function warehouseOrder()
    {
        return $this->belongsTo('App\Models\WarehouseOrder');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function resendOrder()
    {
        return $this->belongsTo('App\Models\resendOrder');
    }

    public function packing()
    {
        $this->hasMany('App\Models\Packing');
    }

    public function warehouseOrderHistory()
    {
        return $this->hasMany('App\Models\WarehouseOrderHistory');
    }
    /*
    |--------------------------------------------------
    | Private
    |--------------------------------------------------
    */


}
