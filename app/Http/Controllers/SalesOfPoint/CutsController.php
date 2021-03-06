<?php
/**
 * Created by PHP Storm
 * User : jmartinez
 * Date : 27/07/19
 * Time : 18:45
 */

namespace App\Http\Controllers\SalesOfPoint;


use App\Http\Controllers\MasterController;
use App\SysCuts;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\JsonResponse;

class CutsController extends MasterController
{

    /**
     * CutsController constructor.
     */
    public function __construct()
    {
        parent::__construct();

    }

    /**
     * This method is used see views
     * @access public
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = [
            'page_title' 	              => "Punto de Venta"
            ,'title'  		              => "Cortes de Caja"
        ];
        return $this->_loadView( 'salesOfPoint.cuts', $data );
    }

    /**
     * This method is for get all data cuts by company and groups
     * @access public
     * @param Request $request
     * @param int|null $year
     * @param int|null $month
     * @return JsonResponse
     */
    public function all(Request $request, int $year = null, int $month = null )
    {
        try {
            $data = [
                "user"  => $request->get("user") ,
                "year"  => $year ,
                "month" => $month
            ];
            $data = [
                "cuts"      => $this->_cutsBelongsCompany($data)['response'] ,
                "subtotal"  => $this->_cutsBelongsCompany($data)['subtotal'] ,
                "iva"       => $this->_cutsBelongsCompany($data)['iva'] ,
                "total"     => $this->_cutsBelongsCompany($data)['total'] ,
                "mount"     => $this->_cutsBelongsCompany($data)['mount'] ,
                "users"     => $this->_usersBelongsCompany() ,
            ];
            \Log::debug($data);
            return new JsonResponse([
                "success" => TRUE ,
                "data"    => $data ,
                "message" => self::$message_success
            ],Response::HTTP_OK);

        } catch ( \Exception $e) {
            $error = $e->getMessage()." ".$e->getLine()." ".$e->getFile();
            \Log::debug($error);
            return new JsonResponse([
                "success" => FALSE ,
                "data"    => $error ,
                "message" => self::$message_error
            ],Response::HTTP_BAD_REQUEST);
        }

    }

    /**
     * This method is for get information the roles by companies
     * @access public
     * @param int|null $id
     * @param SysCuts $cuts
     * @return JsonResponse
     */
    public function show( int $id = null, SysCuts $cuts )
    {
        try {
            $cut    = $cuts->with('boxes')->find($id);
            $date   = new \DateTime($cut->created_at);
            $date   = $date->format("Y-m-d");
            $boxes  = $cut->boxes()->with("orders")->first();
            $orders = $boxes->orders()->with('concepts')->whereCount($cut->n_cuts)->where('created_at','LIKE',$date.'%')->get();
            $data = [
                "cut"    => $cut ,
                "orders" => $orders
            ];
            \Log::debug($data);
            return new JsonResponse([
                'success'   => TRUE
                ,'data'     => $data
                ,'message'  => self::$message_success
            ],Response::HTTP_OK);

        } catch (\Exception $e) {
            $error = $e->getMessage() . " " . $e->getLine() . " " . $e->getFile();
            \Log::debug($error);
            return new JsonResponse([
                'success'   => FALSE
                ,'data'     => $error
                ,'message'  => self::$message_error
            ],Response::HTTP_BAD_REQUEST);

        }

    }

    /**
     * This method is used to get information of sales
     * @param array $data
     * @return array
     */
    public function _cutsBelongsCompany(array $data = [])
    {
        $where = "";
        if (Session::get("roles_id") != 1){
            $where .= " AND e.id = ".Session::get('company_id')." AND ss.id = ".Session::get('group_id');
        }
        if ($data['user']){
            $where .= " AND u.id = ".$data['user'];
        }
        $sql = "SELECT
                c.id ,
                c.n_cuts ,
                c.n_orders ,
                ROUND(c.subtotal,2) AS subtotal ,
                ROUND(c.iva,2) AS iva ,
                ROUND(c.total,2) AS total,
                ROUND(c.mount_total,2 ) AS mount_total ,
                c.file_path ,
                b.name AS caja ,
                ROUND(b.init_mount,2) AS mount_start ,
                e.razon_social ,
                CONCAT(ss.codigo,' ',ss.sucursal) AS grupo ,
                CONCAT(u.name,' ',u.first_surname,' ',u.second_surname) AS full_name ,
                c.created_at
            FROM companies_boxes cb
                     JOIN sys_empresas e ON cb.company_id = e.id
                     JOIN sys_sucursales ss ON cb.group_id= ss.id
                     JOIN boxes b ON b.id = cb.box_id
                     LEFT JOIN cuts c ON c.box_id = b.id
                     JOIN sys_users u ON cb.user_id = u.id
                WHERE 
                    MONTH(c.created_at ) = {$data['month']} AND YEAR(c.created_at) = {$data['year']}
                  {$where}
                GROUP BY c.id ORDER BY c.id DESC";
        $response = DB::select($sql);
        $data = [];
        $subtotal= $iva = $total = $mountTotal = 0;

        foreach ($response as $cut ){
            $subtotal   += $cut->subtotal;
            $iva        += $cut->iva;
            $total      += $cut->total;
            $mountTotal += $cut->mount_total;
        }
        $data['response']   = $response;
        $data['total']      = number_format($total,2,'.',',');
        $data['subtotal']   = number_format($subtotal,2,'.',',');
        $data['iva']        = number_format($iva,2,'.',',');
        $data['mount']      = number_format($mountTotal,2,'.',',');

        return $data;
    }


}