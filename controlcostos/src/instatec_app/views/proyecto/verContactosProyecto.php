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
	<li class="breadcrumb-item active">Contactos</li>
</ol>

<h1 class="text-center">Contactos de proyectos</h1>
<hr>


<div class="page-content" ng-controller="proyectoContactosController" ng-cloak ng-init="proyecto_id='<?=$proyecto['proyecto_id']?>'; consultarContactosProyecto();">
	
	<div class="row">
		<div class="col-12 col-md-6"><h3 class=" text-center text-md-left"><i class="fa fa-fw fa-table"></i> Lista de contactos</h3></div>
		<div class="col-12 col-md-6">
		<?php if(isset($permisos['proyecto_contactos']['create'])){ ?>
			<a class="btn btn-primary float-md-right mb-3 mr-md-3 mx-auto d-block d-md-inline-block" href="<?=base_url()?>proyectos/contactos/<?=$proyecto['proyecto_id']?>/agregar-contacto" role="button"><i class="fa fa-fw fa-plus-circle"></i> Agregar contacto</a> 
		<?php } ?>
		<a class="btn btn-primary float-md-right mb-3 mr-md-3 mx-auto d-block d-md-inline-block" href="<?=base_url()?>proyectos/ver-proyecto/<?=$proyecto['proyecto_id']?>" role="button"><i class="fa fa-fw fa-arrow-left"></i> Volver al proyecto</a></div>
	</div>

	<?php 
		
		if($this->input->get('nuevo')!=null && $this->input->get('nuevo')==1){ ?>
			<div class="alert alert-success alert-dismissable">Contacto registrado con éxito.</div>
		<?php  } 


		if($this->input->get('editar')!=null && $this->input->get('editar')==1){ ?>
			<div class="alert alert-success alert-dismissable">Contacto editado con éxito.</div>
		<?php  } 

    ?>

	<div ng-if="contactos!==false" class="table-espaciado">

		<div class="table-responsive">
	        <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
	            <thead class="thead-light">
			        <tr>
			        	<th class="d-md-none">Acciones</th>
						<th>Nombre</th>
						<th>Correo electrónico</th>
						<th>Teléfono 1</th>
						<th>Teléfono 2</th>
						<th class="d-none d-md-table-cell">Acciones</th>
					</tr>
				</thead>
				<tbody>
					<tr class="contacto-item" ng-repeat="contacto in contactos">
						<td  class="d-md-none">
							<?php if(isset($permisos['proyecto_contactos']['edit'])){ ?>
								<a href="<?=base_url()?>proyectos/contactos/<?=$proyecto['proyecto_id']?>/editar-contacto/{{contacto.contacto_id}}" class="btn btn-sm btn-edit btn-success  mb-1"><i class="fa fa-fw fa-edit"></i></a> 
							<?php } ?>
							<?php if(isset($permisos['proyecto_contactos']['delete'])){ ?>
								<a class="btn btn-sm btn-danger  mb-1" href="#" data-toggle="modal" data-target="#deleteModal1{{contacto.contacto_id}}"><i class="fa fa-fw fa-trash-o"></i></a>
								<!-- Modal -->
								<div class="modal fade" id="deleteModal1{{contacto.contacto_id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="deleteModalLabel">¿Está seguro que desea eliminar este contacto?</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											Una vez eliminado el contacto, no se podrá recuperar su información. 
											<br><br>
											Ingrese la palabra <strong>"eliminar"</strong> en el siguiente campo de texto para confirmar que está seguro de esta acción:
											<br><input ng-model="confirm_delete" type="text">
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
											<button type="button" ng-disabled="confirm_delete!='eliminar'" class="btn btn-danger" ng-click="borrarRow(contacto.contacto_id)"><i class="fa fa-fw fa-trash-o"></i> Eliminar</button>
										</div>
									</div>
									</div>
								</div>

							<?php } ?>
						</td>
						<td>
							<a href="<?=base_url()?>proyectos/contactos/<?=$proyecto['proyecto_id']?>/editar-contacto/{{contacto.contacto_id}}">{{contacto.nombre_contacto}}</a>
						</td>
						<td>
							<a href="<?=base_url()?>proyectos/contactos/<?=$proyecto['proyecto_id']?>/editar-contacto/{{contacto.contacto_id}}">{{contacto.correo_contacto}}</a>
						</td>
						<td>
							<a href="<?=base_url()?>proyectos/contactos/<?=$proyecto['proyecto_id']?>/editar-contacto/{{contacto.contacto_id}}">{{contacto.telefono_contacto_1}}</a>
						</td>
						<td>
							<a href="<?=base_url()?>proyectos/contactos/<?=$proyecto['proyecto_id']?>/editar-contacto/{{contacto.contacto_id}}">{{contacto.telefono_contacto_2}}</a>
						</td>
						
						<td  class="d-none d-md-table-cell">
							<?php if(isset($permisos['proyecto_contactos']['edit'])){ ?>
								<a  href="<?=base_url()?>proyectos/contactos/<?=$proyecto['proyecto_id']?>/editar-contacto/{{contacto.contacto_id}}" class="btn btn-sm btn-edit btn-success  mb-1"><i class="fa fa-fw fa-edit"></i></a> 
								<?php } ?>
							<?php if(isset($permisos['proyecto_contactos']['delete'])){ ?>
								<a class="btn btn-sm btn-danger  mb-1" href="#"  data-toggle="modal" data-target="#deleteModal2{{contacto.contacto_id}}"><i class="fa fa-fw fa-trash-o"></i></a>
								<!-- Modal -->
								<div class="modal fade" id="deleteModal2{{contacto.contacto_id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
									  <div class="modal-header">
									    <h5 class="modal-title" id="deleteModalLabel">¿Está seguro que desea eliminar este contacto?</h5>
									    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
									      <span aria-hidden="true">&times;</span>
									    </button>
									  </div>
									  <div class="modal-body">
									    Una vez eliminado el contacto, no se podrá recuperar su información. 
											<br><br>
											Ingrese la palabra <strong>"eliminar"</strong> en el siguiente campo de texto para confirmar que está seguro de esta acción:
											<br><input ng-model="confirm_delete" type="text">
									  </div>
									  <div class="modal-footer">
									    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
									    <button type="button" ng-disabled="confirm_delete!='eliminar'" class="btn btn-danger" ng-click="borrarRow(contacto.contacto_id)"><i class="fa fa-fw fa-trash-o"></i> Eliminar</button>
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

	
	<p ng-if="contactos===false" class="text-center table-espaciado">No hay contacto registrados aún<br>
		<a class="btn btn-primary mt-4" href="<?=base_url()?>proyectos/contactos/<?=$proyecto['proyecto_id']?>/agregar-contacto" role="button"><i class="fa fa-fw fa-plus-circle"></i> Agregar contacto</a>
	</p>

</div>