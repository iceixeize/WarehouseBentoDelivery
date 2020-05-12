<?php

namespace App\Models;
use SoftDeletes;
use App\Scopes\ActiveScope;

class Subdistrict extends MyModel
{
    public $timestamps = false;

    protected $table = 'subdistrict';
    protected $primaryKey = 'sub_dist_id';
    protected $attributes = []; // define default value
    
    // Mutators
    protected $dates = [
        'date_modified',
    ]; // additional date attributes to convert columns to instances of Carbon, which extends the PHP
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
    public function district()
    {
        return $this->belongsTo('App\Models\District');
    }

    /*
    |--------------------------------------------------
    | Private
    |--------------------------------------------------
    */


}