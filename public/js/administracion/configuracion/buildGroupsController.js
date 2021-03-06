const URL = {
  url_insert            : "groups/register"
  ,url_update           : 'groups/update'
  ,url_edit             : 'groups/{id}/edit'
  ,url_all              : 'groups/all'
  ,url_destroy          : "groups/destroy/{id}/companies"
};
app.controller('GroupsController', ['ServiceController','FactoryController','NotificationsFactory','$scope', function( sc,fc,nf,$scope ) {

    $scope.constructor = function(){
        $scope.datos  = [];
        $scope.insert = { estatus: 1 };
        $scope.update = {};
        $scope.fields = {};
        $scope.index();
        $scope.register = [];
        $scope.titles   = [
            "Código",
            "Sucursal",
            "Direccion",
            "Telefono",
            "Estatus",
            ""
        ];
    };

    $scope.index = function(){
        var url = fc.domain( URL.url_all );
        sc.requestHttp(url,null,"GET",false).then(function (response) {
            if (sc.validateSessionStatus(response)){
                console.log(response);
                $scope.register = [];
                angular.forEach(response.data.data.groups,function (value,key) {
                    $scope.register[key] = {
                        'id'          : value.id ,
                        'codigo'      : value.codigo ,
                        'sucursal'    : value.sucursal ,
                        'direccion'   : value.direccion ,
                        'telefono'    : value.telefono ,
                        'estatus'     : value.estatus ,
                        'btnDelete'   : ""
                    };
                });
                $scope.datos = {"titles" : $scope.titles, "register" : $scope.register};
                $scope.configPagePagination($scope.register);
            }
        });
    };

    $scope.insertRegister = function(){
        var url     = fc.domain(  URL.url_insert );
        var fields  = $scope.insert;
        $scope.spinning = true;
        sc.requestHttp(url, fields, 'POST', false).then(function (response) {
            if (sc.validateSessionStatus(response)) {
                nf.toastSuccess(response.data.message, nf.titleRegisterSuccess);
                nf.modal("#modal_add_register",true);
                $scope.index();
            }
            $scope.spinning = false;
        });

    };

    $scope.updateRegister = function(){
        let url = fc.domain(URL.url_update);
        var fields = sc.mapObject($scope.update, ['companies_groups'], false);
        $scope.spinning = true;
        sc.requestHttp(url, fields, 'PUT', false).then(function (response) {
            if (sc.validateSessionStatus(response)) {
                nf.toastInfo(response.data.message, nf.titleMgsSuccess);
                nf.modal("#modal_edit_register",true);
                nf.trEffect($scope.update.id);
                $scope.index();
            }
            $scope.spinning = false;
        });
    };

    $scope.editRegister = function(id){
        var url = fc.domain(URL.url_edit,id);
        sc.requestHttp(url,null,"GET",false).then(function (response) {
            var datos = ['created_at',"updated_at","roles_groups"];
            $scope.update = sc.mapObject(response.data.data, datos, false);
            $scope.update.companyId = "";
            angular.forEach($scope.update.companies_groups,function (value, key) {
                $scope.update.companyId = value.id;
            });
            console.log($scope.update);
            nf.modal("#modal_edit_register");
        });
    };

    $scope.destroyRegister = function( id ){
        var url = fc.domain( URL.url_destroy,id);
        nf.buildSweetAlertOptions("¿Borrar Registro?", "¿Realmente desea eliminar el registro?", "warning", function () {
            sc.requestHttp(url, null, "DELETE", false).then(function (response) {
                if (sc.validateSessionStatus(response)) {
                    nf.toastSuccess(response.data.message, nf.titleMgsSuccess);
                    $scope.constructor();
                }
            });
        }, null, "SI", "NO");

    };

}]);