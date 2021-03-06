<!--<div class="" id="modal_add_register" style="display:none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3> Titulo modales </h3>
            </div>
            <div class="modal-body">
                
                
            </div>
            <div class="modal-footer">
                <div class="btn-toolbar pull-right">
                    <button type="button" class="btn btn-danger" data-fancybox-close> <i class="fa fa-times-circle"></i> Cancelar</button>
                    <button type="button" class="btn btn-primary" v-on:click.prevent="insert_register()"><i class="fa fa-save"></i> Registrar </button> 
                </div>
            </div>

        </div>
    </div>
</div>-->

<div id="modal_add_register" style="display:none;" class="col-sm-12">
        <input type="hidden" id="id_factura"/>
        <input type="hidden" id="id_concep_producto">
        <h3>Registro de Información</h3>
        <hr>

        <div class="modal-body" style="overflow-y:scroll; height:500px;">
                        <form class="form-horizontal" >
                            <div class="form-group row">
                              <label for="nombre_cliente" class="col-md-2 control-label">Selecciona el cliente:</label>
                              <div class="col-md-3">
                                  <!-- <input type="text" class="form-control input-sm ui-autocomplete-input" id="nombre_cliente" placeholder="Ingresa el nombre del cliente" required="" autocomplete="off">
                                  <input id="id_cliente" type="hidden">  -->
                                 <!--  <select name="cliente" id="sys_idCliente" class="form-control input-sm" required="required"></select>
 -->                             
                                    {!! $clientes !!}
                              </div>
                              
                              
                              <label for="contacto" class="col-md-1 control-label">Contacto:</label>
                                <div class="col-md-2">
                                    <div id="div_contacto">
                                        <select class="form-control input-sm">
                                            <option value="">Selecciona Opción</option>
                                        </select>
                                    </div>
                                </div>
                                
                              
                                <div class="col-md-2">
                                    <input type="text" class="form-control input-sm" id="tel1" placeholder="" value="Teléfono" readonly="">
                                 </div>
                                 <div class="col-md-2">
                                    <input type="text" class="form-control input-sm" id="email_contact" placeholder="" value="Correo electrónico" readonly="">
                                 </div>
                            
                            </div>

                            <div class="form-group row">
                                <label for="empresa" class="col-md-2 control-label">RFC empresa:</label>
                                <div class="col-md-3">
                                    <input type="text" class="form-control input-sm" id="rfc_empresa" placeholder="" readonly="">
                                </div>
                                <label for="tel2" class="col-md-1 control-label">Nombre comercial:</label>
                                <div class="col-md-3">
                                    <input type="text" class="form-control input-sm" id="nombre_comercial" placeholder="" readonly="">
                                </div>
                                <label for="email" class="col-md-1 control-label">Teléfono:</label>
                                <div class="col-md-2">
                                    <input type="email" class="form-control input-sm" id="tel2" placeholder="" readonly="">
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

                                    {!! $estatus !!}
                                </div>

                            </div>

                            <div class="form-group row">
                                <label for="condiciones" class="col-md-2 control-label">Descripción:</label>
                                <div class="col-md-6">
                                    <textarea class="form-control" id="observaciones" name="observaciones" style="text-transform: uppercase;"></textarea>
                                </div>
                                
                                <label for="moneda" class="col-md-1 control-label">Moneda:</label>
                                <div class="col-md-3">
                                    {!! $monedas !!}
                                </div>
                                
                            </div>
                            
                            <div class="form-group row">
                                <div class="pull-right col-sm-2">
                                    <!-- <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">
                                     <span class="glyphicon glyphicon-plus"></span> Agregar Conceptos
                                    </button> -->
                                    <button type="button" class="btn btn-info" title="Agregar Producto" onclick="facyadd_pro();"><i class="fa fa-plus-circle"></i> Agregar conceptos</button>
                                    <!-- <button type="submit" class="btn btn-default">
                                      <span class="glyphicon glyphicon-print"></span> Imprimir
                                    </button> -->
                                </div>
                            </div>

                            
                            <hr>    
                        
                            <input type="hidden" v-model="totales.subtotal" id="sub">
                            <input type="hidden" v-model="totales.iva" id="iv">
                            <input type="hidden" v-model="totales.Total" id="tol">
                            <div class="table-responsive">

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
                                    <tr v-for="data in datos">
                                        <td class="text-center">@{{ (data.cod_productos)?data.cod_productos:data.cod_planes }}</td>
                                        <td class="text-center">@{{ data.cantidad }}</td>
                                        <td>@{{ (data.descripcion)?data.descripcion:data.prod_desc }}</td>
                                        <td class="text-right">@{{ data.precio }}</td>
                                        <td class="text-right">@{{ data.total }}</td>
                                        <td class="text-center"><a href="#" v-on:click.prevent="destroy_register(data)"><i class="glyphicon glyphicon-trash"></i></a></td>
                                    </tr> 
                                    </tbody> 
                                    <tfoot>          
                                    <tr>
                                        <td class="text-right" colspan="4" >SUBTOTAL </td>
                                        <td class="text-right" style="background-color:#eee"> @{{ totales.subtotal }} </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right" colspan="4">IVA ({{$iva}})% </td>
                                        <td class="text-right" style="background-color:#eee"> @{{ totales.iva }} </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right" colspan="4">TOTAL </td>
                                        <td class="text-right" style="background-color:#eee"> @{{ totales.Total }} </td>
                                    </tr>

                                </tfoot></table>

                            </div>
                              <!-- <div class="form-group">
                                <label class="control-label col-sm-2" for="">Posicion</label>
                                <div class="col-sm-2">
                                  <input type="text" class="form-control" placeholder="" v-model="datos.skill_orden">
                                </div>
                            </div> -->
                        </form>
        </div>

        <div class="modal-footer">
            <div class="btn-toolbar pull-right">
                <button type="button" class="btn btn-danger" data-fancybox-close v-on:click.prevent="cancel_cotizacion()"> <i class="fa fa-times-circle"></i> Cancelar</button>
                <button type="button" class="btn btn-primary" v-on:click.prevent="insert_register()" {{$insertar}} id="insertar_add"><i class="fa fa-save"></i> Registrar </button> 
            </div>
        </div>

