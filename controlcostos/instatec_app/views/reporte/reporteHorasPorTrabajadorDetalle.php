<script src="<?=base_url()?>instatec_pub/js/reporte.js"></script>
<!-- Breadcrumbs-->
<ol class="breadcrumb">
	<li class="breadcrumb-item">
	  <a href="<?=base_url()?>">Inicio</a>
	</li>
	<li class="breadcrumb-item">
	  <a href="<?=base_url()?>reportes">Reportes</a>
	</li>
    <li class="breadcrumb-item">
	  <a href="<?=base_url()?>reportes/horas-por-trabajador">Horas por Trabajador</a>
	</li>
	<li class="breadcrumb-item active"><?=@$colaborador->nombre.' '.@$colaborador->apellidos?></li>
</ol>

<h1 class="text-center"><i class="fa fa-fw fa-table"></i> Reporte de horas: <?=@$colaborador->nombre.' '.@$colaborador->apellidos?></h1>
<hr>


<div class="page-content" ng-controller="reporteHorasPorTrabajadorDetalleController"  ng-init="colaborador_id=<?=$colaborador->colaborador_id?>; consultarHoras();">
		<div class="row">
			<div class="col-12 col-md-6"><h3 class=" text-center text-md-left"><i class="fa fa-fw fa-table"></i> Horas por trabajador</h3></div>
			<div class="col-12 col-md-6">
				<a class="btn btn-primary float-md-right mb-3 mr-md-3 mx-auto d-block d-md-inline-block" href="<?=base_url()?>reportes/horas-por-trabajador/" role="button"><i class="fa fa-fw fa-arrow-left"></i> Volver al listado de colaboradores</a>
			</div>
		</div>
		<div class="card">
			<div class="card-header anchor-class" data-toggle="collapse" data-target="#filtroContainer" aria-expanded="false" aria-controls="collapseExample">
				<i class="fa fa-fw fa-filter"></i> Filtros <i class="fa float-right fa-plus-circle"></i>
		</div>
		<div class="card-body collapse show" id="filtroContainer">
			
			<div class="filtros">
				<form id="form-filtro">
					<div class="row">
						<div class="form-group col-12 col-md-3">
							<label for="nombre_proyecto">Nombre de proyecto</label>
							<input type="text" name="nombre_proyecto" class="form-control" id="nombre_proyecto"  ng-model="nombre_proyecto">
							
						</div>
						<div class="form-group col-12 col-md-3">
							<label for="fecha_gasto">Fecha de ingreso:</label>
							<div class="input-group input-daterange">
								<input type="text" name="fecha_gasto[from]" class="form-control" ng-model="fecha_gasto_from" >
								<div class="input-group-addon"> a </div>
								<input type="text" name="fecha_gasto[to]" class="form-control" ng-model="fecha_gasto_to" >
							</div>
							<!--<input type="text" name="fecha_gasto" class="form-control datepicker" id="fecha_gasto" aria-describedby="fechafirmaHelp" >-->
							
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
	<div class="table-espaciado"  ng-cloak ng-if="tiempos_colaboradores!==false">
		<div class="table-responsive">
			<form action="<?=base_url()?>/reporte/generarReporteHorasPorTrabajador"  id="download-form">
				<input type="text" ng-show="false"  ng-model="nombre_proyecto_filtrado" name="nombre_proyecto" >
				<input type="text" ng-show="false" ng-model="fecha_gasto_from_filtrado" name="fecha_gasto_from" >
				<input type="text" ng-show="false" ng-model="fecha_gasto_to_filtrado" name="fecha_gasto_to" >
				<input type="hidden" name="colaborador_id" value="<?=$colaborador->colaborador_id?>" />
				<button  class="btn btn-success form-submit mb-3 float-right" type="submit"><i class="fa fa-download"></i> Descargar reporte</button>
			</form>
			<table  class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead class="thead-light">
					<tr>
						<th>Proyecto</th>
						<th>Fecha</th>
						<th>Horas normales</th>
						<th>Horas extras</th>
						<th>Costo / hora</th>
						<th>Costo</th>
					</tr>
				</thead>
				
	      		<tbody>
					<tr ng-repeat="tiempo in tiempos_colaboradores">
						
						<td>{{tiempo.nombre_proyecto}}</td>						
						<td>{{tiempo.fecha_gasto}}</td>
						<td>{{tiempo.cantidad_horas}} h.</td>
						<td>{{tiempo.cantidad_horas_extra}} h.</td>
						<td>{{tiempo.costo_hora_mano_obra | currency:'₡ '}}</td>
						<td>{{((tiempo.cantidad_horas * tiempo.costo_hora_mano_obra) + (tiempo.cantidad_horas_extra * (tiempo.costo_hora_mano_obra * 1.5))) | currency:'₡ '}}</td>
					</tr>
				</tbody>
			</table>
		</div>
		
		<p class="text-right">Total: {{total_rows}}</p>
	</div>

	<p ng-if="tiempos_colaboradores===false" class="text-center table-espaciado">No hay tiempos registrados para este colaborador aún</p>
</div>