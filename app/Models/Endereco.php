<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "endereco";
    protected $fillable = [
              'cep',
              'logradouro',
              'complemento',
              'bairro',
              'uf',
              'cidade'
        
    ];
    
    protected $primaryKey = "id_endereco";
    
    public $timestamps = false;

    

}
