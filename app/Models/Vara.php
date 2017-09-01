<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vara extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "vara";
    protected $fillable = [
              'vara'
        
    ];
    
    protected $primaryKey = "id_vara";
    
    public $timestamps = false;

    
}
