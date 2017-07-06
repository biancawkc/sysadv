<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Processo extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "processo";
    protected $fillable = [
              'numero',
              'desc_processo',
              'nome_acao',
              'justica_grat',
              'acao_grat',
              'data_inicio',
              'data_final',
              'vara',
              'id_justica',
              'id_estado_processo',
              'id_comarca',
              'id_advogado'      
    ];
    
    protected $primaryKey = "id_processo";
    
    public $timestamps = false;


    public function etapa()
    {
       
        return $this->hasMany('App\Models\EtapaProcesso', 'id_etapa_processo');
    }

    public function estado()
    {
       
        return $this->hasOne('App\Models\EstadoProcesso', 'id_estado_processo');
    }

    public function documento()
    {
       
        return $this->hasMany('App\Models\Documento', 'id_documento');
    }

    public function procedimento()
    {
       
        return $this->hasOne('App\Models\TipoProcedimento', 'id_tp_procedimento');
    }

     public function parcela()
    {
       
        return $this->hasMany('App\Models\Parcela', 'id_parcela');
    }

         public function despesa()
    {
       
        return $this->hasMany('App\Models\Despesa', 'id_despesa');
    }

}
