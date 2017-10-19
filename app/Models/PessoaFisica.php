<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PessoaFisica extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "pessoa_fisica";
    protected $fillable = [
              'id_parte',
              'nome',
              'rg',
              'orgao_exp',
              'cpf',
              'ctps',
              'serie_ctps',
              'id_funcionario',
              'id_advogado',
              'id_profissao',
              'id_estado_civil',
              'id_profissao',
              'remuneracao'        
    ];
    
   // protected $primaryKey = "id_parte";
    
    public $timestamps = false;
    protected $primaryKey = null;
    public $incrementing = false;

    
       public function funcionario()
    {
       
        return $this->hasOne('App\Models\Funcionario', 'id_funcionario');
    }

           public function advogado()
    {
       
        return $this->hasOne('App\Models\Advogado', 'id_advogado');
    }

     public function parte() 
    {

        return $this->belongsTo('App\Models\Parte');
    }

           public function profissao()
    {
       
        return $this->hasOne('App\Models\Profissao', 'id_profissao');
    }

}
