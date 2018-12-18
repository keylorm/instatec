<script src="<?=base_url()?>src/instatec_pub/js/cliente.js"></script>
<!-- Breadcrumbs-->
<ol class="breadcrumb">
	<li class="breadcrumb-item">
	  <a href="<?=base_url()?>">Inicio</a>
	</li>
	<li class="breadcrumb-item active">Clientes</li>
</ol>

<h1 class="text-center"><i class="fa fa-fw fa-handshake-o"></i> Clientes</h1>
<hr>


<div class="page-content" ng-controller="clienteController">
	<div class="row">
		<div class="col-12 col-md-10"><h3 class=" text-center text-md-left"><i class="fa fa-fw fa-table"></i> Lista de clientes</h3></div>
		<?php if(isset($permisos['cliente']['create'])){ ?>
			<div class="col-12 col-md-2"><a class="btn btn-primary float-md-right mb-3 mr-md-3 mx-auto d-block d-md-inline-block" href="<?=base_url()?>clientes/agregar-cliente" role="button"><i class="fa fa-fw fa-plus-circle"></i> Agregar cliente</a></div>
		<?php } ?>
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
							<label for="nombre">Nombre de cliente</label>
							<input type="text" name="nombre_cliente" class="form-control" id="nombre" aria-describedby="nombreHelp" ng-model="searchInputs.nombre_cliente">
							</small>
						</div>
						<div class="form-group col-12 col-md-3">
							<label for="cedula">Cédula del cliente</label>
							<input type="text" name="cedula_cliente" class="form-control" id="cedula" aria-describedby="cedulaHelp" ng-model="searchInputs.cedula_cliente">
						</div>
						<div class="form-group col-12 col-md-3">
							<label for="cliente_calificacion_id">Calificación del cliente:</label>
							<select class="form-control chosen-select" data-placeholder="Seleccione una opción..." name="cliente_calificacion_id" id="cliente_calificacion_id" aria-describedby="clienteHelp" required="true" ng-model="searchInputs.cliente_calificacion_id">
								<option value=""></option>
								<option value="">Todos</option>
								<?php foreach($cliente_calificaciones as $kcliente_calificacion => $vcliente_calificacion){ ?>
									<option value="<?=$vcliente_calificacion['cliente_calificacion_id']?>"><?=$vcliente_calificacion['cliente_calificacion']?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group col-12 col-md-3">
							<label>Estado del cliente:</label>
							<div class="form-check">
								<label class="form-check-label">
									<input class="form-check-input" type="radio" name="estado_cliente" id="estado1" ng-value="1" ng-model="searchInputs.estado_cliente" >
									Activo
								</label>
							</div>
							<div class="form-check">
								<label class="form-check-label">
									<input class="form-check-input" type="radio" name="estado_cliente" id="estado2" ng-model="searchInputs.estado_cliente" ng-value="0">
									Inactivo
								</label>
							</div>
						</div>
						<!-- Filtrado previo a usar el filter de angularjs -->
						<!--
						<div class="col-12 col-md-3">
							<button  class="btn btn-primary form-submit" ng-click="filtrarCliente()">Filtrar</button>
						</div>
						-->
					</div>
				
				</form>
			</div>
		</div>
	</div>
	<div class="table-espaciado">
		<div class="table-responsive">
	        <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
	            <thead class="thead-light">
			        <tr>
						<th class="d-md-none">Acciones</th>
						<th>Nombre</th>
						<th>Cédula</th>
						<th>Fecha de registro</th>
						<th>Calificación</th>
						<th>Estado</th>
						<th class="d-none d-md-table-cell">Acciones</th>
					</tr>
				</thead>
                <tfoot ng-if="total_rows > cantidad_mostrar">
                	<td colspan="6">
                	
                    	<nav aria-label="Page navigation example">
	                        <ul class="pagination pull-right">
                                <li class="page-item"><button class="page-link" ng-disabled="validarPrev()" ng-click="pagePrev()">Anterior</button></li>					
								<li class="page-item"><button class="page-link" ng-disabled="validarNext()" ng-click="pageNext()">Siguiente</button></li>

                            </ul>
	                        
	                    </nav>
                			
                		
                    </td>
				</tfoot>
	            <tbody>
					<tr ng-repeat="cliente in clientes | filter: searchInputs | limitTo : cantidad_mostrar : currentPage*cantidad_mostrar">
						<td class="d-md-none">
							<?php if(isset($permisos['cliente']['view'])){ ?>
								<a href="<?=base_url()?>clientes/ver-cliente/{{cliente.cliente_id}}" class="btn btn-edit btn-sm btn-primary mb-1"><i class="fa fa-fw fa-eye"></i></a>
							<?php } ?>
							<?php if(isset($permisos['cliente']['edit'])){ ?>
								<a href="<?=base_url()?>clientes/editar-cliente/{{cliente.cliente_id}}" class="btn btn-edit btn-sm btn-success mb-1"><i class="fa fa-fw fa-edit"></i></a></td>
							<?php } ?>
						<td>{{cliente.nombre_cliente}}</td>
						<td>{{cliente.cedula_cliente}}</td>
						<td>{{cliente.fecha_registro}}</td>
						<td>{{cliente.cliente_calificacion}}</td>
						<td ng-switch="cliente.estado_cliente"><span ng-switch-when="1">Activo</span><span ng-switch-when="0">Inactivo</span></td>
						<td class="d-none d-md-table-cell">
							<?php if(isset($permisos['cliente']['view'])){ ?>
								<a href="<?=base_url()?>clientes/ver-cliente/{{cliente.cliente_id}}" class="btn btn-edit btn-sm btn-primary mb-1"><i class="fa fa-fw fa-eye"></i></a>
							<?php } ?>
							<?php if(isset($permisos['cliente']['edit'])){ ?>
								<a href="<?=base_url()?>clientes/editar-cliente/{{cliente.cliente_id}}" class="btn btn-edit btn-sm btn-success mb-1"><i class="fa fa-fw fa-edit"></i></a></td>
							<?php } ?>
					</tr>
				</tbody>
			</table>
		</div>
		
	</div>
    <p class="text-right">Mostrando de {{(currentPage*cantidad_mostrar)+1}} a {{(currentPage*cantidad_mostrar)+cantidad_mostrar}} - Total: {{total_rows}}</p>
</div>

