<?php


namespace App\Http\Controllers\SalesOfPoint;


use App\Facades\Ticket;
use App\Http\Controllers\MasterController;
use App\SysBoxes;
use App\SysCuts;
use App\SysExtract;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\JsonResponse;

class BoxesController extends MasterController
{
    private $ticket;
    /**
     * BoxesController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->ticket = new Ticket("EPSON");
    }
    /**
     * @access public
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = [
            'page_title' 	              => "Punto de Venta"
            ,'title'  		              => "Cajas"
        ];
        return $this->_loadView( 'salesOfPoint.boxes', $data );
    }

    /**
     * This method is for get all data boxes by company
     * @access public
     * @return JsonResponse
     */
    public function all()
    {
        try {
            $data = [
                "boxes"     => $this->_boxesBelongsCompany() ,
                "users"     => $this->_usersBelongsCompany() ,
            ];
            \Log::debug($data);
            return new JsonResponse([
                "success" => true ,
                "data"    => $data ,
                "message" => self::$message_success
            ],Response::HTTP_OK);

        } catch ( \Exception $e) {
            $error = $e->getMessage()." ".$e->getLine()." ".$e->getFile();
            \Log::debug($error);
            return new JsonResponse([
                "success" => false ,
                "data"    => $error ,
                "message" => self::$message_error
            ],Response::HTTP_BAD_REQUEST);
        }

    }

    /**
     * This method is for insert information in boxes
     * @access public
     * @param Request $request [Description]
     * @param SysBoxes $boxes
     * @return JsonResponse
     */
    public function store( Request $request, SysBoxes $boxes )
    {
        $error = null;
        DB::beginTransaction();
        try {
            $data = array_filter($request->all(), function ($key) use ($request){
                if($key != "groupId" && $key != "companyId" && $key != "userId"){
                    $data[$key] = $request->$key;
                    if ($request->$key == 0){
                        $data[$key] = "0";
                    }
                    return $data;
                }
            },ARRAY_FILTER_USE_KEY);
            $response = $boxes->create($data);
            $box = $boxes->find($response->id);
            if ( isset($request->companyId ) ){
                $box->groups()->attach($request->get("groupId"),[
                    'company_id'    => $request->get("companyId") ,
                    'user_id'       => $request->get("userId")
                ]);
            }else{
                $box->groups()->attach([Session::get('group_id')],[
                    'company_id' => Session::get('company_id') ,
                    'user_id'    => $request->get("userId")
                ]);
            }
            DB::commit();
            $success = true;
        } catch (\Exception $e) {
            $success = false;
            $error = $e->getMessage() . " " . $e->getLine() . " " . $e->getFile();
            \Log::error($error);
            DB::rollback();
        }

        if ($success) {
            return new JsonResponse([
                'success'   => $success
                ,'data'     => $response
                ,'message' => self::$message_success
            ],Response::HTTP_CREATED);
        }
        return new JsonResponse([
            'success'   => $success
            ,'data'     => $error
            ,'message' => self::$message_error
        ],Response::HTTP_BAD_REQUEST);

    }

    /**
     * This method is for get information the roles by companies
     * @access public
     * @param int|null $id
     * @param SysBoxes $boxes
     * @return JsonResponse
     */
    public function show( int $id = null, SysBoxes $boxes )
    {
        try {
            $response = $boxes->with(['companies','groups','users','extracts','logs' => function($query){
                return $query->where('boxes_logs.created_at','LIKE',$this->_today->format('Y-m-d').'%');
            }])->find($id);
            return new JsonResponse([
                'success'   => true
                ,'data'     => $response
                ,'message'  => self::$message_success
            ],Response::HTTP_OK);

        } catch (\Exception $e) {
            $error = $e->getMessage() . " " . $e->getLine() . " " . $e->getFile();
            \Log::debug($error);
            return new JsonResponse([
                'success'   => false
                ,'data'     => $error
                ,'message'  => self::$message_error
            ],Response::HTTP_BAD_REQUEST);

        }

    }

