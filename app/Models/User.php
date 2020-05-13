<?php

namespace App\Models;
use App\Scopes\DeletedScope;

class User extends MyModel
{
    const CREATED_AT = 'date_create';
    const UPDATED_AT = 'date_modified';

    protected $table = 'users';
    protected $primaryKey = 'user_id';
    protected $attributes = []; // define default value
    
    // Mutators
    protected $dates = []; // additional date attributes to convert columns to instances of Carbon, which extends the PHP
    protected $casts = [
        'is_blocked' => 'boolean',
        'deleted' => 'boolean',
    ];
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
    public function scopeIsNotBlock($query)
    {
        return $query->where('is_block', 0);
    }


    /*
    |--------------------------------------------------
    | Relation
    |--------------------------------------------------
    */

    public function accessWarehouseHistory()
    {
        return $this->hasMany('App\Models\AccessWarehouseHistory');
    }

    public function announcementHistory()
    {
        return $this->hasMany('App\Models\AnnouncementHistory');
    }

    public function boxesHistory()
    {
        return $this->hasMany('App\Models\BoxesHistory');
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

    public function lotProduct()
    {
        return $this->hasMany('App\Models\LotProduct');
    }

    public function inboundList()
    {
        return $this->hasMany('App\Models\InboundList');
    }

    public function receiveReceipt()
    {
        return $this->hasMany('App\Models\ReceiveReceipt');
    }

    public function inboundMatchList()
    {
        return $this->hasMany('App\Models\InboundMatchList');
    }

    public function logPrint()
    {
        return $this->hasMany('App\Models\LogPrint');
    }

    public function shelftype()
    {
        return $this->belongsTo('App\Models\ShelfType');
    }

    public function orderCardHistory()
    {
        $this->hasMany('App\Models\OrderCardHistory');
    }

    public function outboundList()
    {
        return $this->hasMany('App\Models\OutboundList');
    }

    public function paymentAdditional()
    {
        $this->hasMany('App\Models\PaymentAdditional');
    }

    public function paymentRenting()
    {
        return $this->hasMany('App\Models\PaymentRenting');
    }

    public function paymentHistory()
    {
        return $this->belongsTo('App\Models\PaymentHistory');
    }

    public function pickupParcel()
    {
        return $this->hasMany('App\Models\PickupParcel');
    }

    public function portalAccessStoreHistory()
    {
        return $this->hasMany('App\Models\PortalAccessStoreHistory');
    }

    public function portalUserHistory()
    {
        return $this->hasMany('App\Models\PortalUserHistory');
    }

    public function priceRateHistory()
    {
        return $this->hasMany('App\Models\PriceRateHistory');
    }

    public function providerHistory()
    {
        return $this->hasMany('App\Models\ProviderHistory');
    }

    public function rackHistory()
    {
        return $this->hasMany('App\Models\RackHistory');
    }

    public function receiveHistory()
    {
        return $this->hasMany('App\Models\ReceiveHistory');
    }

    public function stockBoxHistory()
    {
        return $this->hasMany('App\Models\StockBoxHistory');
    }

    public function stocklist()
    {
        return $this->hasMany('App\Models\Stocklist');
    }

    public function storeConfigPrice()
    {
        return $this->hasMany('App\Models\StoreConfigPrice');
    }

    public function storeHistory()
    {
        return $this->hasMany('App\Models\StoreHistory');
    }

    public function storePromotionHistory()
    {
        return $this->hasMany('App\Models\StorePromotionHistory');
    }

    public function storeShippingKey()
    {
        return $this->hasMany('App\Models\StoreShippingKey');
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

    public function tempSms()
    {
        return $this->hasMany('App\Models\TempSms');
    }

    public function unreachableOrder()
    {
        return $this->hasMany('App\Models\UnreachableOrder');
    }

    public function userHistory()
    {
        return $this->hasMany('App\Models\UserHistory');
    }

    public function userRolesHistory()
    {
        return $this->hasMany('App\Models\UserRolesHistory');
    }

    public function warehouseHistory()
    {
        return $this->hasMany('App\Models\WarehouseHistory');
    }

    public function warehouseLocationHistory()
    {
        return $this->hasMany('App\Models\WarehouseLocationHistory');
    }

    public function warehouseOrderHistory()
    {
        return $this->hasMany('App\Models\WarehouseOrderHistory');
    }

    public function warehouseLogError()
    {
        return $this->hasMany('App\Models\WarehouseLogError');
    }

    public function warehouses()
    {
        return $this->belongsToMany('App\Models\Warehouse', 'access_warehouse', 'user_id', 'warehouse_id');
    }
    
    /*
    |--------------------------------------------------
    | Private
    |--------------------------------------------------
    */



    
}
