<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Justica extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "justica";
    protected $fillable = [
              'id_justica',
              'nm_justica'
    ];
    
    protected $primaryKey = "id_justica";
    
    public $timestamps = false;

    

}
