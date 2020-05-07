<?php

namespace App\Models;
use SoftDeletes;
class ResendItem extends MyModel
{
    public $timestamps = false;

    protected $table = 'resend_item';
    protected $primaryKey = 'resend_item_id';
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
    public function resendOrder()
    {
        return $this->belongsTo('App\Models\ResendOrder');
    }

    public function variant()
    {
        return $this->belongsTo('App\Models\Variant');
    }

    public function setParentProduct()
    {
        return $this->belongsTo('App\Models\Product', 'product_id', 'set_parent_product_id');
    }

    public function setParentVariant()
    {
        return $this->belongsTo('App\Models\Variant', 'variant_id', 'set_variant_product_id');
    }

    public function giveaway()
    {
        return $this->belongsTo('App\Models\Giveaway');
    }

    public function storePromotion()
    {
        return $this->belongsTo('App\Models\StorePromotion');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function tempSeparateTaskItem()
    {
        return $this->hasMany('App\Models\TempSeparateTaskItem');
    }
    /*
    |--------------------------------------------------
    | Private
    |--------------------------------------------------
    */


}
