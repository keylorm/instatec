myApp.controller('usuarioController', ['$scope', '$log', '$http', '$filter', '$window', function ($scope, $log, $http, $filter, $window) {
    $scope.usuario = '';
    $scope.nombre = '';
    $scope.apelllidos = '';
    $scope.correo_electronico = '';
    $scope.estado_id = 1;
    $scope.cantidad_mostrar = 20;
    $scope.total_rows = 0;
    $scope.pages = 1;
    $scope.q = '';

    $scope.currentPage = 0;



    $scope.filtrarUsuario = function () {
        $scope.consultarUsuarios();
    };

    $scope.consultarUsuarios = function () {
        $http({
            url: '../usuario/consultaUsuariosAjax/',
            method: "POST",
            data: {
                filtros: {
                    usuario: $scope.usuario,
                    nombre: $scope.nombre,
                    apellidos: $scope.apellidos, 
                    correo: $scope.correo_electronico,
                    estado_id: $scope.estado_id,
                    rol_id: $scope.rol_id
                },
                cantidad_mostrar: $scope.cantidad_mostrar,
            },
        })
            .then(function (result) {
                $scope.usuarios = result.data.datos;
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

    $scope.consultarUsuarios();

    $scope.borrarRow = function (row_id) {
        $http({
            url: '../usuario/eliminarUsuarioAjax/',
            method: "POST",
            data: { usuario_id: row_id },
        })
        .then(function (result) {
            if (result.data !== "false") {
                $window.location.href = '/controlcostos/usuarios';
                return true;

            } else {
                $window.location.href = '/controlcostos/usuarios';
                return false;
            }
        }, function (result) {
            $log.error(result);
        });
    }
}]);

myApp.controller('agregarUsuarioController', ['$scope', '$log', '$http', '$filter', function ($scope, $log, $http, $filter) {
    $scope.password = '';

}]);