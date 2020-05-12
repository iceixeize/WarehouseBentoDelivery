<?php

namespace App\Models;
use SoftDeletes;
use App\Scopes\DeletedScope;

class WarehouseOrder extends MyModel
{
    // public $timestamps = false;
    const CREATED_AT = 'date_create';
    const UPDATED_AT = 'date_modified';
    const DELETED_AT = 'date_cancelled';

    protected $table = 'warehouse_order';
    protected $primaryKey = 'warehouse_order_id';
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
    public function store()
    {
        return $this->belongsTo('App\Models\Store', 'store_id');
    }

    public function warehouse()
    {
        return $this->belongsTo('App\Models\Warehouse');
    }

    public function warehouseLocation()
    {
        return $this->belongsTo('App\Models\WarehouseLocation');
    }

    public function shippingProvider()
    {
        return $this->belongsTo('App\Models\ShippingProvider');
    }

    public function warehouseCard()
    {
        return $this->belongsTo('App\Models\WarehouseCard');
    }

    public function paymentDoc()
    {
        return $this->belongsTo('App\Models\PaymentDoc');
    }

    public function customOrderShipping()
    {
        return $this->hasMany('App\Models\CustomOrderShipping');
    }
    
    public function orderCardHistory()
    {
        $this->hasMany('App\Models\OrderCardHistory');
    }

    public function orderItem()
    {
        $this->hasMany('App\Models\OrderItem');
    }

    public function packing()
    {
        $this->hasMany('App\Models\Packing');
    }

    public function paymentAdditional()
    {
        $this->hasMany('App\Models\PaymentAdditional');
    }

    public function productMovement()
    {
        return $this->hasMany('App\Models\ProductMovement');
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

    public function tempSms()
    {
        return $this->hasMany('App\Models\TempSms');
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
