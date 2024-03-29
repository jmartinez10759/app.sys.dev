<?php

namespace App\Http\Controllers\Administracion\Correos;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\MasterController;
use App\Model\Administracion\Correos\SysEnviadosModel;
use App\Model\Administracion\Correos\SysCorreosModel;
use App\Model\Administracion\Correos\SysCategoriasModel;
use App\Model\Administracion\Correos\SysCategoriasCorreosModel;

class RedactarController extends MasterController
{
    #se crea las propiedades
    private $_tabla_model;

    public function __construct(){
        parent::__construct();
        $this->_tabla_model = new SysEnviadosModel;
    }
    /**
     *Metodo para obtener la vista y cargar los datos
     *@access public
     *@param Request $request [Description]
     *@return void
     */
    public function index(){

        $data = self::page_mail();
        return self::_load_view('administracion.correos.redactar',$data);

    }
   /**
    *Metodo para obtener la vista y cargar los datos
    *@access public
    *@param Request $request [Description]
    *@return void
    */
    public function all( Request $request){

        try {
          $data = $this->consulta_emails();
          return $this->_message_success( 200, $data , self::$message_success );
        } catch (\Exception $e) {
              $error = $e->getMessage()." ".$e->getLine()." ".$e->getFile();
              return $this->show_error(6, $error, self::$message_error );
        }

    }
    /**
     *Metodo para realizar la consulta por medio de su id
     *@access public
     *@param Request $request [Description]
     *@return void
     */
    public function show( Request $request ){


    }
    /**
     *Metodo para
     *@access public
     *@param Request $request [Description]
     *@return void
     */
    public function store( Request $request){



    }
    /**
     *Metodo para la actualizacion de los registros
     *@access public
     *@param Request $request [Description]
     *@return void
     */
    public function update( Request $request){


    }
    /**
     *Metodo para borrar el registro
     *@access public
     *@param Request $request [Description]
     *@return void
     */
    public function destroy( Request $request ){


    }
}
