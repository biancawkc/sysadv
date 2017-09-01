<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comarca extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "comarca";
    protected $fillable = [
              'id_comarca',
              'comarca'
    ];
    
    protected $primaryKey = "id_comarca";
    
    public $timestamps = false;

    

}
