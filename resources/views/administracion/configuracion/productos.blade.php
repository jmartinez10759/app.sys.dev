@extends('layouts.template.app')
@section('content')
@push('styles')
@endpush
<div ng-app="ng-productos" ng-controller="ProductosController" ng-init="constructor()" ng-cloak>
    <div class="table-responsive">
	    <table class="table table-striped table-responsive highlight table-hover fixed_header" id="datatable">
	        <thead>
	            <tr style="background-color: #337ab7; color: #ffffff;">
	                <th>Categoria</th>
	                <th>Codigo Producto</th>
	                <th>Unidad de Medida</th>
	                <th>Producto</th>
	                <th>Stock</th>
	                <th>SubTotal</th>
	                <th>Total</th>
	                <th>Estatus</th>
	                <th class="text-right"></th>
	                <th class="text-right"></th>
	                <th class="text-right"></th>
	            </tr>
	        </thead>
	        <tbody>
	            <tr ng-repeat="data in datos">
	                <td>@{{(data.categorias !== null )? data.categorias : "" }}</td>
	                <td>@{{ data.codigo }}</td>
	                <td>@{{(data.unidades !== null )? data.unidades.clave+" - "+data.unidades.descripcion : "" }}</td>
	                <td>@{{ data.nombre }}</td>
	                <td>@{{ data.stock }}</td>
	                <td>$ @{{ data.subtotal.toLocaleString() }}</td>
	                <td>$ @{{ data.total.toLocaleString()}} </td>
	                <td>
	                	<span class="label label-success" ng-if="data.estatus == 1">Activo</span>
	                	<span class="label label-danger" ng-if="data.estatus == 0">Baja</span>
	                </td>
	                <td class="text-right">
	                    <div class="dropdown">
	                        <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
	                            Acciones
	                            <span class="caret"></span>
	                        </button>
	                        <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
	                            <li>
	                                <a title="Editar" style="cursor:pointer;" ng-click="edit_register(data)">
	                                    <i class="glyphicon glyphicon-edit"></i> Editar
	                                </a>
	                            </li>
	                            
	                            <li {{$eliminar}}>
	                                <a style="cursor:pointer;" title="Borrar" ng-click="destroy_register(data.id)" >
	                                    <i class="glyphicon glyphicon-trash"></i> Eliminar
	                                </a>
	                            </li>
	                        </ul>
	                    </div>
	                </td>
	                <td>
                        <select class="form-control" ng-model="data.empresas[0].id" ng-options="value.id as value.nombre_comercial for (key, value) in datos.empresas" ng-change="display_sucursales(data.id )" id="cmb_empresas_@{{data.id}}" {{$permisos}}>
                        </select>
                    </td>
	                </tr>

	        </tbody>
	    </table>
	</div>
    @include('administracion.configuracion.productos_edit')
</div>
@stop
@push('scripts')
<script type="text/javascript" src="{{asset('js/administracion/configuracion/build_productos.js')}}"></script>
@endpush