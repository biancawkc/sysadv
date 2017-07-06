<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoParte extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "tp_parte";
    protected $fillable = [
              'desc_parte'
    ];
    
    protected $primaryKey = "id_tp_parte";
    
    public $timestamps = false;

    

}
