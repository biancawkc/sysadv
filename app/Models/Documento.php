<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "documento";
    protected $fillable = [
              'nome_documento',
              'desc_documento',
              'documento',
              'id_processo'   
    ];
    
    protected $primaryKey = "id_documento";
    
    public $timestamps = false;

}
