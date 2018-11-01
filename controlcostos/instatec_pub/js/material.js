myApp.controller('materialController', ['$scope', '$log', '$http', '$filter', '$window', function ($scope, $log, $http, $filter, $window) {
    $scope.material = '';
    $scope.material_codigo = '';
    $scope.estado = 1;
    $scope.cantidad_mostrar = 20;
    $scope.total_rows = 0;
    $scope.pages = 1;
    $scope.q = '';

    $scope.currentPage = 0;



    $scope.filtrar = function () {
        $scope.consultarMateriales();
    };

    $scope.consultarMateriales = function () {
        $http({
            url: '../material/consultaMaterialesAjax/',
            method: "POST",
            data: {
                filtros: {
                    material: $scope.material,
                    material_codigo: $scope.material_codigo,
                },
                cantidad_mostrar: $scope.cantidad_mostrar,
            },
        })
            .then(function (result) {
                //$log.log(result);
                $scope.materiales = result.data.datos;
                $scope.total_rows = result.data.total_rows;
                $scope.calcularPaginas();
            }, function (result) {
                $log.error(result);
            });
    }

    $scope.validarPrev = function () {
        if ($scope.currentPage > 0) {
            return false;
        } else {
            return true;
        }
    }

    $scope.validarNext = function () {
        if ($scope.currentPage >= ($scope.pages - 1)) {
            return true;
        } else {
            return false;
        }
    }

    $scope.pagePrev = function () {
        $scope.currentPage = $scope.currentPage - 1;
    }

    $scope.pageNext = function () {
        $scope.currentPage = $scope.currentPage + 1;
    }

    $scope.calcularPaginas = function () {
        if ($scope.total_rows > $scope.cantidad_mostrar) {
            $scope.pages = Math.ceil($scope.total_rows / $scope.cantidad_mostrar);
        }
    }

    $scope.consultarMateriales();

    $scope.borrarRow = function (row_id) {
        $http({
            url: '../material/eliminarMaterialAjax/',
            method: "POST",
            data: { material_id: row_id },
        })
            .then(function (result) {
                if (result.data !== "false") {
                    $window.location.href = '/controlcostos/materiales';
                    return true;

                } else {
                    $window.location.href = '/controlcostos/materiales';
                    return false;
                }
            }, function (result) {
                $log.error(result);
            });
    }

   
}]);


myApp.controller('agregarMaterialController', ['$scope', '$log', '$http', '$filter', '$timeout', function ($scope, $log, $http, $filter, $timeout) {

}]);

myApp.controller('editarMaterialController', ['$scope', '$log', '$http', '$filter', '$timeout', function ($scope, $log, $http, $filter, $timeout) {

}]);



/* Para agregar mantenimiento de Tipos de orden de cambio */
myApp.controller('materialUnidadController', ['$scope', '$log', '$http', '$filter', '$window', function ($scope, $log, $http, $filter, $window) {
    $scope.material_unidad = '';
    $scope.cantidad_mostrar = 20;
    $scope.total_rows = 0;
    $scope.pages = 1;
    $scope.q = '';

    $scope.currentPage = 0;



    $scope.filtrar = function () {
        $scope.consultarMaterial();
    };

    $scope.consultarMaterial = function () {
        $http({
            url: '../../material/consultaUnidadAjax/',
            method: "POST",
            data: {
                filtros: {
                    material_unidad: $scope.material_unidad,
                },
                cantidad_mostrar: $scope.cantidad_mostrar,
            },
        })
            .then(function (result) {
                //$log.log(result);
                $scope.material_unidades = result.data.datos;
                $scope.total_rows = result.data.total_rows;
                $scope.calcularPaginas();
            }, function (result) {
                $log.error(result);
            });
    }

    $scope.validarPrev = function () {
        if ($scope.currentPage > 0) {
            return false;
        } else {
            return true;
        }
    }

    $scope.validarNext = function () {
        if ($scope.currentPage >= ($scope.pages - 1)) {
            return true;
        } else {
            return false;
        }
    }

    $scope.pagePrev = function () {
        $scope.currentPage = $scope.currentPage - 1;
    }

    $scope.pageNext = function () {
        $scope.currentPage = $scope.currentPage + 1;
    }

    $scope.calcularPaginas = function () {
        if ($scope.total_rows > $scope.cantidad_mostrar) {
            $scope.pages = Math.ceil($scope.total_rows / $scope.cantidad_mostrar);
        }
    }

    $scope.consultarMaterial();

    $scope.borrarRow = function (row_id) {
        $scope.error = false;
        $scope.error_message ='';
        $http({
            url: '../../material/eliminarUnidadAjax/',
            method: "POST",
            data: { material_unidad_id: row_id },
        })
            .then(function (result) {
                if (result.data !== "false") {
                    $window.location.href = '/controlcostos/materiales/unidades';
                   return true;

                } else {
                    $scope.error = true;
                    $scope.error_message = 'No se puede eliminar la unidad';
                    return false;
                }
            }, function (result) {
                $log.error(result);
            });
    }

   
}]);


myApp.controller('agregarUnidadController', ['$scope', '$log', '$http', '$filter', '$timeout', function ($scope, $log, $http, $filter, $timeout) {

}]);

myApp.controller('editarUnidadController', ['$scope', '$log', '$http', '$filter', '$timeout', function ($scope, $log, $http, $filter, $timeout) {

}]);