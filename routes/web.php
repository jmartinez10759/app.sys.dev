<?php
date_default_timezone_set('America/Mexico_City');
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

	Route::get('/failed/error', function () {
	    return view('errors/error');
	});

	Route::get('/', [
	    'uses'      => 'Auth\AuthController@showLogin'
	    ,'as'       => '/'
	]);

	Route::get('/register/verify/{code}', [
	    'uses'      => 'Auth\AuthController@verify_code'
	    ,'as'       => 'register.verify'
	]);

	Route::post('login', [
	    'uses'      => 'Auth\AuthController@authLogin'
	    ,'as'       => 'login'
	]);

	Route::post('/logout', [
	    'uses'      => 'Auth\AuthController@logout'
	    ,'as'       => 'logout'
	]);

	Route::get('/logout', [
        'uses'      => 'Auth\AuthController@logout'
        ,'as'       => 'logout'
    ]);

	Route::get('/password/request', [
        'uses'      => 'Auth\PasswordController@index'
        ,'as'       => 'password.request'
    ]);


	Route::post('/password/verify', [
        'uses'      => 'Auth\PasswordController@store'
        ,'as'       => 'password.verify'
    ]);

	Route::get('/agendar/citas', [
		'uses'      => 'Administracion\CitasController@index'
		,'as'       => 'password.request'
	]);

	Route::get('/portal/{groupId}', [
			'uses'      => 'Administracion\Configuracion\SucursalesController@portal'
			,'as'       => 'portal'
	]);

