<?php

namespace App\Models;
use SoftDeletes;
use App\Scopes\DeletedScope;

class LotProduct extends MyModel
{
    public $timestamps = false;
    const CREATED_AT = 'date_created';
    const DELETED_AT = 'date_deleted';

    protected $table = 'lot_product';
    protected $primaryKey = 'lot_product_id';
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
    
    public function variant()
    {
        return $this->belongsTo('App\Models\Variant');
    }

    public function store()
    {
        return $this->belongsTo('App\Models\Store');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function userDelete()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'user_id_delete_lot');
    }

    public function userCreate()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'user_id_create_lot');
    }

    public function inboundList()
    {
        return $this->hasMany('App\Models\InboundList');
    }

    public function inboundMatchList()
    {
        return $this->hasMany('App\Models\InboundMatchList');
    }

    public function lotQty()
    {
        return $this->hasMany('App\Models\LotQty');
    }

    public function outboundList()
    {
        return $this->hasMany('App\Models\OutboundList');
    }

    public function productMovement()
    {
        return $this->hasMany('App\Models\ProductMovement');
    }

    public function receiveHistory()
    {
        return $this->hasMany('App\Models\ReceiveHistory');
    }

    public function serialNumber()
    {
        return $this->hasMany('App\Models\SerialNumber');
    }

    public function serialNumberHistory()
    {
        return $this->hasMany('App\Models\SerialNumberHistory');
    }

    public function stocklist()
    {
        return $this->hasMany('App\Models\Stocklist');
    }

    public function tempInboundItem()
    {
        return $this->hasMany('App\Models\TempInboundItem');
    }

    public function tempOutboundItem()
    {
        return $this->hasMany('App\Models\TempOutboundItem');
    }
    /*
    |--------------------------------------------------
    | Private
    |--------------------------------------------------
    */


}
