<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Etapa extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "etapa";
    protected $fillable = [
              'nm_etapa'       
    ];
    
    protected $primaryKey = "id_etapa";
    
    public $timestamps = false;
    

}