</div>





<div id="modal_conceptos" style="display:none;">
        <h3>Agregar Conceptos</h3>
            <hr>
        <div class="modal-body">

            <form class="form-horizontal" >

                <div class="form-group">
                    <label for="condiciones" class="col-sm-3 control-label">Productos:</label>
                    <div class="col-sm-3">
               
                        {!! $productos !!}
                    </div>
                    <label for="validez" class="col-sm-3 control-label">Planes:</label>
                    <div class="col-sm-3">

                        {!! $planes !!}
                    </div>

                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3" for="">Cantidad</label>
                    <div class="col-sm-9">
                        <input type="number" id="cantidad_concepto" value='0' class="form-control" placeholder="" onkeyup="calcular_suma()" onkeypress="valida_num()" onFocus="if (this.value=='0') this.value='';">
                    </div>
                </div>


                <div class="form-group">
                    <label class="control-label col-sm-3" for="">Precio Unitario</label>
                    <div class="col-sm-9">
                        <input type="text" id="precio_concepto" class="form-control" disabled placeholder="$" onkeyup="calcular_suma()" >
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3" for="">Descripción</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="descripcion" rows="5" readonly="readonly"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3" for="">Total</label>
                    <div class="col-sm-9">
                        <input type="text"  class="form-control" placeholder="$"  disabled id="total_concepto">
                    </div>
                </div>

         </form>


        </div>
        <div class="modal-footer">
            <div class="pull-right">
                <button type="button" class="btn btn-danger" data-fancybox-close id="add_cancelar"> <i class="fa fa-times-circle"></i> Cancelar</button>
                        
                <button type="button" class="btn btn-success" v-on:click.prevent="insert_register(1)" value="1" id="reg"><i class="fa fa-save"></i> Agregar</button>
            </div>
        </div>


    </div>

