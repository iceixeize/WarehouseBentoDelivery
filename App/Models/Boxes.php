<?php

namespace App\Models;
use SoftDeletes;
use App\Scopes\DeletedScope;

class Boxes extends MyModel
{
    const CREATED_AT = 'date_created_box';
    const UPDATED_AT = 'date_modified_box';
    const DELETED_AT = 'date_deleted_box';

    protected $table = 'boxes';
    protected $primaryKey = 'boxes_id';
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

    public function boxesHistory()
    {
        return $this->hasMany('App\Models\BoxesHistory');
    }

    public function customBoxPrice()
    {
        return $this->hasMany('App\Models\CustomBoxPrice');
    }

    public function packing()
    {
        $this->hasMany('App\Models\Packing');
    }

    public function providerHistory()
    {
        return $this->hasMany('App\Models\ProviderHistory');
    }

    public function shippingBoxRate()
    {
        return $this->hasMany('App\Models\ShippingBoxRate');
    }

    public function stockBox()
    {
        return $this->hasMany('App\Models\StockBox');
    }

    public function stockBoxHistory()
    {
        return $this->hasMany('App\Models\StockBoxHistory');
    }

    public function stores()
    {
        return $this->belongsToMany('App\Models\Store', 'custom_box_price', 'boxes_id', 'store_id');
    }

    public function warehouses()
    {
        return $this->belongsToMany('App\Models\Warehouse', 'stock_box', 'warehouse_id', 'boxes_id');
    }
    /*
    |--------------------------------------------------
    | Private
    |--------------------------------------------------
    */


}
