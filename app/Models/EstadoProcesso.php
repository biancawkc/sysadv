<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoProcesso extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "estado_processo";
    protected $fillable = [
              'desc_et_processo'
    ];
    
    protected $primaryKey = "id_estado_processo";
    
    public $timestamps = false;

}
