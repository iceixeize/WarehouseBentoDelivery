<?php

namespace App\Models;
use Illuminate\Database\Eloquent\softDeletes;
use App\Scopes\SubshelfActiveScope;

class Subshelf extends MyModel
{
    use SoftDeletes;
    // public $timestamps = false;
    const CREATED_AT = 'subshelf_date_create';
    const UPDATED_AT = 'subshelf_date_modified';

    protected $table = 'subshelf';
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

    protected $touches = ['shelf', 'rack'];
    
    protected $fillable = [
        'subshelf_no',
        'rack_id',
        'shelf_id',
        'warehouse_id',
        'subshelf_barcode',
    ];
    
    protected static function boot() {
        parent::boot();
        static::addGlobalScope(new SubshelfActiveScope);

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
        return $this->belongsTo('App\Models\Rack', 'rack_id');
    }

    public function shelf()
    {
        return $this->belongsTo('App\Models\Shelf', 'shelf_id');
    }

    public function warehouse()
    {
        return $this->belongsTo('App\Models\Warehouse');
    }

    public function outboundList()
    {
        return $this->hasMany('App\Models\OutboundList');
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
