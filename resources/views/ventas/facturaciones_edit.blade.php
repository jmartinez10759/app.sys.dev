
<div id="modal_add_register" style="display:none;" class="col-sm-12">
    <input type="hidden" ng-model="insert.id">
    <h3>Registro de Facturas</h3>
    <hr>

    <div class="modal-body">
        <form class="form-horizontal">
            <div class="form-group row">
                <label for="nombre_cliente" class="col-md-2 control-label">Cliente:</label>
                <div class="col-md-3">
                    <select class="form-control input-sm"
                    width="'100%'"
                    chosen
                    ng-model="insert.id_cliente" 
                    ng-options="value.id as value.razon_social for (key, value) in datos.clientes" 
                    ng-change="display_contactos()" >
                        <option value="">--Seleccione Opcion--</option>
                    </select>
                </div>


                <label for="contacto" class="col-md-1 control-label">Uso CFDI:</label>
                <div class="col-md-3">
                    <select class="form-control input-sm"
                    width="'100%'"
                    chosen
                    ng-model="insert.id_uso_cfdi" 
                    ng-options="value.id as value.clave +' '+value.descripcion for (key, value) in cmb_uso_cfdi">
                        <option value="">--Seleccione Opcion--</option>
                    </select>
                </div>


                <div class="col-md-1">
                    <input type="text" class="form-control input-sm" placeholder="Teléfono Contacto" readonly="" ng-model="fields.telefono" capitalize>
                </div>
                <div class="col-md-1">
                    <input type="text" class="form-control input-sm" placeholder="Correo Contacto" readonly="" ng-model="fields.correo">
                </div>

            </div>

            <div class="form-group row">
                <label for="empresa" class="col-md-2 control-label">RFC:</label>
                <div class="col-md-3">
                    <input type="text" class="form-control input-sm" placeholder="" readonly="" ng-model="fields.rfc">
                </div>
                <label for="tel2" class="col-md-1 control-label">Nombre Comercial:</label>
                <div class="col-md-3">
                    <input type="text" class="form-control input-sm" placeholder="" readonly="" ng-model="fields.nombre_comercial">
                </div>
                <label for="email" class="col-md-1 control-label">Tipo Comprobante:</label>
                <div class="col-md-2">
                    <select class="form-control input-sm"
                    width="'100%'"
                    chosen
                    ng-model="insert.id_tipo_comprobante" 
                    ng-options="value.id as value.nombre+' - '+value.descripcion for (key, value) in datos.tipo_comprobante">
                        <option value="">--Seleccione Opcion--</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="condiciones" class="col-md-2 control-label">Forma de pago:</label>
                <div class="col-md-3">
                    <select class="form-control input-sm"
                    width="'100%'"
                    chosen
                    ng-model="insert.id_forma_pago" 
                    ng-options="value.id as value.clave+' - '+value.descripcion for (key, value) in datos.formas_pagos">
                        <option value="">--Seleccione Opcion--</option>
                    </select>
                </div>
                <label for="validez" class="col-md-1 control-label">Método de pago:</label>
                <div class="col-md-2">
                    <select class="form-control input-sm"
                    width="'100%'"
                    chosen
                    ng-model="insert.id_metodo_pago" 
                    ng-options="value.id as value.clave+' - '+value.descripcion for (key, value) in datos.metodos_pagos">
                        <option value="">--Seleccione Opcion--</option>
                    </select>
                </div>

                <label for="validez" class="col-md-1 control-label">Estatus:</label>
                <div class="col-md-3">
                    <select class="form-control input-sm"
                    width="'100%'"
                    chosen
                    disabled="" 
                    ng-model="insert.id_estatus" 
                    ng-options="value.id as value.nombre for (key, value) in datos.estatus">
                        <option value="">--Seleccione Opcion--</option>
                    </select>
                </div>

            </div>

            <div class="form-group row">
                <label for="condiciones" class="col-md-2 control-label">Descripción:</label>
                <div class="col-md-6">
                    <textarea class="form-control" ng-model="insert.descripcion" capitalize></textarea>
                </div>

                <label for="moneda" class="col-md-1 control-label">Moneda:</label>
                <div class="col-md-3">
                    <select class="form-control input-sm"
                    width="'100%'"
                    chosen
                    ng-model="insert.id_moneda" 
                    ng-options="value.id as value.nombre+' - '+value.descripcion for (key, value) in datos.monedas">
                        <option value="">--Seleccione Opcion--</option>
                    </select>
                </div>

            </div>

            <div class="form-group row">
                <div class="pull-right col-sm-2">
                    <button type="button" class="btn btn-warning add" title="Agregar Producto" href="#modal_conceptos">
                        <i class="fa fa-plus-circle"></i> Conceptos
                    </button>
                </div>
            </div>


            <hr>

            <div class="table-responsive" style="overflow-y:scroll; height:200px;">

                <table class="table table-hover" id="table_concepts">
                    <thead>
                        <tr style="background-color: #337ab7; color: #ffffff;">
                            <th class="text-center">CÓDIGO</th>
                            <th class="text-center">CANTIDAD</th>
                            <th>DESCRIPCIÓN</th>
                            <th class="text-right">PRECIO UNITARIO.</th>
                            <th class="text-right">PRECIO TOTAL</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr ng-repeat="concepto in table_concepts">
                            <td class="text-center">@{{ (concepto.id_producto == null)? concepto.planes.codigo :concepto.productos.codigo}}</td>
                            <td class="text-center">@{{concepto.cantidad}}</td>
                            <td>@{{ (concepto.id_producto == null)? concepto.planes.descripcion :concepto.productos.descripcion }} </td>
                            <td class="text-right">$ @{{concepto.precio.toLocaleString() }}  </td>
                            <td class="text-right">$ @{{concepto.total.toLocaleString() }}</td>
                            <td class="text-center">
                                <a style="cursor: pointer;" ng-click="destroy_concepto(concepto.id)" {{$eliminar}}>
                                    <i class="glyphicon glyphicon-trash"></i>
                                </a>
                            </td>

                        </tr>
                    </tbody>

                    <tfoot>
                        <tr>
                            <td class="text-right" colspan="4">SUBTOTAL </td>
                            <td class="text-right" style="background-color:#eee">
                                @{{(subtotal) ? subtotal : "$ 0.00" }}
                            </td>
                            <input type="hidden" ng-model="insert.subtotal">
                        </tr>
                        <tr>
                            <td class="text-right" colspan="4">IVA ({{$iva}})% </td>
                            <td class="text-right" id="iva" style="background-color:#eee">
                                @{{(iva) ? iva : "$ 0.00" }}
                            </td>
                            <input type="hidden" ng-model="insert.iva">
                        </tr>
                        <tr>
                            <td class="text-right" colspan="4">TOTAL </td>
                            <td class="text-right" style="background-color:#eee">
                                @{{(total) ? total : "$ 0.00" }}
                            </td>
                            <input type="hidden" ng-model="insert.total">
                        </tr>
                    </tfoot>

                </table>

            </div>

        </form>
    </div>

    <div class="modal-footer">
        <div class="btn-toolbar pull-right">
            <button type="button" class="btn btn-danger" data-fancybox-close ng-click="cancel_pedido()">
                <i class="fa fa-times-circle"></i> Cancelar
            </button>
            <button type="button" class="btn btn-primary agregar" ng-click="update_register()" {{$insertar}}>
                <i class="fa fa-save"></i> Registrar
            </button>
        </div>
    </div>

