<?php

namespace App\Models;
use SoftDeletes;
use App\Scopes\DeletedScope;

class ShelfType extends MyModel
{
    public $timestamps = false;
    const CREATED_AT = 'date_created';

    protected $table = 'shelf_type';
    protected $primaryKey = 'shelf_type_id';
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

    public function shelf()
    {
        return $this->hasMany('App\Models\Shelf', 'shelf_type_id');
    }

    public function user()
    {
        return $this->hasMany('App\Models\User');
    }

    /*
    |--------------------------------------------------
    | Private
    |--------------------------------------------------
    */


}
