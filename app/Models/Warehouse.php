<?php

namespace App\Models;
use App\Scopes\DeletedScope;

class Warehouse extends MyModel
{
    const CREATED_AT = 'date_create';
    const UPDATED_AT = 'date_modified';
    const DELETED_AT = 'date_deleted';

    protected $table = 'warehouse';
    protected $primaryKey = 'warehouse_id';
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

    public function accessWarehouse()
    {
        return $this->hasMany('App\Models\AccessWarehouse');
    }

    public function customOrderShipping()
    {
        return $this->hasMany('App\Models\CustomOrderShipping');
    }

    public function resendOrder()
    {
        return $this->hasMany('App\Models\ResendOrder');
    }

    public function warehouseCard()
    {
        return $this->hasMany('App\Models\WarehouseCard');
    }

    public function outboundTask()
    {
        return $this->hasMany('App\Models\OutboundTask');
    }

    public function receiveReceipt()
    {
        return $this->hasMany('App\Models\ReceiveReceipt');
    }

    public function logPrint()
    {
        return $this->hasMany('App\Models\LogPrint');
    }
    
    public function lotQty()
    {
        return $this->hasMany('App\Models\LotQty');
    }

    public function rack()
    {
        return $this->hasMany('App\Models\Rack');
    }

    public function warehouseLocation()
    {
        return $this->hasMany('App\Models\WarehouseLocation');
    }

    public function subshelf()
    {
        return $this->hasMany('App\Models\Subshelf');
    }

    public function orderCardHistory()
    {
        $this->hasMany('App\Models\OrderCardHistory');
    }

    public function outboundList()
    {
        return $this->hasMany('App\Models\OutboundList');
    }

    public function packing()
    {
        $this->hasMany('App\Models\Packing');
    }

    public function renting()
    {
        return $this->hasMany('App\Models\Renting');
    }

    public function paymentRenting()
    {
        return $this->hasMany('App\Models\PaymentRenting');
    }

    public function pickSlip()
    {
        return $this->belongsTo('App\Models\PickSlip');
    }

    public function pickupParcel()
    {
        return $this->hasMany('App\Models\PickupParcel');
    }

    public function productMovement()
    {
        return $this->hasMany('App\Models\ProductMovement');
    }
    
    public function rackHistory()
    {
        return $this->hasMany('App\Models\RackHistory');
    }

    public function receiveHistory()
    {
        return $this->hasMany('App\Models\ReceiveHistory');
    }

    public function serialNumber()
    {
        return $this->hasMany('App\Models\SerialNumber');
    }

    public function serialNumberHistory()
    {
        return $this->hasMany('App\Models\SerialNumberHistory');
    }

    public function stockBox()
    {
        return $this->hasMany('App\Models\StockBox');
    }

    public function stockBoxHistory()
    {
        return $this->hasMany('App\Models\StockBoxHistory');
    }

    public function tempInboundItem()
    {
        return $this->hasMany('App\Models\TempInboundItem');
    }

    public function tempOutboundItem()
    {
        return $this->hasMany('App\Models\TempOutboundItem');
    }

    public function tempPackingTask()
    {
        return $this->hasMany('App\Models\TempPackingTask');
    }

    public function tempSeparateTask()
    {
        return $this->hasMany('App\Models\TempSeparateTask');
    }

    public function warehouseHistory()
    {
        return $this->hasMany('App\Models\WarehouseHistory');
    }

    public function warehouseOrderHistory()
    {
        return $this->hasMany('App\Models\WarehouseOrderHistory');
    }

    public function warehouseOrder()
    {
        return $this->hasMany('App\Models\WarehouseOrder');
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'access_warehouse', 'warehouse_id', 'user_id');
    }

    public function boxes()
    {
        return $this->belongsToMany('App\Models\Boxes', 'stock_box', 'boxes_id', 'warehouse_id');
    }
    /*
    |--------------------------------------------------
    | Private
    |--------------------------------------------------
    */


}
