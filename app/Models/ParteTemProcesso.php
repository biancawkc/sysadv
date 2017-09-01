<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParteTemProcesso extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "parte_tem_processo";
    protected $fillable = [
              'id_parte',
              'id_processo',
              'participacao'
        
    ];
    
    protected $primaryKey = null;
    public $incrementing = false;
    
    public $timestamps = false;
          
    public function TemParte()
    {
        return $this->belongsToMany('App\Models\Parte');
    }

    public function TemProcesso()
    {
      return $this->belongsToMany('App\Models\Processo');
    }

}
