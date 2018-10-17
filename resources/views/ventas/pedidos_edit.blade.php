<div id="modal_add_register" style="display:none;" class="col-sm-12">
    <input type="hidden" id="id_factura" />
    <input type="hidden" id="id_concep_producto">
    <h3>Registro de Pedidos</h3>
    <hr>

    <div class="modal-body">
        <form class="form-horizontal">
            <div class="form-group row">
                <label for="nombre_cliente" class="col-md-2 control-label">Cliente:</label>
                <div class="col-md-3">
                    {!! $clientes !!}
                </div>


                <label for="contacto" class="col-md-1 control-label">Contacto:</label>
                <div class="col-md-2">
                    <div id="div_contacto">
                        <select class="form-control input-sm" disabled>
                            <option value="">Selecciona Opcion</option>
                        </select>
                    </div>
                </div>


                <div class="col-md-2">
                    <input type="text" class="form-control input-sm" id="telefono_contacto" placeholder="Teléfono Contacto" readonly="">
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control input-sm" id="correo_contacto" placeholder="Correo Contacto" readonly="">
                </div>

            </div>

            <div class="form-group row">
                <label for="empresa" class="col-md-2 control-label">RFC:</label>
                <div class="col-md-3">
                    <input type="text" class="form-control input-sm" id="rfc_receptor" placeholder="" readonly="">
                </div>
                <label for="tel2" class="col-md-1 control-label">Nombre Comercial:</label>
                <div class="col-md-3">
                    <input type="text" class="form-control input-sm" id="nombre_comercial" placeholder="" readonly="">
                </div>
                <label for="email" class="col-md-1 control-label">Teléfono:</label>
                <div class="col-md-2">
                    <input type="email" class="form-control input-sm" id="telefono_cliente" placeholder="Telefono Cliente" readonly="">
                </div>
            </div>

            <div class="form-group row">
                <label for="condiciones" class="col-md-2 control-label">Forma de pago:</label>
                <div class="col-md-3">
                    {!! $formas_pagos !!}
                </div>
                <label for="validez" class="col-md-1 control-label">Método de pago:</label>
                <div class="col-md-2">
                    {!! $metodos_pagos !!}
                </div>

                <label for="validez" class="col-md-1 control-label">Estatus:</label>
                <div class="col-md-3">
                    {!! $cmb_estatus_form !!}
                </div>

            </div>

            <div class="form-group row">
                <label for="condiciones" class="col-md-2 control-label">Descripción:</label>
                <div class="col-md-6">
                    <textarea class="form-control" id="observaciones" name="observaciones"></textarea>
                </div>

                <label for="moneda" class="col-md-1 control-label">Moneda:</label>
                <div class="col-md-3">
                    {!! $monedas !!}
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

                <table class="table table-hover">
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
                        <tr>
                            <td class="text-center"></td>
                            <td class="text-center"></td>
                            <td></td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                            <td class="text-center">
                                <a href="#" v-on:click.prevent="destroy_concepto()">
                                    <i class="glyphicon glyphicon-trash"></i>
                                </a>
                            </td>

                        </tr>
                    </tbody>

                    <tfoot>
                        <tr>
                            <td class="text-right" colspan="4">SUBTOTAL </td>
                            <td class="text-right" id="subtotal" style="background-color:#eee"> </td>
                        </tr>
                        <tr>
                            <td class="text-right" colspan="4">IVA ({{$iva}})% </td>
                            <td class="text-right" id="iva" style="background-color:#eee"> </td>
                        </tr>
                        <tr>
                            <td class="text-right" colspan="4">TOTAL </td>
                            <td class="text-right" id="total" style="background-color:#eee"></td>
                        </tr>
                    </tfoot>

                </table>

            </div>

        </form>
    </div>

    <div class="modal-footer">
        <div class="btn-toolbar pull-right">
            <button type="button" class="btn btn-danger" data-fancybox-close>
                <i class="fa fa-times-circle"></i> Cancelar
            </button>
            <button type="button" class="btn btn-primary" v-on:click.prevent="insert_register()" {{$insertar}}>
                <i class="fa fa-save"></i> Registrar
            </button>
        </div>
    </div>

</div>


<div class="" id="modal_conceptos" style="display:none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3> Agregar Concepto </h3>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
            <div class="form-group">
                <label for="condiciones" class="col-sm-2 control-label">Productos:</label>
                <div class="col-sm-4">
                    {!! $productos !!}
                </div>
                <label for="validez" class="col-sm-2 control-label">Planes:</label>
                <div class="col-sm-4">
                    {!! $planes !!}
                </div>

            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="">Cantidad</label>
                <div class="col-sm-9">
                    <input type="number" id="cantidad_concepto" class="form-control" placeholder="" onblur="calcular_suma()" value="0">
                </div>
            </div>


            <div class="form-group">
                <label class="control-label col-sm-2" for="">Precio Unitario</label>
                <div class="col-sm-9">
                    <input type="text" id="precio_concepto" class="form-control" readonly placeholder="$" onblur="calcular_suma()" value="0">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="">Descripción</label>
                <div class="col-sm-9">
                    <textarea class="form-control" id="descripcion" rows="5" readonly></textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="">Total</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="$" disabled id="total_concepto" value="0">
                </div>
            </div>

        </form>
            </div>
            <div class="modal-footer">
                <div class="btn-toolbar pull-right">
                    <button type="button" class="btn btn-danger" data-fancybox-close> <i class="fa fa-times-circle"></i> Cancelar</button>
                    <button type="button" class="btn btn-info" v-on:click.prevent="insert_productos()" {{$insertar}}><i class="fa fa-save"></i> Agregar </button>
                </div>
            </div>

        </div>
    </div>
</div>