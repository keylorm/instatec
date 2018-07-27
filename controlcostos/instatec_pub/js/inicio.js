myApp.controller('inicioController', ['$scope','$log','$http', '$filter', '$window', function($scope, $log, $http, $filter, $window){
	$scope.cantidad_mostrar = 10;
	$scope.total_rows = 0;


	$scope.consultarProyecto = function(){
		$http({
	        url: 'proyecto/consultaProyectosActivosAjax/',
	        method: "POST",
	        data: {},
	    })
		.then(function(result){
			if (result.data !== "false") {
				$scope.proyectos = result.data.datos;
				$scope.total_rows = result.data.total_rows;	
			}else{
				$scope.proyectos = false;
			}		
		},function(result){
			$log.error(result);
		});
	}


	$scope.consultarProyecto();
}]);