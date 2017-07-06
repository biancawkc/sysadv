<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profissao extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "profissao";
    protected $fillable = [
              'nm_profissao',
              'cbo',
              'remuneracao'
    ];
    
    protected $primaryKey = "id_profissao";
    
    public $timestamps = false;

}