    /**
     * This method is used find box is active
     * @param int|null $id
     * @param int|null $userId
     * @param SysBoxes $boxes
     * @return JsonResponse
     */
    public function findActiveBox(int $id = null, int $userId = null, SysBoxes $boxes)
    {
        $error = null;
        DB::beginTransaction();
        try {
            $today = $this->_today->format("Y-m-d");
            $box = $boxes->with(["logs" => function($query) use ($userId, $today){
                return $query->where(["boxes_logs.user_id" => $userId])->where('boxes_logs.created_at',"LIKE",$today."%");
            }])->whereIdAndIsActive($id,true)->first();

            $findBox = $boxes->find($id);
            if (is_null($box)){
                $findBox->logs()->attach($userId);
                $findBox->update(['is_active' => true]);
            }
            if( $findBox->logs()->count() == 0 ){
                $findBox->logs()->attach($userId);
            }
            $box = $boxes->with(["logs" => function($query) use ($userId, $today){
                return $query->where(["boxes_logs.user_id" => $userId])->where('boxes_logs.created_at',"LIKE",$today."%");
            }])->whereIdAndIsActive($id,true)->first();
            DB::commit();
            $success = true;
        } catch (\Exception $e) {
            $success = false;
            $error = $e->getMessage() . " " . $e->getLine() . " " . $e->getFile();
            \Log::error($error);
            DB::rollback();
        }

        if ($success) {
            return new JsonResponse([
                'success'   => $success
                ,'data'     => $box
                ,'message'  => self::$message_success
            ],Response::HTTP_CREATED);
        }
        return new JsonResponse([
            'success'   => $success
            ,'data'     => $error
            ,'message' => self::$message_error
        ],Response::HTTP_BAD_REQUEST);
    }

    /**
     * This method is for update register the roles
     * @access public
     * @param Request $request [Description]
     * @param SysBoxes $boxes
     * @param SysExtract $extracts
     * @return JsonResponse
     */
    public function update( Request $request, SysBoxes $boxes, SysExtract $extracts )
    {
        $error = null;
        DB::beginTransaction();
        try {
            $data = array_filter($request->all(), function ($key) use ($request){
                if($key != "companyId" && $key != "groupId" && $key != "userId" && $key != "is_extract" && $key != "extract"){
                    $data[$key] = $request->$key;
                    if ($request->$key == 0){
                        $data[$key] = "0";
                    }
                    return $data;
                }
            },ARRAY_FILTER_USE_KEY);

            \Log::debug($data);
            $box = $boxes->find($request->get('id'));
            $box->update($data);
            if ( isset($request->companyId) && $request->companyId){
                $box->groups()->detach();
                $box->groups()->attach($request->get("groupId"),[
                    'company_id'    => $request->get("companyId") ,
                    'user_id'       => $request->get("userId")
                ]);
            }
            if ( isset($request->is_extract) && $request->is_extract){
                \Log::debug(sprintf("Insert in extract: %s", $request->is_extract) );
                $extracts->create([
                    'box_id'        => $box->id ,
                    'user_id'       => $request->get("userId") ,
                    'extract'       => $request->get("extract"),
                    'motives'       => $request->get("motives")
                ]);
            }

            DB::commit();
            $success = true;
        } catch ( \Exception $e) {
            $success = false;
            $error = $e->getMessage() . " " . $e->getLine() . " " . $e->getFile();
            \Log::error($error);
            DB::rollback();
        }

        if ($success) {
            return $this->show( $request->get("id"), $boxes );
        }
        return new JsonResponse([
            'success'   => $success
            ,'data'     => $error
            ,'message'  => self::$message_error
        ],Response::HTTP_BAD_REQUEST);

    }

    /**
     * This method is for destroy register the rol by companies
     * @access public
     * @param int $id [Description]
     * @param SysBoxes $boxes
     * @return JsonResponse
     */
    public function destroy( int $id = null, SysBoxes $boxes )
    {
        $error = null;
        DB::beginTransaction();
        try {
            $box = $boxes->find($id);
            $box->groups()->detach();
            $box->extracts()->detach();
            $box->delete();
            DB::commit();
            $success = true;
        } catch (\Exception $e) {
            $success = false;
            $error = $e->getMessage() . " " . $e->getLine() . " " . $e->getFile();
            \Log::error($error);
            DB::rollback();
        }

        if ($success) {
            return new JsonResponse([
                'success'   => $success
                ,'data'     => []
                ,'message' => self::$message_success
            ],Response::HTTP_OK);
        }
        return new JsonResponse([
            'success'   => $success
            ,'data'     => $error
            ,'message' => self::$message_error
        ],Response::HTTP_BAD_REQUEST);

    }

