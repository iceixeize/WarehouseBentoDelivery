<?php

namespace App\Models;
use SoftDeletes;
class Subshelfs extends MyModel
{
    // public $timestamps = false;
    const CREATED_AT = 'subshelf_date_create';
    const UPDATED_AT = 'subshelf_date_modified';

    protected $table = 'subshelfs';
    protected $primaryKey = 'subshelf_id';
    protected $attributes = [
        'subshelf_active' => 1,
        'subshelf_available' => 1,
    ]; // define default value
    
    // Mutators
    protected $dates = []; // additional date attributes to convert columns to instances of Carbon, which extends the PHP
    protected $casts = [];
    protected $appends = []; // append value to JSON (Eloquent > Serialization)
    protected $hidden = []; // hiding attributes from JSON (Eloquent > Serialization)

    protected $fillable = [
        'subshelf_no',
        'rack_id',
        'shelf_id',
        'warehouse_id',
        'subshelf_barcode',
    ];
    

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
    public function scopeActive($query)
    {
        return $query->where('subshelf_active', 1);
    }


    /*
    |--------------------------------------------------
    | Relation
    |--------------------------------------------------
    */

    public function rack()
    {
        return $this->belongsTo('App\Models\Racks');
    }

    public function shelf()
    {
        return $this->belongsTo('App\Models\Shelfs');
    }

    
    /*
    |--------------------------------------------------
    | Private
    |--------------------------------------------------
    */


}
