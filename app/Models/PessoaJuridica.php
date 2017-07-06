<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PessoaJuridica extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "pessoa_juridica";
    protected $fillable = [
              'id_parte',
              'cnpj',
              'razao_social',
              'nm_fantasia',
              'ins_estadual',
              'desc_atividades'
    ];
    
    //protected $primaryKey = "id_parte";
    
    public $timestamps = false;

}
