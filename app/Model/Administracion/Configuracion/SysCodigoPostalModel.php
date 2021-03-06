<?php

namespace App\Model\Administracion\Configuracion;

use Illuminate\Database\Eloquent\Model;

class SysCodigoPostalModel extends Model
{
      public $table = "sys_codigos_postales";
      public $fillable = [
      	'id'
      	,'codigo_postal'
      	,'estado'
      	,'municipio'
      	,'localidad'
      ];

    public function empresas()
    {
      return $this->belongsTo(SysEmpresasModel::class, 'id_codigo', 'id');
    }
    public function estados()
    {
        return $this->belongsTo(SysEstadosModel::class, 'id_codigo', 'id');
    }

}