<!-- EDITAR  -->
    <div id="modal_conceptos_editar" style="display:none;">
        <h3>Agregar Conceptos</h3>
            <hr>
        <div class="modal-body">

            <form class="form-horizontal" >

                <div class="form-group">
                    <label for="condiciones" class="col-sm-3 control-label">Productos:</label>
                    <div class="col-sm-3">
               
                        {!! $productos_edit !!}
                    </div>
                    <label for="validez" class="col-sm-3 control-label">Planes:</label>
                    <div class="col-sm-3">

                        {!! $planes_edit !!}
                    </div>

                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3" for="">Cantidad</label>
                    <div class="col-sm-9">
                        <input type="number" id="cantidad_concepto_edit" class="form-control" placeholder="" onkeyup="calcular_suma_edit()" onkeypress="valida_num_edit()">
                    </div>
                </div>


                <div class="form-group">
                    <label class="control-label col-sm-3" for="">Precio Unitario</label>
                    <div class="col-sm-9">
                        <input type="text" id="precio_concepto_edit" class="form-control" disabled placeholder="$" onkeyup="calcular_suma_edit()" >
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3" for="">Descripción</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="descripcion_edit" readonly="readonly" rows="5"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3" for="">Total</label>
                    <div class="col-sm-9">
                        <input type="text"  class="form-control" placeholder="$"  disabled id="total_concepto_edit">
                    </div>
                </div>

         </form>


        </div>
        <div class="modal-footer">
            <div class="pull-right">
                <button type="button" class="btn btn-danger" data-fancybox-close> <i class="fa fa-times-circle"></i> Cancelar</button>
                        
                <button type="button" class="btn btn-success" v-on:click.prevent="insert_register_edit(1)" value="1"><i class="fa fa-save"></i> Agregar</button>
            </div>
        </div>


    </div>


