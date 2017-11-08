<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parcela extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "parcela";
    protected $fillable = [
              'valor',
              'num_parcela',
              'dt_venc',
              'id_forma_pag',
              'id_processo',
              'id_tp_parcela',
              'valor_ganho',
              'porcentagem',
              'juros',
              'multa',
              'desconto',
              'dias_atraso',
              'adversa_pag',
              'id_usuario'   
    ];
    
    protected $primaryKey = "id_parcela";
    
    /*public $timestamps = false;*/
    const CREATED_AT = 'dt_criacao';
    const UPDATED_AT = 'dt_atualizacao';

     public function formaPag()
    {
       
        return $this->hasOne('App\Models\formaPag', 'id_forma_pag');
    }

      public function tipoParcela()
    {
       
        return $this->hasOne('App\Models\TipoParcela', 'id_tp_parcela');
    }

}
