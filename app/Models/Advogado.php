<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advogado extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "advogado";
    protected $fillable = [
              'oab',
              'seccional'
        
    ];
    
    protected $primaryKey = "id_advogado";
    
    public $timestamps = false;

    
     public function processo()
    {
       
        return $this->hasMany('App\Models\Processo', 'id_processo');
    }

}
