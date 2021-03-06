<?php

namespace App\Model\Administracion\Configuracion;

use Illuminate\Database\Eloquent\Model;

class SysClientesModel extends Model
{
    public $table = "sys_clientes";
    public $fillable = [
      'id'
      ,'id_uso_cfdi'
      ,'rfc_receptor'
      ,'nombre_comercial'
      ,'razon_social'
      ,'calle'
      ,'colonia'
      ,'municipio'
      ,'id_country'
      ,'id_codigo'
      ,'id_estado'
      ,'id_servicio_comercial'
      ,'telefono'
      ,'logo'
      ,'estatus'
    ];

    public function facturas()
    {
      return $this->belongsToMany('App\Model\Administracion\Facturacion\SysFacturacionModel','sys_users_facturacion','id_cliente','id_factura');
    }
    /*public function facturaciones()
    {
      return $this->belongsToMany('App\Model\Ventas\SysFacturacionesModel','sys_users_facturaciones','id_cliente','id_facturacion');
    }*/
    public function usuarios()
    {
      return $this->belongsToMany(SysUsersModel::class,'sys_users_facturacion','id_cliente','id_users');
    }
    public function estados()
    {
      return $this->hasOne(SysEstadosModel::class,'id','id_estado');
    }
    public function contactos()
    {
      return $this->belongsToMany(SysContactosModel::class,'sys_contactos_sistemas','id_cliente','id_contacto');
    }
    public function empresas()
    {
      return $this->belongsToMany(SysEmpresasModel::class,'sys_clientes_empresas','id_cliente','id_empresa');
    }
    public function sucursales()
    {
      return $this->belongsToMany(SysSucursalesModel::class,'sys_clientes_empresas','id_cliente','id_sucursal');
    }
    public function pedidos()
    {
        return $this->belongsTo('App\Model\Ventas\SysPedidosModel','id','id_cliente');
    }
    public function usoCfdi()
    {
      return $this->hasOne(SysUsoCfdiModel::class,'id','id_uso_cfdi');
    }
    public function paises()
    {
      return $this->hasOne(SysPaisModel::class, 'id','id_country');
    }
    public function comerciales()
    {
      return $this->hasOne( SysServiciosComercialesModel::class, 'id','id_servicio_comercial');
    }
    public function codigos()
    {
       return $this->hasOne( SysCodigoPostalModel::class, 'id','id_codigo');
    }
    public function actividades()
    {
      return $this->belongsToMany(SysActivitiesModel::class, 'sys_users_activities', 'id_cliente' ,'id_actividad');
    }
    public function archivos()
    {
      return $this->belongsToMany(SysFilesCompanysModel::class,'sys_users_files','id_cliente','id_archivo');
    }


}
