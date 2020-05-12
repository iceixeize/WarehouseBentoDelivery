<?php

namespace App\Models;
use Illuminate\Database\Eloquent\softDeletes;
use App\Scopes\ShelfActiveScope;

class Shelf extends MyModel
{
    use SoftDeletes;
    // public $timestamps = false;
    const CREATED_AT = 'shelf_date_create';
    const UPDATED_AT = 'shelf_date_modified';

    protected $table = 'shelf';
    protected $primaryKey = 'shelf_id';
    protected $attributes = [
        'shelf_active' => 1,
    ]; // define default value
    
    // Mutators
    protected $dates = []; // additional date attributes to convert columns to instances of Carbon, which extends the PHP
    protected $casts = [];
    protected $appends = []; // append value to JSON (Eloquent > Serialization)
    protected $hidden = []; // hiding attributes from JSON (Eloquent > Serialization)
    
    protected $fillable = [
        'shelf_no',
        'shelf_type_id',
        'shelf_type',
        'shelf_seq',
        'warehouse_id',
        'rack_id',
    ];

    protected static function boot() {
        parent::boot();
        static::addGlobalScope(new ShelfActiveScope);

        static::created(function ($model) {
            
        });
        static::updated(function ($model) {
            
        });

        static::deleting(function($model) {

            $model->subshelf()->each(function($subshelf) {
                $subshelf->subshelf_active = 0;
                $subshelf->save();
                $subshelf->delete(); // <-- direct deletion
             });
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
        return $query->where('shelf_active', 1);
    }


    /*
    |--------------------------------------------------
    | Relation
    |--------------------------------------------------
    */

    public function lot_qty()
    {
        return $this->hasMany('App\Models\LotQty', 'shelf_id');
    }

    public function rack() 
    {
        return $this->belongsTo('App\Models\Rack', 'rack_id');
    }

    public function shelfType() 
    {
        return $this->belongsTo('App\Models\ShelfType', 'shelf_type_id');
    }

    public function warehouse() 
    {
        return $this->belongsTo('App\Models\Warehouse');
    }

    public function subshelf()
    {
        return $this->hasMany('App\Models\Subshelf', 'shelf_id');
    }

    public function outboundList()
    {
        return $this->hasMany('App\Models\OutboundList');
    }

    public function renting()
    {
        return $this->hasMany('App\Models\Renting', 'shelf_id');
    }

    public function paymentRenting()
    {
        return $this->hasMany('App\Models\PaymentRenting');
    }

    public function productMovement()
    {
        return $this->hasMany('App\Models\ProductMovement');
    }

    public function rackHistory()
    {
        return $this->hasMany('App\Models\RackHistory');
    }

    public function stocklist()
    {
        return $this->hasMany('App\Models\Stocklist');
    }

    /*
    |--------------------------------------------------
    | Private
    |--------------------------------------------------
    */


}
