@extends('layouts.template.app')
@section('content')
@push('styles')
@endpush
<div ng-app="application" ng-controller="CuentasController" ng-init="constructor()" ng-cloak>
    <!-- {!! $data_table !!} -->
<div class="table-responsive">
    <table class="table table-striped table-responsive highlight table-hover fixed_header" id="datatable">
        <thead>
            <tr style="background-color: #337ab7; color: #ffffff;">
                <th>Cuenta</th>
                <th>Servicios</th>
                <th>Empresa</th>
                <th>Cliente</th>
                <th>Correo Contacto</th>
                <th>Estatus</th>
                <th class="text-right"></th>
            </tr>
        </thead>
        <tbody>

            <tr ng-repeat="data in datos">
                <td ng-click="edit_register(data.id)" style="cursor: pointer;">@{{data.nombre_comercial}}</td>
                <td ng-click="edit_register(data.id)" style="cursor: pointer;">@{{(data.servicios !== null )? data.servicios.clave+" - "+data.servicios.descripcion : "" }}</
                <td ng-click="edit_register(data.id)" style="cursor: pointer;">@{{data.empresas.length > 0 ? data.empresas[0].razon_social : "" }}</td>
                <td ng-click="edit_register(data.id)" style="cursor: pointer;">@{{data.clientes.length > 0 ? data.clientes[0].razon_social: "" }}</td>
                <td ng-click="edit_register(data.id)" style="cursor: pointer;">@{{ (data.contactos.length > 0)? data.contactos[0].correo: ""}}</td>
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
                            {{-- <li>
                                <a title="Editar" style="cursor:pointer;" ng-click="edit_register(data.id)">
                                    <i class="glyphicon glyphicon-edit"></i> Editar
                                </a>
                            </li> --}}
                            
                            <li {{$eliminar}}>
                                <a style="cursor:pointer;" title="Borrar" ng-click="destroy_register(data.id)" >
                                    <i class="glyphicon glyphicon-trash"></i> Eliminar
                                </a>
                            </li>
                        </ul>
                    </div>
                </td>
                </tr>

        </tbody>
    </table>
</div>
   @include('administracion.configuracion.cuentas_edit')
</div>
@stop
@push('scripts')
<script type="text/javascript" src="{{asset('js/administracion/configuracion/build_cuentas.js')}}"></script>
@endpush