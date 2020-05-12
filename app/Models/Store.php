<?php

namespace App\Models;
use SoftDeletes;
class Store extends MyModel
{
    // public $timestamps = false;
    const CREATED_AT = 'date_create';
    const UPDATED_AT = 'date_modified';

    protected $table = 'store';
    protected $primaryKey = 'store_id';
    protected $attributes = []; // define default value
    
    // Mutators
    protected $dates = []; // additional date attributes to convert columns to instances of Carbon, which extends the PHP
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

    public function scopeActive($query)
    {
        return $query->where('store_active', 1);
    }

    /*
    |--------------------------------------------------
    | Relation
    |--------------------------------------------------
    */

    public function configPriceRate()
    {
        return $this->hasMany('App\Models\ConfigPriceRate');
    }

    public function customOrderShipping()
    {
        return $this->hasMany('App\Models\CustomOrderShipping');
    }

    public function warehouseOrder()
    {
        return $this->hasMany('App\Models\WarehouseOrder', 'store_id');
    }

    public function resendOrder()
    {
        return $this->hasMany('App\Models\ResendOrder');
    }

    public function giveaway()
    {
        return $this->hasMany('App\Models\Giveaway');
    }

    public function product()
    {
        return $this->hasMany('App\Models\Product');
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

    public function logChangeStock()
    {
        return $this->hasMany('App\Models\LogChangeStock');
    }

    public function lotQty()
    {
        return $this->hasMany('App\Models\LotQty');
    }

    public function outboundList()
    {
        return $this->hasMany('App\Models\OutboundList');
    }

    public function packing()
    {
        $this->hasMany('App\Models\Packing');
    }

    public function paymentAdditional()
    {
        $this->hasMany('App\Models\PaymentAdditional');
    }

    public function renting()
    {
        return $this->hasMany('App\Models\Renting');
    }

    public function paymentRenting()
    {
        return $this->hasMany('App\Models\PaymentRenting');
    }

    public function paymentHistory()
    {
        return $this->belongsTo('App\Models\PaymentHistory');
    }

    public function pickSlip()
    {
        return $this->belongsTo('App\Models\PickSlip');
    }

    public function portalAccessStore()
    {
        return $this->hasMany('App\Models\PortalAccessStore');
    }

    public function productMovement()
    {
        return $this->hasMany('App\Models\ProductMovement');
    }

    public function storePromotion()
    {
        return $this->hasMany('App\Models\StorePromotion');
    }

    public function serialNumber()
    {
        return $this->hasMany('App\Models\SerialNumber');
    }

    public function serialNumberHistory()
    {
        return $this->hasMany('App\Models\SerialNumberHistory');
    }

    public function stocklist()
    {
        return $this->hasMany('App\Models\Stocklist');
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

    public function boxes()
    {
        return $this->belongsToMany('App\Models\Boxes', 'custom_box_price', 'store_id', 'boxes_id');
    }

    public function shippingProviders()
    {
        return $this->belongsToMany('App\Models\ShippingProvider', 'store_shipping_key', 'store_id', 'shipping_provider_id');
    }
    /*
    |--------------------------------------------------
    | Private
    |--------------------------------------------------
    */


}
