<?php

namespace App\Models;
use SoftDeletes;
class OrderCardHistory extends MyModel
{
    public $timestamps = false;
    const CREATED_AT = 'date_created';

    protected $table = 'order_card_history';
    protected $primaryKey = 'order_card_id';
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
    public function warehouseCard()
    {
        return $this->belongsTo('App\Models\WarehouseCard');
    }

    public function warehouseOrder()
    {
        return $this->belongsTo('App\Models\WarehouseOrder');
    }

    public function warehouse()
    {
        return $this->belongsTo('App\Models\Warehouse');
    }
    
    public function warehouseLocation()
    {
        return $this->belongsTo('App\Models\WarehouseLocation');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function actionProduct()
    {
        return $this->belongsTo('App\Models\ActionProduct', 'action_product_id', 'action_id');
    }

    /*
    |--------------------------------------------------
    | Private
    |--------------------------------------------------
    */


}
