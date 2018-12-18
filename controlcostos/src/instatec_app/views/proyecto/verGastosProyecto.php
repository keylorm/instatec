<script src="<?=base_url()?>src/instatec_pub/js/proyecto.js"></script>
<!-- Breadcrumbs-->
<ol class="breadcrumb">
	<li class="breadcrumb-item">
	  <a href="<?=base_url()?>">Inicio</a>
	</li>
	<li class="breadcrumb-item">
	  <a href="<?=base_url()?>proyectos">Proyectos</a>
	</li>
	<li class="breadcrumb-item">
		<a href="<?=base_url()?>proyectos/ver-proyecto/<?=$proyecto['proyecto_id']?>">Ver proyecto</a>
	</li>
	<li class="breadcrumb-item active">Gastos</li>
</ol>

<h1 class="text-center">Gastos de proyectos</h1>
<hr>


<div class="page-content" ng-controller="proyectoGastosController" ng-cloak ng-init="proyecto_id='<?=$proyecto['proyecto_id']?>'; consultarGastosProyecto();">
	
	<div class="row">
		<div class="col-12 col-md-6"><h3 class=" text-center text-md-left"><i class="fa fa-fw fa-table"></i> Lista de gastos</h3></div>
		<div class="col-12 col-md-6">
		<?php if(isset($permisos['proyecto_gastos']['create'])){ ?>
			<a class="btn btn-primary float-md-right mb-3 mr-md-3 mx-auto d-block d-md-inline-block" href="<?=base_url()?>proyectos/gastos/<?=$proyecto['proyecto_id']?>/agregar-gasto" role="button"><i class="fa fa-fw fa-plus-circle"></i> Agregar gasto</a> 
		<?php } ?>
		<a class="btn btn-primary float-md-right mb-3 mr-md-3 mx-auto d-block d-md-inline-block" href="<?=base_url()?>proyectos/ver-proyecto/<?=$proyecto['proyecto_id']?>" role="button"><i class="fa fa-fw fa-arrow-left"></i> Volver al proyecto</a></div>
	</div>

	<?php 
		
		if($this->input->get('nuevo')!=null && $this->input->get('nuevo')==1){ ?>
			<div class="alert alert-success alert-dismissable">Gasto registrado con éxito.</div>
		<?php  } 


		if($this->input->get('editar')!=null && $this->input->get('editar')==1){ ?>
			<div class="alert alert-success alert-dismissable">Gasto editado con éxito.</div>
		<?php  } 

    ?>
	
	<div class="card">
		<div class="card-header anchor-class" data-toggle="collapse" data-target="#filtroContainer" aria-expanded="false" aria-controls="collapseExample">
				<i class="fa fa-fw fa-filter"></i> Filtros <i class="fa float-right fa-plus-circle"></i>
        </div>
		<div class="card-body collapse" id="filtroContainer">			
			<div class="filtros">
				<form id="form-filtro">
					<div class="row">
						<div class="form-group col-12 col-md-6 col-lg-4">
							<label for="proyecto_gasto_tipo_id">Tipo de gasto:</label>
							<select class="form-control" name="proyecto_gasto_tipo_id" id="proyecto_gasto_tipo_id" aria-describedby="tipogastoHelp" required="true" ng-model="proyecto_gasto_tipo_id" ng-change="chosenSelect()">
								<option value="all">Todos</option>
								<?php foreach($gasto_tipo as $kgasto => $vgasto){ ?>
									<option value="<?=$vgasto['proyecto_gasto_tipo_id']?>"><?=$vgasto['proyecto_gasto_tipo']?></option>
								<?php } ?>
							</select>
						</div>

						<div class="form-group col-12 col-md-6 col-lg-4">
							<label for="fecha_registro">Fecha de registro de gasto:</label>
							<div class="input-group input-daterange">
									<input type="text" name="fecha_registro[from]" class="form-control" ng-model="fecha_registro_from" >
									<div class="input-group-addon"> a </div>
									<input type="text" name="fecha_registro[to]" class="form-control" ng-model="fecha_registro_to" >
							</div>
							<!--<input type="text" name="fecha_registro" class="form-control datepicker" id="fecha_registro" aria-describedby="fechafirmaHelp" >-->
							
						</div>	
						<div class="form-group col-12 col-md-6 col-lg-4">
							<label for="fecha_gasto">Fecha de gasto:</label>
							<div class="input-group input-daterange">
									<input type="text" name="fecha_gasto[from]" class="form-control" ng-model="fecha_gasto_from" >
									<div class="input-group-addon"> a </div>
									<input type="text" name="fecha_gasto[to]" class="form-control" ng-model="fecha_gasto_to" >
							</div>
							<!--<input type="text" name="fecha_gasto" class="form-control datepicker" id="fecha_gasto" aria-describedby="fechafirmaHelp" >-->
							
						</div>	
					</div>
					<div class="row">

						<div class="form-group col-12 col-md-6 col-lg-4">
							<label for="proveedor_id">Proveedor:</label>
							<select class="form-control chosen-select" data-placeholder="Seleccione una opción..." name="proveedor_id" id="proveedor_id" aria-describedby="proveedorHelp" required="true" ng-model="proveedor_id">
								<option value=""></option>
								<option value="all">Todos</option>
								<?php foreach($proveedores as $kproveedor => $vproveedor){ ?>
									<option value="<?=$vproveedor['proveedor_id']?>"><?=$vproveedor['nombre_proveedor']?></option>
								<?php } ?>
							</select>						
						</div>

						<div class="form-group col-12 col-md-6 col-lg-4">
							<label for="numero_factura">Número de factura</label>
							<input type="text" name="numero_factura" class="form-control" id="numero_factura" aria-describedby="nombreHelp" ng-model="numero_factura">
							</small>
						</div>	

						<div class="form-group col-12 col-md-6 col-lg-4">
							<label for="proyecto_gasto_estado_id">Estado del gasto:</label>
							<select class="form-control "  name="proyecto_gasto_estado_id" id="proyecto_gasto_estado_id" aria-describedby="gastoestadoHelp" required="true" ng-model="proyecto_gasto_estado_id">
								<option value="all">Todos</option>
								<?php foreach($gasto_estados as $kestado => $vestado){ ?>
									<option value="<?=$vestado['proyecto_gasto_estado_id']?>"><?=$vestado['proyecto_gasto_estado']?></option>
								<?php } ?>
							</select>						
						</div>	

						

						
					</div>

					<div class="row">
						<div class="col-12 col-md-6 col-lg-3">
							<button  class="btn btn-primary form-submit" ng-click="consultarGastosProyecto()">Filtrar</button>
							<button  class="btn btn-outline-primary form-submit" ng-click="limpiarFiltro()">Limpiar Filtrado</button>
						</div>
						
					</div>
				
				</form>
			</div>
		</div>
	</div>


	<div ng-if="gastos!==false" class="table-espaciado">

		<div class="table-responsive">
	        <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
	            <thead class="thead-light">
			        <tr>
			        	<th class="d-md-none">Acciones</th>
						<th>Fecha de gasto</th>
						<th>Tipo de gasto</th>
						<th>Monto</th>
						<th>Proveedor</th>
						<th>N° Factura</th>
						<th>Estado</th>
						<th class="d-none d-md-table-cell">Acciones</th>
					</tr>
				</thead>
				<tfoot ng-if="total_rows > cantidad_mostrar">
                	<td colspan="7">
                    	<nav aria-label="Page navigation example">
	                        <ul class="pagination pull-right">
                                <li class="page-item"><button class="page-link" ng-disabled="validarPrev()" ng-click="pagePrev()">Anterior</button></li>					
								<li class="page-item"><button class="page-link" ng-disabled="validarNext()" ng-click="pageNext()">Siguiente</button></li>

                            </ul>
	                    </nav>
                    </td>
				</tfoot>
				<tbody>
					<tr class="valor-oferta-item" ng-repeat="gasto in gastos  | limitTo : cantidad_mostrar : currentPage*cantidad_mostrar">
						<td  class="d-md-none">
							<?php if(isset($permisos['proyecto_gastos']['edit'])){ ?>
								<a ng-if="gasto.proyecto_gasto_tipo_id!=4 && gasto.tiene_desgloce==0" href="<?=base_url()?>proyectos/gastos/<?=$proyecto['proyecto_id']?>/editar-gasto/{{gasto.proyecto_gasto_id}}" class="btn btn-sm btn-edit btn-success  mb-1"><i class="fa fa-fw fa-edit"></i></a> 
								<a ng-if="gasto.proyecto_gasto_tipo_id!=4 && gasto.tiene_desgloce==1  && gasto.proyecto_gasto_tipo_id == 2" href="<?=base_url()?>proyectos/colaboradores/<?=$proyecto['proyecto_id']?>/registrar-tiempo-colaboradores?gasto_id={{gasto.proyecto_gasto_id}}" class="btn btn-sm btn-edit btn-success  mb-1"><i class="fa fa-fw fa-edit"></i></a>
								<a ng-if="gasto.proyecto_gasto_tipo_id!=4 && gasto.tiene_desgloce==1  && gasto.proyecto_gasto_tipo_id == 1" href="<?=base_url()?>proyectos/materiales/<?=$proyecto['proyecto_id']?>/solicitudes-compra-materiales/{{gasto.proyecto_material_solicitud_compra_id}}/ordenes-compra/" class="btn btn-sm btn-edit btn-success  mb-1"><i class="fa fa-fw fa-edit"></i></a>
							<?php } ?>
							<?php if(isset($permisos['proyecto_gastos']['delete'])){ ?>
								<a class="btn btn-sm btn-danger  mb-1" href="#" data-toggle="modal" ng-if="gasto.proyecto_gasto_tipo_id!=4" data-target="#deleteModal1{{gasto.proyecto_gasto_id}}"><i class="fa fa-fw fa-trash-o"></i></a>
								<!-- Modal -->
								<div class="modal fade" id="deleteModal1{{gasto.proyecto_gasto_id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="deleteModalLabel">¿Está seguro que desea eliminar este gasto?</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											Una vez eliminado el gasto, no se podrá recuperar su información. 
											<br><br>
											Ingrese la palabra <strong>"eliminar"</strong> en el siguiente campo de texto para confirmar que está seguro de esta acción:
											<br><input ng-model="confirm_delete" type="text">
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
											<button type="button" ng-disabled="confirm_delete!='eliminar'" class="btn btn-danger" ng-click="borrarRow(gasto.proyecto_gasto_id)"><i class="fa fa-fw fa-trash-o"></i> Eliminar</button>
										</div>
									</div>
									</div>
								</div>

							<?php } ?>
						</td>
						<td>
							<a ng-if="gasto.tiene_desgloce==0" href="<?=base_url()?>proyectos/gastos/<?=$proyecto['proyecto_id']?>/editar-gasto/{{gasto.proyecto_gasto_id}}">{{gasto.fecha_gasto}}</a>
							<a ng-if="gasto.tiene_desgloce==1 && gasto.proyecto_gasto_tipo_id == 2" href="<?=base_url()?>proyectos/colaboradores/<?=$proyecto['proyecto_id']?>/registrar-tiempo-colaboradores?gasto_id={{gasto.proyecto_gasto_id}}">{{gasto.fecha_gasto}}</a>
							<a ng-if="gasto.tiene_desgloce==1 && gasto.proyecto_gasto_tipo_id == 1" href="<?=base_url()?>proyectos/materiales/<?=$proyecto['proyecto_id']?>/solicitudes-compra-materiales/{{gasto.proyecto_material_solicitud_compra_id}}/ordenes-compra">{{gasto.fecha_gasto}}</a>
						</td>
						<td>
							<a ng-if="gasto.tiene_desgloce==0" href="<?=base_url()?>proyectos/gastos/<?=$proyecto['proyecto_id']?>/editar-gasto/{{gasto.proyecto_gasto_id}}">{{(gasto.tiene_desgloce==1)?gasto.proyecto_gasto_tipo+' *':gasto.proyecto_gasto_tipo}}</a>
							<a ng-if="gasto.tiene_desgloce==1 && gasto.proyecto_gasto_tipo_id == 2" href="<?=base_url()?>proyectos/colaboradores/<?=$proyecto['proyecto_id']?>/registrar-tiempo-colaboradores?gasto_id={{gasto.proyecto_gasto_id}}">{{(gasto.tiene_desgloce==1)?gasto.proyecto_gasto_tipo+' *':gasto.proyecto_gasto_tipo}}</a>
							<a ng-if="gasto.tiene_desgloce==1 && gasto.proyecto_gasto_tipo_id == 1" href="<?=base_url()?>proyectos/materiales/<?=$proyecto['proyecto_id']?>/solicitudes-compra-materiales/{{gasto.proyecto_material_solicitud_compra_id}}/ordenes-compra">{{(gasto.tiene_desgloce==1)?gasto.proyecto_gasto_tipo+' *':gasto.proyecto_gasto_tipo}}</a>
						</td>
						<td>
							<a ng-if="gasto.tiene_desgloce==0" href="<?=base_url()?>proyectos/gastos/<?=$proyecto['proyecto_id']?>/editar-gasto/{{gasto.proyecto_gasto_id}}">{{gasto.proyecto_gasto_monto | currency:gasto.simbolo+" " }}</a>
							<a ng-if="gasto.tiene_desgloce==1 && gasto.proyecto_gasto_tipo_id == 2" href="<?=base_url()?>proyectos/colaboradores/<?=$proyecto['proyecto_id']?>/registrar-tiempo-colaboradores?gasto_id={{gasto.proyecto_gasto_id}}">{{gasto.proyecto_gasto_monto | currency:gasto.simbolo+" " }}</a>
							<a ng-if="gasto.tiene_desgloce==1 && gasto.proyecto_gasto_tipo_id == 1" href="<?=base_url()?>proyectos/materiales/<?=$proyecto['proyecto_id']?>/solicitudes-compra-materiales/{{gasto.proyecto_material_solicitud_compra_id}}/ordenes-compra">{{gasto.proyecto_gasto_monto | currency:gasto.simbolo+" " }}</a>
						</td>
						<td>
							<a ng-if="gasto.tiene_desgloce==0" href="<?=base_url()?>proyectos/gastos/<?=$proyecto['proyecto_id']?>/editar-gasto/{{gasto.proyecto_gasto_id}}">{{gasto.nombre_proveedor}}</a>
							<a ng-if="gasto.tiene_desgloce==1 && gasto.proyecto_gasto_tipo_id == 2" href="<?=base_url()?>proyectos/colaboradores/<?=$proyecto['proyecto_id']?>/registrar-tiempo-colaboradores?gasto_id={{gasto.proyecto_gasto_id}}">{{gasto.nombre_proveedor}}</a>
							<a ng-if="gasto.tiene_desgloce==1 && gasto.proyecto_gasto_tipo_id == 1" href="<?=base_url()?>proyectos/materiales/<?=$proyecto['proyecto_id']?>/solicitudes-compra-materiales/{{gasto.proyecto_material_solicitud_compra_id}}/ordenes-compra">{{gasto.nombre_proveedor}}</a>
						</td>
						<td>
							<a ng-if="gasto.tiene_desgloce==0" href="<?=base_url()?>proyectos/gastos/<?=$proyecto['proyecto_id']?>/editar-gasto/{{gasto.proyecto_gasto_id}}">{{gasto.numero_factura}}</a>
							<a ng-if="gasto.tiene_desgloce==1 && gasto.proyecto_gasto_tipo_id == 2" href="<?=base_url()?>proyectos/colaboradores/<?=$proyecto['proyecto_id']?>/registrar-tiempo-colaboradores?gasto_id={{gasto.proyecto_gasto_id}}">{{gasto.numero_factura}}</a>
							<a ng-if="gasto.tiene_desgloce==1 && gasto.proyecto_gasto_tipo_id == 1" href="<?=base_url()?>proyectos/materiales/<?=$proyecto['proyecto_id']?>/solicitudes-compra-materiales/{{gasto.proyecto_material_solicitud_compra_id}}/ordenes-compra">{{gasto.numero_factura}}</a>
						</td>
						<td>
							<a ng-if="gasto.tiene_desgloce==0" href="<?=base_url()?>proyectos/gastos/<?=$proyecto['proyecto_id']?>/editar-gasto/{{gasto.proyecto_gasto_id}}">{{gasto.proyecto_gasto_estado}}</a>
							<a ng-if="gasto.tiene_desgloce==1 && gasto.proyecto_gasto_tipo_id == 2" href="<?=base_url()?>proyectos/colaboradores/<?=$proyecto['proyecto_id']?>/registrar-tiempo-colaboradores?gasto_id={{gasto.proyecto_gasto_id}}">{{gasto.proyecto_gasto_estado}}</a>
							<a ng-if="gasto.tiene_desgloce==1 && gasto.proyecto_gasto_tipo_id == 1" href="<?=base_url()?>proyectos/materiales/<?=$proyecto['proyecto_id']?>/solicitudes-compra-materiales/{{gasto.proyecto_material_solicitud_compra_id}}/ordenes-compra">{{gasto.proyecto_gasto_estado}}</a>
						</td>
						<td  class="d-none d-md-table-cell">
							<?php if(isset($permisos['proyecto_gastos']['edit'])){ ?>
								<a ng-if="gasto.proyecto_gasto_tipo_id!=4 && gasto.tiene_desgloce==0" href="<?=base_url()?>proyectos/gastos/<?=$proyecto['proyecto_id']?>/editar-gasto/{{gasto.proyecto_gasto_id}}" class="btn btn-sm btn-edit btn-success  mb-1"><i class="fa fa-fw fa-edit"></i></a> 
								<a ng-if="gasto.proyecto_gasto_tipo_id!=4 && gasto.tiene_desgloce==1 && gasto.proyecto_gasto_tipo_id == 2" href="<?=base_url()?>proyectos/colaboradores/<?=$proyecto['proyecto_id']?>/registrar-tiempo-colaboradores?gasto_id={{gasto.proyecto_gasto_id}}" class="btn btn-sm btn-edit btn-success  mb-1"><i class="fa fa-fw fa-edit"></i></a>
								<a ng-if="gasto.proyecto_gasto_tipo_id!=4 && gasto.tiene_desgloce==1 && gasto.proyecto_gasto_tipo_id == 1" href="<?=base_url()?>proyectos/materiales/<?=$proyecto['proyecto_id']?>/solicitudes-compra-materiales/{{gasto.proyecto_material_solicitud_compra_id}}/ordenes-compra" class="btn btn-sm btn-edit btn-success  mb-1"><i class="fa fa-fw fa-edit"></i></a>
							<?php } ?>
							<?php if(isset($permisos['proyecto_gastos']['delete'])){ ?>
								<a class="btn btn-sm btn-danger  mb-1" href="#" ng-if="gasto.proyecto_gasto_tipo_id!=4" data-toggle="modal" data-target="#deleteModal2{{gasto.proyecto_gasto_id}}"><i class="fa fa-fw fa-trash-o"></i></a>
								<!-- Modal -->
								<div class="modal fade" id="deleteModal2{{gasto.proyecto_gasto_id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
									  <div class="modal-header">
									    <h5 class="modal-title" id="deleteModalLabel">¿Está seguro que desea eliminar esta extensión?</h5>
									    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
									      <span aria-hidden="true">&times;</span>
									    </button>
									  </div>
									  <div class="modal-body">
									    Una vez eliminado el gasto, no se podrá recuperar su información. 
											<br><br>
											Ingrese la palabra <strong>"eliminar"</strong> en el siguiente campo de texto para confirmar que está seguro de esta acción:
											<br><input ng-model="confirm_delete" type="text">
									  </div>
									  <div class="modal-footer">
									    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
									    <button type="button" ng-disabled="confirm_delete!='eliminar'" class="btn btn-danger" ng-click="borrarRow(gasto.proyecto_gasto_id)"><i class="fa fa-fw fa-trash-o"></i> Eliminar</button>
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
		<p class="text-right">Mostrando de {{(currentPage*cantidad_mostrar)+1}} a {{(currentPage*cantidad_mostrar)+cantidad_mostrar}} - Total: {{total_rows}}</p>
		<p class="text-left">* Gasto con desgloce</p>
	</div>

	
	<p ng-if="gastos===false" class="text-center table-espaciado">No hay gastos registrados aún<br>
		<a class="btn btn-primary mt-4" href="<?=base_url()?>proyectos/gastos/<?=$proyecto['proyecto_id']?>/agregar-gasto" role="button"><i class="fa fa-fw fa-plus-circle"></i> Agregar gasto</a>
	</p>

</div>