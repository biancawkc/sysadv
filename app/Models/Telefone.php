<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Telefone extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "telefone";
    protected $fillable = [
              'id_telefone',
              'telefone',
              'id_parte',
              'id_tp_telefone'
    ];
    
    protected $primaryKey = "id_telefone";
    
    public $timestamps = false;

    
       public function tpTelefone()
    {
       
        return $this->hasOne('App\Models\TipoTel', 'id_tp_telefone');
    }

}