</div>


<div id="modal_edit_register" style="display:none;" class="col-sm-12">
    <input type="hidden" ng-model="update.id">
    <h3>Detalles de Factura</h3>
    <hr>

    <div class="modal-body">
        <form class="form-horizontal">
            <div class="form-group row">
                <label for="nombre_cliente" class="col-md-2 control-label">Cliente:</label>
                <div class="col-md-3">
                    <select class="form-control input-sm"
                    width="'100%'"
                    chosen
                    ng-model="update.id_cliente" 
                    ng-options="value.id as value.razon_social for (key, value) in datos.clientes" 
                    ng-change="display_contactos(1)" >
                        <option value="">--Seleccione Opcion--</option>
                    </select>
                </div>


                <label for="contacto" class="col-md-1 control-label">Contacto:</label>
                <div class="col-md-2">
                    <select class="form-control input-sm"
                    width="'100%'"
                    chosen
                    ng-model="update.id_contacto" 
                    ng-options="value.id as value.nombre_completo for (key, value) in cmb_contactos" 
                    ng-change="change_contactos(1)" >
                        <option value="">--Seleccione Opcion--</option>
                    </select>
                </div>


                <div class="col-md-2">
                    <input type="text" class="form-control input-sm" placeholder="Teléfono Contacto" readonly="" ng-model="fields.telefono" capitalize>
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control input-sm" placeholder="Correo Contacto" readonly="" ng-model="fields.correo">
                </div>

            </div>

            <div class="form-group row">
                <label for="empresa" class="col-md-2 control-label">RFC:</label>
                <div class="col-md-3">
                    <input type="text" class="form-control input-sm" placeholder="" readonly="" ng-model="fields.rfc">
                </div>
                <label for="tel2" class="col-md-1 control-label">Nombre Comercial:</label>
                <div class="col-md-3">
                    <input type="text" class="form-control input-sm" placeholder="" readonly="" ng-model="fields.nombre_comercial">
                </div>
                <label for="email" class="col-md-1 control-label">Tipo Comprobante:</label>
                <div class="col-md-2">
                    <select class="form-control input-sm"
                    width="'100%'"
                    chosen
                    ng-model="update.id_tipo_comprobante" 
                    ng-options="value.id as value.nombre+' - '+value.descripcion for (key, value) in datos.tipo_comprobante">
                        <option value="">--Seleccione Opcion--</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="condiciones" class="col-md-2 control-label">Forma de pago:</label>
                <div class="col-md-3">
                    <select class="form-control input-sm"
                    width="'100%'"
                    chosen
                    ng-model="update.id_forma_pago" 
                    ng-options="value.id as value.descripcion for (key, value) in datos.formas_pagos">
                        <option value="">--Seleccione Opcion--</option>
                    </select>
                </div>
                <label for="validez" class="col-md-1 control-label">Método de pago:</label>
                <div class="col-md-2">
                    <select class="form-control input-sm"
                    width="'100%'"
                    chosen
                    ng-model="update.id_metodo_pago" 
                    ng-options="value.id as value.descripcion for (key, value) in datos.metodos_pagos">
                        <option value="">--Seleccione Opcion--</option>
                    </select>
                </div>

                <label for="validez" class="col-md-1 control-label">Estatus:</label>
                <div class="col-md-3">
                    <select class="form-control input-sm"
                    width="'100%'"
                    chosen
                    ng-model="update.id_estatus" 
                    ng-options="value.id as value.nombre for (key, value) in datos.estatus">
                        <option value="">--Seleccione Opcion--</option>
                    </select>
                </div>

            </div>

            <div class="form-group row">
                <label for="condiciones" class="col-md-2 control-label">Descripción:</label>
                <div class="col-md-6">
                    <textarea class="form-control" ng-model="update.descripcion" capitalize></textarea>
                </div>

                <label for="moneda" class="col-md-1 control-label">Moneda:</label>
                <div class="col-md-3">
                    <select class="form-control input-sm"
                    width="'100%'"
                    chosen
                    ng-model="update.id_moneda" 
                    ng-options="value.id as value.descripcion for (key, value) in datos.monedas">
                        <option value="">--Seleccione Opcion--</option>
                    </select>
                </div>

            </div>

            <div class="form-group row">
                <div class="pull-right col-sm-2">
                    <button type="button" class="btn btn-warning add" title="Agregar Producto" href="#modal_conceptos_edit">
                        <i class="fa fa-plus-circle"></i> Conceptos
                    </button>
                </div>
            </div>


            <hr>

            <div class="table-responsive" style="overflow-y:scroll; height:200px;">

                <table class="table table-hover" id="table_concepts_edit">
                    <thead>
                        <tr style="background-color: #337ab7; color: #ffffff;">
                            <th class="text-center">CÓDIGO</th>
                            <th class="text-center">CANTIDAD</th>
                            <th>DESCRIPCIÓN</th>
                            <th class="text-right">PRECIO UNITARIO.</th>
                            <th class="text-right">PRECIO TOTAL</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr ng-repeat="concepto in table_concepts">
                            <td class="text-center">@{{ (concepto.id_producto == null)? concepto.planes.codigo :concepto.productos.codigo}}</td>
                            <td class="text-center">@{{concepto.cantidad}}</td>
                            <td>@{{ (concepto.id_producto == null)? concepto.planes.descripcion :concepto.productos.descripcion }} </td>
                            <td class="text-right">$ @{{concepto.precio.toLocaleString() }}  </td>
                            <td class="text-right">$ @{{concepto.total.toLocaleString() }}</td>
                            <td class="text-center">
                                <div ng-if="estatus != 8 ">
                                    <a style="cursor: pointer;" ng-click="destroy_concepto(concepto.id,1)" {{$eliminar}}>
                                        <i class="glyphicon glyphicon-trash"></i>
                                    </a>
                                </div>
                            </td>

                        </tr>
                    </tbody>

                    <tfoot>
                        <tr>
                            <td class="text-right" colspan="4">SUBTOTAL </td>
                            <td class="text-right" style="background-color:#eee">
                                @{{(subtotal) ? subtotal : "$ 0.00" }}
                            </td>
                            <input type="hidden" ng-model="update.subtotal">
                        </tr>
                        <tr>
                            <td class="text-right" colspan="4">IVA ({{$iva}})% </td>
                            <td class="text-right" id="iva" style="background-color:#eee">
                                @{{(iva) ? iva : "$ 0.00" }}
                            </td>
                            <input type="hidden" ng-model="update.iva">
                        </tr>
                        <tr>
                            <td class="text-right" colspan="4">TOTAL </td>
                            <td class="text-right" style="background-color:#eee">
                                @{{(total) ? total : "$ 0.00" }}
                            </td>
                            <input type="hidden" ng-model="update.total">
                        </tr>
                    </tfoot>

                </table>

            </div>

        </form>
    </div>

    <div class="modal-footer">
        <div class="btn-toolbar pull-right">
            <button type="button" class="btn btn-danger" data-fancybox-close ng-click="cancel_pedido()">
                <i class="fa fa-times-circle"></i> Cancelar
            </button>
            <button type="button" class="btn btn-info update" ng-click="update_register(1)" {{$update}} ng-if="estatus !=8 ">
                <i class="fa fa-save"></i> Actualizar
            </button>
        </div>
    </div>

