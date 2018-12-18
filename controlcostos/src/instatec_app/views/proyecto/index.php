<script src="<?=base_url()?>src/instatec_pub/js/proyecto.js"></script>
<!-- Breadcrumbs-->
<ol class="breadcrumb">
	<li class="breadcrumb-item">
	  <a href="<?=base_url()?>">Inicio</a>
	</li>
	<li class="breadcrumb-item active">Proyectos</li>
</ol>

<h1 class="text-center"><i class="fa fa-fw fa-area-chart"></i> Proyectos</h1>
<hr>


<div class="page-content" ng-controller="proyectoController" ng-init="base_url='<?=base_url()?>'" ng-cloak>
	<div class="row">
		<div class="col-12 col-md-8"><h3 class=" text-center text-md-left"><i class="fa fa-fw fa-table"></i> Lista de proyectos</h3></div>
		<?php if(isset($permisos['proyecto']['create'])){ ?>
			<div class="col-12 col-md-2"><a class="btn btn-primary float-md-right mb-3 mr-md-3 mx-auto d-block d-md-inline-block" href="<?=base_url()?>proyectos/agregar-proyecto" role="button"><i class="fa fa-fw fa-plus-circle"></i> Agregar proyecto</a></div>
		<?php } ?>
		<?php if(isset($permisos['proyecto_tipos_orden_cambio']['list'])){ ?>
			<div class="col-12 col-md-2">
				<div class="dropdown">
					<button class="btn btn-secondary dropdown-toggle text-right" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-fw fa-cog"></i> Configuración </button>
					<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						<a class="dropdown-item" href="<?=base_url()?>proyectos/ordenes-cambio/tipos-orden-cambio">Tipos de orden de cambio</a>
					</div>
				</div>
				
			</div>
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
						<?php if($rol_id!=3 && $rol_id!=4){ ?>
							<div class="form-group col-12 col-md-3">
								<label for="cliente_id">Cliente del proyecto:</label>
								<select class="form-control chosen-select" data-placeholder="Seleccione una opción..." name="cliente_id" id="cliente_id" aria-describedby="clienteHelp" required="true" ng-model="cliente_id">
									<option value=""></option>
									<option value="all">Todos</option>
									<?php foreach($clientes as $kcliente => $vcliente){ ?>
										<option value="<?=$vcliente['cliente_id']?>"><?=$vcliente['nombre_cliente']?></option>
									<?php } ?>
								</select>
							</div>

						<?php }else if($rol_id==3){ ?>
							<div class="form-group col-12 col-md-3">
								<label>Estado del proyecto:</label>
								<select class="form-control select-required" name="proyecto_estado_id" id="proyecto_estado_id" ng-model="proyecto_estado_id">
									<option value="all" selected="selected">Todos</option>
									<?php foreach($proyecto_estados as $kproyecto_estado => $vproyecto_estado){ ?>
										<option value="<?=$vproyecto_estado['proyecto_estado_id']?>"><?=$vproyecto_estado['proyecto_estado']?></option>
									<?php } ?>
								</select>
								
							</div>
						<?php } ?>
					</div>
					

					<div class="row">
						<?php if($rol_id!=3 && $rol_id!=4){ ?>
							<div class="form-group col-12 col-md-3">
								<label>Estado del proyecto:</label>
								<select class="form-control select-required" name="proyecto_estado_id" id="proyecto_estado_id" ng-model="proyecto_estado_id">
									<option value="all" selected="selected">Todos</option>
									<?php foreach($proyecto_estados as $kproyecto_estado => $vproyecto_estado){ ?>
										<option value="<?=$vproyecto_estado['proyecto_estado_id']?>"><?=$vproyecto_estado['proyecto_estado']?></option>
									<?php } ?>
								</select>
								
							</div>
						<?php } ?>
						<div class="form-group col-12 col-md-3">
							<label for="provincia_id">Provincia:</label>
							<select class="form-control" name="provincia_id" id="provincia_id" aria-describedby="provinciaHelp" ng-model="provincia_id" ng-click="getCantones()" required="required">
								<option value="all" selected="selected">Todos</option>
								<?php foreach($provincias as $kprovincia => $vprovincia){ ?>
									<option value="<?=$vprovincia['provincia_id']?>"><?=$vprovincia['provincia']?></option>
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
					<?php if($rol_id!=3 && $rol_id!=4){ ?>
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
					<?php } ?>

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
	
	<div class="table-espaciado"  ng-if="proyectos!==false" >
		<div class="table-responsive">
	        <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
	            <thead class="thead-light">
			        <tr>
			        	<th class="d-md-none">Acciones</th>
						<th>Datos</th>
						<th>Cliente</th>
						<?php if($rol_id==1 || $rol_id==2){ ?>
							<th>Estado</th>
						<?php } ?>						
						<th>Ubicación</th>						
						<?php if($rol_id==1 || $rol_id==2){ ?>
							<th>Fechas reelevantes</th>
						<?php } ?>
						<th class="d-none d-md-table-cell">Acciones</th>
					</tr>
				</thead>
                <tfoot ng-if="total_rows > cantidad_mostrar">
                	<td colspan="<?=($rol_id==1 || $rol_id==2)?'6':'4'?>">
                	
                    	<nav aria-label="Page navigation example">
	                        <ul class="pagination pull-right">
                                <li class="page-item"><button class="page-link" ng-disabled="validarPrev()" ng-click="pagePrev()">Anterior</button></li>					
								<li class="page-item"><button class="page-link" ng-disabled="validarNext()" ng-click="pageNext()">Siguiente</button></li>

                            </ul>
	                        
	                    </nav>
                			
                		
                    </td>
				</tfoot>
	            <tbody>
					<tr ng-repeat="proyecto in proyectos | limitTo : cantidad_mostrar : currentPage*cantidad_mostrar">
						<td class="d-md-none">
							<?php if(isset($permisos['proyecto']['view'])){ ?>
								<a href="{{base_url}}proyectos/ver-proyecto/{{proyecto.proyecto_id}}" class="btn btn-edit btn-sm mb-1 btn-primary"><i class="fa fa-fw fa-eye"></i></a> 
							<?php } ?>
							<?php if(isset($permisos['proyecto']['edit'])){ ?>
								<a href="{{base_url}}proyectos/editar-proyecto/{{proyecto.proyecto_id}}" class="btn btn-edit btn-sm mb-1 btn-success"><i class="fa fa-fw fa-edit"></i></a> 
							<?php } ?> 
							<?php if(isset($permisos['reporte_proyecto_especifico']['view'])){ ?>
								<a href="{{base_url}}reportes/proyecto-especifico/{{proyecto.proyecto_id}}" class="btn btn-edit btn-sm mb-1 btn-secondary" target="_blank"><i class="fa fa-fw fa-download"></i></a>
							<?php } ?>
							<?php if(isset($permisos['proyecto']['delete'])){ ?>
								<a class="btn btn-sm mb-1 btn-danger" href="#" data-toggle="modal" data-target="#deleteModal1{{proyecto.proyecto_id}}"><i class="fa fa-fw fa-trash-o"></i></a>
								<!-- Modal -->
								<div class="modal fade" id="deleteModal1{{proyecto.proyecto_id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
									  <div class="modal-header">
									    <h5 class="modal-title" id="deleteModalLabel">¿Está seguro que desea eliminar este proyecto?</h5>
									    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
									      <span aria-hidden="true">&times;</span>
									    </button>
									  </div>
									  <div class="modal-body">
									    Se elimará toda la información relacionada a este proyecto, como gastos, valor de la oferta, registro de horas de trabajo, extensiones de valor de la oferta, etc. Una vez eliminada esta información, no podrá ser recuperada.
									  	<br><br>
										Ingrese la palabra <strong>"eliminar"</strong> en el siguiente campo de texto para confirmar que está seguro de esta acción:
										<br><input ng-model="confirm_delete" type="text">
									  </div>
									  <div class="modal-footer">
									    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
									    <button type="button" ng-disabled="confirm_delete!='eliminar'" class="btn btn-danger" ng-click="borrarRow(proyecto.proyecto_id)"><i class="fa fa-fw fa-trash-o"></i> Eliminar</button>
									  </div>
									</div>
									</div>
								</div>
							<?php } ?>
	
						</td>
						<td><?=(isset($permisos['proyecto']['view']))?'<a href="{{base_url}}proyectos/ver-proyecto/{{proyecto.proyecto_id}}">':''?><strong>Nombre: {{proyecto.nombre_proyecto}}</strong><br>N° Contrato: {{proyecto.numero_contrato}}<br>Orden de compra: {{proyecto.orden_compra}}<?=(isset($permisos['proyecto']['view']))?'</a>':''?></td>
						<td><?=(isset($permisos['proyecto']['view']))?'<a href="{{base_url}}proyectos/ver-proyecto/{{proyecto.proyecto_id}}">':''?>{{proyecto.nombre_cliente}}<?=(isset($permisos['proyecto']['view']))?'</a>':''?></td>
						<?php if($rol_id==1 || $rol_id==2){ ?>
							<td><?=(isset($permisos['proyecto']['view']))?'<a href="{{base_url}}proyectos/ver-proyecto/{{proyecto.proyecto_id}}">':''?>{{proyecto.proyecto_estado}}<?=(isset($permisos['proyecto']['view']))?'</a>':''?></td>
						<?php } ?>
							<td><?=(isset($permisos['proyecto']['view']))?'<a href="{{base_url}}proyectos/ver-proyecto/{{proyecto.proyecto_id}}">':''?>Provincia: {{proyecto.provincia}}<br>Cantón: {{proyecto.canton}}<br>Distrito: {{proyecto.distrito}}<?=(isset($permisos['proyecto']['view']))?'</a>':''?></td>
						<?php if($rol_id==1 || $rol_id==2){ ?>
							<td><?=(isset($permisos['proyecto']['view']))?'<a href="{{base_url}}proyectos/ver-proyecto/{{proyecto.proyecto_id}}">':''?>Firma de contrato: {{proyecto.fecha_firma_contrato}}<br>Inicio: {{proyecto.fecha_inicio}}<br>Entrega: {{proyecto.fecha_entrega_estimada}}<?=(isset($permisos['proyecto']['view']))?'</a>':''?></td>
						<?php } ?>
						<td class="d-none d-md-table-cell">
							<?php if(isset($permisos['proyecto']['view'])){ ?>
								<a href="{{base_url}}proyectos/ver-proyecto/{{proyecto.proyecto_id}}" class="btn btn-edit btn-sm mb-1 btn-primary"><i class="fa fa-fw fa-eye"></i></a> 
							<?php } ?>
							<?php if(isset($permisos['proyecto']['edit'])){ ?>
								<a href="{{base_url}}proyectos/editar-proyecto/{{proyecto.proyecto_id}}" class="btn btn-edit btn-sm mb-1 btn-success"><i class="fa fa-fw fa-edit"></i></a> 
							<?php } ?>	
							<?php if(isset($permisos['reporte_proyecto_especifico']['view'])){ ?>
								<a href="{{base_url}}reportes/proyecto-especifico/{{proyecto.proyecto_id}}" class="btn btn-edit btn-sm mb-1 btn-secondary" target="_blank"><i class="fa fa-fw fa-download"></i></a>
							<?php } ?>
							<?php if(isset($permisos['proyecto']['delete'])){ ?>
								<a class="btn btn-sm mb-1 btn-danger" href="#" data-toggle="modal" data-target="#deleteModal2{{proyecto.proyecto_id}}"><i class="fa fa-fw fa-trash-o"></i></a>
								<!-- Modal -->
								<div class="modal fade" id="deleteModal2{{proyecto.proyecto_id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
									  <div class="modal-header">
									    <h5 class="modal-title" id="deleteModalLabel">¿Está seguro que desea eliminar este proyecto?</h5>
									    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
									      <span aria-hidden="true">&times;</span>
									    </button>
									  </div>
									  <div class="modal-body">
									    Se elimará toda la información relacionada a este proyecto, como gastos, valor de la oferta, registro de horas de trabajo, extensiones de valor de la oferta, etc. Una vez eliminada esta información, no podrá ser recuperada.
									  	<br><br>
										Ingrese la palabra <strong>"eliminar"</strong> en el siguiente campo de texto para confirmar que está seguro de esta acción:
										<br><input ng-model="confirm_delete" type="text">
									  </div>
									  <div class="modal-footer">
									    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
									    <button type="button" ng-disabled="confirm_delete!='eliminar'" class="btn btn-danger" ng-click="borrarRow(proyecto.proyecto_id)"><i class="fa fa-fw fa-trash-o"></i> Eliminar</button>
									  </div>
									</div>
									</div>
								</div>
							<?php } ?>
	
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		
	</div>
    <p class="text-right"   ng-if="proyectos!==false">Mostrando de {{(currentPage*cantidad_mostrar)+1}} a {{(currentPage*cantidad_mostrar)+cantidad_mostrar}} - Total: {{total_rows}}</p>
	<p ng-if="proyectos===false" class="text-center table-espaciado">No hay proyectos registrados aún</p>
</div>
