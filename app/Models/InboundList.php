<?php

namespace App\Models;
use SoftDeletes;
class InboundList extends MyModel
{
    const CREATED_AT = 'date_created';
    const UPDATED_AT = 'date_last_update';

    protected $table = 'InboundList';
    protected $primaryKey = 'inbound_list_id';
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

    public function outbound()
    {
        return $this->belongsTo('App\Models\Outbound');
    }

    public function variant()
    {
        return $this->belongsTo('App\Models\Variant');
    }

    public function lotProductId()
    {
        return $this->belongsTo('App\Models\LotProduct');
    }

    public function store()
    {
        return $this->belongsTo('App\Models\Store');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function receiveReceipt()
    {
        return $this->belongsTo('App\Models\ReceiveReceipt');
    }

    /*
    |--------------------------------------------------
    | Private
    |--------------------------------------------------
    */


}
