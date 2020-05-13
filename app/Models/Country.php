<?php

namespace App\Models;
use SoftDeletes;
use App\Scopes\DeletedScope;

class Country extends MyModel
{
    const CREATED_AT = 'date_created';
    const UPDATED_AT = 'date_modified';

    protected $table = 'country';
    protected $primaryKey = 'country_id';
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
    public function countryZone()
    {
        return $this->belongsTo('App\Models\CountryZone', 'country_zone_id', 'zone_id');
    }

    public function province()
    {
        return $this->hasMany('App\Models\Province');
    }

    public function providerMatchCountry()
    {
        return $this->hasMany('App\Models\ProviderMatchCountry');
    }

    public function shippingProvider()
    {
        return $this->hasMany('App\Models\ShippingProvider');
    }

    public function tempPackingTask()
    {
        return $this->hasMany('App\Models\Country', 'country_id', 'shipping_country_id');
    }
    

    /*
    |--------------------------------------------------
    | Private
    |--------------------------------------------------
    */


}
