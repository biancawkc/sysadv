<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoTel extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "tp_telefone";
    protected $fillable = [
              'tp_telefone'
        
    ];
    
    protected $primaryKey = "id_tp_telefone";
    
    public $timestamps = false;

    

}
