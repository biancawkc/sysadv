<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parte extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "parte";
    protected $fillable = [
              'ativo',
              'email'
    ];
    
    protected $primaryKey = "id_parte";
    
    public $timestamps = false;

       public function Tipo()
    {
       
        return $this->hasOne('App\Models\TipoParte', 'id_tp_parte');
    }

}
