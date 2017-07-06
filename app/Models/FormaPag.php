<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormaPag extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "forma_pag";
    protected $fillable = [
              'nome',
              'qtd_parcelas' 
    ];
    
    protected $primaryKey = "id_forma_pag";
    
    public $timestamps = false;

}
