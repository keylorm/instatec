myApp.controller('reporteProyectosGeneralController', ['$scope', '$log', '$http', '$filter', '$window', function ($scope, $log, $http, $filter, $window) {
	$scope.cantidad_mostrar = 20;
	$scope.total_rows = 0;
	$scope.pages = 1;
	$scope.q = '';
	$scope.loader = false;

	$scope.currentPage = 0;


	//Variables de filtrado
	$scope.nombre_proyecto_filtrado = '';
	$scope.numero_contrato_filtrado = '';
	$scope.orden_compra_filtrado = '';
	$scope.cliente_id_filtrado = 'all';
	$scope.proyecto_estado_id_filtrado = 'all';
	$scope.provincia_id_filtrado = 'all';
	$scope.canton_id_filtrado = 'all';
	$scope.distrito_id_filtrado = 'all';
	$scope.fecha_registro_from_filtrado = '';
	$scope.fecha_registro_to_filtrado = '';
	$scope.fecha_firma_contrato_from_filtrado = '';
	$scope.fecha_firma_contrato_to_filtrado = '';
	$scope.fecha_inicio_from_filtrado = '';
	$scope.fecha_inicio_to_filtrado = '';
	$scope.fecha_entrega_estimada_from_filtrado = '';
	$scope.fecha_entrega_estimada_to_filtrado = '';



	$scope.filtrarProyecto = function () {
		$scope.consultarProyecto();
	};

	$scope.limpiarFiltro = function () {
		$scope.nombre_proyecto = '';
		$scope.proyecto_estado_id = 'all';
		$scope.cliente_id = 'all';
		$scope.numero_contrato = '';
		$scope.orden_compra = '';
		$scope.provincia_id = 'all';
		$scope.canton_id = 'all';
		$scope.distrito_id = 'all';
		$scope.fecha_registro_from = '';
		$scope.fecha_registro_to = '';
		$scope.fecha_firma_contrato_from = '';
		$scope.fecha_firma_contrato_to = '';
		$scope.fecha_inicio_from = '';
		$scope.fecha_inicio_to = '';
		$scope.fecha_entrega_estimada_from = '';
		$scope.fecha_entrega_estimada_to = '';

		$scope.nombre_proyecto_filtrado = '';
		$scope.numero_contrato_filtrado = '';
		$scope.orden_compra_filtrado = '';
		$scope.cliente_id_filtrado = 'all';
		$scope.proyecto_estado_id_filtrado = 'all';
		$scope.provincia_id_filtrado = 'all';
		$scope.canton_id_filtrado = 'all';
		$scope.distrito_id_filtrado = 'all';
		$scope.fecha_registro_from_filtrado = '';
		$scope.fecha_registro_to_filtrado = '';
		$scope.fecha_firma_contrato_from_filtrado = '';
		$scope.fecha_firma_contrato_to_filtrado = '';
		$scope.fecha_inicio_from_filtrado = '';
		$scope.fecha_inicio_to_filtrado = '';
		$scope.fecha_entrega_estimada_from_filtrado = '';
		$scope.fecha_entrega_estimada_to_filtrado = '';


		$scope.consultarProyecto();
	}

	$scope.consultarProyecto = function () {
		$scope.loader = true;
		$http({
			url: BASE_URL + 'reporte/reporteProyectosGeneralAjax/',
			method: "POST",
			data: {
				filtros: {
					nombre_proyecto: $scope.nombre_proyecto,
					proyecto_estado_id: $scope.proyecto_estado_id,
					cliente_id: $scope.cliente_id,
					numero_contrato: $scope.numero_contrato,
					orden_compra: $scope.orden_compra,
					provincia_id: $scope.provincia_id,
					canton_id: $scope.canton_id,
					distrito_id: $scope.distrito_id,
					fecha_registro: {
						from: $scope.fecha_registro_from,
						to: $scope.fecha_registro_to,
					},
					fecha_firma_contrato: {
						from: $scope.fecha_firma_contrato_from,
						to: $scope.fecha_firma_contrato_to,
					},
					fecha_inicio: {
						from: $scope.fecha_inicio_from,
						to: $scope.fecha_inicio_to,
					},
					fecha_entrega_estimada: {
						from: $scope.fecha_entrega_estimada_from,
						to: $scope.fecha_entrega_estimada_to,
					},
				},
				cantidad_mostrar: $scope.cantidad_mostrar,
			},
		})
		.then(function (result) {
			$scope.proyectos = result.data.datos;
			$scope.total_rows = result.data.total_rows;
			$scope.calcularPaginas();
			$scope.loader = false;
		}, function (result) {
			$log.error(result);
			$scope.loader = false;
		});

		$scope.nombre_proyecto_filtrado = $scope.nombre_proyecto;
		$scope.numero_contrato_filtrado = $scope.numero_contrato;
		$scope.orden_compra_filtrado = $scope.orden_compra;
		$scope.cliente_id_filtrado = $scope.cliente_id;
		$scope.proyecto_estado_id_filtrado = $scope.proyecto_estado_id;
		$scope.provincia_id_filtrado = $scope.provincia_id;
		$scope.canton_id_filtrado = $scope.canton_id;
		$scope.distrito_id_filtrado = $scope.distrito_id;
		$scope.fecha_registro_from_filtrado = $scope.fecha_registro_from;
		$scope.fecha_registro_to_filtrado = $scope.fecha_registro_to;
		$scope.fecha_firma_contrato_from_filtrado = $scope.fecha_firma_contrato_from;
		$scope.fecha_firma_contrato_to_filtrado = $scope.fecha_firma_contrato_to;
		$scope.fecha_inicio_from_filtrado = $scope.fecha_inicio_from;
		$scope.fecha_inicio_to_filtrado = $scope.fecha_inicio_to;
		$scope.fecha_entrega_estimada_from_filtrado = $scope.fecha_entrega_estimada_from;
		$scope.fecha_entrega_estimada_to_filtrado = $scope.fecha_entrega_estimada_to;
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

	$scope.consultarProyecto();



	$scope.getCantones = function () {
		$scope.canton_id = 'all';
		$scope.distrito_id = 'all';
		$scope.consultarCantones();
	}

	$scope.getDistritos = function () {
		$scope.distrito_id = 'all';
		$scope.consultarDistritos();
	}

	$scope.consultarCantones = function () {
		if ($scope.provincia_id != 'none') {
			$http({
				url: BASE_URL + 'proyecto/consultaCantonesAjax/',
				method: "POST",
				data: { provincia_id: $scope.provincia_id },
			})
				.then(function (result) {
					$scope.cantones = result.data.datos;
				}, function (result) {
					$scope.cantones = '';
					$log.error(result);
				});

		} else {
			$scope.cantones = '';
		}
	}


	$scope.consultarDistritos = function () {
		if ($scope.canton_id != 'none') {
			$http({
				url: BASE_URL + 'proyecto/consultaDistritosAjax/',
				method: "POST",
				data: { canton_id: $scope.canton_id },
			})
				.then(function (result) {
					$scope.distritos = result.data.datos;
				}, function (result) {
					$scope.distritos = '';
					$log.error(result);
				});
		} else {
			$scope.distritos = '';
		}
	}


}]);

myApp.controller('reporteProyectoEspecificoController', ['$scope','$log','$http', '$filter', '$window', function($scope, $log, $http, $filter, $window){
	$scope.cantidad_mostrar = 20;
	$scope.total_rows = 0;
	$scope.pages = 1;
	$scope.q = '';

    $scope.currentPage = 0;	



	$scope.filtrarProyecto = function(){
		$scope.consultarProyecto();
	};

	$scope.limpiarFiltro = function(){
		$scope.nombre_proyecto = '';
		$scope.proyecto_estado_id = 'all';
		$scope.cliente_id = 'all';
		$scope.numero_contrato = '';
		$scope.orden_compra = '';
		$scope.provincia_id = 'all';
		$scope.canton_id = 'all';
		$scope.distrito_id = 'all';		
		$scope.fecha_registro_from = '';
		$scope.fecha_registro_to = '';		
		$scope.fecha_firma_contrato_from = '';
		$scope.fecha_firma_contrato_to = '';		
		$scope.fecha_inicio_from = '';
		$scope.fecha_inicio_to = '';	
		$scope.fecha_entrega_estimada_from = '';
		$scope.fecha_entrega_estimada_to = '';
		$scope.consultarProyecto();	
	}

	$scope.consultarProyecto = function(){
		$http({
			url: BASE_URL + 'proyecto/consultaProyectosAjax/',
	        method: "POST",
	        data: {  filtros: { 
									nombre_proyecto: $scope.nombre_proyecto, 
									proyecto_estado_id: $scope.proyecto_estado_id, 
									cliente_id: $scope.cliente_id,
									numero_contrato: $scope.numero_contrato,
									orden_compra: $scope.orden_compra,
									provincia_id: $scope.provincia_id,
									canton_id: $scope.canton_id,
									distrito_id: $scope.distrito_id,
									fecha_registro: {
										from: $scope.fecha_registro_from,
										to: $scope.fecha_registro_to,
									},
									fecha_firma_contrato: {
										from: $scope.fecha_firma_contrato_from,
										to: $scope.fecha_firma_contrato_to,
									},
									fecha_inicio: {
										from: $scope.fecha_inicio_from,
										to: $scope.fecha_inicio_to,
									},
									fecha_entrega_estimada: {
										from: $scope.fecha_entrega_estimada_from,
										to: $scope.fecha_entrega_estimada_to,
									},
								},
								cantidad_mostrar: $scope.cantidad_mostrar,
	    			},
	    })
		.then(function(result){
			$scope.proyectos = result.data.datos;
			$scope.total_rows = result.data.total_rows;
			$scope.calcularPaginas();
		},function(result){
			$log.error(result);
		});
	}

	$scope.validarPrev = function(){
		if($scope.currentPage > 0){
			return false;
		}else{
			return	true;
		}
	}

	$scope.validarNext = function(){
		if($scope.currentPage >= ($scope.pages-1)){
			return true;
		}else{
			return	false;
		}
	}

	$scope.pagePrev = function(){
		$scope.currentPage = $scope.currentPage-1;
	}

	$scope.pageNext = function(){
		$scope.currentPage = $scope.currentPage+1;
	}

	$scope.calcularPaginas =  function(){
		if($scope.total_rows > $scope.cantidad_mostrar){
			$scope.pages = Math.ceil($scope.total_rows / $scope.cantidad_mostrar);
		}
	}

	$scope.consultarProyecto();



	$scope.getCantones = function(){
		$scope.canton_id = 'all';
		$scope.distrito_id = 'all';
		$scope.consultarCantones();
	}

	$scope.getDistritos = function(){
		$scope.distrito_id = 'all';
		$scope.consultarDistritos();
	}

	$scope.consultarCantones = function(){
		if($scope.provincia_id!='none'){
			$http({
				url: BASE_URL + 'proyecto/consultaCantonesAjax/',
		        method: "POST",
		        data: {  provincia_id: $scope.provincia_id },
		    })
			.then(function(result){
				$scope.cantones = result.data.datos;
			},function(result){
				$scope.cantones = '';
				$log.error(result);
			});
			
		}else{
			$scope.cantones = '';
		}
	}


	$scope.consultarDistritos = function(){
		if($scope.canton_id!='none'){
			$http({
				url: BASE_URL + 'proyecto/consultaDistritosAjax/',
		        method: "POST",
		        data: {  canton_id: $scope.canton_id },
		    })
			.then(function(result){
				$scope.distritos = result.data.datos;
			},function(result){
				$scope.distritos = '';
				$log.error(result);
			});
		}else{
			$scope.distritos = '';
		}
	}


}]);

myApp.controller('reporteHorasPorTrabajadorController', ['$scope', '$log', '$http', '$filter', '$window', function ($scope, $log, $http, $filter, $window) {
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
			url: BASE_URL + 'colaborador/consultaColaboradoresAjax/',
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

	


}]);

myApp.controller('reporteHorasPorTrabajadorDetalleController', ['$scope', '$log', '$http','$timeout', function ($scope, $log, $http, $timeout) {
	
	$scope.cantidad_mostrar = 20;
	$scope.total_rows = 0;
	$scope.pages = 1;
	$scope.q = '';
	
	$scope.currentPage = 0;	
	
	$scope.fecha_gasto_from = '';
	$scope.fecha_gasto_to = '';
	$scope.nombre_proyecto = '';
	$scope.nombre_proyecto_filtrado = '';
	$scope.fecha_gasto_from_filtrado = '';
	$scope.fecha_gasto_to_filtrado = '';


	$scope.filtrar = function () {
		$scope.consultarHoras();
	};

	$scope.limpiarFiltro = function(){
		$scope.fecha_gasto_from = '';
		$scope.fecha_gasto_to = '';
		$scope.nombre_proyecto = '';
		$scope.nombre_proyecto_filtrado = '';
		$scope.fecha_gasto_from_filtrado = '';
		$scope.fecha_gasto_to_filtrado = '';
		$scope.consultarHoras();
	}

	$scope.consultarHoras = function () {
		$http({
			url: BASE_URL + 'reporte/reporteHorasPorTrabajadorAjax/',
			method: "POST",
			data: {
				filtros: {
					colaborador_id: $scope.colaborador_id,
					nombre_proyecto: $scope.nombre_proyecto,
					fecha_gasto_from: $scope.fecha_gasto_from,
					fecha_gasto_to: $scope.fecha_gasto_to,
									
				},
				cantidad_mostrar: $scope.cantidad_mostrar,
			},
		})
		.then(function (result) {
			if (result.data !== "false") {
				$scope.tiempos_colaboradores = result.data.datos;
				$scope.total_rows = result.data.total_rows;
				$scope.calcularPaginas();
				
			} else {
				$scope.tiempos_colaboradores = false;
			}
			
		}, function (result) {
			$log.error(result);
		});
		$scope.nombre_proyecto_filtrado = $scope.nombre_proyecto;
		$scope.fecha_gasto_from_filtrado = $scope.fecha_gasto_from;
		$scope.fecha_gasto_to_filtrado = $scope.fecha_gasto_to;
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

	
}]);

myApp.controller('reporteHorasPorProyectoController', ['$scope', '$log', '$http', '$filter', '$window', function ($scope, $log, $http, $filter, $window) {
	$scope.cantidad_mostrar = 20;
	$scope.total_rows = 0;
	$scope.pages = 1;
	$scope.q = '';

	$scope.currentPage = 0;



	$scope.filtrarProyecto = function () {
		$scope.consultarProyecto();
	};

	$scope.limpiarFiltro = function () {
		$scope.nombre_proyecto = '';
		$scope.proyecto_estado_id = 'all';
		$scope.cliente_id = 'all';
		$scope.numero_contrato = '';
		$scope.orden_compra = '';
		$scope.provincia_id = 'all';
		$scope.canton_id = 'all';
		$scope.distrito_id = 'all';
		$scope.fecha_registro_from = '';
		$scope.fecha_registro_to = '';
		$scope.fecha_firma_contrato_from = '';
		$scope.fecha_firma_contrato_to = '';
		$scope.fecha_inicio_from = '';
		$scope.fecha_inicio_to = '';
		$scope.fecha_entrega_estimada_from = '';
		$scope.fecha_entrega_estimada_to = '';
		$scope.consultarProyecto();
	}

	$scope.consultarProyecto = function () {
		$http({
			url: BASE_URL + 'proyecto/consultaProyectosAjax/',
			method: "POST",
			data: {
				filtros: {
					nombre_proyecto: $scope.nombre_proyecto,
					proyecto_estado_id: $scope.proyecto_estado_id,
					cliente_id: $scope.cliente_id,
					numero_contrato: $scope.numero_contrato,
					orden_compra: $scope.orden_compra,
					provincia_id: $scope.provincia_id,
					canton_id: $scope.canton_id,
					distrito_id: $scope.distrito_id,
					fecha_registro: {
						from: $scope.fecha_registro_from,
						to: $scope.fecha_registro_to,
					},
					fecha_firma_contrato: {
						from: $scope.fecha_firma_contrato_from,
						to: $scope.fecha_firma_contrato_to,
					},
					fecha_inicio: {
						from: $scope.fecha_inicio_from,
						to: $scope.fecha_inicio_to,
					},
					fecha_entrega_estimada: {
						from: $scope.fecha_entrega_estimada_from,
						to: $scope.fecha_entrega_estimada_to,
					},
				},
				cantidad_mostrar: $scope.cantidad_mostrar,
			},
		})
			.then(function (result) {
				$scope.proyectos = result.data.datos;
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

	$scope.consultarProyecto();



	$scope.getCantones = function () {
		$scope.canton_id = 'all';
		$scope.distrito_id = 'all';
		$scope.consultarCantones();
	}

	$scope.getDistritos = function () {
		$scope.distrito_id = 'all';
		$scope.consultarDistritos();
	}

	$scope.consultarCantones = function () {
		if ($scope.provincia_id != 'none') {
			$http({
				url: BASE_URL + 'proyecto/consultaCantonesAjax/',
				method: "POST",
				data: { provincia_id: $scope.provincia_id },
			})
				.then(function (result) {
					$scope.cantones = result.data.datos;
				}, function (result) {
					$scope.cantones = '';
					$log.error(result);
				});

		} else {
			$scope.cantones = '';
		}
	}


	$scope.consultarDistritos = function () {
		if ($scope.canton_id != 'none') {
			$http({
				url: BASE_URL + 'proyecto/consultaDistritosAjax/',
				method: "POST",
				data: { canton_id: $scope.canton_id },
			})
				.then(function (result) {
					$scope.distritos = result.data.datos;
				}, function (result) {
					$scope.distritos = '';
					$log.error(result);
				});
		} else {
			$scope.distritos = '';
		}
	}


}]);

myApp.controller('reporteHorasPorProyectoDetalleController', ['$scope', '$log', '$http', '$timeout', function ($scope, $log, $http, $timeout) {

	$scope.cantidad_mostrar = 20;
	$scope.total_rows = 0;
	$scope.pages = 1;
	$scope.q = '';

	$scope.currentPage = 0;

	$scope.fecha_gasto_from = '';
	$scope.fecha_gasto_to = '';
	$scope.fecha_gasto_from_filtrado = '';
	$scope.fecha_gasto_to_filtrado = '';
	$scope.group_by = 'none';


	$scope.filtrar = function () {
		$scope.consultarHoras();
	};

	$scope.limpiarFiltro = function () {
		$scope.fecha_gasto_from = '';
		$scope.fecha_gasto_to = '';
		$scope.fecha_gasto_from_filtrado = '';
		$scope.fecha_gasto_to_filtrado = '';
		$scope.group_by = 'none';
		$scope.consultarHoras();
	}

	$scope.consultarHoras = function () {
		$log.log($scope.group_by);
		$http({
			url: BASE_URL + 'reporte/reporteHorasPorProyectoAjax/',
			method: "POST",
			data: {
				filtros: {
					proyecto_id: $scope.proyecto_id,
					fecha_gasto_from: $scope.fecha_gasto_from,
					fecha_gasto_to: $scope.fecha_gasto_to,
					group_by: $scope.group_by,

				},
				cantidad_mostrar: $scope.cantidad_mostrar,
			},
		})
			.then(function (result) {
				if (result.data !== "false") {
					$log.log(result.data.datos);
					$scope.tiempos_proyecto = result.data.datos;
					$scope.total_rows = result.data.total_rows;
					$scope.calcularPaginas();

				} else {
					$scope.tiempos_proyecto = false;
				}

			}, function (result) {
				$log.error(result);
			});
		$scope.group_by_filtrado = $scope.group_by;
		$scope.fecha_gasto_from_filtrado = $scope.fecha_gasto_from;
		$scope.fecha_gasto_to_filtrado = $scope.fecha_gasto_to;
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


}]);

myApp.controller('reporteGastosMaterialesPorProyectoController', ['$scope', '$log', '$http', '$filter', '$window', function ($scope, $log, $http, $filter, $window) {
	$scope.cantidad_mostrar = 20;
	$scope.total_rows = 0;
	$scope.pages = 1;
	$scope.q = '';

	$scope.currentPage = 0;



	$scope.filtrarProyecto = function () {
		$scope.consultarProyecto();
	};

	$scope.limpiarFiltro = function () {
		$scope.nombre_proyecto = '';
		$scope.proyecto_estado_id = 'all';
		$scope.cliente_id = 'all';
		$scope.numero_contrato = '';
		$scope.orden_compra = '';
		$scope.provincia_id = 'all';
		$scope.canton_id = 'all';
		$scope.distrito_id = 'all';
		$scope.fecha_registro_from = '';
		$scope.fecha_registro_to = '';
		$scope.fecha_firma_contrato_from = '';
		$scope.fecha_firma_contrato_to = '';
		$scope.fecha_inicio_from = '';
		$scope.fecha_inicio_to = '';
		$scope.fecha_entrega_estimada_from = '';
		$scope.fecha_entrega_estimada_to = '';
		$scope.consultarProyecto();
	}

	$scope.consultarProyecto = function () {
		$http({
			url: BASE_URL + 'proyecto/consultaProyectosAjax/',
			method: "POST",
			data: {
				filtros: {
					nombre_proyecto: $scope.nombre_proyecto,
					proyecto_estado_id: $scope.proyecto_estado_id,
					cliente_id: $scope.cliente_id,
					numero_contrato: $scope.numero_contrato,
					orden_compra: $scope.orden_compra,
					provincia_id: $scope.provincia_id,
					canton_id: $scope.canton_id,
					distrito_id: $scope.distrito_id,
					fecha_registro: {
						from: $scope.fecha_registro_from,
						to: $scope.fecha_registro_to,
					},
					fecha_firma_contrato: {
						from: $scope.fecha_firma_contrato_from,
						to: $scope.fecha_firma_contrato_to,
					},
					fecha_inicio: {
						from: $scope.fecha_inicio_from,
						to: $scope.fecha_inicio_to,
					},
					fecha_entrega_estimada: {
						from: $scope.fecha_entrega_estimada_from,
						to: $scope.fecha_entrega_estimada_to,
					},
				},
				cantidad_mostrar: $scope.cantidad_mostrar,
			},
		})
			.then(function (result) {
				$scope.proyectos = result.data.datos;
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

	$scope.consultarProyecto();



	$scope.getCantones = function () {
		$scope.canton_id = 'all';
		$scope.distrito_id = 'all';
		$scope.consultarCantones();
	}

	$scope.getDistritos = function () {
		$scope.distrito_id = 'all';
		$scope.consultarDistritos();
	}

	$scope.consultarCantones = function () {
		if ($scope.provincia_id != 'none') {
			$http({
				url: BASE_URL + 'proyecto/consultaCantonesAjax/',
				method: "POST",
				data: { provincia_id: $scope.provincia_id },
			})
				.then(function (result) {
					$scope.cantones = result.data.datos;
				}, function (result) {
					$scope.cantones = '';
					$log.error(result);
				});

		} else {
			$scope.cantones = '';
		}
	}


	$scope.consultarDistritos = function () {
		if ($scope.canton_id != 'none') {
			$http({
				url: BASE_URL + 'proyecto/consultaDistritosAjax/',
				method: "POST",
				data: { canton_id: $scope.canton_id },
			})
				.then(function (result) {
					$scope.distritos = result.data.datos;
				}, function (result) {
					$scope.distritos = '';
					$log.error(result);
				});
		} else {
			$scope.distritos = '';
		}
	}


}]);

myApp.controller('reporteGastosMaterialesPorProyectoDetalleController', ['$scope', '$log', '$http', '$timeout', function ($scope, $log, $http, $timeout) {

	$scope.cantidad_mostrar = 20;
	$scope.total_rows = 0;
	$scope.pages = 1;
	$scope.q = '';

	$scope.currentPage = 0;

	$scope.fecha_gasto_from = '';
	$scope.fecha_gasto_to = '';
	$scope.fecha_gasto_from_filtrado = '';
	$scope.fecha_gasto_to_filtrado = '';
	$scope.proveedor_id = 'all';
	$scope.proyecto_gasto_estado_id = 'all';
	$scope.proveedor_id_filtrado = 'all';
	$scope.proyecto_gasto_estado_id_filtrado = 'all';
	$scope.group_by = 'none';


	$scope.filtrar = function () {
		$scope.consultarHoras();
	};

	$scope.limpiarFiltro = function () {
		$scope.fecha_gasto_from = '';
		$scope.fecha_gasto_to = '';
		$scope.fecha_gasto_from_filtrado = '';
		$scope.fecha_gasto_to_filtrado = '';
		$scope.proveedor_id = 'all';
		$scope.proyecto_gasto_estado_id = 'all';
		$scope.proveedor_id_filtrado = 'all';
		$scope.proyecto_gasto_estado_id_filtrado = 'all';
		$scope.group_by = 'none';
		$scope.consultarHoras();
	}

	$scope.consultarHoras = function () {
		$log.log($scope.group_by);
		$http({
			url: BASE_URL + 'reporte/reporteGastosMaterialesPorProyectoAjax/',
			method: "POST",
			data: {
				filtros: {
					proyecto_id: $scope.proyecto_id,
					fecha_gasto_from: $scope.fecha_gasto_from,
					fecha_gasto_to: $scope.fecha_gasto_to,
					proveedor_id: $scope.proveedor_id,
					proyecto_gasto_estado_id: $scope.proyecto_gasto_estado_id,
					group_by: $scope.group_by,

				},
				cantidad_mostrar: $scope.cantidad_mostrar,
			},
		})
			.then(function (result) {
				if (result.data !== "false") {
					$log.log(result.data.datos);
					$scope.result_reporte = result.data.datos;
					$scope.total_rows = result.data.total_rows;
					$scope.calcularPaginas();

				} else {
					$scope.result_reporte = false;
				}

			}, function (result) {
				$log.error(result);
			});
		$scope.group_by_filtrado = $scope.group_by;
		$scope.fecha_gasto_from_filtrado = $scope.fecha_gasto_from;
		$scope.fecha_gasto_to_filtrado = $scope.fecha_gasto_to;
		$scope.proveedor_id_filtrado = $scope.proveedor_id;
		$scope.proyecto_gasto_estado_id_filtrado = $scope.proyecto_gasto_estado_id;
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


}]);