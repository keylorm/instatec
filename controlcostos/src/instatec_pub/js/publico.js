var myApp = angular.module('myApp', []);
myApp.controller('comprobacionOrdenCambioCliente', ['$scope', '$log', '$http', '$filter', '$window', function ($scope, $log, $http, $filter, $window) {
    $scope.total_rows = 0;
    $scope.show_comentarios = false;
    $scope.error_formulario = false;
    $scope.bloqueo_button_aprobar = false;
    $scope.bloqueo_button_cancelar = false;
    $scope.q = '';

    $scope.consultarExtensionCambiosProyecto = function () {
        $http({
            url: BASE_URL + 'publico/consultaExtensionCambiosAjax/',
            method: "POST",
            data: {
                filtros: {
                    proyecto_valor_oferta_id: $scope.proyecto_valor_oferta_id,
                },
                cantidad_mostrar: $scope.cantidad_mostrar,
            },
        })
        .then(function (result) {
            if (result.data !== "false") {
                if (result.data.cambios !== false) {
                    $scope.cambios = result.data.cambios.datos;
                    $scope.total_rows = result.data.cambios.total_rows;
                } else {
                    $scope.cambios = false;
                }

                if (result.data.cambios_totales !== false) {
                    $scope.cambios_totales = result.data.cambios_totales;
                } else {
                    $scope.cambios_totales = false;
                }


            } else {
                $scope.cambios = false;
                $scope.cambios_totales = false;
            }
        }, function (result) {
            $log.error(result);
        });
    }

    $scope.habilitarTextboxCancelar = function () {
        $scope.show_comentarios = true;
    }

    $scope.enviarCancelacion = function () {
        $scope.bloqueo_button_cancelar = true;
        if ($scope.comentarios == '' || $scope.comentarios == undefined) {
            $scope.error_formulario = true;
        } else {
            $scope.error_formulario = false;
            $http({
                url: BASE_URL + 'publico/rechazarOrdenCambio/',
                method: "POST",
                data: {
                    proyecto_valor_oferta_id: $scope.proyecto_valor_oferta_id,
                    proyecto_id: $scope.proyecto_id,
                    comentarios: $scope.comentarios,
                },
            })
                .then(function (result) {
                    if (result.data !== "false") {
                        $window.location.reload();
                        return true;


                    } else {
                        $window.location.reload();
                        return false;
                    }
                }, function (result) {
                    $log.error(result);
                });
        }
    }

    $scope.aprobarOrden = function () {
        $scope.bloqueo_button_aprobar = true;
        $http({
            url: BASE_URL + 'publico/aprobarOrdenCambio/',
            method: "POST",
            data: {
                proyecto_valor_oferta_id: $scope.proyecto_valor_oferta_id,
                proyecto_id: $scope.proyecto_id,
            },
        })
            .then(function (result) {
                if (result.data !== "false") {
                    $window.location.reload();
                    return true;


                } else {
                    $window.location.reload();
                    return false;
                }
            }, function (result) {
                $log.error(result);
            });
    }
 
 


}]);