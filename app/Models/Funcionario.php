<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "funcionario";
    protected $fillable = [
              'dt_admissao',
              'dt_demissao',
              'qualificacoes'
        
    ];
    
    protected $primaryKey = "id_funcionario";
    
    public $timestamps = false;

}
