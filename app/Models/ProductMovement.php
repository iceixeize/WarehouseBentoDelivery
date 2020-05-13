<?php

namespace App\Models;
use SoftDeletes;
class ProductMovement extends MyModel
{
    public $timestamps = false;

    protected $table = 'product_movement';
    protected $primaryKey = 'product_movement_id';
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



    /*
    |--------------------------------------------------
    | Relation
    |--------------------------------------------------
    */
    public function damageProductPic() 
    {
        return $this->hasOne('App\Models\DamageProductPic');
    }
    
    public function subshelf()
    {
        return $this->belongsTo('App\Models\Subshelf');
    }

    public function variant()
    {
        return $this->belongsTo('App\Models\Variant');
    }

    public function action()
    {
        return $this->belongsTo('App\Models\ActionName');
    }

    public function warehouseLocation()
    {
        return $this->belongsTo('App\Models\WarehouseLocation');
    }

    public function receiveReceipt()
    {
        return $this->belongsTo('App\Models\ReceiveReceipt');
    }

    public function description()
    {
        return $this->belongsTo('App\Models\Description');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function store()
    {
        return $this->belongsTo('App\Models\Store'); 
    }

    public function shelf()
    {
        return $this->belongsTo('App\Models\Shelf');
    }

    public function rack()
    {
        return $this->belongsTo('App\Models\Rack');
    }

    public function warehouse()
    {
        return $this->belongsTo('App\Models\Warehouse');
    }

    public function lotProduct()
    {
        return $this->belongsTo('App\Models\LotProduct');
    }

    public function outboundTask()
    {
        return $this->belongsTo('App\Models\OutboundTask');
    }

    public function moveToWarehouse()
    {
        return $this->belongsTo('App\Models\Warehouse');
    }

    public function warehouseOrder()
    {
        return $this->belongsTo('App\Models\WarehouseOrder');
    }

    public function resendOrder()
    {
        return $this->belongsTo('App\Models\ResendOrder');
    }

    /*
    |--------------------------------------------------
    | Private
    |--------------------------------------------------
    */


}