<div id="modal_edit_register" style="display:none;" class="col-sm-12">
        <input type="hidden" id="id_factura_edit"/>
        <input type="hidden" id="id_concep_producto_edit">
        <h3>Editar Información</h3>
        <hr>
            <div v-for="cotiz in edit_cotizacion.cotizacion">
                <input type="hidden" v-model="cotiz.id_cliente" id="id_cliente_edit">
                <input type="hidden" v-model="cotiz.id_contacto" id="id_contacto_edit">
                <input type="hidden" v-model="cotiz.id_forma_pago" id="id_forma_pago_edit"> 
                <input type="hidden" v-model="cotiz.id_metodo_pago" id="id_metodo_pago_edit"> 
                <input type="hidden" v-model="cotiz.id_estatus" id="id_estatus_edit"> 
                <input type="hidden" v-model="cotiz.des_cot" id="des_cot_edit">
                <input type="hidden" v-model="cotiz.id_moneda" id="id_moneda_edit">
                <input type="hidden" v-model="cotiz.id_cotizacion" id="id_cotizacion_edit"> 
            </div>
             
        
        <div class="modal-body" style="overflow-y:scroll; height:500px;">
                        <form class="form-horizontal" >
                            <div class="form-group row">
                              <label for="nombre_cliente" class="col-md-2 control-label">Selecciona el cliente:</label>
                              <div class="col-md-3">
                                  <!-- <input type="text" class="form-control input-sm ui-autocomplete-input" id="nombre_cliente" placeholder="Ingresa el nombre del cliente" required="" autocomplete="off">
                                  <input id="id_cliente" type="hidden">  -->
                                 <!--  <select name="cliente" id="sys_idCliente" class="form-control input-sm" required="required"></select>
 -->                             
                                    {!! $clientes_edit !!}
                              </div>
                              
                              
                              <label for="contacto" class="col-md-1 control-label">Contacto:</label>
                                <div class="col-md-2">
                                    <div id="div_contacto_edit"></div>
                                    <!-- <select class="form-control input-sm" id="contacto" name="contacto">
                                        <option value="">Selecciona</option>
                                    </select> -->
                                </div>
                                
                              
                                <div class="col-md-2">
                                    <input type="text" class="form-control input-sm" id="tel1_edit" placeholder="" value="Teléfono" readonly="">
                                 </div>
                                 <div class="col-md-2">
                                    <input type="text" class="form-control input-sm" id="email_contact_edit" placeholder="" value="Correo electrónico" readonly="">
                                 </div>
                            
                            </div>

                            <div class="form-group row">
                                <label for="empresa" class="col-md-2 control-label">RFC empresa:</label>
                                <div class="col-md-3">
                                    <input type="text" class="form-control input-sm" id="rfc_empresa_edit" placeholder="" readonly="">
                                </div>
                                <label for="tel2" class="col-md-1 control-label">Nombre comercial:</label>
                                <div class="col-md-3">
                                    <input type="text" class="form-control input-sm" id="nombre_comercial_edit" placeholder="" readonly="">
                                </div>
                                <label for="email" class="col-md-1 control-label">Teléfono:</label>
                                <div class="col-md-2">
                                    <input type="email" class="form-control input-sm" id="tel2_edit" placeholder="" readonly="">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="condiciones" class="col-md-2 control-label">Forma de pago:</label>
                                <div class="col-md-3">

                                    {!! $formas_pagos_edit !!}
                                </div>
                                <label for="validez" class="col-md-1 control-label">Método de pago:</label>
                                <div class="col-md-2">

                                    {!! $metodos_pagos_edit !!}
                                </div>

                                <label for="validez" class="col-md-1 control-label">Estatus:</label>
                                <div class="col-md-3">

                                    {!! $estatus_edit !!}
                                </div>

                            </div>

                            <div class="form-group row">
                                <label for="condiciones" class="col-md-2 control-label">Descripción:</label>
                                <div class="col-md-6">
                                    <textarea class="form-control" id="observaciones_edit" name="observaciones" style="text-transform: uppercase;"></textarea>
                                </div>
                                
                                <label for="moneda" class="col-md-1 control-label">Moneda:</label>
                                <div class="col-md-3">
                                    {!! $monedas_edit !!}
                                </div>
                                
                            </div>
                            
                            <div class="form-group row">
                                <div class="pull-right col-sm-2">
                                    <!-- <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">
                                     <span class="glyphicon glyphicon-plus"></span> Agregar Conceptos
                                    </button> -->
                                    <button type="button" class="btn btn-info" title="Agregar Producto"  onclick="facyadd_pro_edit();" id="add_concepto_edit"><i class="fa fa-plus-circle"></i> Agregar conceptos</button>
                                    <!-- <button type="submit" class="btn btn-default">
                                      <span class="glyphicon glyphicon-print"></span> Imprimir
                                    </button> -->
                                </div>
                            </div>

                            
                            <hr>    

                            <div class="table-responsive">

                                <table class="table table-hover" id="table_concepts_edit">
                                    <thead><tr style="background-color: #337ab7; color: #ffffff;">
                                        <th class="text-center">CÓDIGO</th>
                                        <th class="text-center">CANTIDAD</th>
                                        <th>DESCRIPCIÓN</th>
                                        <th class="text-right">PRECIO UNITARIO.</th>
                                        <th class="text-right">PRECIO TOTAL</th>
                                        <th ></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="concep in datos">
                                        <td class="text-center">@{{ (concep.cod_productos)?concep.cod_productos:concep.cod_planes }}</td>
                                        <td class="text-center">@{{ concep.cantidad }}</td>
                                        <td>@{{ (concep.descripcion)?concep.descripcion:concep.prod_desc }}</td>
                                        <td class="text-right">@{{ concep.precio }}</td>
                                        <td class="text-right">@{{ concep.total }}</td>
                                        <td class="text-center ocultarr">
                                        <a href="#" v-on:click.prevent="destroy_register_edit(concep)" v-if="datos[0].id_estatus != 5"><i class="glyphicon glyphicon-trash"></i></a>
                                        </td>
                                    </tr>   
                                    </tbody>   
                                    <tfoot>       
                                    <tr>
                                        <td class="text-right" colspan="4" >SUBTOTAL </td>
                                        <td class="text-right" style="background-color:#eee">  @{{ edit.subtotal }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-right" colspan="4">IVA ({{$iva}})% </td>
                                        <td class="text-right" style="background-color:#eee"> @{{ edit.iva }} </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right" colspan="4">TOTAL </td>
                                        <td class="text-right" style="background-color:#eee"> @{{ edit.total }} </td>
                                    </tr>

                                </tfoot></table>

                            </div>
                              <!-- <div class="form-group">
                                <label class="control-label col-sm-2" for="">Posicion</label>
                                <div class="col-sm-2">
                                  <input type="text" class="form-control" placeholder="" v-model="datos.skill_orden">
                                </div>
                            </div> -->
                        </form>
        </div>

        <div class="modal-footer">
            <div class="btn-toolbar pull-right">
                <button type="button" class="btn btn-danger" data-fancybox-close v-on:click.prevent="cancel_cotizacion_edit()"> <i class="fa fa-times-circle"></i> Cancelar</button>
                <button type="button" class="btn btn-primary" v-on:click.prevent="insert_register_edit_update()" {{$insertar}} id="insertar_add_edit"><i class="fa fa-save"></i> Registrar </button> 
            </div>
        </div>

</div>

<div id="modal_send_email" style="display:none;">
        <h3><i class="glyphicon glyphicon-envelope"></i>  Enviar Cotización</h3>
            <hr>
        <div class="modal-body">

            <form class="form-horizontal" >

                <div class="form-group">
                    <label for="condiciones" class="col-sm-7 control-label"></label>
                    <div class="col-sm-7">
               
                       
                    </div>
                    <label for="validez" class="col-sm-7 control-label"></label>
                    <div class="col-sm-7">

                        
                    </div>

                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3" for="">Para: </label>
                    <div class="col-sm-9">
                        <input type="text" id="destinatario_pdf" disabled class="form-control" placeholder="">
                    </div>
                </div>


                <div class="form-group">
                    <label class="control-label col-sm-3" for="">Asunto: </label>
                    <div class="col-sm-9">
                        <input type="text" id="asunto_pdf" class="form-control" placeholder="Cotización" value="Cotización">
                    </div>

                     <label class="control-label col-sm-3" for=""> </label>
                    <div class="col-sm-9">
                        <input type="hidden" id="nomb_contacto" class="form-control" placeholder="">
                        <input type="hidden" id="id_cotzacion" class="form-control" placeholder="">
                    </div>
                    
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3" for="">Mensaje: </label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="mensaje_pdf" rows="5" >Hola, buen día. Adjunto cotización solicitada</textarea>
                    </div>
                </div>

                <div class="form-group">
				<label class="col-sm-2 control-label"></label>
				<div class="col-sm-10">
				  <span><i class="glyphicon glyphicon-paperclip"></i> Archivo adjunto</span>
				</div>
			  </div>
              <div v-if="loading == true">
          <img src="" alt="" style="position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url('https://cdn.dribbble.com/users/493409/screenshots/3070302/043_success-mail.gif') 50% 50% no-repeat rgb(249,249,249);
    opacity: .8;"> 
          Enviando.....
        </div>
        <!-- <p>https://www.dmdentalgroup.com/wp-content/uploads/2017/12/mail.gif</p> -->
         </form>


        </div>
        <div class="modal-footer">
            <div class="pull-right">
                <button type="button" class="btn btn-danger" data-fancybox-close id="mail_cancelar"> <i class="fa fa-times-circle"></i> Cancelar</button>
                        
                <button type="button" class="btn btn-success" v-on:click.prevent="send_pdf()" value="1" ><i class="glyphicon glyphicon-envelope"></i> Enviar</button>
            </div>
        </div>


    </div>
