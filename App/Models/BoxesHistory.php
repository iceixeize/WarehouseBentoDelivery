<?php

namespace App\Models;
use SoftDeletes;
class BoxesHistory extends MyModel
{
    public $timestamps = false;

    protected $table = 'boxes_history';
    protected $primaryKey = 'boxes_history_id';
    protected $attributes = []; // define default value
    
    // Mutators
    protected $dates = [
        'datetime'
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
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    
    public function actionName()
    {
        return $this->belongsTo('App\Models\ActionName');
    }

    public function packingOption()
    {
        return $this->belongsTo('App\Models\PackingOption');
    }

    public function packingOptionPackage()
    {
        return $this->belongsTo('App\Models\PackingOptionPackage');
    }

    public function boxes()
    {
        return $this->belongsTo('App\Models\Boxes');
    }
    /*
    |--------------------------------------------------
    | Private
    |--------------------------------------------------
    */


}