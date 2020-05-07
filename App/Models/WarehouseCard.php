<?php

namespace App\Models;
use SoftDeletes;
use App\Scopes\DeletedScope;

class WarehouseCard extends MyModel
{
    public $timestamps = false;

    protected $table = 'warehouse_card';
    protected $primaryKey = 'card_id';
    protected $attributes = []; // define default value
    
    // Mutators
    protected $dates = [
        'date_created',
        'date_deleted',
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

    public function resendOrder()
    {
        return $this->hasMany('App\Models\ResendOrder');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function warehouse()
    {
        return $this->belongsTo('App\Models\Warehouse');
    }

    public function orderCardHistory()
    {
        $this->hasMany('App\Models\OrderCardHistory');
    }

    public function warehouseOrder()
    {
        return $this->hasMany('App\Models\WarehouseOrder');
    }

    /*
    |--------------------------------------------------
    | Private
    |--------------------------------------------------
    */


}
