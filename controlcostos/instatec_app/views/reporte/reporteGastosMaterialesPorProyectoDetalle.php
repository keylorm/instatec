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
	  <a href="<?=base_url()?>reportes/gastos-materiales">Gastos de materiales por Proyecto</a>
	</li>
	<li class="breadcrumb-item active"><?=@$proyecto['proyecto']->nombre_proyecto?></li>
</ol>

<h1 class="text-center"><i class="fa fa-fw fa-table"></i> Reporte de gastos de materiales: <?=@$proyecto['proyecto']->nombre_proyecto?></h1>
<hr>


<div class="page-content" ng-controller="reporteGastosMaterialesPorProyectoDetalleController"  ng-init="proyecto_id=<?=$proyecto['proyecto']->proyecto_id?>; consultarHoras();">
		<div class="row">
			<div class="col-12 col-md-6"><h3 class=" text-center text-md-left"><i class="fa fa-fw fa-table"></i> Gastos de materiales por proyecto</h3></div>
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
						<div class="form-group col-12 col-md-6 col-lg-3">
							<label for="fecha_gasto">Fecha de gasto:</label>
							<div class="input-group input-daterange">
								<input type="text" name="fecha_gasto[from]" class="form-control" ng-model="fecha_gasto_from" >
								<div class="input-group-addon"> a </div>
								<input type="text" name="fecha_gasto[to]" class="form-control" ng-model="fecha_gasto_to" >
							</div>
							<!--<input type="text" name="fecha_gasto" class="form-control datepicker" id="fecha_gasto" aria-describedby="fechafirmaHelp" >-->
							
						</div>
                        <div class="form-group col-12 col-md-6 col-lg-3">
							<label for="proveedor_id">Proveedor:</label>
							<select class="form-control chosen-select" data-placeholder="Seleccione una opción..." name="proveedor_id" id="proveedor_id" aria-describedby="proveedorHelp" required="true" ng-model="proveedor_id">
								<option value=""></option>
								<option value="all">Todos</option>
								<?php foreach($proveedores as $kproveedor => $vproveedor){ ?>
									<option value="<?=$vproveedor->proveedor_id?>"><?=$vproveedor->nombre_proveedor?></option>
								<?php } ?>
							</select>						
						</div>	

						<div class="form-group col-12 col-md-6 col-lg-3">
							<label for="proyecto_gasto_estado_id">Estado del gasto:</label>
							<select class="form-control "  name="proyecto_gasto_estado_id" id="proyecto_gasto_estado_id" aria-describedby="gastoestadoHelp" required="true" ng-model="proyecto_gasto_estado_id">
								<option value="all">Todos</option>
								<?php foreach($gasto_estados as $kestado => $vestado){ ?>
									<option value="<?=$vestado->proyecto_gasto_estado_id?>"><?=$vestado->proyecto_gasto_estado?></option>
								<?php } ?>
							</select>						
						</div>	
						<div class="form-group col-12 col-md-6 col-lg-3">
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
									<input class="form-check-input" type="radio" name="group_by" id="group_by2" ng-model="group_by" ng-value="'proveedor'">
									Proveedor
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
	<div class="table-espaciado"  ng-cloak ng-if="result_reporte!==false">
		<div class="table-responsive">
			<form action="<?=base_url()?>/reporte/generarReporteGastosMaterialesPorProyecto"  id="download-form">
				<input type="text" ng-show="false" ng-model="fecha_gasto_from_filtrado" name="fecha_gasto_from" >
				<input type="text" ng-show="false" ng-model="fecha_gasto_to_filtrado" name="fecha_gasto_to" >
                <input type="text" ng-show="false" ng-model="proveedor_id_filtrado" name="proveedor_id" >
                <input type="text" ng-show="false" ng-model="proyecto_gasto_estado_id_filtrado" name="proyecto_gasto_estado_id" >
				<input type="text" ng-show="false" ng-model="group_by_filtrado" name="group_by" >
				<input type="hidden" name="proyecto_id" value="<?=$proyecto['proyecto']->proyecto_id?>" />
				<button  class="btn btn-success form-submit mb-3 float-right" type="submit"><i class="fa fa-download"></i> Descargar reporte</button>
			</form>
			<table  class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead class="thead-light">
					<tr ng-if="group_by_filtrado=='dia'">
						<th>Fecha</th>
						<th>Gasto</th>
					</tr>
					<tr ng-if="group_by_filtrado=='proveedor'">
						<th>Proveedor</th>
						<th>Gasto</th>
					</tr>
					<tr ng-if="group_by_filtrado=='none'">
						<th>Proveedor</th>
						<th>Fecha</th>
						<th>Gasto</th>
					</tr>
				</thead>
				
	      		<tbody>
					<tr ng-if="group_by_filtrado=='dia'" ng-repeat="result_row in result_reporte">				
						
						<td>{{result_row.fecha_gasto}}</td>
						<td>{{result_row.proyecto_gasto_monto   | currency:'$ '}}</td>
					</tr>
					<tr ng-if="group_by_filtrado=='proveedor'" ng-repeat="result_row in result_reporte">					
						<td>{{result_row.nombre_proveedor}}</td>
						<td>{{result_row.proyecto_gasto_monto   | currency:'$ '}}</td>
					</tr>
					<tr ng-if="group_by_filtrado=='none'" ng-repeat="result_row in result_reporte">					
						<td>{{result_row.nombre_proveedor}}</td>
						<td>{{result_row.fecha_gasto}}</td>
						<td>{{result_row.proyecto_gasto_monto   | currency:'$ '}}</td>
					</tr>
				</tbody>
			</table>
		</div>
		
		<p class="text-right">Total: {{total_rows}}</p>
	</div>

	<p ng-if="result_reporte===false" class="text-center table-espaciado">No hay gastos registrados para este proyecto aún</p>
</div>