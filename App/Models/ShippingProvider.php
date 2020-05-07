<?php

namespace App\Models;
use SoftDeletes;
use App\Scopes\DeletedScope;

class ShippingProvider extends MyModel
{
    // public $timestamps = false;
    const CREATED_AT = 'date_created';
    const UPDATED_AT = 'date_modified';
    const DELETED_AT = 'date_deleted';

    protected $table = 'shipping_provider';
    protected $primaryKey = 'shipping_provider_id';
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

    public function customOrderShipping()
    {
        return $this->hasMany('App\Models\CustomOrderShipping');
    }

    public function pickupParcel()
    {
        return $this->hasMany('App\Models\PickupParcel');
    }

    public function providerHistory()
    {
        return $this->hasMany('App\Models\ProviderHistory');
    }

    public function providerMatchCountry()
    {
        return $this->hasMany('App\Models\ProviderMatchCountry');
    }

    public function shippingBoxRate()
    {
        return $this->hasMany('App\Models\ShippingBoxRate');
    }

    public function shippingPrive()
    {
        return $this->hasMany('App\Models\ShippingPrice');
    }

    public function country()
    {
        return $this->belongsTo('App\Models\Country');
    }

    public function storeShippingKey()
    {
        return $this->hasMany('App\Models\StoreShippingKey');
    }

    public function tempPackingTask()
    {
        return $this->hasMany('App\Models\TempPackingTask', 'shipping_provider_id', 'select_shipping_provider_id');
    }

    public function stores()
    {
        return $this->belongsToMany('App\Models\Store', 'store_shipping_key', 'shipping_provider_id', 'store_id');
    }

    /*
    |--------------------------------------------------
    | Private
    |--------------------------------------------------
    */


}