Route::group(['middleware' => ['admin.only']], function() {

##################################### RUTAS DE ADMINISTRADORES #############################################
    Route::get('/dashboard', [
        'uses'      => 'Administracion\DashboardController@index'
        ,'as'       => 'dashboard'
    ]);

    Route::get('/dashboard/show', [
        'uses'      => 'Administracion\DashboardController@show'
        ,'as'       => 'dashboard.show'
    ]);

    Route::get('/dashboard/postulaciones', [
        'uses'      => 'Administracion\DashboardController@postulaciones'
        ,'as'       => 'dashboard.postulaciones'
    ]);

############### MODULO DE CORREOS ESTE SERA PARTE DEL SISTEMA.#############

    Route::get('/correos/recibidos', [
        'uses'      => 'Administracion\Correos\CorreoController@index'
        ,'as'       => 'correos.recibidos'
    ]);

    Route::get('/correos/all', [
        'uses'      => 'Administracion\Correos\CorreoController@all'
        ,'as'       => 'correos.all'
    ]);

    Route::put('/correos/update', [
        'uses'      => 'Administracion\Correos\CorreoController@update'
        ,'as'       => 'correos.update'
    ]);

	Route::get('/correos/detalles', [
        'uses'      => 'Administracion\Correos\CorreoController@show'
        ,'as'       => 'correos.detalles'
    ]);

	Route::get('correos/destacados', [
        'uses'      => 'Administracion\Correos\CorreoController@index'
        ,'as'       => 'destacados'
    ]);

	Route::get('correos/papelera', [
        'uses'      => 'Administracion\Correos\CorreoController@index'
        ,'as'       => 'papelera'
    ]);

	Route::get('/correos/envios', [
        'uses'      => 'Administracion\Correos\EnvioController@index'
        ,'as'       => 'correos.envios'
    ]);

	Route::get('/correos/redactar', [
        'uses'      => 'Administracion\Correos\RedactarController@index'
        ,'as'       => 'correos.redactar'
    ]);

    Route::post('/correos/send', [
        'uses'      => 'Administracion\Correos\CorreoController@store'
        ,'as'       => 'correos.send'
    ]);

	Route::get('/correos/show', [
        'uses'      => 'Administracion\Correos\RecibidoController@show'
        ,'as'       => 'correos.show'
    ]);

	Route::post('/correos/destacados', [
        'uses'      => 'Administracion\Correos\CorreoController@destacados'
        ,'as'       => 'correos.destacados'
    ]);

	Route::delete('/correos/destroy', [
        'uses'      => 'Administracion\Correos\CorreoController@destroy'
        ,'as'       => 'correos.destroy'
    ]);

######################## SECCION DE CATEGORIAS  #######################
	Route::post('/categorias/insert', [
        'uses'      => 'Administracion\Correos\CategoriaController@store'
        ,'as'       => 'categorias.insert'
    ]);

	Route::get('/categorias/eliminar', [
        'uses'      => 'Administracion\Correos\CategoriaController@destroy'
        ,'as'       => 'categorias.eliminar'
    ]);

############################ SECCION DE CITAS ###############################
	Route::post('/citas/insert', [
        'uses'      => 'Administracion\CitasController@store'
        ,'as'       => 'citas.insert'
    ]);
		#seccion de notas
     Route::post('notas/insert', [
        'uses'      => 'Administracion\NotasController@store'
        ,'as'       => 'notas.insert'
    ]);

    Route::post('/registros/insert', [
        'uses'      => 'Administracion\RegisterController@create'
        ,'as'       => 'registros.insert'
    ]);

    Route::post('/registros/update', [
        'uses'      => 'Administracion\RegisterController@update'
        ,'as'       => 'registros.update'
    ]);

    Route::get('/registros/destroy/{id}', [
        'uses'      => 'Administracion\RegisterController@destroy'
        ,'as'       => 'registros.destroy'
    ]);

###################### MODULO DE MENUS #####################################
    Route::get('/configuracion/menus', [
        'uses'      => 'Administracion\Configuracion\MenuController@index'
        ,'as'       => 'configuracion.menus'
    ]);

    Route::get('/menus/all', [
        'uses'      => 'Administracion\Configuracion\MenuController@all'
        ,'as'       => 'menus.all'
    ]);

    Route::post('/menus/register', [
        'uses'      => 'Administracion\Configuracion\MenuController@store'
        ,'as'       => 'menus.register'
    ]);

    Route::delete('/menus/destroy/{id}/company', [
        'uses'      => 'Administracion\Configuracion\MenuController@destroy'
        ,'as'       => 'menus.destroy'
    ]);

    Route::get('/menus/{id}/edit', [
        'uses'      => 'Administracion\Configuracion\MenuController@show'
        ,'as'       => 'menus.edit'
    ]);

    Route::put('/menus/update', [
        'uses'      => 'Administracion\Configuracion\MenuController@update'
        ,'as'       => 'menus.update'
    ]);

############################ MODULO DE GENERAR PERMISOS ################################################################

    Route::post('/setting/users/permission', [
        'uses'      => 'Administracion\Configuracion\PermisosController@findMenuByUsers'
        ,'as'       => 'setting.users.permission'
    ]);

    Route::post('/setting/menus/action', [
        'uses'      => 'Administracion\Configuracion\PermisosController@findActionsByMenu'
        ,'as'       => 'setting.menus.action'
    ]);

    Route::post('/setting/permission/register', [
        'uses'      => 'Administracion\Configuracion\PermisosController@createPermission'
        ,'as'       => 'setting.permission.register'
    ]);

    Route::post('/setting/actions/register', [
        'uses'      => 'Administracion\Configuracion\PermisosController@createAction'
        ,'as'       => 'setting.actions.register'
    ]);

########################### SECCION ROLES #####################################

    Route::get('/configuracion/roles', [
        'uses'      => 'Administracion\Configuracion\RolesController@index'
        ,'as'       => 'configuracion.roles'
    ]);

    Route::get('/roles/all', [
        'uses'      => 'Administracion\Configuracion\RolesController@all'
        ,'as'       => 'roles.all'
    ]);

    Route::get('/roles/edit/{id}/company', [
        'uses'      => 'Administracion\Configuracion\RolesController@show'
        ,'as'       => 'roles.edit'
    ]);

    Route::delete('/roles/destroy/{id}/company', [
        'uses'      => 'Administracion\Configuracion\RolesController@destroy'
        ,'as'       => 'roles.destroy'
    ]);

    Route::post('/roles/register', [
        'uses'      => 'Administracion\Configuracion\RolesController@store'
        ,'as'       => 'roles.register'
    ]);

    Route::put('/roles/update', [
        'uses'      => 'Administracion\Configuracion\RolesController@update'
        ,'as'       => 'roles.update'
    ]);

########################### MODULO DE ACCIONES ##############################.

    Route::get( "/configuracion/actions", [
      'uses'      => 'Administracion\Configuracion\ActionsController@index'
      ,'as'       => 'configuracion.actions'
    ]);

    Route::post( "/actions/register", [
      'uses'      => 'Administracion\Configuracion\ActionsController@store'
      ,'as'       => 'actions.register'
    ]);

    Route::post( "/actions/update", [
      'uses'      => 'Administracion\Configuracion\ActionsController@update'
      ,'as'       => 'actions.update'
    ]);

    Route::get('/actions/destroy/{id}', [
        'uses'      => 'Administracion\Configuracion\ActionsController@destroy'
        ,'as'       => 'actions.destroy'
    ]);

    Route::get('/actions/edit', [
        'uses'      => 'Administracion\Configuracion\ActionsController@show'
        ,'as'       => 'actions.edit'
    ]);

########################## MODULO DE USUARIOS.##############################
    Route::get('/configuracion/usuarios', [
        'uses'      => 'Administracion\Configuracion\UsuariosController@index'
        ,'as'       => 'usuarios'
    ]);

    Route::get('/usuarios/all', [
        'uses'      => 'Administracion\Configuracion\UsuariosController@all'
        ,'as'       => 'usuarios.all'
    ]);

    Route::get('usuarios/edit/{userId}', [
        'uses'      => 'Administracion\Configuracion\UsuariosController@show'
        ,'as'       => 'usuarios.edit'
    ]);

    Route::delete('usuarios/destroy/{userId}/user', [
        'uses'      => 'Administracion\Configuracion\UsuariosController@destroy'
        ,'as'       => 'usuarios.destroy'
    ]);

    Route::post('/usuarios/register', [
        'uses'      => 'Administracion\Configuracion\UsuariosController@store'
        ,'as'       => 'usuarios.register'
    ]);

    Route::put('/usuarios/update', [
        'uses'      => 'Administracion\Configuracion\UsuariosController@update'
        ,'as'       => 'usuarios.update'
    ]);

############################# MODULO DE EMPRESAS ######################################

    Route::get('/configuracion/empresas', [
        'uses'      => 'Administracion\Configuracion\EmpresasController@index'
        ,'as'       => 'configuracion.empresas'
    ]);

    Route::get('/company/all', [
        'uses'      => 'Administracion\Configuracion\EmpresasController@all'
        ,'as'       => 'empresas.all'
    ]);

    Route::get('company/{id}/edit', [
        'uses'      => 'Administracion\Configuracion\EmpresasController@show'
        ,'as'       => 'empresas.edit'
    ]);

    Route::delete('company/{id}/destroy', [
        'uses'      => 'Administracion\Configuracion\EmpresasController@destroy'
        ,'as'       => 'empresas.destroy'
    ]);

    Route::post('/company/register', [
        'uses'      => 'Administracion\Configuracion\EmpresasController@store'
        ,'as'       => 'empresas.register'
    ]);

    Route::put('/company/update', [
        'uses'      => 'Administracion\Configuracion\EmpresasController@update'
        ,'as'       => 'empresas.update'
    ]);

    Route::post('/empresas/findGroups', [
    'uses'      => 'Administracion\Configuracion\EmpresasController@findRelGroups'
    ,'as'       => 'empresas.findRelGroups'
    ]);

    Route::post('/empresas/findByUserGroups', [
        'uses'      => 'Administracion\Configuracion\EmpresasController@findByUserGroups'
        ,'as'       => 'empresas.findByUserGroups'
    ]);

    Route::get('/list/companies', [
    'uses'      => 'Administracion\Configuracion\EmpresasController@listCompanies'
    ,'as'       => 'list.empresas'
    ]);

    Route::get('/empresas/listado', [
    'uses'      => 'Administracion\Configuracion\EmpresasController@loadCompanies'
    ,'as'       => 'empresas.listado'
    ]);

    ######################### MODULO DE PROVEEDORES #############################

     Route::get('/configuracion/proveedores', [
        'uses'      => 'Administracion\Configuracion\ProveedoresController@index'
        ,'as'       => 'configuracion.proveedores'
    ]);

    Route::get('/proveedores/all', [
        'uses'      => 'Administracion\Configuracion\ProveedoresController@all'
        ,'as'       => 'proveedores.all'
    ]);

    Route::post('/proveedores/register', [
        'uses'      => 'Administracion\Configuracion\ProveedoresController@store'
        ,'as'       => 'proveedores.register'
    ]);

    Route::get('/proveedores/edit', [
        'uses'      => 'Administracion\Configuracion\ProveedoresController@show'
        ,'as'       => 'proveedores.edit'
    ]);

    Route::put('/proveedores/update', [
        'uses'      => 'Administracion\Configuracion\ProveedoresController@update'
        ,'as'       => 'proveedores.update'
    ]);

    Route::delete('/proveedores/destroy', [
        'uses'      => 'Administracion\Configuracion\ProveedoresController@destroy'
        ,'as'       => 'proveedores.destroy'
    ]);

    Route::get('/proveedores/display_sucursales', [
        'uses'      => 'Administracion\Configuracion\ProveedoresController@display_sucursales'
        ,'as'       => 'proveedores.display_sucursales'
    ]);

    Route::post('/proveedores/register_permisos', [
        'uses'      => 'Administracion\Configuracion\ProveedoresController@register_permisos'
        ,'as'       => 'proveedores.register'
    ]);
    Route::get('/proveedores/asing_producto', [
        'uses'      => 'Administracion\Configuracion\ProveedoresController@asignar'
        ,'as'       => 'proveedores.asing_producto'
    ]);

    Route::post('/proveedores/asing_insert', [
        'uses'      => 'Administracion\Configuracion\ProveedoresController@asignar_insert'
        ,'as'       => 'proveedores.asing_insert'
    ]);

    ######################### MODULO DE PLANES ##################################

    Route::get('/configuracion/planes', [
        'uses'      => 'Administracion\Configuracion\PlanesController@index'
        ,'as'       => 'configuracion.planes'
    ]);

    Route::get('/planes/all', [
        'uses'      => 'Administracion\Configuracion\PlanesController@all'
        ,'as'       => 'planes'
    ]);

    Route::get('planes/edit', [
        'uses'      => 'Administracion\Configuracion\PlanesController@show'
        ,'as'       => 'planes.edit'
    ]);

    Route::delete('planes/destroy', [
        'uses'      => 'Administracion\Configuracion\PlanesController@destroy'
        ,'as'       => 'planes.destroy'
    ]);

    Route::post('/planes/register', [
        'uses'      => 'Administracion\Configuracion\PlanesController@store'
        ,'as'       => 'planes.register'
    ]);

    Route::put('/planes/update', [
        'uses'      => 'Administracion\Configuracion\PlanesController@update'
        ,'as'       => 'planes.update'
    ]);

    Route::get('/planes/asing_producto', [
        'uses'      => 'Administracion\Configuracion\PlanesController@asignar'
        ,'as'       => 'planes.asing_producto'
    ]);

    Route::post('/planes/asing_insert', [
        'uses'      => 'Administracion\Configuracion\PlanesController@asignar_insert'
        ,'as'       => 'planes.asing_insert'
    ]);

    Route::get('/planes/display_sucursales', [
        'uses'      => 'Administracion\Configuracion\PlanesController@display_sucursales'
        ,'as'       => 'planes.display_sucursales'
    ]);

    Route::post('/planes/register_permisos', [
        'uses'      => 'Administracion\Configuracion\PlanesController@register_permisos'
        ,'as'       => 'planes.register_permisos'
    ]);

    ######################### MODULO DE MONEDAS ##################################

    Route::get('/configuracion/monedas', [
        'uses'      => 'Administracion\Configuracion\MonedasController@index'
        ,'as'       => 'configuracion.monedas'
    ]);

    Route::get('/monedas/all', [
        'uses'      => 'Administracion\Configuracion\MonedasController@all'
        ,'as'       => 'monedas.all'
    ]);

    Route::get('monedas/edit', [
        'uses'      => 'Administracion\Configuracion\MonedasController@show'
        ,'as'       => 'monedas.edit'
    ]);

    Route::delete('monedas/destroy', [
        'uses'      => 'Administracion\Configuracion\MonedasController@destroy'
        ,'as'       => 'monedas.destroy'
    ]);

    Route::post('/monedas/register', [
        'uses'      => 'Administracion\Configuracion\MonedasController@store'
        ,'as'       => 'monedas.register'
    ]);

    Route::put('/monedas/update', [
        'uses'      => 'Administracion\Configuracion\MonedasController@update'
        ,'as'       => 'monedas.update'
    ]);

	######################### MODULO DE SUCURSALES #############################

    Route::get('/configuracion/sucursales', [
       'uses'      => 'Administracion\Configuracion\SucursalesController@index'
       ,'as'       => 'configuracion.sucursales'
    ]);
    Route::get('/groups/all', [
        'uses'      => 'Administracion\Configuracion\SucursalesController@all'
        ,'as'       => 'groups.all'
    ]);

    Route::get('groups/{id}/edit', [
        'uses'      => 'Administracion\Configuracion\SucursalesController@show'
        ,'as'       => 'sucursales.edit'
    ]);

    Route::delete('groups/destroy/{id}/companies', [
        'uses'      => 'Administracion\Configuracion\SucursalesController@destroy'
        ,'as'       => 'groups.destroy'
    ]);

    Route::post('/groups/register', [
        'uses'      => 'Administracion\Configuracion\SucursalesController@store'
        ,'as'       => 'groups.register'
    ]);

    Route::put('/groups/update', [
        'uses'      => 'Administracion\Configuracion\SucursalesController@update'
        ,'as'       => 'groups.update'
    ]);

    Route::post('/list/sucursales', [
        'uses'      => 'Administracion\Configuracion\SucursalesController@listGroup'
        ,'as'       => 'list.sucursales'
    ]);

##########################3 MODULO DE PERFIL ########################################

    Route::get('/configuracion/perfiles', [
        'uses'      => 'Administracion\Configuracion\PerfilUsersController@index'
        ,'as'       => 'perfiles'
    ]);

    Route::get('perfiles/edit', [
        'uses'      => 'Administracion\Configuracion\PerfilUsersController@show'
        ,'as'       => 'perfiles.edit'
    ]);

    Route::get('perfiles/destroy', [
        'uses'      => 'Administracion\Configuracion\PerfilUsersController@destroy'
        ,'as'       => 'perfiles.destroy'
    ]);

    Route::post('/perfiles/register', [
        'uses'      => 'Administracion\Configuracion\PerfilUsersController@store'
        ,'as'       => 'perfiles.register'
    ]);

    Route::post('/perfiles/update', [
        'uses'      => 'Administracion\Configuracion\PerfilUsersController@update'
        ,'as'       => 'perfiles.update'
    ]);

		Route::post('/perfiles/upload', [
        'uses'      => 'Administracion\Configuracion\PerfilUsersController@upload'
        ,'as'       => 'perfiles.upload'
    ]);

############################ CATALOGO DE CLIENTES ###################################

    Route::get('/configuracion/clientes', [
        'uses'      => 'Administracion\Configuracion\ClientesController@index'
        ,'as'       => 'configuracion.clientes'
    ]);

    Route::post('/clientes/register', [
        'uses'      => 'Administracion\Configuracion\ClientesController@store'
        ,'as'       => 'clientes.register'
    ]);

    Route::post('/clientes/register_permisos', [
        'uses'      => 'Administracion\Configuracion\ClientesController@register_permisos'
        ,'as'       => 'clientes.register'
    ]);

    Route::get('/clientes/edit', [
        'uses'      => 'Administracion\Configuracion\ClientesController@show'
        ,'as'       => 'clientes.edit'
    ]);

    Route::get('/clientes/all', [
        'uses'      => 'Administracion\Configuracion\ClientesController@all'
        ,'as'       => 'clientes.all'
    ]);

    Route::get('/clientes/display_sucursales', [
        'uses'      => 'Administracion\Configuracion\ClientesController@display_sucursales'
        ,'as'       => 'clientes.display_sucursales'
    ]);


    Route::put('/clientes/update', [
        'uses'      => 'Administracion\Configuracion\ClientesController@update'
        ,'as'       => 'clientes.update'
    ]);

    Route::delete('/clientes/destroy', [
        'uses'      => 'Administracion\Configuracion\ClientesController@destroy'
        ,'as'       => 'clientes.destroy'
    ]);

    Route::post('/upload/register', [
        'uses'      => 'Administracion\Configuracion\ClientesController@store'
        ,'as'       => 'clientes.register'
    ]);

    Route::put('/clientes/estatus', [
        'uses'      => 'Administracion\Configuracion\ClientesController@estatus_update'
        ,'as'       => 'clientes.update'
    ]);

    Route::post('/clientes/comments', [
        'uses'      => 'Administracion\Configuracion\ClientesController@store_activies'
        ,'as'       => 'clientes.comments'
    ]);

    Route::post('/clientes/uploads', [
        'uses'      => 'Administracion\Configuracion\ClientesController@upload_files_clientes'
        ,'as'       => 'clientes.uploads'
    ]);

    Route::delete('/clientes/files_destroy', [
        'uses'      => 'Administracion\Configuracion\ClientesController@destroy_files'
        ,'as'       => 'clientes.files_destroy'
    ]);

############################ CATALOGO DE ACTIVIDADES ###################################

    Route::get('/configuracion/activities', [
        'uses'      => 'Administracion\Configuracion\ActivitiesController@index'
        ,'as'       => 'configuracion.activities'
    ]);

    Route::post('/activities/register', [
        'uses'      => 'Administracion\Configuracion\ActivitiesController@store'
        ,'as'       => 'activities.register'
    ]);

    Route::get('/activities/edit', [
        'uses'      => 'Administracion\Configuracion\ActivitiesController@show'
        ,'as'       => 'activities.edit'
    ]);

    Route::put('/activities/update', [
        'uses'      => 'Administracion\Configuracion\ActivitiesController@update'
        ,'as'       => 'activities.update'
    ]);

    Route::delete('/activities/destroy', [
        'uses'      => 'Administracion\Configuracion\ActivitiesController@destroy'
        ,'as'       => 'activities.destroy'
    ]);

############################ CATALOGO DE CONTACTOS ###################################

    Route::get('/configuracion/contactos', [
        'uses'      => 'Administracion\Configuracion\ContactosController@index'
        ,'as'       => 'configuracion.clientes'
    ]);

    Route::post('/contactos/register', [
        'uses'      => 'Administracion\Configuracion\ContactosController@store'
        ,'as'       => 'contactos.register'
    ]);

    Route::get('/contactos/edit', [
        'uses'      => 'Administracion\Configuracion\ContactosController@show'
        ,'as'       => 'clientes.edit'
    ]);

    Route::get('/contactos/display_sucursales', [
        'uses'      => 'Administracion\Configuracion\ContactosController@display_sucursales'
        ,'as'       => 'contactos.display_sucursales'
    ]);


    Route::put('/contactos/update', [
        'uses'      => 'Administracion\Configuracion\ContactosController@update'
        ,'as'       => 'contactos.update'
    ]);

    Route::delete('/contactos/destroy', [
        'uses'      => 'Administracion\Configuracion\ContactosController@destroy'
        ,'as'       => 'contactos.destroy'
    ]);

############################ SECCION DE PRODUCTOS #######################################

    Route::get('/configuracion/productos', [
        'uses'      => 'Administracion\Configuracion\ProductosController@index'
        ,'as'       => 'configuracion.clientes'
    ]);
    Route::get('/products/all', [
        'uses'      => 'Administracion\Configuracion\ProductosController@all'
        ,'as'       => 'productos.all'
    ]);
    Route::post('/products/register', [
        'uses'      => 'Administracion\Configuracion\ProductosController@store'
        ,'as'       => 'products.register'
    ]);
    Route::get('/products/{id}/edit', [
        'uses'      => 'Administracion\Configuracion\ProductosController@show'
        ,'as'       => 'productos.edit'
    ]);
    Route::put('/products/update', [
        'uses'      => 'Administracion\Configuracion\ProductosController@update'
        ,'as'       => 'productos.update'
    ]);

    Route::delete('/products/{id}/destroy', [
        'uses'      => 'Administracion\Configuracion\ProductosController@destroy'
        ,'as'       => 'productos.destroy'
    ]);

    Route::post('/productos/register_permisos', [
        'uses'      => 'Administracion\Configuracion\ProductosController@register_permisos'
        ,'as'       => 'productos.register_permisos'
    ]);



    Route::get('/products/display_sucursales', [
        'uses'      => 'Administracion\Configuracion\ProductosController@display_sucursales'
        ,'as'       => 'productos.edit'
    ]);


############################ SECCION DE FORMAS DE PAGO #######################################

    Route::get('/configuracion/formaspago', [
        'uses'      => 'Administracion\Configuracion\ProductosController@index'
        ,'as'       => 'configuracion.clientes'
    ]);

    Route::post('/formaspago/register', [
        'uses'      => 'Administracion\Configuracion\ProductosController@store'
        ,'as'       => 'clientes.register'
    ]);

    Route::get('/formaspago/edit', [
        'uses'      => 'Administracion\Configuracion\ProductosController@show'
        ,'as'       => 'clientes.edit'
    ]);

    Route::put('/formaspago/update', [
        'uses'      => 'Administracion\Configuracion\ProductosController@update'
        ,'as'       => 'clientes.update'
    ]);

    Route::delete('/formaspago/destroy', [
        'uses'      => 'Administracion\Configuracion\ProductosController@destroy'
        ,'as'       => 'clientes.destroy'
    ]);

############################ SECCION DE METODO DE PAGO #######################################

    Route::get('/configuracion/metodospago', [
        'uses'      => 'Administracion\Configuracion\ProductosController@index'
        ,'as'       => 'configuracion.clientes'
    ]);

    Route::post('/metodospago/register', [
        'uses'      => 'Administracion\Configuracion\ProductosController@store'
        ,'as'       => 'clientes.register'
    ]);

    Route::get('/metodospago/edit', [
        'uses'      => 'Administracion\Configuracion\ProductosController@show'
        ,'as'       => 'clientes.edit'
    ]);

    Route::put('/metodospago/update', [
        'uses'      => 'Administracion\Configuracion\ProductosController@update'
        ,'as'       => 'clientes.update'
    ]);

    Route::delete('/metodospago/destroy', [
        'uses'      => 'Administracion\Configuracion\ProductosController@destroy'
        ,'as'       => 'clientes.destroy'
    ]);

############################ SECCION PAISES #######################################

    Route::get('/configuracion/pais', [
        'uses'      => 'Administracion\Configuracion\PaisController@index'
        ,'as'       => 'configuracion.pais'
    ]);

    Route::get('/pais/all', [
        'uses'      => 'Administracion\Configuracion\PaisController@all'
        ,'as'       => 'pais.all'
    ]);

    Route::post('/pais/register', [
        'uses'      => 'Administracion\Configuracion\PaisController@store'
        ,'as'       => 'pais.register'
    ]);

    Route::get('/country/{id}/edit', [
        'uses'      => 'Administracion\Configuracion\PaisController@show'
        ,'as'       => 'pais.edit'
    ]);

    Route::put('/pais/update', [
        'uses'      => 'Administracion\Configuracion\PaisController@update'
        ,'as'       => 'pais.update'
    ]);

    Route::delete('/pais/destroy', [
        'uses'      => 'Administracion\Configuracion\PaisController@destroy'
        ,'as'       => 'pais.destroy'
    ]);

############################ SECCION CODIGOS POSTALES #######################################

    Route::get('/configuracion/codigopostal', [
        'uses'      => 'Administracion\Configuracion\CodigoPostalController@index'
        ,'as'       => 'configuracion.codigopostal'
    ]);

    Route::get('/codigopostal/all', [
        'uses'      => 'Administracion\Configuracion\CodigoPostalController@all'
        ,'as'       => 'codigopostal.all'
    ]);

    Route::post('/codigopostal/register', [
        'uses'      => 'Administracion\Configuracion\CodigoPostalController@store'
        ,'as'       => 'codigopostal.register'
    ]);

    Route::get('/edit/{postalCode}/code', [
        'uses'      => 'Administracion\Configuracion\CodigoPostalController@getPostalCode'
        ,'as'       => 'edit.code'
    ]);

    Route::get('/codigopostal/show', [
        'uses'      => 'Administracion\Configuracion\CodigoPostalController@show_clave'
        ,'as'       => 'codigopostal.show'
    ]);

    Route::put('/codigopostal/update', [
        'uses'      => 'Administracion\Configuracion\CodigoPostalController@update'
        ,'as'       => 'codigopostal.update'
    ]);

    Route::delete('/codigopostal/destroy', [
        'uses'      => 'Administracion\Configuracion\CodigoPostalController@destroy'
        ,'as'       => 'codigopostal.destroy'
    ]);

############################ SECCION SERVICIOS COMERCIALES #######################################

    Route::get('/configuracion/servicioscomerciales', [
        'uses'      => 'Administracion\Configuracion\ServiciosComercialesController@index'
        ,'as'       => 'configuracion.servicioscomerciales'
    ]);

    Route::get('/servicioscomerciales/all', [
        'uses'      => 'Administracion\Configuracion\ServiciosComercialesController@all'
        ,'as'       => 'servicioscomerciales.all'
    ]);

    Route::post('/servicioscomerciales/register', [
        'uses'      => 'Administracion\Configuracion\ServiciosComercialesController@store'
        ,'as'       => 'servicioscomerciales.register'
    ]);

    Route::get('/servicioscomerciales/edit', [
        'uses'      => 'Administracion\Configuracion\ServiciosComercialesController@show'
        ,'as'       => 'servicioscomerciales.edit'
    ]);

    Route::put('/servicioscomerciales/update', [
        'uses'      => 'Administracion\Configuracion\ServiciosComercialesController@update'
        ,'as'       => 'servicioscomerciales.update'
    ]);

    Route::delete('/servicioscomerciales/destroy', [
        'uses'      => 'Administracion\Configuracion\ServiciosComercialesController@destroy'
        ,'as'       => 'servicioscomerciales.destroy'
    ]);

################################## SECCION DE CARGA DE ARCHIVOS #######################################

    Route::post('/upload/catalogos', [
        'uses'      => 'Administracion\Configuracion\UploadController@upload_catalogos'
        ,'as'       => 'upload.catalogos'
    ]);

    Route::post('/upload/files', [
        'uses'      => 'Administracion\Configuracion\UploadController@uploadsFiles'
        ,'as'       => 'upload.files'
    ]);

    Route::get('/services', [
        'uses'      => 'ServicesController@services'
        ,'as'       => 'services'
    ]);


    #SE REALIZA UNA URL DINAMICA
    // Route::get('/configuracion/{url}',[
    //   'uses'      => 'Administracion\Configuracion\ActionsController@show'
    //   ,'as'       => 'actions.edit'
    // ]);

    ############################ MODULO DE FACTURAS ############################

    Route::get('/facturacion/facturas', [
        'uses'      => 'Facturacion\FacturacionController@index'
        ,'as'       => 'facturacion.facturas'
    ]);

		Route::post('/facturacion/insert', [
        'uses'      => 'Facturacion\FacturacionController@store'
        ,'as'       => 'facturacion.insert'
    ]);

		Route::post('/facturacion/update', [
        'uses'      => 'Facturacion\FacturacionController@update'
        ,'as'       => 'facturacion.update'
    ]);

		Route::post('/facturacion/estatus', [
				'uses'      => 'Facturacion\FacturacionController@update_estatus'
				,'as'       => 'facturacion.estatus'
		]);

		Route::post('/facturacion/actualizar', [
        'uses'      => 'Facturacion\FacturacionController@actualizar'
        ,'as'       => 'facturacion.actualizar'
    ]);

    Route::post('/facturacion/upload', [
        'uses'      => 'Facturacion\FacturacionController@upload'
        ,'as'       => 'facturacion.upload'
    ]);

		Route::get('/facturacion/all', [
        'uses'      => 'Facturacion\FacturacionController@all'
        ,'as'       => 'facturacion.all'
    ]);

		Route::get('/facturacion/edit', [
        'uses'      => 'Facturacion\FacturacionController@show'
        ,'as'       => 'facturacion.edit'
    ]);

		Route::get('/facturacion/borrar', [
        'uses'      => 'Facturacion\FacturacionController@destroy'
        ,'as'       => 'facturacion.borrar'
    ]);

		Route::get('/facturacion/filtros', [
        'uses'      => 'Facturacion\FacturacionController@filtros'
        ,'as'       => 'facturacion.filtros'
    ]);

		Route::get('/facturacion/download', [
        'uses'      => 'Facturacion\FacturacionController@_download_pdf'
        ,'as'       => 'facturacion.download'
    ]);

		Route::get('/facturacion/ejecutivos', [
        'uses'      => 'Facturacion\CargaFacturaController@index'
        ,'as'       => 'facturacion.ejecutivos'
    ]);

		Route::get('/facturacion/ejecutivo', [
        'uses'      => 'Facturacion\CargaFacturaController@all'
        ,'as'       => 'facturacion.ejecutivo'
    ]);

		Route::post('/facturacion/upload_masiva', [
				'uses'      => 'Facturacion\CargaFacturaController@upload_masiva'
				,'as'       => 'facturacion.upload_masiva'
		]);

		Route::get('/ejecutivos/show', [
				'uses'      => 'Facturacion\CargaFacturaController@show'
				,'as'       => 'ejecutivos.show'
		]);

		Route::get('/ejecutivos/cliente', [
				'uses'      => 'Facturacion\CargaFacturaController@show_clientes'
				,'as'       => 'ejecutivos.cliente'
		]);

		Route::get('/ejecutivos/filtros', [
				'uses'      => 'Facturacion\CargaFacturaController@filters'
				,'as'       => 'ejecutivos.filtros'
		]);

################################## MODULO DE VENTAS PEDIDOS ################################

        Route::get('/ventas/pedidos', [
            'uses'      => 'Ventas\PedidosController@index'
            ,'as'       => 'ventas.pedidos'
        ]);

        Route::get('/pedidos/all', [
            'uses'      => 'Ventas\PedidosController@all'
            ,'as'       => 'pedidos.all'
        ]);

        Route::post('/pedidos/register', [
            'uses'      => 'Ventas\PedidosController@store'
            ,'as'       => 'pedidos.register'
        ]);

        Route::post('/pedidos/correo', [
            'uses'      => 'Ventas\PedidosController@correo'
            ,'as'       => 'pedidos.correo'
        ]);

        Route::get('/pedidos/edit', [
            'uses'      => 'Ventas\PedidosController@show'
            ,'as'       => 'pedidos.edit'
        ]);

        Route::get('/pedidos/reportes/{id}', [
            'uses'      => 'Ventas\PedidosController@reportes'
            ,'as'       => 'pedidos.reportes'
        ]);

        Route::put('/pedidos/update', [
            'uses'      => 'Ventas\PedidosController@update'
            ,'as'       => 'pedidos.update'
        ]);

        Route::delete('/pedidos/destroy', [
            'uses'      => 'Ventas\PedidosController@destroy'
            ,'as'       => 'pedidos.destroy'
        ]);

        Route::delete('/pedidos/destroy_concepto', [
            'uses'      => 'Ventas\PedidosController@destroy_conceptos'
            ,'as'       => 'pedidos.destroy_concepto'
        ]);

################################## MODULO DE VENTAS FACTURACIONES ##########################

        Route::get('/ventas/facturaciones', [
            'uses'      => 'Ventas\FacturacionesController@index'
            ,'as'       => 'ventas.facturaciones'
        ]);

        Route::get('/facturaciones/all', [
            'uses'      => 'Ventas\FacturacionesController@all'
            ,'as'       => 'facturaciones.all'
        ]);

        Route::post('/facturaciones/register', [
            'uses'      => 'Ventas\FacturacionesController@store'
            ,'as'       => 'facturaciones.register'
        ]);

        Route::post('/facturaciones/insert', [
            'uses'      => 'Ventas\FacturacionesController@create'
            ,'as'       => 'facturaciones.insert'
        ]);

        Route::get('/facturaciones/edit', [
            'uses'      => 'Ventas\FacturacionesController@show'
            ,'as'       => 'facturaciones.edit'
        ]);

        Route::put('/facturaciones/update', [
            'uses'      => 'Ventas\FacturacionesController@update'
            ,'as'       => 'facturaciones.update'
        ]);
        Route::put('/facturaciones/estatus', [
            'uses'      => 'Ventas\FacturacionesController@estatus'
            ,'as'       => 'facturaciones.estatus'
        ]);
        Route::delete('/facturaciones/destroy', [
            'uses'      => 'Ventas\FacturacionesController@destroy'
            ,'as'       => 'facturaciones.destroy'
        ]);

        Route::delete('/facturaciones/destroy_concepto', [
            'uses'      => 'Ventas\FacturacionesController@destroy_conceptos'
            ,'as'       => 'facturaciones.destroy_concepto'
        ]);

################################## CATALOGO DE TIPO DE COMPROBANTES ################################

    Route::get('/configuracion/tiposcomprobantes', [
        'uses' => 'Administracion\Configuracion\TiposComprobantesController@index'
        ,'as'  => 'configuracion.tiposcomprobantes'
    ]);

    Route::get('/tiposcomprobantes/all', [
        'uses' => 'Administracion\Configuracion\TiposComprobantesController@all'
        ,'as'  => 'tiposcomprobantes.all'
    ]);

    Route::post('/tiposcomprobantes/register', [
        'uses' => 'Administracion\Configuracion\TiposComprobantesController@store'
        ,'as' => 'tiposcomprobantes.register'
    ]);

    Route::get('/tiposcomprobantes/edit', [
        'uses' => 'Administracion\Configuracion\TiposComprobantesController@show'
        ,'as' => 'tiposcomprobantes.edit'
    ]);

    Route::put('/tiposcomprobantes/update', [
        'uses' => 'Administracion\Configuracion\TiposComprobantesController@update'
        ,'as' => 'tiposcomprobantes.update'
    ]);

    Route::delete('/tiposcomprobantes/destroy', [
        'uses' => 'Administracion\Configuracion\TiposComprobantesController@destroy'
        ,'as' => 'tiposcomprobantes.destroy'
    ]);

################################## CATALOGO REGIMEN FISCAL ################################

    Route::get('/configuracion/regimenfiscal', [
        'uses' => 'Administracion\Configuracion\RegimenFiscalController@index'
        ,'as'  => 'configuracion.tiposcomprobantes'
    ]);

    Route::get('/regimenfiscal/all', [
        'uses' => 'Administracion\Configuracion\RegimenFiscalController@all'
        ,'as'  => 'regimenfiscal.all'
    ]);

    Route::post('/regimenfiscal/register', [
        'uses' => 'Administracion\Configuracion\RegimenFiscalController@store'
        ,'as' => 'regimenfiscal.register'
    ]);

    Route::get('/regimenfiscal/edit', [
        'uses' => 'Administracion\Configuracion\RegimenFiscalController@show'
        ,'as' => 'regimenfiscal.edit'
    ]);

    Route::put('/regimenfiscal/update', [
        'uses' => 'Administracion\Configuracion\RegimenFiscalController@update'
        ,'as' => 'regimenfiscal.update'
    ]);

    Route::delete('/regimenfiscal/destroy', [
        'uses' => 'Administracion\Configuracion\RegimenFiscalController@destroy'
        ,'as' => 'regimenfiscal.destroy'
    ]);

################################## CATALOGO USOCFDI  ################################

    Route::get('/configuracion/usocfdi', [
        'uses' => 'Administracion\Configuracion\UsoCfdiController@index'
        ,'as'  => 'configuracion.usocfdi'
    ]);

    Route::get('/usocfdi/all', [
        'uses' => 'Administracion\Configuracion\UsoCfdiController@all'
        ,'as'  => 'usocfdi.all'
    ]);

    Route::post('/usocfdi/register', [
        'uses' => 'Administracion\Configuracion\UsoCfdiController@store'
        ,'as' => 'usocfdi.register'
    ]);

    Route::get('/usocfdi/edit', [
        'uses' => 'Administracion\Configuracion\UsoCfdiController@show'
        ,'as' => 'usocfdi.edit'
    ]);

    Route::put('/usocfdi/update', [
        'uses' => 'Administracion\Configuracion\UsoCfdiController@update'
        ,'as' => 'usocfdi.update'
    ]);

    Route::delete('/usocfdi/destroy', [
        'uses' => 'Administracion\Configuracion\UsoCfdiController@destroy'
        ,'as' => 'usocfdi.destroy'
    ]);

################################## CATALOGO TIPO FACTOR ################################

    Route::get('/configuracion/tipofactor', [
        'uses' => 'Administracion\Configuracion\TipoFactorController@index'
        ,'as'  => 'configuracion.tipofactor'
    ]);

    Route::get('/tipofactor/all', [
        'uses' => 'Administracion\Configuracion\TipoFactorController@all'
        ,'as'  => 'tipofactor.all'
    ]);

    Route::post('/tipofactor/register', [
        'uses' => 'Administracion\Configuracion\TipoFactorController@store'
        ,'as' => 'tipofactor.register'
    ]);

    Route::get('/tipofactor/edit', [
        'uses' => 'Administracion\Configuracion\TipoFactorController@show'
        ,'as' => 'tipofactor.edit'
    ]);

    Route::put('/tipofactor/update', [
        'uses' => 'Administracion\Configuracion\TipoFactorController@update'
        ,'as' => 'tipofactor.update'
    ]);

    Route::delete('/tipofactor/destroy', [
        'uses' => 'Administracion\Configuracion\TipoFactorController@destroy'
        ,'as' => 'tipofactor.destroy'
    ]);

################################## CATALOGO TASA ################################

    Route::get('/configuracion/tasa', [
        'uses' => 'Administracion\Configuracion\TasaController@index'
        ,'as'  => 'configuracion.tasa'
    ]);

    Route::get('/tasa/all', [
        'uses' => 'Administracion\Configuracion\TasaController@all'
        ,'as'  => 'tasa.all'
    ]);

    Route::post('/tasa/register', [
        'uses' => 'Administracion\Configuracion\TasaController@store'
        ,'as' => 'tasa.register'
    ]);

    Route::get('/tasa/edit', [
        'uses' => 'Administracion\Configuracion\TasaController@show'
        ,'as' => 'tasa.edit'
    ]);

    Route::put('/tasa/update', [
        'uses' => 'Administracion\Configuracion\TasaController@update'
        ,'as' => 'tasa.update'
    ]);

    Route::delete('/tasa/destroy', [
        'uses' => 'Administracion\Configuracion\TasaController@destroy'
        ,'as' => 'tasa.destroy'
    ]);

    Route::get('/tasa/{factorId}/tasaByFactor', [
        'uses' => 'Administracion\Configuracion\TasaController@tasaByFactor'
        ,'as' => 'tasas.tasaByFactor'
    ]);

################################## CATALOGO NOTIFICACIONES ################################

    Route::get('/notificaciones', [
        'uses' => 'Administracion\NotificationController@index'
        ,'as'  => 'configuracion'
    ]);

    Route::get('/notificaciones/all', [
        'uses' => 'Administracion\NotificationController@all'
        ,'as'  => 'notificaciones.all'
    ]);

    Route::post('/notificaciones/register', [
        'uses' => 'Administracion\NotificationController@store'
        ,'as' => 'notificaciones.register'
    ]);

    Route::get('/notificaciones/edit', [
        'uses' => 'Administracion\NotificationController@show'
        ,'as' => 'notificaciones.edit'
    ]);

    Route::put('/notificaciones/update', [
        'uses' => 'Administracion\NotificationController@update'
        ,'as' => 'notificaciones.update'
    ]);

    Route::delete('/notifications/{id}/destroy', [
        'uses' => 'Administracion\NotificationController@destroy'
        ,'as' => 'notificaciones.destroy'
    ]);


################################## CATALOGO IMPUESTO ################################

    Route::get('/configuracion/impuesto', [
        'uses' => 'Administracion\Configuracion\ImpuestoController@index'
        ,'as'  => 'configuracion.impuesto'
    ]);

    Route::get('/impuesto/all', [
        'uses' => 'Administracion\Configuracion\ImpuestoController@all'
        ,'as'  => 'impuesto.all'
    ]);

    Route::get('/taxes/{tasaId}/taxesByTasa', [
        'uses' => 'Administracion\Configuracion\ImpuestoController@taxesByTasa'
        ,'as'  => 'taxes.taxesByTasa'
    ]);

    Route::post('/impuesto/register', [
        'uses' => 'Administracion\Configuracion\ImpuestoController@store'
        ,'as' => 'impuesto.register'
    ]);

    Route::get('/impuesto/edit', [
        'uses' => 'Administracion\Configuracion\ImpuestoController@show'
        ,'as' => 'impuesto.edit'
    ]);

    Route::put('/impuesto/update', [
        'uses' => 'Administracion\Configuracion\ImpuestoController@update'
        ,'as' => 'impuesto.update'
    ]);

    Route::delete('/impuesto/destroy', [
        'uses' => 'Administracion\Configuracion\ImpuestoController@destroy'
        ,'as' => 'impuesto.destroy'
    ]);

################################## CATALOGO CLAVE SERVICIO PRODUCTO ################################

    Route::get('/configuracion/claveprodservicio', [
        'uses' => 'Administracion\Configuracion\ClaveProdServicioController@index'
        ,'as'  => 'configuracion.claveprodservicio'
    ]);

    Route::get('/claveprodservicio/all', [
        'uses' => 'Administracion\Configuracion\ClaveProdServicioController@all'
        ,'as'  => 'claveprodservicio.all'
    ]);

    Route::post('/claveprodservicio/register', [
        'uses' => 'Administracion\Configuracion\ClaveProdServicioController@store'
        ,'as' => 'claveprodservicio.register'
    ]);

    Route::get('/claveprodservicio/edit', [
        'uses' => 'Administracion\Configuracion\ClaveProdServicioController@show'
        ,'as' => 'claveprodservicio.edit'
    ]);

    Route::put('/claveprodservicio/update', [
        'uses' => 'Administracion\Configuracion\ClaveProdServicioController@update'
        ,'as' => 'claveprodservicio.update'
    ]);

    Route::delete('/claveprodservicio/destroy', [
        'uses' => 'Administracion\Configuracion\ClaveProdServicioController@destroy'
        ,'as' => 'claveprodservicio.destroy'
    ]);

################################## CATALOGO DE UNIDAD DE MEDIDAS ################################

    Route::get('/configuracion/unidadesmedidas', [
        'uses' => 'Administracion\Configuracion\UnidadesMedidasController@index'
        ,'as' => 'ventas.unidadesmedidas'
    ]);

    Route::get('/unidadesmedidas/all', [
        'uses' => 'Administracion\Configuracion\UnidadesMedidasController@all'
        ,'as' => 'unidadesmedidas.all'
    ]);

    Route::post('/unidadesmedidas/register', [
        'uses' => 'Administracion\Configuracion\UnidadesMedidasController@store'
        ,'as' => 'unidadesmedidas.register'
    ]);

    Route::get('/unidadesmedidas/edit', [
        'uses' => 'Administracion\Configuracion\UnidadesMedidasController@show'
        ,'as' => 'unidadesmedidas.edit'
    ]);

    Route::put('/unidadesmedidas/update', [
        'uses' => 'Administracion\Configuracion\UnidadesMedidasController@update'
        ,'as' => 'unidadesmedidas.update'
    ]);

    Route::delete('/unidadesmedidas/destroy', [
        'uses' => 'Administracion\Configuracion\UnidadesMedidasController@destroy'
        ,'as' => 'unidadesmedidas.destroy'
    ]);

    ################################## CATALOGO DE CUENTAS ################################
    Route::get('/configuracion/cuentas', [
        'uses' => 'Administracion\Configuracion\CuentasController@index'
        ,'as' => 'configuracion.cuentas'
    ]);

    Route::get('/cuentas/all', [
        'uses' => 'Administracion\Configuracion\CuentasController@all'
        ,'as' => 'cuentas.all'
    ]);

    Route::post('/cuentas/register', [
        'uses' => 'Administracion\Configuracion\CuentasController@store'
        ,'as' => 'cuentas.register'
    ]);

    Route::get('/cuentas/edit', [
        'uses' => 'Administracion\Configuracion\CuentasController@show'
        ,'as' => 'cuentas.edit'
    ]);

    Route::put('/cuentas/update', [
        'uses' => 'Administracion\Configuracion\CuentasController@update'
        ,'as' => 'cuentas.update'
    ]);

    Route::delete('/cuentas/destroy', [
        'uses' => 'Administracion\Configuracion\CuentasController@destroy'
        ,'as' => 'cuentas.destroy'
    ]);
    ################################## CATALOGO DE CATEGORIAS ################################
    Route::get('/configuracion/categoriasproductos', [
        'uses' => 'Administracion\Configuracion\CategoriasProductosController@index'
        ,'as' => 'configuracion.categoriasproductos'
    ]);

    Route::get('/categoriasproductos/all', [
        'uses' => 'Administracion\Configuracion\CategoriasProductosController@all'
        ,'as' => 'categoriasproductos.all'
    ]);

    Route::post('/categoriasproductos/register', [
        'uses' => 'Administracion\Configuracion\CategoriasProductosController@store'
        ,'as' => 'categoriasproductos.register'
    ]);

    Route::get('/categoriasproductos/edit', [
        'uses' => 'Administracion\Configuracion\CategoriasProductosController@show'
        ,'as' => 'categoriasproductos.edit'
    ]);

    Route::put('/categoriasproductos/update', [
        'uses' => 'Administracion\Configuracion\CategoriasProductosController@update'
        ,'as' => 'categoriasproductos.update'
    ]);

    Route::delete('/categoriasproductos/destroy', [
        'uses' => 'Administracion\Configuracion\CategoriasProductosController@destroy'
        ,'as' => 'categoriasproductos.destroy'
    ]);

##################################### MODULO DE ALMACENES#########################################
    Route::get('/almacen/almacenes', [
        'uses' => 'Almacenes\AlmacenesController@index'
        ,'as' => 'Almacenes.almacenes'
    ]);

    Route::get('/almacenes/all', [
        'uses' => 'Almacenes\AlmacenesController@all'
        ,'as' => 'almacenes.all'
    ]);

    Route::post('/almacenes/register', [
        'uses' => 'Almacenes\AlmacenesController@store'
        ,'as' => 'almacenes.register'
    ]);

    Route::get('/almacenes/edit', [
        'uses' => 'Almacenes\AlmacenesController@show'
        ,'as' => 'almacenes.edit'
    ]);

    Route::put('/almacenes/update', [
        'uses' => 'Almacenes\AlmacenesController@update'
        ,'as' => 'almacenes.update'
    ]);

    Route::delete('/almacenes/destroy', [
        'uses' => 'Almacenes\AlmacenesController@destroy'
        ,'as' => 'almacenes.destroy'
    ]);
    Route::get('/almacenes/display_sucursales', [
        'uses'      => 'Almacenes\AlmacenesController@display_sucursales'
        ,'as'       => 'almacenes.display_sucursales'
    ]);

    Route::post('/almacenes/register_permisos', [
        'uses'      => 'Almacenes\AlmacenesController@register_permisos'
        ,'as'       => 'almacenes.register'
    ]);
    Route::get('/almacenes/asing_producto', [
        'uses'      => 'Almacenes\AlmacenesController@asignar'
        ,'as'       => 'almacenes.asing_producto'
    ]);

    Route::post('/almacenes/asing_insert', [
        'uses'      => 'Almacenes\AlmacenesController@asignar_insert'
        ,'as'       => 'almacenes.asing_insert'
    ]);

##################################### COTIZACIONES #########################################

    Route::get('/ventas/cotizacion', [
        'uses' => 'Ventas\CotizacionController@index'
        ,'as' => 'ventas.cotizacion'
    ]);

    Route::get('/cotizacion/all', [
        'uses' => 'Ventas\CotizacionController@all'
        ,'as' => 'cotizacion.all'
    ]);

    Route::post('/cotizacion/register', [
        'uses' => 'Ventas\CotizacionController@store'
        ,'as' => 'cotizacion.register'
    ]);

    Route::get('/cotizacion/edit', [
        'uses' => 'Ventas\CotizacionController@show'
        ,'as' => 'cotizacion.edit'
    ]);

    Route::put('/cotizacion/update', [
        'uses' => 'Ventas\CotizacionController@update'
        ,'as' => 'cotizacion.update'
    ]);

    Route::delete('/cotizacion/destroy', [
        'uses' => 'Ventas\CotizacionController@destroy'
        ,'as' => 'cotizacion.destroy'
    ]);

    Route::delete('/cotizacion/destroy/gen', [
        'uses' => 'Ventas\CotizacionController@destroy_cotizacion'
        ,'as' => 'cotizacion.destroy.gen'
    ]);

    Route::delete('/cotizacion/destroy/edit', [
        'uses' => 'Ventas\CotizacionController@destroy_cotizacion_edit'
        ,'as' => 'cotizacion.destroy.edit'
    ]);

    Route::get('/ventas/contactos', [
        'uses' => 'Ventas\CotizacionController@getbycontactos'
        ,'as' => 'ventas.contactos'
    ]);

    Route::get('/ventas/contacto', [
        'uses' => 'Ventas\CotizacionController@getContacto'
        ,'as' => 'ventas.contacto'
    ]);

    Route::get('/ventas/contacto/edicion', [
        'uses' => 'Ventas\CotizacionController@getContactoEdicion'
        ,'as' => 'ventas.contacto.edicion'
    ]);

    Route::post('/cotizaciones/update', [
        'uses' => 'Ventas\CotizacionController@update_estatus'
        ,'as' => 'cotizaciones.update'
    ]);

    //PDF generar para imprimir
    Route::get('/pdf/cotizacion/{id}', [
        'uses' => 'Ventas\CotizacionController@get_pdf'
        ,'as' => 'ventas.pdf.cotizacion'
    ]);

    //Envio de pdf por correo
    Route::post('/pdf/email', [
        'uses' => 'Ventas\CotizacionController@send_pdf'
        ,'as' => 'ventas.pdf.email'
    ]);

    Route::get('/cotizacion/send/email', [
        'uses' => 'Ventas\CotizacionController@get_correo'
        ,'as' => 'cotizacion.send.email'
    ]);

    Route::post('/cotizacion/filter', [
        'uses' => 'Ventas\CotizacionController@all'
        ,'as' => 'cotizacion.filter'
    ]);

    /*Route::get('/ventas/productos', [
        'uses' => 'Ventas\CotizacionController@getProducto'
        ,'as' => 'ventas.productos'
    ]);
*/
   /* Route::get('/ventas/planes', [
        'uses' => 'Ventas\CotizacionController@get_planes'
        ,'as' => 'ventas.planes'
    ]);*/


        ########################## DEVELOPMENT MODULOS ################################

        Route::get('/atencion/llamadas', [
                'uses'      => 'Development\AtencionesController@index'
                ,'as'       => 'atencion'
        ]);

    #################################### SECTION SALES OF POINT #####################################

    Route::get('/sales/boxes', [
        'uses'      => 'SalesOfPoint\BoxesController@index'
        ,'as'       => 'sales.boxes'
    ]);

    Route::get('/boxes/all', [
        'uses'      => 'SalesOfPoint\BoxesController@all'
        ,'as'       => 'boxes.all'
    ]);

    Route::get('/boxes/{id}/edit', [
        'uses'      => 'SalesOfPoint\BoxesController@show'
        ,'as'       => 'boxes.edit'
    ]);
    Route::get('/boxes/{id}/edit/{userId}', [
        'uses'      => 'SalesOfPoint\BoxesController@findActiveBox'
        ,'as'       => 'boxes.active'
    ]);

    Route::get('/boxes/{id}/close/{countCut}', [
        'uses'      => 'SalesOfPoint\BoxesController@boxCut'
        ,'as'       => 'boxes.cut'
    ]);

    Route::delete('/boxes/{id}/destroy', [
        'uses'      => 'SalesOfPoint\BoxesController@destroy'
        ,'as'       => 'boxes.destroy'
    ]);

    Route::post('/boxes/register', [
        'uses'      => 'SalesOfPoint\BoxesController@store'
        ,'as'       => 'sales.register'
    ]);

    Route::put('/boxes/update', [
        'uses'      => 'SalesOfPoint\BoxesController@update'
        ,'as'       => 'boxes.update'
    ]);


    Route::get('/sales/orders', [
        'uses'      => 'SalesOfPoint\OrdersController@index'
        ,'as'       => 'orders.orders'
    ]);

    Route::get('/orders/all', [
        'uses'      => 'SalesOfPoint\OrdersController@all'
        ,'as'       => 'orders.all'
    ]);

    Route::get('/orders/{id}/edit', [
        'uses'      => 'SalesOfPoint\OrdersController@show'
        ,'as'       => 'orders.edit'
    ]);

    Route::delete('/orders/{id}/destroy', [
        'uses'      => 'SalesOfPoint\OrdersController@destroy'
        ,'as'       => 'orders.destroy'
    ]);

    Route::post('/orders/register', [
        'uses'      => 'SalesOfPoint\OrdersController@store'
        ,'as'       => 'orders.register'
    ]);

    Route::put('/orders/update', [
        'uses'      => 'SalesOfPoint\OrdersController@update'
        ,'as'       => 'orders.update'
    ]);

    Route::delete('/concept/{id}/destroy', [
        'uses'      => 'SalesOfPoint\ConceptsController@destroy'
        ,'as'       => 'concepts.destroy'
    ]);
    Route::put('/concept/update', [
        'uses'      => 'SalesOfPoint\ConceptsController@update'
        ,'as'       => 'concepts.update'
    ]);

    Route::get('/sales/pedidos', [
        'uses'      => 'SalesOfPoint\SalesController@index'
        ,'as'       => 'sales.pedidos'
    ]);

    Route::post('/sales/{year}/filter/{month}', [
        'uses'      => 'SalesOfPoint\SalesController@all'
        ,'as'       => 'sales.all'
    ]);

    Route::get('/sales/{id}/edit', [
        'uses'      => 'SalesOfPoint\SalesController@show'
        ,'as'       => 'sales.edit'
    ]);

    Route::delete('/sales/{id}/destroy', [
        'uses'      => 'SalesOfPoint\SalesController@destroy'
        ,'as'       => 'sales.destroy'
    ]);

    Route::post('/sales/register', [
        'uses'      => 'SalesOfPoint\SalesController@store'
        ,'as'       => 'sales.register'
    ]);

    Route::put('/sales/{id}/update', [
        'uses'      => 'SalesOfPoint\SalesController@update'
        ,'as'       => 'sales.update'
    ]);

    Route::get('/sales/cuts', [
        'uses'      => 'SalesOfPoint\CutsController@index'
        ,'as'       => 'sales.cuts'
    ]);

    Route::post('/cuts/{year}/filter/{month}', [
        'uses'      => 'SalesOfPoint\CutsController@all'
        ,'as'       => 'cuts.all'
    ]);

    Route::get('/cuts/{id}/edit', [
        'uses'      => 'SalesOfPoint\CutsController@show'
        ,'as'       => 'cuts.edit'
    ]);

    Route::delete('/cuts/{id}/destroy', [
        'uses'      => 'SalesOfPoint\CutsController@destroy'
        ,'as'       => 'cuts.destroy'
    ]);

    Route::post('/cuts/register', [
        'uses'      => 'SalesOfPoint\CutsController@store'
        ,'as'       => 'cuts.register'
    ]);

    Route::put('/cuts/{id}/update', [
        'uses'      => 'SalesOfPoint\CutsController@update'
        ,'as'       => 'cuts.update'
    ]);







################################## CATALOGO DE PROYECTOS ################################
    Route::get('/proyectos/listado', [
        'uses' => 'Development\ProyectosController@index'
        ,'as' => 'proyectos.listado'
    ]);

    Route::get('/proyectos/all', [
        'uses' => 'Development\ProyectosController@all'
        ,'as' => 'proyectos.all'
    ]);

    Route::post('/proyectos/register', [
        'uses' => 'Development\ProyectosController@store'
        ,'as' => 'proyectos.register'
    ]);

    Route::get('/proyectos/edit', [
        'uses' => 'Development\ProyectosController@show'
        ,'as' => 'proyectos.edit'
    ]);

    Route::put('/proyectos/update', [
        'uses' => 'Development\ProyectosController@update'
        ,'as' => 'proyectos.update'
    ]);

    Route::delete('/proyectos/destroy', [
        'uses' => 'Development\ProyectosController@destroy'
        ,'as' => 'proyectos.destroy'
    ]);
    Route::get('/sales/agency', [
        'uses' => 'AgencyController@index'
        ,'as' => 'sales.agency'
    ]);

    Route::get('/agency/all', [
        'uses' => 'AgencyController@all'
        ,'as' => 'agency.all'
    ]);












});
