myApp.controller('colaboradorController', ['$scope', '$log', '$http', '$filter', '$window', function ($scope, $log, $http, $filter, $window) {
    $scope.cedula = '';
    $scope.nombre = '';
    $scope.apelllidos = '';
    $scope.correo_electronico = '';
    $scope.identificador_interno = '';
    $scope.seguro_social = '';
    $scope.estado = 1;
    $scope.cantidad_mostrar = 20;
    $scope.total_rows = 0;
    $scope.pages = 1;
    $scope.q = '';

    $scope.currentPage = 0;



    $scope.filtrarColaborador = function () {
        $scope.consultarColaboradores();
    };

    $scope.consultarColaboradores = function () {
        $http({
            url: '../colaborador/consultaColaboradoresAjax/',
            method: "POST",
            data: {
                filtros: {
                    cedula: $scope.cedula,
                    nombre: $scope.nombre,
                    apellidos: $scope.apellidos,
                    identificador_interno: $scope.identificador_interno,
                    seguro_social: $scope.seguro_social,
                    estado: $scope.estado,
                    correo_electronico: $scope.correo_electronico,
                    colaborador_puesto_id: $scope.colaborador_puesto_id
                },
                cantidad_mostrar: $scope.cantidad_mostrar,
            },
        })
            .then(function (result) {
                $log.log(result);
                $scope.colaboradores = result.data.datos;
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

    $scope.consultarColaboradores();

    $scope.borrarRow = function (row_id) {
        $http({
            url: '../colaborador/eliminarColaboradorAjax/',
            method: "POST",
            data: { colaborador_id: row_id },
        })
            .then(function (result) {
                if (result.data !== "false") {
                    $window.location.href = '/controlcostos/colaboradores';
                    return true;

                } else {
                    $window.location.href = '/controlcostos/colaboradores';
                    return false;
                }
            }, function (result) {
                $log.error(result);
            });
    }

   
}]);

myApp.controller('agregarColaboradorController', ['$scope', '$log', '$http', '$filter', '$timeout', function ($scope, $log, $http, $filter, $timeout) {
    $scope.password = '';
     

    

}]);

myApp.controller('editarColaboradorController', ['$scope', '$log', '$http', '$filter', '$timeout', function ($scope, $log, $http, $filter, $timeout) {
    $scope.password = '';
    $timeout(function(){
        $log.log($scope.colaborador_puesto_id);

    },122);
  

}]);