<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Despesa extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "despesa";
    protected $fillable = [
              'valor',
              'desc_despesa',
              'dt_despesa',
              'id_processo'
        
    ];
    
    protected $primaryKey = "id_despesa";
    
    /*public $timestamps = false;*/
    const CREATED_AT = 'dt_criacao';
    const UPDATED_AT = 'dt_atualizacao';

    

}
