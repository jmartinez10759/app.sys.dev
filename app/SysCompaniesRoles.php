<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SysCompaniesRoles extends Model
{
    public $table = "sys_companies_roles";
    public $fillable = [
        'company_id' ,
        'roles_id'
    ];
}
