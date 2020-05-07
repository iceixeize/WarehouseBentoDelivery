<?php

namespace App\Models;
use SoftDeletes;
use App\Scopes\DeletedScope;

class StoreShippingKey extends MyModel
{
    const CREATED_AT = 'date_created';
    const UPDATED_AT = 'date_modified';
    
    protected $table = 'store_shipping_key';
    protected $primaryKey = 'store_shipping_key_id';
    protected $attributes = []; // define default value
    
    // Mutators
    protected $dates = []; // additional date attributes to convert columns to instances of Carbon, which extends the PHP
    protected $casts = [
        'optimize_list' => 'array',
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



    /*
    |--------------------------------------------------
    | Relation
    |--------------------------------------------------
    */
    public function store()
    {
        return $this->belongsTo('App\Models\Store');
    }

    public function shippingProvider()
    {
        return $this->belongsTo('App\Models\ShippingProvider');
    }

    public function createUser()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function deleteUser()
    {
        return $this->belongsTo('App\Models\User');
    }

    
    /*
    |--------------------------------------------------
    | Private
    |--------------------------------------------------
    */


}
