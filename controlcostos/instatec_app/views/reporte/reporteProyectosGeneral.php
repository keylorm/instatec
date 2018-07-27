<script src="<?=base_url()?>instatec_pub/js/reporte.js"></script>
<!-- Breadcrumbs-->
<ol class="breadcrumb">
	<li class="breadcrumb-item">
	  <a href="<?=base_url()?>">Inicio</a>
	</li>
	<li class="breadcrumb-item">
	  <a href="<?=base_url()?>reportes">Reportes</a>
	</li>
	<li class="breadcrumb-item active">Proyectos en general</li>
</ol>

<h1 class="text-center"><i class="fa fa-fw fa-table"></i> Reporte de proyectos en general</h1>
<hr>


<div class="page-content" ng-controller="reporteProyectosGeneralController">
	<div class="row">
		<div class="col-12"><h3 class=" text-center text-md-left"><i class="fa fa-fw fa-table"></i> Lista de proyectos</h3></div>		
	</div>
	<div class="card">
		<div class="card-header anchor-class" data-toggle="collapse" data-target="#filtroContainer" aria-expanded="false" aria-controls="collapseExample">
				<i class="fa fa-fw fa-filter"></i> Filtros <i class="fa float-right fa-plus-circle"></i>
        </div>
		<div class="card-body collapse" id="filtroContainer">			
			<div class="filtros">
				<form id="form-filtro">
					<div class="row">
						<div class="form-group col-12 col-md-3">
							<label for="nombre_proyecto">Nombre de proyecto</label>
							<input type="text" name="nombre_proyecto" class="form-control" id="nombre_proyecto"  ng-model="nombre_proyecto">
							
						</div>
						<div class="form-group col-12 col-md-3">
							<label for="numero_contrato">Número de contrato del proyecto</label>
							<input type="text" name="numero_contrato" class="form-control" id="numero_contrato"  ng-model="numero_contrato">
						</div>
						<div class="form-group col-12 col-md-3">
							<label for="orden_compra">Orden de compra del proyecto</label>
							<input type="text" name="orden_compra" class="form-control" id="orden_compra"  ng-model="orden_compra">
						</div>
						<div class="form-group col-12 col-md-3">
							<label for="cliente_id">Cliente del proyecto:</label>
							<select class="form-control chosen-select" data-placeholder="Seleccione una opción..." name="cliente_id" id="cliente_id" aria-describedby="clienteHelp" required="true" ng-model="cliente_id">
								<option value=""></option>
								<option value="all">Todos</option>
								<?php foreach($clientes as $kcliente => $vcliente){ ?>
									<option value="<?=$vcliente->cliente_id?>"><?=$vcliente->nombre_cliente?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					

					<div class="row">
						<div class="form-group col-12 col-md-3">
							<label>Estado del proyecto:</label>
							<select class="form-control select-required" name="proyecto_estado_id" id="proyecto_estado_id" ng-model="proyecto_estado_id">
								<option value="all" selected="selected">Todos</option>
								<?php foreach($proyecto_estados as $kproyecto_estado => $vproyecto_estado){ ?>
									<option value="<?=$vproyecto_estado->proyecto_estado_id?>"><?=$vproyecto_estado->proyecto_estado?></option>
								<?php } ?>
							</select>
							
						</div>
						<div class="form-group col-12 col-md-3">
							<label for="provincia_id">Provincia:</label>
							<select class="form-control" name="provincia_id" id="provincia_id" aria-describedby="provinciaHelp" ng-model="provincia_id" ng-click="getCantones()" required="required">
								<option value="all" selected="selected">Todos</option>
								<?php foreach($provincias as $kprovincia => $vprovincia){ ?>
									<option value="<?=$vprovincia->provincia_id?>"><?=$vprovincia->provincia?></option>
								<?php } ?>
							</select>						
						</div>
						<div class="form-group col-12 col-md-3">
							<label for="canton_id">Cantón:</label>
							<select class="form-control" name="canton_id" id="canton_id" aria-describedby="cantonHelp" ng-model="canton_id" ng-click="getDistritos()">
								<option value="all" selected="selected">Todos</option>
								<option ng-repeat="canton in cantones" value="{{canton.canton_id}}" required="required">
									{{canton.canton}}
								</option>
							</select>
						</div>
					
						<div class="form-group col-12 col-md-3">
							<label for="distrito_id">Distrito:</label>
							<select class="form-control" name="distrito_id" id="distrito_id" aria-describedby="distritoHelp" ng-model="distrito_id">
								<option value="all" selected="selected">Todos</option>
								<option ng-repeat="distrito in distritos" value="{{distrito.distrito_id}}" required="required">
									{{distrito.distrito}}
								</option>
							</select>						
						</div>
						
					</div>

					<div class="row">
						<div class="form-group col-12 col-md-3">
							<label for="fecha_registro">Fecha de registro:</label>
							<div class="input-group input-daterange">
								<input type="text" name="fecha_registro[from]" class="form-control" ng-model="fecha_registro_from" >
								<div class="input-group-addon"> a </div>
								<input type="text" name="fecha_registro[to]" class="form-control" ng-model="fecha_registro_to" >
							</div>
							<!--<input type="text" name="fecha_registro" class="form-control datepicker" id="fecha_registro" aria-describedby="fechafirmaHelp" >-->
							
						</div>
						<div class="form-group col-12 col-md-3">
							<label for="fecha_firma_contrato">Fecha de firma de contrato:</label>
							<div class="input-group input-daterange">
								<input type="text" name="fecha_firma_contrato[from]" class="form-control" ng-model="fecha_firma_contrato_from" >
								<div class="input-group-addon"> a </div>
								<input type="text" name="fecha_firma_contrato[to]" class="form-control" ng-model="fecha_firma_contrato_to">
							</div>
							<!--<input type="text" name="fecha_firma_contrato" class="form-control datepicker" id="fecha_firma_contrato" aria-describedby="fechafirmaHelp" >-->						
						</div>
						<div class="form-group col-12 col-md-3">
							<label for="fecha_inicio">Fecha de inicio esperada:</label>
							<div class="input-group input-daterange">
								<input type="text" name="fecha_inicio[from]" class="form-control" ng-model="fecha_inicio_from" >
								<div class="input-group-addon"> a </div>
								<input type="text" name="fecha_inicio[to]" class="form-control" ng-model="fecha_inicio_to">
							</div>
							<!--<input type="text" name="fecha_inicio" class="form-control datepicker" id="fecha_inicio" aria-describedby="fechainicioHelp" >-->
						</div>
					
						<div class="form-group col-12 col-md-3">
							<label for="fecha_entrega_estimada">Fecha de entrega estimada:</label>
							<div class="input-group input-daterange">
								<input type="text" name="fecha_entrega_estimada[from]" class="form-control" ng-model="fecha_entrega_estimada_from" >
								<div class="input-group-addon"> a </div>
								<input type="text" name="fecha_entrega_estimada[to]" class="form-control" ng-model="fecha_entrega_estimada_to">
							</div>
							<!--<input type="text" name="fecha_entrega_estimada" class="form-control datepicker" id="fecha_entrega_estimada" aria-describedby="fechaentregaHelp" >-->					
						</div>
						
					</div>

					<div class="row">
						<div class="col-12 col-md-3">
							<button  class="btn btn-primary form-submit" ng-click="consultarProyecto()">Filtrar</button>
							<button  class="btn btn-outline-primary form-submit" ng-click="limpiarFiltro()">Limpiar Filtrado</button>
						</div>
						
					</div>
				
				</form>
			</div>
		</div>
	</div>
	<div class="loader text-center mb-3 mt-3" ng-if="loader==true">
		<img src="<?=base_url()?>/instatec_pub/images/ajax-loader.gif" alt="" class="loader-ajax">
	</div>
	<div ng-if="loader===false">
		<div class="table-espaciado">
			<div class="table-responsive">
				<form action="<?=base_url()?>/reporte/generarReporteProyectosGeneral"  id="download-form">
					<input type="text" ng-show="false"  ng-model="nombre_proyecto_filtrado" name="nombre_proyecto" >
					<input type="text" ng-show="false"  ng-model="numero_contrato_filtrado" name="numero_contrato" >
					<input type="text" ng-show="false"  ng-model="orden_compra_filtrado" name="orden_compra" >
					<input type="text" ng-show="false"  ng-model="proyecto_estado_id_filtrado" name="proyecto_estado_id" >
					<input type="text" ng-show="false"  ng-model="cliente_id_filtrado" name="cliente_id" >
					<input type="text" ng-show="false"  ng-model="provincia_id_filtrado" name="provincia_id" >
					<input type="text" ng-show="false"  ng-model="canton_id_filtrado" name="canton_id" >
					<input type="text" ng-show="false"  ng-model="distrito_id_filtrado" name="distrito_id" >
					<input type="text" ng-show="false" ng-model="fecha_registro_from_filtrado" name="fecha_registro[from]" >
					<input type="text" ng-show="false" ng-model="fecha_registro_to_filtrado" name="fecha_registro[to]" >
					<input type="text" ng-show="false"  ng-model="fecha_firma_contrato_from_filtrado" name="fecha_firma_contrato[from]" >
					<input type="text" ng-show="false"  ng-model="fecha_firma_contrato_to_filtrado" name="fecha_firma_contrato[to]" >
					<input type="text" ng-show="false"  ng-model="fecha_inicio_from_filtrado" name="fecha_inicio[from]" >
					<input type="text" ng-show="false"  ng-model="fecha_inicio_to_filtrado" name="fecha_inicio[to]" >
					<input type="text" ng-show="false"  ng-model="fecha_entrega_estimada_from_filtrado" name="fecha_entrega_estimada[from]" >
					<input type="text" ng-show="false"  ng-model="fecha_entrega_estimada_to_filtrado" name="fecha_entrega_estimada[to]" >
					<button  class="btn btn-success form-submit mb-3 float-right" type="submit"><i class="fa fa-download"></i> Descargar reporte</button>
				</form>
				<table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead class="thead-light">
						<tr>
							<th>Proyecto</th>
							<th>Valor de Oferta</th>
							<th>Gastos</th>
							<th>Utilidad</th>
							<th>Avance en tiempo</th>
						</tr>
					</thead>
					
					<tbody>
						<tr ng-repeat="proyecto in proyectos">
							<td><a href="<?=base_url()?>proyectos/ver-proyecto/{{proyecto.proyecto_id}}"><strong>Nombre: {{proyecto.nombre_proyecto}}</strong><br>
							Cliente: {{proyecto.nombre_cliente}}<br>
							Estado: {{proyecto.proyecto_estado}}<br>
							N° Contrato: {{proyecto.numero_contrato}}<br>
							Orden de compra: {{proyecto.orden_compra}}<br>
							Fecha de inicio: {{proyecto.fecha_inicio}}<br>
							Fecha de entrega: {{proyecto.fecha_entrega_estimada}}</a></td>
							<td><a href="<?=base_url()?>proyectos/ver-proyecto/{{proyecto.proyecto_id}}">{{proyecto.valor_oferta.total | currency}}</a></td>
							<td><a href="<?=base_url()?>proyectos/ver-proyecto/{{proyecto.proyecto_id}}">{{proyecto.gastos.total | currency}}</a></td>
							<td><a href="<?=base_url()?>proyectos/ver-proyecto/{{proyecto.proyecto_id}}"><span ng-class="{'text-danger': (proyecto.valor_oferta.total - proyecto.gastos.total) < 0}">{{proyecto.valor_oferta.total - proyecto.gastos.total | currency}}</span></a></td>
							<td><a href="<?=base_url()?>proyectos/ver-proyecto/{{proyecto.proyecto_id}}"><span ng-if="proyecto.proyecto_estado_id==2">{{proyecto.avance_tiempo.porcentaje}} % ({{proyecto.avance_tiempo.dias_consumidos}} de {{proyecto.avance_tiempo.dias_proyecto}} días)</span></a></td>
						</tr>
					</tbody>
				</table>
				<form action="<?=base_url()?>/reporte/generarReporteProyectosGeneral"  id="download-form-bottom">
					<input type="text" ng-show="false"  ng-model="nombre_proyecto_filtrado" name="nombre_proyecto" >
					<input type="text" ng-show="false"  ng-model="numero_contrato_filtrado" name="numero_contrato" >
					<input type="text" ng-show="false"  ng-model="orden_compra_filtrado" name="orden_compra" >
					<input type="text" ng-show="false"  ng-model="proyecto_estado_id_filtrado" name="proyecto_estado_id" >
					<input type="text" ng-show="false"  ng-model="cliente_id_filtrado" name="cliente_id" >
					<input type="text" ng-show="false"  ng-model="provincia_id_filtrado" name="provincia_id" >
					<input type="text" ng-show="false"  ng-model="canton_id_filtrado" name="canton_id" >
					<input type="text" ng-show="false"  ng-model="distrito_id_filtrado" name="distrito_id" >
					<input type="text" ng-show="false" ng-model="fecha_registro_from_filtrado" name="fecha_registro[from]" >
					<input type="text" ng-show="false" ng-model="fecha_registro_to_filtrado" name="fecha_registro[to]" >
					<input type="text" ng-show="false"  ng-model="fecha_firma_contrato_from_filtrado" name="fecha_firma_contrato[from]" >
					<input type="text" ng-show="false"  ng-model="fecha_firma_contrato_to_filtrado" name="fecha_firma_contrato[to]" >
					<input type="text" ng-show="false"  ng-model="fecha_inicio_from_filtrado" name="fecha_inicio[from]" >
					<input type="text" ng-show="false"  ng-model="fecha_inicio_to_filtrado" name="fecha_inicio[to]" >
					<input type="text" ng-show="false"  ng-model="fecha_entrega_estimada_from_filtrado" name="fecha_entrega_estimada[from]" >
					<input type="text" ng-show="false"  ng-model="fecha_entrega_estimada_to_filtrado" name="fecha_entrega_estimada[to]" >
					<button  class="btn btn-success form-submit mb-3 float-right" type="submit"><i class="fa fa-download"></i> Descargar reporte</button>
				</form>
			</div>
			
		</div>
	</div>
    <p ng-if="loader===false" class="text-right">Total: {{total_rows}} proyectos</p>
</div>