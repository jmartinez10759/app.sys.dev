<?php

namespace App;

use App\Model\Administracion\Configuracion\SysEmpresasModel;
use App\Model\Administracion\Configuracion\SysSucursalesModel;
use App\Model\Administracion\Configuracion\SysUsersModel;
use Illuminate\Database\Eloquent\Model;

class SysBoxes extends Model
{
    public $table = "boxes";
    public $fillable = [
        'id'
        ,'name'
        ,'description'
        ,'status'
        ,'is_active'
        ,'init_mount'
        ,'mount_total'
    ];
    public function companies()
    {
        return $this->belongsToMany(SysEmpresasModel::class,'companies_boxes','box_id','company_id')
                    ->withPivot("group_id","user_id");
    }
    public function groups()
    {
        return $this->belongsToMany(SysSucursalesModel::class,'companies_boxes','box_id','group_id')
            ->withPivot("company_id","user_id");
    }
    public function users()
    {
        return $this->belongsToMany(SysUsersModel::class,'companies_boxes','box_id','user_id')
            ->withPivot("company_id","group_id");
    }
    public function orders()
    {
        return $this->hasMany(SysOrders::class,'box_id','id');
    }
    public function logs()
    {
        return $this->belongsToMany(SysUsersModel::class,'boxes_logs','box_id','user_id')->withPivot("created_at");
    }
    public function cuts()
    {
        return $this->hasMany(SysCuts::class,'box_id','id');
    }
    public function extracts()
    {
        return $this->hasMany(SysExtract::class,'box_id','id');
    }

}