    /**
     * This method is used close box and cut box
     * @param int|null $id
     * @param int|null $countCut
     * @param SysBoxes $boxes
     * @return JsonResponse
     */
    public function boxCut(int $id = null,int $countCut = null ,SysBoxes $boxes)
    {
        try {
            $countCut = (!$countCut)? 1: $countCut;
            $today = $this->_today->format('Y-m-d');
            $box = $boxes->with(['orders' => function($query) use ($today,$countCut){
                return $query->whereCount($countCut)->where('created_at','LIKE',$today.'%');
            }])->find($id);
            $subtotal   = $box->orders()
                ->whereCount($countCut)
                ->where('created_at','LIKE',$today.'%')
                ->where('status_id','!=' ,4)->sum("subtotal");
            $iva        = $box->orders()
                ->whereCount($countCut)
                ->where('created_at','LIKE',$today.'%')
                ->where('status_id','!=' ,4)->sum("iva");
            $total      = $box->orders()
                ->whereCount($countCut)
                ->where('created_at','LIKE',$today.'%')
                ->where('status_id','!=' ,4)->sum("total");
            $extract    = $box->extracts()
                ->where('created_at','LIKE',$today.'%')
                ->sum('extract');

            $dataPrinter = [];
            foreach ($box->companies as $company){
                $dataPrinter = [
                    "rfc"               =>  $company->rfc_emisor ,
                    "social_reason"     =>  $company->razon_social ,
                    "logo"              =>  $company->logo ,
                    "address"           =>  $company->calle ,
                    "postal_code"       =>  $company->codigo,
                    "state"             =>  $company->states->estado ,
                    "country"           =>  $company->countries->descripcion ,
                    "subtotal"          =>  $subtotal ,
                    "iva"               =>  $iva ,
                    "total"             =>  $total ,
                    "init_mount"        =>  $box->init_mount ,
                    "extract"           =>  $extract,
                    #"n_extract"         =>  $box->extracts()->where('created_at','LIKE',$today.'%')->count() ,
                    "totales"           =>  ( ($total + $box->init_mount) - $extract)
                ];
            }
            $dataPrinter['caja']     = $box->name;
            $dataPrinter['cut']      = $countCut;
            $dataPrinter['cajero']   = ( $box->logs->count() > 0 ) ? $box->logs[0]->name." ".$box->logs[0]->first_surname : "CAJERO";
            $dataPrinter['concepts'] = [];
            if ($box->orders->count() > 0){
                foreach ($box->orders as $order){
                    foreach ($order->concepts as $concept ){
                        $dataPrinter['concepts'][] = [
                            "code"          => $concept->products->codigo ,
                            "product"       => $concept->products->nombre ,
                            "price"         => $concept->products->total ,
                            "discount"      => $concept->discount ,
                            "quantity"      => $concept->quantity ,
                            "total"         => $concept->total ,
                            "order"         => $order->id ,
                            "status"        => $order->status_id ,
                        ];
                    }
                }
            }
            \Log::debug($dataPrinter);
            $box->update(['is_active' => false]);
            $ticket = $this->ticket->printer($dataPrinter,true);
            $path = "";
            if ($ticket['success']){
                $path = $ticket['data'];
            }
            SysCuts::create([
                "box_id"          => $box->id ,
                "n_cuts"          => $countCut ,
                "n_orders"        => $box->orders->count(),
                "subtotal"        => $subtotal ,
                "iva"             => $iva ,
                "total"           => $total ,
                "mount_total"     => $dataPrinter['totales'] ,
                "file_path"       => $path
            ]);
            $sendData = [
                "path"  => $path ,
                "total" => $total
            ];
            \Log::debug($sendData);
            return new JsonResponse([
                'success'   => TRUE
                ,'data'     => $sendData
                ,'message'  => self::$message_success
            ],Response::HTTP_OK);

        } catch (\Exception $e) {
            $error = $e->getMessage() . " " . $e->getLine() . " " . $e->getFile();
            \Log::error($error);
            return new JsonResponse([
                'success'   => FALSE
                ,'data'     => $error
                ,'message'  => self::$message_error
            ],Response::HTTP_BAD_REQUEST);

        }
    }

}
