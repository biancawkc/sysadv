<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoCivil extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "estado_civil";
    protected $fillable = [
             
              'desc_estado_civil'
        
    ];
    
    protected $primaryKey = "id_estado_civil";
    
    public $timestamps = false;

    

}
