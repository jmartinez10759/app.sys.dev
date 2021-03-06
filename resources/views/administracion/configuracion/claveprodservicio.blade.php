@extends('layouts.template.app')
@section('content')
@push('styles')
@endpush
<div id="vue-claveprodservicio" ng-clock>
    {{-- {!! $data_table !!} --}}
     <div class="panel-body">
        
        <div class="table-responsive">
            <table class="table table-striped table-responsive highlight table-hover fixed_header" id="datatable">
                <thead>
                    <tr style="background-color: #337ab7; color: #ffffff;">
                        <th>#</th>
                        <th>Clave</th>
                        <th>Descripcion</th>
                        <th>IVA Trasladado</th>
                        <th>IEPS Trasladado</th>
                        <th>Similares</th>
                        
                        <th class="text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>

                    <tr v-for="data in datos">

                        <td>@{{data.id}}</td>
                        <td>@{{data.clave }}</td>
                        <td>@{{data.descripcion }}</td>
                        <td>@{{data.iva_trasladado }}</td>
                        <td>@{{data.ieps_trasladado }}</td>
                        <td>@{{data.similares }}</td>
                        <td class="text-right">
                            <div class="dropdown">
                                <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    Acciones
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
                                    <li>
                                        <a title="Editar" style="cursor:pointer;" v-on:click.prevent="edit_register(data.id)">
                                            <i class="glyphicon glyphicon-edit"></i> Editar
                                        </a>
                                    </li>
                                    
                                    <li {{$eliminar}}>
                                        <a style="cursor:pointer;" title="Borrar" v-on:click.prevent="destroy_register(data.id)" >
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
    </div>
    
    @include('administracion.configuracion.claveprodservicio_edit')
    {!! $seccion_reportes !!}
</div>
@stop
@push('scripts')
<script type="text/javascript" src="{{asset('js/administracion/configuracion/build_claveprodservicio.js')}}"></script>
@endpush