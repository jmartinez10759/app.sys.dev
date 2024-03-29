<?php
    namespace App\Http\Controllers\Administracion\Configuracion;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Session;
    use App\Http\Controllers\MasterController;
    use App\Model\Administracion\Configuracion\SysImpuestoModel;
    use App\Model\Administracion\Configuracion\SysTasaModel;
    use Symfony\Component\HttpFoundation\JsonResponse;
    use Symfony\Component\HttpFoundation\Response;

    class ImpuestoController extends MasterController
    {
        #se crea las propiedades
        private $_tabla_model;

        public function __construct(){
            parent::__construct();
            $this->_tabla_model = new SysImpuestoModel;
        }
        /**
        *Metodo para obtener la vista y cargar los datos
        *@access public
        *@param Request $request [Description]
        *@return void
        */
        public function index(){
            if( Session::get("permisos")["GET"] ){
              return view("errors.error");
            }
            
            $data = [
                "page_title" 	        => "Configuración"
                ,"title"  		        => "Impuesto"
                
            ];
            return self::_load_view( "administracion.configuracion.impuesto",$data );
        }
        /**
         *Metodo para obtener los datos de manera asicronica.
         *@access public
         *@param Request $request [Description]
         *@return void
         */
        public function all( Request $request ){

            try {
                $response = $this->_tabla_model::get();
                 $data = [
          'impuesto'  => $response
        ];

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

        try {
            $where = ['id' => $request->id];
            $response = SysImpuestoModel::where( $where )->groupby('id')->get();

        return $this->_message_success( 200, $response[0] , self::$message_success );
        } catch (\Exception $e) {
        $error = $e->getMessage()." ".$e->getLine()." ".$e->getFile();
        return $this->show_error(6, $error, self::$message_error );
        }

    }
    /**
    *Metodo para
    *@access public
    *@param Request $request [Description]
    *@return void
    */
    public function store( Request $request){

        $error = null;
        DB::beginTransaction();
        try {

            // debuger($request->all());
            $response = $this->_tabla_model::create( $request->all() );


        DB::commit();
        $success = true;
        } catch (\Exception $e) {
        $success = false;
        $error = $e->getMessage()." ".$e->getLine()." ".$e->getFile();
        DB::rollback();
        }

        if ($success) {
        return $this->_message_success( 201, $response , self::$message_success );
        }
        return $this->show_error(6, $error, self::$message_error );


    }
    /**
    *Metodo para la actualizacion de los registros
    *@access public
    *@param Request $request [Description]
    *@return void
    */
    public function update( Request $request){

        $error = null;
        DB::beginTransaction();
        try {
        //     $string_key_impuesto = [ 'id','clave','descripcion','retencion','traslado','localfederal'];
        //     $string_data_impuesto = [];
        //     foreach( $request->all() as $key => $value ){
        //         if( in_array( $key, $string_key_impuesto) ){
        //            $string_data_impuesto[$key] = $value; 
        //         }
                
        // }

            $response = $this->_tabla_model::where(['id' => $request->id] )->update( $request->all() );

        DB::commit();
        $success = true;
        } catch (\Exception $e) {
        $success = false;
        $error = $e->getMessage()." ".$e->getLine()." ".$e->getFile();
        DB::rollback();
        }

        if ($success) {
        return $this->_message_success( 201, $response , self::$message_success );
        }
        return $this->show_error(6, $error, self::$message_error );

    }
    /**
    * Metodo para borrar el registro
    * @access public
    * @param Request $request [Description]
    * @return void
    */
    public function destroy( Request $request ){

        $error = null;
        DB::beginTransaction();
        try {
             $response = SysImpuestoModel::where(['id' => $request->id])->delete();

        DB::commit();
        $success = true;
        } catch (\Exception $e) {
        $success = false;
        $error = $e->getMessage()." ".$e->getLine()." ".$e->getFile();
        DB::rollback();
        }

        if ($success) {
        return $this->_message_success( 201, $response , self::$message_success );
        }
        return $this->show_error(6, $error, self::$message_error );

    }

        /**
         * This method is used get for taxes tasas
         * @access public
         * @param int|null $tasaId
         * @param SysTasaModel $tasas
         * @return JsonResponse
         */
        public function taxesByTasa( int $tasaId = null, SysTasaModel $tasas )
        {
            try {
                $tasa= $tasas->find($tasaId);
                $taxes = SysImpuestoModel::whereDescripcion($tasa->clave)->get();
                $data = [
                    'valor_maximo' =>  $tasa->valor_maximo
                    ,'taxes'    =>  $taxes
                ];
                return new JsonResponse([
                    "success" => TRUE ,
                    "data"    => $data ,
                    "message" => self::$message_success
                ], Response::HTTP_OK);

            } catch (\Exception $e) {
                $error = $e->getMessage()." ".$e->getLine()." ".$e->getFile();
                return new JsonResponse([
                    "success" => FALSE ,
                    "data"    => $error ,
                    "message" => self::$message_error
                ], Response::HTTP_BAD_REQUEST);
            }


        }


}