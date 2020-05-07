<?php

namespace App\Models;
use SoftDeletes;
use App\Scopes\DeletedScope;

class ResendOrder extends MyModel
{
    public $timestamps = false;
    const CREATED_AT = 'date_create';
    const UPDATED_AT = 'date_modified';

    protected $table = 'resend_order';
    protected $primaryKey = 'resend_order_id';
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

    public function customOrderShipping()
    {
        return $this->hasMany('App\Models\CustomOrderShipping');
    }

    public function warehouseOrder()
    {
        return $this->belongsTo('App\Models\WarehouseOrder');
    }

    public function shippingCountry()
    {
        return $this->belongsTo('App\Models\Contry', 'shipping_country_id', 'country_id');
    }

    public function resendType()
    {
        return $this->belongsTo('App\Models\ResendType', 'resend_type', 'resend_type_id');
    }

    public function shippingProvider()
    {
        return $this->belongsTo('App\Models\ShippingProvider');
    }

    public function warehouse()
    {
        return $this->belongsTo('App\Models\Warehouse');
    }

    public function store()
    {
        return $this->belongsTo('App\Models\Store');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function warehouseCard()
    {
        return $this->belongsTo('App\Models\WarehouseCard');
    }

    public function packing()
    {
        $this->hasMany('App\Models\Packing');
    }

    public function productMovement()
    {
        return $this->hasMany('App\Models\ProductMovement');
    }

    public function resendItem()
    {
        return $this->hasMany('App\Models\ResendItem');
    }

    public function serialNumber()
    {
        return $this->hasMany('App\Models\SerialNumber');
    }

    public function serialNumberHistory()
    {
        return $this->hasMany('App\Models\SerialNumberHistory');
    }

    public function tempPackingTask()
    {
        return $this->hasMany('App\Models\TempPackingTask');
    }

    public function tempSeparateTask()
    {
        return $this->hasMany('App\Models\TempSeparateTask');
    }

    public function warehouseOrderHistory()
    {
        return $this->hasMany('App\Models\WarehouseOrderHistory');
    }

    public function serials()
    {
        return $this->belongsToMany('App\Models\Serial', 'resend_serial_list', 'resend_order_id', 'serial_number_id');
    }
    /*
    |--------------------------------------------------
    | Private
    |--------------------------------------------------
    */


}