</div>


<div class="" id="modal_conceptos" style="display:none;">
    <div class="modal-header">
        <h3> Agregar Concepto </h3>
    </div>
    <div class="modal-body">
        <form class="form-horizontal">
            <div class="form-group">
                <label for="condiciones" class="col-sm-2 control-label">Productos:</label>
                <div class="col-sm-4">
                    <select class="form-control input-sm"
                    width="'100%'"
                    chosen
                    ng-model="products.id_producto" 
                    ng-change="display_productos(1)"
                    ng-options="value.id as value.nombre for (key, value) in datos.productos">
                        <option value="">--Seleccione Opcion--</option>
                    </select>
                </div>
                <label for="validez" class="col-sm-2 control-label">Planes:</label>
                <div class="col-sm-4">
                    <select class="form-control input-sm"
                    width="'100%'"
                    chosen
                    ng-model="products.id_plan" 
                    ng-change="display_planes(1)"
                    ng-options="value.id as value.nombre for (key, value) in datos.planes">
                        <option value="">--Seleccione Opcion--</option>
                    </select>
                </div>

            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="">Cantidad</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" ng-blur="calcular_suma(1)" maxlength="8" ng-model="products.cantidad" string-to-number>
                </div>
            </div>


            <div class="form-group">
                <label class="control-label col-sm-2" for="">Precio Unitario</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" readonly placeholder="$" ng-blur="calcular_suma(1)" value="0" ng-model="products.precio" string-to-number>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="">Descripción</label>
                <div class="col-sm-9">
                    <textarea class="form-control" rows="5" readonly ng-model="products.descripcion"></textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="">Total</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" placeholder="$" readonly="" ng-model="products.total" string-to-number>
                </div>
            </div>

        </form>

    </div>

    <div class="modal-footer">
        <div class="btn-toolbar pull-right">
            <button type="button" class="btn btn-danger" data-fancybox-close> <i class="fa fa-times-circle"></i> Cancelar</button>
            <button type="button" class="btn btn-info agregar" ng-click="insert_register()" {{$insertar}}><i class="fa fa-save"></i> Agregar </button>
        </div>
    </div>
    
