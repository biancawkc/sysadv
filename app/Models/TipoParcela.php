<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoParcela extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "tp_parcela";
    protected $fillable = [
              'tp_parcela'
    ];
    
    protected $primaryKey = "id_tp_parcela";
    
    public $timestamps = false;

}
