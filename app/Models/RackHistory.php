<?php

namespace App\Models;
use SoftDeletes;
class RackHistory extends MyModel
{
    public $timestamps = false;

    protected $table = 'rack_history';
    protected $primaryKey = 'rack_history_id';
    protected $attributes = []; // define default value
    
    // Mutators
    protected $dates = [
        'datetime',
    ]; // additional date attributes to convert columns to instances of Carbon, which extends the PHP
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

    public function rack()
    {
        return $this->belongsTo('App\Models\Rack');
    }

    public function shelf()
    {
        return $this->belongsTo('App\Models\Shelf');
    }

    public function subshelf()
    {
        return $this->belongsTo('App\Models\Subshelf');
    }

    public function action()
    {
        return $this->belongsTo('App\Models\ActionName');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function shelfMerge()
    {
        return $this->belongsTo('App\Models\Shelf');
    }

    public function shelfSeparate()
    {
        return $this->belongsTo('App\Models\Shelf');
    }

    public function warehouse()
    {
        return $this->belongsTo('App\Models\Warehouse');
    }
    /*
    |--------------------------------------------------
    | Private
    |--------------------------------------------------
    */


}