</div>

<div class="" id="modal_conceptos_edit" style="display:none;">
    <div class="modal-header">
        <h3> Agregar Concepto </h3>
    </div>
    <div class="modal-body">
        <form class="form-horizontal">
            <div class="form-group">
                <label for="condiciones" class="col-sm-2 control-label">Productos:</label>
                <div class="col-sm-4">
                    <select class="form-control input-sm"
                    width="'100%'"
                    chosen
                    ng-model="products.id_producto" 
                    ng-change="display_productos(1)"
                    ng-options="value.id as value.nombre for (key, value) in datos.productos">
                        <option value="">--Seleccione Opcion--</option>
                    </select>
                </div>
                <label for="validez" class="col-sm-2 control-label">Planes:</label>
                <div class="col-sm-4">
                    <select class="form-control input-sm"
                    width="'100%'"
                    chosen
                    ng-model="products.id_plan" 
                    ng-change="display_planes(1)"
                    ng-options="value.id as value.nombre for (key, value) in datos.planes">
                        <option value="">--Seleccione Opcion--</option>
                    </select>
                </div>

            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="">Cantidad</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" ng-blur="calcular_suma(1)" ng-maxlength="8" ng-model="products.cantidad" string-to-number>
                </div>
            </div>


            <div class="form-group">
                <label class="control-label col-sm-2" for="">Precio Unitario</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" readonly placeholder="$" ng-blur="calcular_suma(1)" value="0" ng-model="products.precio" string-to-number>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="">Descripción</label>
                <div class="col-sm-9">
                    <textarea class="form-control" rows="5" readonly ng-model="products.descripcion"></textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="">Total</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" placeholder="$" readonly="" ng-model="products.total" string-to-number>
                </div>
            </div>

        </form>

    </div>

    <div class="modal-footer">
        <div class="btn-toolbar pull-right">
            <button type="button" class="btn btn-danger" data-fancybox-close> <i class="fa fa-times-circle"></i> Cancelar</button>
            <button type="button" class="btn btn-info agregar" ng-click="insert_register(1)" {{$insertar}} ng-if="estatus!=8"><i class="fa fa-save"></i> Agregar </button>
        </div>
    </div>
    
</div>


<div class="" id="modal_correo_send" style="display:none;">
    <div class="modal-header">
        <h3> Envio de Correo  </h3>
    </div>
    <div class="modal-body">
        <form class="form-horizontal">

            <div class="form-group">
                <label class="control-label col-sm-2" for="">Correo: </label>
                <div class="col-sm-9">
                    <input type="text" ng-model="correo.email" class="form-control">
                </div>
            </div>


            <div class="form-group">
                <label class="control-label col-sm-2" for="">Asunto</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" ng-model="correo.asunto" >
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="">Descripción</label>
                <div class="col-sm-9">
                    <textarea class="form-control" rows="6"  ng-model="correo.mensaje"></textarea>
                </div>
            </div>

        </form>

    </div>

    <div class="modal-footer">
        <div class="btn-toolbar pull-right">
            <button type="button" class="btn btn-danger" data-fancybox-close> <i class="fa fa-times-circle"></i> Cancelar</button>
            <button type="button" class="btn btn-info" ng-click="send_correo()" {{$email}}><i class="glyphicon glyphicon-send"></i> Enviar Correo </button>
        </div>
    </div>
    
</div>