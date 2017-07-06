<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EtapaProcesso extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "etapa_processo";
    protected $fillable = [
             
              'nome',
              'desc_etapa',
              'instancia',
              'dt_etapa',
              'dt_prazo',
              'id_processo'
        
    ];
    
    protected $primaryKey = "id_etapa_processo";
    
    public $timestamps = false;

    

}
