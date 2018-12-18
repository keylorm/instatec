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
	<li class="breadcrumb-item active">Ordenes de cambio</li>
</ol>

<h1 class="text-center">Ordenes de cambio de proyectos</h1>
<hr>


<div class="page-content" ng-controller="proyectoExtensionesController" ng-cloak ng-init="proyecto_id='<?=$proyecto['proyecto_id']?>'; consultarExtensionesProyecto();">
	<?php if(isset($permisos['proyecto_tipos_orden_cambio']['list'])){ ?>
		<div class="row">
			<div class="col-12 col-md-10"></div>
			<div class="col-12 col-md-2 text-right dropdown  mb-3">
				<button class="btn btn-sm btn-secondary dropdown-toggle float-md-right mb-3 mx-auto d-block d-md-inline-block" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-fw fa-cog"></i> Configuración </button>
				<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
					<a class="dropdown-item" href="<?=base_url()?>proyectos/ordenes-cambio/tipos-orden-cambio">Tipos de orden de cambio</a>
				</div>
			</div>
			
		</div>
			
	<?php } ?>
	<div class="row ">
		<div class="col-12 col-md-6"><h3 class=" text-center text-md-left"><i class="fa fa-fw fa-table"></i> Lista de ordenes de cambio</h3></div>
		<div class="col-12 col-md-3">
			<a class="btn btn-sm btn-secondary float-md-right mb-3 mx-auto d-block d-md-inline-block" href="<?=base_url()?>proyectos/ver-proyecto/<?=$proyecto['proyecto_id']?>" role="button"><i class="fa fa-fw fa-arrow-left"></i> Volver al proyecto</a>
		</div>
		<div class="col-12 col-md-3 text-right ">
			<a class="btn btn-sm btn-primary float-md-right mb-3 mx-auto d-block d-md-inline-block" href="<?=base_url()?>proyectos/ordenes-cambio/<?=$proyecto['proyecto_id']?>/agregar-orden-cambio" role="button"><i class="fa fa-fw fa-plus-circle"></i> Agregar orden de cambio</a>
		</div>
	</div>

	<?php 
		
		if($this->input->get('nuevo')!=null && $this->input->get('nuevo')==1){ ?>
			<div class="alert alert-success alert-dismissable">Orden de cambio registrada con éxito.</div>
		<?php  } 

		if($this->input->get('editar')!=null && $this->input->get('editar')==1){ ?>
			<div class="alert alert-success alert-dismissable">Orden de cambio editada con éxito.</div>
		<?php  } 

    ?>

    <div class="card" ng-if="extensiones!==false">
    	<div class="card-header anchor-class" data-toggle="collapse" data-target="#filtroContainer" aria-expanded="false" aria-controls="collapseExample">
				<i class="fa fa-fw fa-filter"></i> Filtros <i class="fa float-right fa-plus-circle"></i>
        </div>
		<div class="card-body collapse" id="filtroContainer">			
			<div class="filtros">
				<form id="form-filtro">
					<div class="row">
						<div class="form-group col-12 col-md-3">
							<label for="proyecto_valor_oferta_extension_tipo_id">Tipo de orden de cambio:</label>
							<select class="form-control" name="proyecto_valor_oferta_extension_tipo_id" id="proyecto_valor_oferta_extension_tipo_id" aria-describedby="tipoextensionHelp" required="true" ng-model="proyecto_valor_oferta_extension_tipo_id">
								<option value="all">Todos</option>
								<?php foreach($extensiones_tipos as $kextension => $vextension){ ?>
									<option value="<?=$vextension['proyecto_valor_oferta_extension_tipo_id']?>"><?=$vextension['proyecto_valor_oferta_extension_tipo']?></option>
								<?php } ?>
							</select>
						</div>

						<div class="form-group col-12 col-md-3">
							<label for="fecha_registro">Fecha de registro de orden de cambio:</label>
							<div class="input-group input-daterange">
									<input type="text" name="fecha_registro[from]" class="form-control" ng-model="fecha_registro_from" >
									<div class="input-group-addon"> a </div>
									<input type="text" name="fecha_registro[to]" class="form-control" ng-model="fecha_registro_to" >
							</div>
							<!--<input type="text" name="fecha_registro" class="form-control datepicker" id="fecha_registro" aria-describedby="fechafirmaHelp" >-->
							
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

	<div ng-if="extensiones!==false" class="table-espaciado">
		<div class="table-responsive">
	        <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
	            <thead class="thead-light">
			        <tr>
			        	<th class="d-md-none">Acciones</th>
						<th>Fecha de orden de cambio</th>
						<th>Tipo de orden de cambio</th>
						<th>Monto</th>
						<th class="d-none d-md-table-cell">Acciones</th>
					</tr>
				</thead>
				<tfoot ng-if="total_rows > cantidad_mostrar">
                	<td colspan="4">
                    	<nav aria-label="Page navigation example">
	                        <ul class="pagination pull-right">
                                <li class="page-item"><button class="page-link" ng-disabled="validarPrev()" ng-click="pagePrev()">Anterior</button></li>					
								<li class="page-item"><button class="page-link" ng-disabled="validarNext()" ng-click="pageNext()">Siguiente</button></li>

                            </ul>
	                    </nav>
                    </td>
				</tfoot>
	            <tbody>
	            	<tr class="valor-oferta-item" ng-repeat="extension in extensiones  | limitTo : cantidad_mostrar : currentPage*cantidad_mostrar">
	            		<td  class="d-md-none"><a href="<?=base_url()?>proyectos/ordenes-cambio/<?=$proyecto['proyecto_id']?>/editar-orden-cambio/{{extension.proyecto_valor_oferta_id}}" class="btn btn-sm btn-edit btn-success  mb-1"><i class="fa fa-fw fa-edit"></i></a> 
							<?php if(isset($rol_id) && $rol_id==1){ ?>
								<a class="btn btn-sm btn-danger  mb-1" href="#" data-toggle="modal" data-target="#deleteModal1{{extension.proyecto_valor_oferta_id}}"><i class="fa fa-fw fa-trash-o"></i></a>
								<!-- Modal -->
								<div class="modal fade" id="deleteModal1{{extension.proyecto_valor_oferta_id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
									  <div class="modal-header">
									    <h5 class="modal-title" id="deleteModalLabel">¿Está seguro que desea eliminar esta orden de cambio?</h5>
									    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
									      <span aria-hidden="true">&times;</span>
									    </button>
									  </div>
									  <div class="modal-body">
									    Una vez eliminada la orden de cambio, no se podrá recuperar su información. 
											<br><br>
											Ingrese la palabra <strong>"eliminar"</strong> en el siguiente campo de texto para confirmar que está seguro de esta acción:
											<br><input ng-model="confirm_delete" type="text">
									  </div>
									  <div class="modal-footer">
									    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
									    <button type="button" ng-disabled="confirm_delete!='eliminar'" class="btn btn-danger" ng-click="borrarRow(extension.proyecto_valor_oferta_id)"><i class="fa fa-fw fa-trash-o"></i> Eliminar</button>
									  </div>
									</div>
									</div>
								</div>

							<?php } ?>
						</td>
						<td><a href="<?=base_url()?>proyectos/ordenes-cambio/<?=$proyecto['proyecto_id']?>/editar-orden-cambio/{{extension.proyecto_valor_oferta_id}}">{{extension.fecha_registro}}</a></td>
						<td><a href="<?=base_url()?>proyectos/ordenes-cambio/<?=$proyecto['proyecto_id']?>/editar-orden-cambio/{{extension.proyecto_valor_oferta_id}}">{{extension.proyecto_valor_oferta_extension_tipo}}</a></td>
						<td><a href="<?=base_url()?>proyectos/ordenes-cambio/<?=$proyecto['proyecto_id']?>/editar-orden-cambio/{{extension.proyecto_valor_oferta_id}}">{{extension.valor_oferta | currency }}</a></td>
						<td  class="d-none d-md-table-cell"><a href="<?=base_url()?>proyectos/ordenes-cambio/<?=$proyecto['proyecto_id'] ?>/editar-orden-cambio/{{extension.proyecto_valor_oferta_id}}" class="btn btn-sm btn-edit btn-success  mb-1"><i class="fa fa-fw fa-edit"></i></a> 
							<?php if(isset($rol_id) && $rol_id==1){ ?>
								<a class="btn btn-sm btn-danger  mb-1" href="#" data-toggle="modal" data-target="#deleteModal2{{extension.proyecto_valor_oferta_id}}"><i class="fa fa-fw fa-trash-o"></i></a>
								<!-- Modal -->
								<div class="modal fade" id="deleteModal2{{extension.proyecto_valor_oferta_id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
									  <div class="modal-header">
									    <h5 class="modal-title" id="deleteModalLabel">¿Está seguro que desea eliminar esta orden de cambio?</h5>
									    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
									      <span aria-hidden="true">&times;</span>
									    </button>
									  </div>
									  <div class="modal-body">
									    Una vez eliminada la orden de cambio, no se podrá recuperar su información. 
											<br><br>
											Ingrese la palabra <strong>"eliminar"</strong> en el siguiente campo de texto para confirmar que está seguro de esta acción:
											<br><input ng-model="confirm_delete" type="text">
									  </div>
									  <div class="modal-footer">
									    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
									    <button type="button" ng-disabled="confirm_delete!='eliminar'" class="btn btn-danger" ng-click="borrarRow(extension.proyecto_valor_oferta_id)"><i class="fa fa-fw fa-trash-o"></i> Eliminar</button>
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
	</div>

	
	<p ng-if="extensiones===false" class="text-center table-espaciado">No hay ordenes de cambio registradas aún<br>
		<a class="btn btn-primary mt-4" href="<?=base_url()?>proyectos/ordenes-cambio/<?=$proyecto['proyecto_id']?>/agregar-orden-cambio" role="button"><i class="fa fa-fw fa-plus-circle"></i> Agregar orden de cambio</a>
	</p>

</div>