<?php

namespace App\Models;
use SoftDeletes;
use App\Scopes\DeletedScope;

class ShippingBoxRate extends MyModel
{
    public $timestamps = false;

    protected $table = 'shipping_box_rate';
    protected $primaryKey = 'shipping_box_rate_id';
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

    public function providerHistory()
    {
        return $this->hasMany('App\Models\ProviderHistory');
    }

    public function boxes()
    {
        return $this->belongsTo('App\Models\Boxes');
    }

    public function shippingProvider()
    {
        return $this->belongsTo('App\Models\ShippingProvider');
    }
    
    public function shippingPrive()
    {
        return $this->hasMany('App\Models\ShippingPrice');
    }
    
    /*
    |--------------------------------------------------
    | Private
    |--------------------------------------------------
    */


}
