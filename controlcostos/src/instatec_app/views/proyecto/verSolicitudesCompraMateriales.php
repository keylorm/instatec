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
	<li class="breadcrumb-item">
		<a href="<?=base_url()?>proyectos/materiales/<?=$proyecto['proyecto_id']?>">Materiales</a>
	</li>
	<li class="breadcrumb-item active">Solicitudes de compra de materiales</li>
</ol>

<h1 class="text-center "><i class="fa fa-fw fa-wrench"></i> Materiales de proyecto</h1>
<hr>


<div class="page-content" ng-controller="proyectoVerSolicitudesCompraMaterialesController" ng-cloak ng-init="proyecto_id='<?=$proyecto['proyecto_id']?>'; consultarSolicitudes();">
	<div class="row">
		<div class="col-12 col-md-12"><h3 class=" text-center text-md-left"><i class="fa fa-fw fa-table"></i> Solicitudes de compra de materiales</h3></div>
	</div>
	<div class="row">
		<div class="col-12 col-md-12">
			<?php if(isset($permisos['proyecto_materiales_solicitud_compra']['create'])){ ?>
				<a class="btn btn-sm btn-primary float-md-right mb-3 mr-md-3 mx-auto d-block d-md-inline-block" href="<?=base_url()?>proyectos/materiales/<?=$proyecto['proyecto_id']?>/solicitudes-compra-materiales/agregar" role="button"><i class="fa fa-fw fa-plus-circle"></i> Generar Solicitud</a> 
			<?php } ?>
			<a class="btn btn-sm btn-secondary float-md-right mb-3 mr-md-3 mx-auto d-block d-md-inline-block" href="<?=base_url()?>proyectos/materiales/<?=$proyecto['proyecto_id']?>" role="button"><i class="fa fa-fw fa-arrow-left"></i> Volver</a>
		</div>
	</div>

	<?php 
		
		if($this->input->get('nuevo')!=null && $this->input->get('nuevo')==1){ ?>
			<div class="alert alert-success alert-dismissable">Solicitud guardada con éxito.</div>
		<?php  } 

		if($this->input->get('editar')!=null && $this->input->get('editar')==1){ ?>
			<div class="alert alert-success alert-dismissable">Solicitud editada con éxito.</div>
		<?php  } 

    ?>

    
	
    <div class="listado-materiales">
        
        <h3 class="text-center mb-3">Lista de solicitudes</h3>
		<div ng-if="solicitudes_compra_materiales!==false" class="table-espaciado">
			<div class="table-responsive">
		        <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
		            <thead class="thead-light">
				        <tr>
				        	<th class="d-md-none">Acciones</th>
							<th>ID</th>
							<th>Fecha</th>
							<?php if (isset($permisos['proyecto_materiales_solicitud_compra']['edit'])) { ?>
								<th>Costo</th>
							<?php } ?>
							<th>Usuario</th>
							<th>Estado</th>
							<th class="d-none d-md-table-cell">Acciones</th>
						</tr>
					</thead>
		            <tbody>
		            	<tr class="material-item" ng-repeat="solicitud in solicitudes_compra_materiales">
		            		<td  class="d-md-none">
		            			<?php if(isset($permisos['proyecto_materiales_solicitud_compra']['view'])){ ?>
									<a href="<?=base_url()?>proyectos/materiales/<?=$proyecto['proyecto_id']?>/solicitudes-compra-materiales/{{solicitud.proyecto_material_solicitud_compra_id}}/ver" class="btn btn-sm btn-edit btn-primary  mb-1"><i class="fa fa-fw fa-eye"></i></a>
								<?php } ?>
								<?php if(isset($permisos['proyecto_materiales_solicitud_compra']['edit'])){ ?>
									<a ng-if="solicitud.proyecto_material_solicitud_compra_estado_id != 4" href="<?=base_url()?>proyectos/materiales/<?=$proyecto['proyecto_id']?>/solicitudes-compra-materiales/{{solicitud.proyecto_material_solicitud_compra_id}}/editar" class="btn btn-sm btn-edit btn-success  mb-1"><i class="fa fa-fw fa-edit"></i></a>
								<?php } ?>
								<?php if(isset($permisos['proyecto_materiales_solicitud_compra']['delete'])){ ?>
									<a class="btn btn-sm btn-danger  mb-1" href="#" data-toggle="modal" data-target="#deleteModal1{{solicitud.proyecto_material_solicitud_compra_id}}"><i class="fa fa-fw fa-trash-o"></i></a>
									<!-- Modal -->
									<div class="modal fade" id="deleteModal1{{solicitud.proyecto_material_solicitud_compra_id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
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
												<button type="button" ng-disabled="confirm_delete!='eliminar'" class="btn btn-danger" ng-click="borrarRow(solicitud.proyecto_material_solicitud_compra_id)"><i class="fa fa-fw fa-trash-o"></i> Eliminar</button>
											</div>
										</div>
										</div>
									</div>

								<?php } ?>
							</td>
		            		<td><a href="<?=base_url()?>proyectos/materiales/<?=$proyecto['proyecto_id']?>/solicitudes-compra-materiales/{{solicitud.proyecto_material_solicitud_compra_id}}/ver">{{solicitud.proyecto_material_solicitud_compra_id}}</a></td>
		            		<td><a href="<?=base_url()?>proyectos/materiales/<?=$proyecto['proyecto_id']?>/solicitudes-compra-materiales/{{solicitud.proyecto_material_solicitud_compra_id}}/ver">{{solicitud.fecha_registro}}</a></td>
							<?php if (isset($permisos['proyecto_materiales_solicitud_compra']['edit'])) { ?>
									<td><a href="<?=base_url()?>proyectos/materiales/<?=$proyecto['proyecto_id']?>/solicitudes-compra-materiales/{{solicitud.proyecto_material_solicitud_compra_id}}/ver">{{solicitud.costo_solicitud  | currency}}</a></td>
							<?php } ?>
							<td><a href="<?=base_url()?>proyectos/materiales/<?=$proyecto['proyecto_id']?>/solicitudes-compra-materiales/{{solicitud.proyecto_material_solicitud_compra_id}}/ver">{{solicitud.nombre+' '+solicitud.apellidos}}</a></td>
							<td><a href="<?=base_url()?>proyectos/materiales/<?=$proyecto['proyecto_id']?>/solicitudes-compra-materiales/{{solicitud.proyecto_material_solicitud_compra_id}}/ver">{{solicitud.proyecto_material_solicitud_compra_estado}}</a></td>
							<td  class="d-none d-md-table-cell">
								<?php if(isset($permisos['proyecto_materiales_solicitud_compra']['view'])){ ?>
									<a href="<?=base_url()?>proyectos/materiales/<?=$proyecto['proyecto_id']?>/solicitudes-compra-materiales/{{solicitud.proyecto_material_solicitud_compra_id}}/ver" class="btn btn-sm btn-edit btn-primary  mb-1"><i class="fa fa-fw fa-eye"></i></a>
								<?php } ?>
								<?php if(isset($permisos['proyecto_materiales_solicitud_compra']['edit'])){ ?>
									<a ng-if="solicitud.proyecto_material_solicitud_compra_estado_id != 4" href="<?=base_url()?>proyectos/materiales/<?=$proyecto['proyecto_id']?>/solicitudes-compra-materiales/{{solicitud.proyecto_material_solicitud_compra_id}}/editar" class="btn btn-sm btn-edit btn-success  mb-1"><i class="fa fa-fw fa-edit"></i></a>
								<?php } ?>
								<?php if(isset($permisos['proyecto_materiales_solicitud_compra']['delete'])){ ?>
									<a class="btn btn-sm btn-danger  mb-1" href="#" ng-if="solicitud.proyecto_gasto_tipo_id!=4" data-toggle="modal" data-target="#deleteModal2{{solicitud.proyecto_material_solicitud_compra_id}}"><i class="fa fa-fw fa-trash-o"></i></a>
									<!-- Modal -->
									<div class="modal fade" id="deleteModal2{{solicitud.proyecto_material_solicitud_compra_id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
										  <div class="modal-header">
										    <h5 class="modal-title" id="deleteModalLabel">¿Está seguro que desea eliminar esta solicitud de compra?</h5>
										    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
										      <span aria-hidden="true">&times;</span>
										    </button>
										  </div>
										  <div class="modal-body">
										    Una vez eliminado el registro, no se podrá recuperar su información y se alterará el total de gastos de materiales de este proyecto.
												<br><br>
												Ingrese la palabra <strong>"eliminar"</strong> en el siguiente campo de texto para confirmar que está seguro de esta acción:
												<br><input ng-model="confirm_delete" type="text">
										  </div>
										  <div class="modal-footer">
										    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
										    <button type="button" ng-disabled="confirm_delete!='eliminar'" class="btn btn-danger" ng-click="borrarRow(solicitud.proyecto_material_solicitud_compra_id)"><i class="fa fa-fw fa-trash-o"></i> Eliminar</button>
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


		<p ng-if="solicitudes_compra_materiales===false" class="text-center table-espaciado">No hay solicitudes generadas aún</p>
	</div>
</div>