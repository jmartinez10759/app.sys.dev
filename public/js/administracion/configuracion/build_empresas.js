var url_insert  = "empresas/register";
var url_update  = 'empresas/update';
var url_edit    = 'empresas/edit';
var url_destroy = "empresas/destroy/";
var redireccion = "configuracion/empresas";
var url_relacion  = "empresas/insert_relacion";
var url_edit_pais = 'pais/edit';
var url_edit_codigos = 'codigopostal/show';

new Vue ({
  el: "#vue_empresas",
  created: function () {
    this.consulta_general();
  },
  data: {
    datos: [],
    newKeep: {'estatus' : 1 },
    fillKeep: { 'estatus' : 1 },
    fields: {}
  },
  mixins : [mixins],
  methods:{
    consulta_general(){}
    ,insert(){ 
        var validacion = ['correo','razon_social','rfc_receptor','cmb_estados'];
        if(validacion_fields(validacion) == "error"){return;}
        if( !emailValidate(jQuery('#correo').val()) ){
            jQuery('#correo').parent().parent().addClass('has-error');
            toastr.error("Correo Incorrecto","Ocurrio un error, favior de verificar");
        }
        if( !valida_rfc(jQuery('#rfc_receptor').val()) ){
            jQuery('#rfc_receptor').parent().parent().addClass('has-error');
            toastr.error("RFC Incorrecto","Ocurrio un error, favior de verificar");
        }
        var url = domain( url_insert );
        this.newKeep.id_estado = jQuery('#cmb_estados').val();
        var fields = this.newKeep;
        var promise = MasterController.method_master(url,fields,"post");
          promise.then( response => {
              toastr.success( response.data.message , title );
              redirect(domain(redireccion));
          }).catch( error => {
              if( error.response.status == 419 ){
                    toastr.error( session_expired ); 
                    redirect(domain("/"));
                    return;
                }
              toastr.error( error.response.data.message , expired );
              redirect();
          });
        
        
        
    }
    ,destroy( id ){
        var url = domain( url_destroy );
        var fields = {id : id };
         buildSweetAlertOptions("¿Borrar Registro?","¿Realmente desea eliminar el registro?",function(){
          var promise = MasterController.method_master(url,fields,"delete");
          promise.then( response => {
              toastr.success( response.data.message , title );
              redirect( domain(redireccion) );
          }).catch( error => {
              if( error.response.status == 419 ){
                    toastr.error( session_expired ); 
                    redirect(domain("/"));
                    return;
                }
              toastr.error( error.response.data.message , expired );
              //redirect();
          });
      },"warning",true,["SI","NO"]);   
        
    }
    ,update(){
        var url = domain( url_update );
        this.fillKeep.id_estado = jQuery('#cmb_estados_edit').val();
        var fields = this.fillKeep;
        var promise = MasterController.method_master(url,fields,"put");
          promise.then( response => {
              toastr.success( response.data.message , title );
              redirect(domain(redireccion));       
          }).catch( error => {
              if( error.response.status == 419 ){
                    toastr.error( session_expired ); 
                    redirect(domain("/"));
                    return;
                }
              toastr.error( error.response.data.message , expired );
              //redirect();
          });
          
    }
    ,editar( id ){
        var url = domain( url_edit );
        var fields = {id : id };
        var promise = MasterController.method_master(url,fields,"get");
          promise.then( response => {
               this.fillKeep = response.data.result;
               this.fillKeep.id = response.data.result.id;
               if( response.data.result.contactos.length > 0 ){
                   this.fillKeep.contacto = response.data.result.contactos[0].nombre_completo;
                   this.fillKeep.departamento = response.data.result.contactos[0].departamento;
                   this.fillKeep.telefono = response.data.result.contactos[0].telefono;
                   this.fillKeep.correo = response.data.result.contactos[0].correo;
               }
               jQuery('#cmb_estados_edit').val(response.data.result.id_estado);
               jQuery('#modal_edit_register').modal('show');
          }).catch( error => {
              if( error.response.status == 419 ){
                    toastr.error( session_expired ); 
                    redirect(domain("/"));
                    return;
                }
              toastr.error( error.response.data.message , expired );
              //redirect();
          });
    }
    ,sucursales( id_empresa ){
      var url = domain( url_edit );
      var fields = {'id' : id_empresa};
      axios.get( url, { params: fields }, csrf_token ).then(response => {
          if( response.data.success == true ){
              this.fields.id_empresa = id_empresa;
              if( response.data.result.sucursales.length > 0 ){

                    jQuery('input[type="checkbox"]').each(function(){
                      var id_sucursal = jQuery(this).attr('id_sucursal');
                      jQuery('#'+id_sucursal).prop('checked',false);
                    });
                    for (var i in response.data.result.sucursales ) {
                        jQuery('input[type="checkbox"]').each(function(){
                            jQuery('#'+response.data.result.sucursales[i].id).prop('checked',response.data.result.sucursales[i].estatus);
                        });
                    }
              }else{
                jQuery('input[type="checkbox"]').each(function(){
                    var id_sucursal = jQuery(this).attr('id_sucursal');
                    jQuery('#'+id_sucursal).prop('checked',false);
                });

              }

            jQuery('#modal_sucusales_register').modal('show');
          }else{
              toastr.error( response.data.message, "¡Ningun Registro Encontrado!" );
          }
      }).catch(error => {
          toastr.error( error, expired );
      });
    }
    ,insert_sucursales(){
        var id_empresa = this.fields.id_empresa;
        var matrix = [];
        var i = 0;
        jQuery('input[type="checkbox"]').each(function(){
            var id_sucursal = jQuery(this).attr('id_sucursal');
            if( isset(id_sucursal) === true){
              matrix[i] = id_sucursal+'|'+jQuery('#'+id_sucursal).is(':checked');
              i++;
            }

        });
        console.log(matrix);
        var fields = {
          'id_empresa' : id_empresa
          ,'matrix' : matrix
        }
        var url = domain( url_relacion );
        axios.post( url, fields , csrf_token ).then(response => {
            if( response.data.success == true ){
              toastr.info( response.data.message ,"¡Registros Correctos!");
              jQuery('#modal_sucusales_register').modal('hide');
            }else{
                toastr.error( response.data.message, "¡Ningun Registro Encontrado!" );
            }
        }).catch(error => {
            toastr.error( error, expired );
        });


    }
    ,select_estado(){
      var url = domain( url_edit_pais );
      var fields = {id: jQuery('#cmb_pais').val()}
      MasterController.method_master(url,fields,"get")
      .then( response => {
          var estados = {
              'data'    : response.data.result.estados
              ,'text'   : "nombre"
              ,'value'  : "clave"
              ,'name'   : "cmb_estados"
              ,'class'  : 'form-control'
              ,'leyenda': 'Seleccione Opción'
              ,'attr'   : 'data-live-search="true" '
              ,'event'  : "select_codigos()"
          };
          jQuery('#div_cmb_estados').html('');
          jQuery('#div_cmb_estados').html( select_general( estados ) );
      }).catch( error => {
          if( isset(error.response) && error.response.status == 419 ){
            toastr.error( session_expired ); 
            redirect(domain("/"));
            return;
          }
            toastr.error( error.result , expired );  
      });    

    }    

  }


});
function select_codigos(){
      var url = domain( url_edit_codigos );
      var fields = {clave: jQuery('#cmb_estados').val()}
      MasterController.method_master(url,fields,"get")
      .then( response => {
          var codigos = {
              'data'    : response.data.result
              ,'text'   : "codigo_postal"
              ,'value'  : "id"
              ,'name'   : "cmb_codigo_postal"
              ,'class'  : 'form-control'
              ,'attr'   : 'data-live-search="true" '
              ,'leyenda': 'Seleccione Opción'
          };
          jQuery('#div_cmb_codigos').html('');
          jQuery('#div_cmb_codigos').html( select_general( codigos ) );
      }).catch( error => {
          if( isset(error.response) && error.response.status == 419 ){
            toastr.error( session_expired ); 
            redirect(domain("/"));
            return;
          }
            toastr.error( error.result , expired );  
      }); 

    }




jQuery('#cmb_servicio').selectpicker({width:'100%', size: 5});
jQuery('#cmb_servicio_edit').selectpicker({width:'100%', size: 5});
jQuery('#cmb_estados').selectpicker({width:'100%', size: 5});
jQuery('#cmb_estados_edit').selectpicker({width:'100%', size: 5});
jQuery('#cmb_regimen_fiscal').selectpicker({width:'100%',size: 5});
jQuery('#cmb_regimen_fiscal_edit').selectpicker({width:'100%', size: 5});

jQuery('#cmb_pais').selectpicker({width:'100%', size: 5});
jQuery('#cmb_pais_edit').selectpicker({width:'100%', size: 5});
jQuery('#cmb_codigo_postal_edit').selectpicker({width:'100%', size: 5});
jQuery('#cmb_codigo_postal').selectpicker({width:'100%', size: 5});



var upload_url = domain('empresas/upload');
var ids = {
  div_content  : 'div_dropzone_file_empresa'
  ,div_dropzone : 'dropzone_xlsx_file_empresa'
  ,file_name    : 'file'
};
var message = "Dar Clic aquí o arrastrar archivo";
upload_file('',upload_url,message,1,ids,'.jpg,.png,.jpeg',function( request ){
    console.log(request);
});