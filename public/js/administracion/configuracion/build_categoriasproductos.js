var url_insert  = "categoriasproductos/register";
var url_update   = "categoriasproductos/update";
var url_edit     = "categoriasproductos/edit";
var url_destroy  = "categoriasproductos/destroy";
var url_all      = "categoriasproductos/all";
var redireccion  = "configuracion/categoriasproductos";

var app = angular.module("ng-categoriasproductos", ["ngRoute","localytics.directives","components"]);
app.config(function( $routeProvider, $locationProvider ) {
    $routeProvider
    .when("/ruta1", {
        template : "<h1></h1>",
    })
    .when("/ruta2", {
        template : "<h1></h1>",
    })
    .when("/ruta3", {
        templateUrl : "ruta3.html",
        controller : ""
    });
    $locationProvider.html5Mode(true);
});
app.controller("categoriasproductosController", function( $scope, $http, $location ) {
    
    $scope.constructor = function(){
        $scope.datos  = [];
        $scope.insert = {
          estatus : "1"
        };
        $scope.cmb_estatus = [{id:0 ,descripcion:"Baja"}, {id:1, descripcion:"Activo"}];
        $scope.update = {};
        $scope.edit   = {};
        $scope.fields = {};
        $scope.index();
    }
    $scope.index = function(){
        var url = domain( url_all );
        var fields = {};
        MasterController.request_http(url,fields,"get",$http, false )
        .then(function(response){
            $scope.datos = response.data.result;
            console.log($scope.datos);
        }).catch(function(error){
            if( isset(error.response) && error.response.status == 419 ){
                  toastr.error( session_expired ); 
                  redirect(domain("/"));
                  return;
              }
              console.error(error);
              toastr.error( error.result , expired );
        });
    }
    
    $scope.insert_register = function(){

        var url = domain( url_insert );
        var fields = $scope.insert;
        MasterController.request_http(url,fields,"post",$http, false )
        .then(function( response ){
            toastr.success( response.data.message , title );
            
            jQuery.fancybox.close({
                "type"      : "inline"
                ,"src"      : "#modal_add_register"
                ,"modal"    : true
                ,"width"    : 900
                ,"height"   : 400
                ,"autoSize" : false
            });
            $scope.constructor();
            // console.log($scope.index());return;
        }).catch(function( error ){
            if( isset(error.response) && error.response.status == 419 ){
                  toastr.error( session_expired ); 
                  redirect(domain("/"));
                  return;
              }
              console.error( error );
              toastr.error( error.result , expired );
        });

    }

    $scope.update_register = function(){
      
      $scope.update = $scope.edit;
      var url = domain( url_update );
      var fields = $scope.update;
      MasterController.request_http(url,fields,"put",$http, false )
      .then(function( response ){
          toastr.info( response.data.message , title );
          jQuery.fancybox.close({
                "type"      : "inline"
                ,"src"      : "#modal_edit_register"
                ,"modal"    : true
                ,"width"    : 900
                ,"height"   : 400
                ,"autoSize" : false
            });
          $scope.index();
          jQuery('#tr_'+$scope.update.id).effect("highlight",{},5000);
      }).catch(function( error ){
          if( isset(error.response) && error.response.status == 419 ){
                toastr.error( session_expired ); 
                redirect(domain("/"));
                return;
            }
            console.error( error );
            toastr.error( error.result , expired );
      });
    }

    $scope.edit_register = function( id ){

      var url = domain( url_edit );
      var fields = {id : id };
      MasterController.request_http(url,fields,"get",$http, false )
        .then(function( response ){
           $scope.edit = response.data.result;


          jQuery.fancybox.open({
                "type"      : "inline"
                ,"src"      : "#modal_edit_register"
                ,"modal"    : true
                ,"width"    : 900
                ,"height"   : 400
                ,"autoSize" : false
            });          
        }).catch(function( error ){
            if( isset(error.response) && error.response.status == 419 ){
                  toastr.error( session_expired ); 
                  redirect(domain("/"));
                  return;
              }
              console.error( error );
              toastr.error( error.result , expired );
        });
    }

    $scope.destroy_register = function( id ){

      var url = domain( url_destroy );
      var fields = {id : id };
      buildSweetAlertOptions("¿Borrar Registro?","¿Realmente desea eliminar el registro?",function(){
        MasterController.request_http(url,fields,"delete",$http, false )
        .then(function( response ){
            toastr.success( response.data.message , title );
            $scope.index();
        }).catch(function( error ){
            if( isset(error.response) && error.response.status == 419 ){
                  toastr.error( session_expired ); 
                  redirect(domain("/"));
                  return;
              }
              console.error( error );
              toastr.error( error.result , expired );
        });
          
      },"warning",true,["SI","NO"]);  
    }

});
