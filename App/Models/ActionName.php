<?php

namespace App\Models;
use SoftDeletes;
use App\Scopes\ActiveScope;

class ActionName extends MyModel
{
    public $timestamps = false;

    protected $table = 'ActionName';
    protected $primaryKey = 'action_id';
    protected $attributes = []; // define default value
    
    // Mutators
    protected $dates = []; // additional date attributes to convert columns to instances of Carbon, which extends the PHP
    protected $casts = [];
    protected $appends = []; // append value to JSON (Eloquent > Serialization)
    protected $hidden = []; // hiding attributes from JSON (Eloquent > Serialization)
    

    protected static function boot() {
        parent::boot();
        static::addGlobalScope(new ActiveScope);

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

    public function stockBoxHistory()
    {
        return $this->hasMany('App\Models\StockBoxHistory');
    }

    public function storeHistory()
    {
        return $this->hasMany('App\Models\StoreHistory');
    }

    public function storePromotionHistory()
    {
        return $this->hasMany('App\Models\StorePromotionHistory');
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
    /*
    |--------------------------------------------------
    | Private
    |--------------------------------------------------
    */


}
