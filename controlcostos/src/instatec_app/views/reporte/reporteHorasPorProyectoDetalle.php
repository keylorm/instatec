<script src="<?=base_url()?>src/instatec_pub/js/reporte.js"></script>
<!-- Breadcrumbs-->
<ol class="breadcrumb">
	<li class="breadcrumb-item">
	  <a href="<?=base_url()?>">Inicio</a>
	</li>
	<li class="breadcrumb-item">
	  <a href="<?=base_url()?>reportes">Reportes</a>
	</li>
    <li class="breadcrumb-item">
	  <a href="<?=base_url()?>reportes/horas-por-proyecto">Horas por Proyecto</a>
	</li>
	<li class="breadcrumb-item active"><?=@$proyecto['proyecto']['nombre_proyecto']?></li>
</ol>

<h1 class="text-center"><i class="fa fa-fw fa-table"></i> Reporte de horas: <?=@$proyecto['proyecto']['nombre_proyecto']?></h1>
<hr>


<div class="page-content" ng-controller="reporteHorasPorProyectoDetalleController"  ng-init="proyecto_id=<?=$proyecto['proyecto']['proyecto_id']?>; consultarHoras();">
		<div class="row">
			<div class="col-12 col-md-6"><h3 class=" text-center text-md-left"><i class="fa fa-fw fa-table"></i> Horas por proyecto</h3></div>
			<div class="col-12 col-md-6">
				<a class="btn btn-primary float-md-right mb-3 mr-md-3 mx-auto d-block d-md-inline-block" href="<?=base_url()?>reportes/horas-por-proyecto/" role="button"><i class="fa fa-fw fa-arrow-left"></i> Volver al listado de proyectos</a>
			</div>
		</div>
		<div class="card">
			<div class="card-header anchor-class" data-toggle="collapse" data-target="#filtroContainer" aria-expanded="true" aria-controls="collapseExample">
				<i class="fa fa-fw fa-filter"></i> Filtros <i class="fa float-right fa-plus-circle"></i>
		</div>
		<div class="card-body collapse show" id="filtroContainer">
			
			<div class="filtros">
				<form id="form-filtro">
					<div class="row">						
						<div class="form-group col-12 col-md-3">
							<label for="fecha_gasto">Fecha de ingreso:</label>
							<div class="input-group input-daterange">
								<input type="text" name="fecha_gasto[from]" class="form-control" ng-model="fecha_gasto_from" >
								<div class="input-group-addon"> a </div>
								<input type="text" name="fecha_gasto[to]" class="form-control" ng-model="fecha_gasto_to" >
							</div>
							<!--<input type="text" name="fecha_gasto" class="form-control datepicker" id="fecha_gasto" aria-describedby="fechafirmaHelp" >-->
							
						</div>
						<div class="form-group col-12 col-md-4">
							<label>Agrupar por:</label>
							<div class="form-check">
								<label class="form-check-label">
									<input class="form-check-input" type="radio" name="group_by" id="group_by1" ng-value="'none'" ng-model="group_by" >
									No agrupar
								</label>
							</div>
							<div class="form-check">
								<label class="form-check-label">
									<input class="form-check-input" type="radio" name="group_by" id="group_by1" ng-value="'dia'" ng-model="group_by" >
									Día
								</label>
							</div>
							<div class="form-check">
								<label class="form-check-label">
									<input class="form-check-input" type="radio" name="group_by" id="group_by2" ng-model="group_by" ng-value="'colaborador'">
									Colaborador
								</label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12 col-md-3">
							<button  class="btn btn-primary form-submit" ng-click="filtrar()">Filtrar</button>
							<button  class="btn btn-outline-primary form-submit" ng-click="limpiarFiltro()">Limpiar Filtrado</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="table-espaciado"  ng-cloak ng-if="tiempos_proyecto!==false">
		<div class="table-responsive">
			<form action="<?=base_url()?>/reporte/generarReporteHorasPorProyecto"  id="download-form">
				<input type="text" ng-show="false" ng-model="fecha_gasto_from_filtrado" name="fecha_gasto_from" >
				<input type="text" ng-show="false" ng-model="fecha_gasto_to_filtrado" name="fecha_gasto_to" >
				<input type="text" ng-show="false" ng-model="group_by_filtrado" name="group_by" >
				<input type="hidden" name="proyecto_id" value="<?=$proyecto['proyecto']['proyecto_id']?>" />
				<button  class="btn btn-success form-submit mb-3 float-right" type="submit"><i class="fa fa-download"></i> Descargar reporte</button>
			</form>
			<table  class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead class="thead-light">
					<tr ng-if="group_by_filtrado=='dia'">
						<th>Fecha</th>
						<th>Horas</th>
						<th>Horas extra</th>
						<th>Costo</th>
					</tr>
					<tr ng-if="group_by_filtrado=='colaborador'">
						<th>Colaborador</th>
						<th>Horas</th>
						<th>Horas extra</th>
						<th>Costo</th>
					</tr>
					<tr ng-if="group_by_filtrado=='none'">
						<th>Colaborador</th>
						<th>Fecha</th>
						<th>Horas</th>
						<th>Horas extra</th>
						<th>Costo / Hora</th>
						<th>Costo total</th>
					</tr>
				</thead>
				
	      		<tbody>
					<tr ng-if="group_by_filtrado=='dia'" ng-repeat="tiempo in tiempos_proyecto">					
						<td>{{tiempo.fecha_gasto}}</td>
						<td>{{tiempo.total_horas}} h.</td>
						<td>{{tiempo.total_horas_extra}} h.</td>
						<td>{{tiempo.total_costo  | currency:'₡ '}}</td>
					</tr>
					<tr ng-if="group_by_filtrado=='colaborador'" ng-repeat="tiempo in tiempos_proyecto">					
						<td>{{tiempo.nombre + ' ' + tiempo.apellidos}}</td>
						<td>{{tiempo.total_horas}} h.</td>
						<td>{{tiempo.total_horas_extra}} h.</td>
						<td>{{tiempo.total_costo  | currency:'₡ '}}</td>
					</tr>
					<tr ng-if="group_by_filtrado=='none'" ng-repeat="tiempo in tiempos_proyecto">					
						<td>{{tiempo.nombre + ' ' + tiempo.apellidos}}</td>
						<td>{{tiempo.fecha_gasto}}</td>
						<td>{{tiempo.cantidad_horas}} h.</td>
						<td>{{tiempo.cantidad_horas_extra}} h.</td>
						<td>{{tiempo.costo_hora_mano_obra   | currency:'₡ '}}</td>
						<td>{{(tiempo.cantidad_horas*tiempo.costo_hora_mano_obra)+(tiempo.cantidad_horas_extra*(tiempo.costo_hora_mano_obra*1.5))  | currency:'₡ '}}</td>
					</tr>
				</tbody>
			</table>
		</div>
		
		<p class="text-right">Total: {{total_rows}}</p>
	</div>

	<p ng-if="tiempos_proyecto===false" class="text-center table-espaciado">No hay tiempos registrados para este proyecto aún</p>
</div>