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
		<a href="<?=base_url()?>proyectos/ordenes-cambio/<?=$proyecto['proyecto_id']?>">Ordenes de cambio</a>
	</li>
	<li class="breadcrumb-item active">Editar orden de cambio</li>
</ol>

<h1 class="text-center">Ordenes de cambio de proyectos</h1>
<hr>

<div class="row">
	<div class="col-12 col-md-10"><h3 class=" text-center text-md-left"><i class="fa fa-fw fa-edit"></i> Editar orden de cambio</h3></div>
	<div class="col-12 col-md-2"><a class="btn btn-primary float-md-right mb-3 mr-md-3 mx-auto d-block d-md-inline-block" href="<?=base_url()?>proyectos/ordenes-cambio/<?=$proyecto['proyecto_id']?>" role="button"><i class="fa fa-fw fa-arrow-left"></i> Volver a ordenes de cambio</a></div>
</div>


<div class="page-content" ng-cloak ng-controller="editarExtensionProyecto" ng-init="proyecto_id=<?=$proyecto['proyecto_id']?>; proyecto_valor_oferta_id=<?=$proyecto_extension['proyecto_valor_oferta_id']?>; <?=((isset($proyecto_extension['tiene_impuesto']))?'tiene_impuesto='.$proyecto_extension['tiene_impuesto'].';':'')?> <?=((isset($proyecto_extension['proyecto_valor_oferta_extension_estado_id']))?'proyecto_valor_oferta_extension_estado_id='.$proyecto_extension['proyecto_valor_oferta_extension_estado_id'].';':'')?> consultarExtensionCambiosProyecto();">
	<?php 
		if(validation_errors()){ ?>
    		<div class="alert alert-danger alert-dismissable"><?php echo validation_errors(); ?></div>
    <?php 
		} 

		if(isset($msg)){
			foreach ($msg as $kmsg => $vmsg) { ?>
				<div class="alert alert-<?=$vmsg['tipo']?> alert-dismissable"><?=$vmsg['texto']?></div>
			<?php
			}
		}

    ?>

	<?php 
		
		if($this->input->get('nuevo')!=null && $this->input->get('nuevo')==1){ ?>
			<div class="alert alert-success alert-dismissable">Cambio registrada con éxito.</div>
		<?php  } 

		if($this->input->get('editar')!=null && $this->input->get('editar')==1){ ?>
			<div class="alert alert-success alert-dismissable">Cambio editada con éxito.</div>
		<?php  } 

    ?>

	<form id="editarExtensionProyecto" class="form-validation" method="post" name="editarExtensionProyecto">
		<div class="card mb-3">
	        <div class="card-header">
	          	Información de la orden de cambio</div>
	        <div class="card-body">
	        	<div class="row">
					<?php 
					if ($rol_id != 3) { ?>
						<div class="col-12 col-md-4">
							<div class="form-group">
								
								<label for="proyecto_valor_oferta_extension_estado_id">Estado de orden de cambio:</label>
								<select class="form-control" name="proyecto_valor_oferta_extension_estado_id" ng-model="proyecto_valor_oferta_extension_estado_id" id="proyecto_valor_oferta_extension_estado_id" aria-describedby="tipoextensionHelp">
									<?php if(isset($extensiones_estados)){
											foreach ($extensiones_estados as $kextension => $vextension) { 
												$selected = '';
												if(isset($proyecto_extension['proyecto_valor_oferta_extension_estado_id'])){
													if($proyecto_extension['proyecto_valor_oferta_extension_estado_id'] == $vextension['proyecto_valor_oferta_extension_estado_id']){
														$selected='selected="selected"';
													}
												} ?>
												<option ng-value="<?=$vextension['proyecto_valor_oferta_extension_estado_id']?>" value="<?=$vextension['proyecto_valor_oferta_extension_estado_id']?>" <?=$selected?>><?=$vextension['proyecto_valor_oferta_extension_estado']?></option>
									<?php 	}
										}
									?>
								</select>
								<small id="tipoextensionHelp" class="form-text text-muted">Indique el estado de orden de cambio que está registrando.<br/>
								</small>
							</div>
						</div>
					<?php } ?>
	        		<div class="col-12 col-md-4">
	        			<div class="form-group">
							<label for="tiene_impuesto">¿Tiene impuesto?:</label>							
							<select class="form-control" name="tiene_impuesto" id="tiene_impuesto" ng-model="tiene_impuesto" aria-describedby="tieneImpuestoHelp">
								<option value="0" ng-value="0" <?=((isset($proyecto_extension['tiene_impuesto']) && $proyecto_extension['tiene_impuesto']==0)?'selected="selected" ng-selected="selected"':'')?>>No</option>
								<option value="1" ng-value="1" <?=((isset($proyecto_extension['tiene_impuesto']) && $proyecto_extension['tiene_impuesto']==1)?'selected="selected" ng-selected="selected"':'')?>>Si</option>
								
							</select>
							<small id="tieneImpuestoHelp" class="form-text text-muted">Ingrese el valor de la orden de cambio.<br/>
							</small>
						</div>
	        		</div>
	        		<div class="col-12 col-md-4">
	        			<div class="form-group" ng-show="tiene_impuesto==1">
							<label for="impuesto">Impuesto (%):</label>
							<input  type="number" <?=((isset($proyecto_extension['impuesto']) && $proyecto_extension['impuesto']!='')?'value="'.$proyecto_extension['impuesto'].'" ng-value="'.$proyecto_extension['impuesto'].'"':'value=""')?> step="0.05" pattern="^\d+(?:\.\d{1,2})?$" name="impuesto" id="impuesto" class="form-control" aria-describedby="impuestoHelp" ng-model="impuesto">
							<small id="impuestoHelp" class="form-text text-muted">Ingrese el impuesto asignado a esta orden de cambio<br/>
							</small>
							
						</div>
	        		</div>
					<div class="col-12" ng-if="proyecto_valor_oferta_extension_estado_id===3">
						<div class="form-group">
							
							<label for="proyecto_valor_oferta_extension_estado_id">Motivo del rechazo:</label>
							<textarea name="comentarios" id="comentarios" cols="30" rows="10" class="form-control"><?=(isset($proyecto_extension_rechazo['comentarios']))?$proyecto_extension_rechazo['comentarios']:''?></textarea>
							
						</div>
					</div>
	        	</div>
				<div class="row">
					<div class="col-12 col-md-4">
						<button type="submit" class="btn btn-primary form-submit"><i class="fa fa-fw fa-save"></i> Guardar</button>
					</div>		        		
					
				</div>
	        </div>
		</div>
		<div class="card mb-3">
			<div class="card-header">
				Envio a Cliente</div>
			<div class="card-body">
				<div class="row">
					<?php if (isset($proyecto_extension['proyecto_valor_oferta_extension_estado_id']) && $proyecto_extension['proyecto_valor_oferta_extension_estado_id'] == 1) { ?>
						<?php if (isset($correos_contactos) && !empty($correos_contactos)) { ?> 
							<div class="col-12 col-md-6">
								<div class="table-responsive">
									<table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
										<thead class="thead-light">
											<tr>
												<th></th>
												<th>Nombre</th>
												<th>Correo electrónico</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($correos_contactos as $kcorreo => $vcorreo) { ?>
												<tr class="material-item">
													<td><input type="checkbox" ng-model="correo_envio[<?=$vcorreo['contacto_id']?>]" name="correo_envio[]" value="<?=$vcorreo['contacto_id']?>" /></td>
													<td><?=$vcorreo['nombre_contacto']?></td>
													<td><?=$vcorreo['correo_contacto']?></td>
												</tr>						

											<?php } ?>
											
										</tbody>
									</table>
								</div>
								<input class="btn btn-primary" type="submit" name="submit_correo" value="Enviar correos" ng-class="{'btn-loading-primary': bloqueo_button_email}" ng-disabled="bloqueo_button_email" ng-click="enviarCorreos();" />
							</div>
						<?php } ?>
					<?php } ?>
					<div class="col-12 col-md-6">
						<a class="btn btn-primary" target="_blank" href="<?=base_url().'proyecto/generarArchivoOrdenCambio/'.$proyecto['proyecto_id'].'/'.$proyecto_extension['proyecto_valor_oferta_id']?>">Descargar PDF <i class="fa fa-fw fa-download"></i></a>
					</div>
				</div>				
			</div>
		</div>

		
		

		<div class="card mb-3">
	        <div class="card-header">
	          	Cambios</div>
	        <div class="card-body">
				<div class="row">
					<div class="col-12">
						<a href="<?=base_url()?>proyectos/ordenes-cambio/<?=$proyecto['proyecto_id']?>/editar-orden-cambio/<?=$proyecto_extension['proyecto_valor_oferta_id']?>/agregar-cambio" class="btn btn-success btn-sm" role="button"><i class="fa fa-fw fa-plus-circle"></i>Agregar cambio</a>
					</div>
				</div>
	        	<div ng-if="cambios!==false" class="table-espaciado">
					<div class="table-responsive">
						<table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
							<thead class="thead-light">
								<tr>
									<th class="d-md-none">Acciones</th>
									<th>Cantidad</th>
									<th>Tipo</th>
									<th>Lámina arq.</th>
									<th class="cambio-desc-col">Descripción</th>
									<th>Total</th>
									<th class="d-none d-md-table-cell">Acciones</th>
								</tr>
							</thead>
							<tbody>
								<tr class="cambio-item" ng-repeat="cambio in cambios">
									<td  class="d-md-none"><a href="<?=base_url()?>proyectos/ordenes-cambio/<?=$proyecto['proyecto_id']?>/editar-orden-cambio/<?=$proyecto_extension['proyecto_valor_oferta_id']?>/editar-cambio/{{cambio.proyecto_valor_oferta_extension_cambio_id}}" class="btn btn-sm btn-edit btn-success  mb-1"><i class="fa fa-fw fa-edit"></i></a> 
										<?php if(isset($permisos['proyecto_extensiones_cambios']['delete'])){ ?>
											<a class="btn btn-sm btn-danger  mb-1" href="#" data-toggle="modal" data-target="#deleteModal1{{cambio.proyecto_valor_oferta_extension_cambio_id}}"><i class="fa fa-fw fa-trash-o"></i></a>
											<!-- Modal -->
											<div class="modal fade" id="deleteModal1{{cambio.proyecto_valor_oferta_extension_cambio_id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="deleteModalLabel">¿Está seguro que desea eliminar este cambio?</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													Una vez eliminado el cambio, no se podrá recuperar su información. 
														<br><br>
														Ingrese la palabra <strong>"eliminar"</strong> en el siguiente campo de texto para confirmar que está seguro de esta acción:
														<br><input ng-model="confirm_delete" type="text">
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
													<button type="button" ng-disabled="confirm_delete!='eliminar'" class="btn btn-danger" ng-click="borrarRow(cambio.proyecto_valor_oferta_extension_cambio_id)"><i class="fa fa-fw fa-trash-o"></i> Eliminar</button>
												</div>
												</div>
												</div>
											</div>

										<?php } ?>
									</td>
									<td><a ng-class="{'text-danger': cambio.tipo_operacion==2}" href="<?=base_url()?>proyectos/ordenes-cambio/<?=$proyecto['proyecto_id']?>/editar-orden-cambio/<?=$proyecto_extension['proyecto_valor_oferta_id']?>/editar-cambio/{{cambio.proyecto_valor_oferta_extension_cambio_id}}">{{cambio.cantidad + ' ' + cambio.proyecto_valor_oferta_extension_unidad_simbolo}}</a></td>
									<td><a ng-class="{'text-danger': cambio.tipo_operacion==2}" href="<?=base_url()?>proyectos/ordenes-cambio/<?=$proyecto['proyecto_id']?>/editar-orden-cambio/<?=$proyecto_extension['proyecto_valor_oferta_id']?>/editar-cambio/{{cambio.proyecto_valor_oferta_extension_cambio_id}}">{{cambio.proyecto_valor_oferta_extension_tipo}}</a></td>
									<td><a ng-class="{'text-danger': cambio.tipo_operacion==2}" href="<?=base_url()?>proyectos/ordenes-cambio/<?=$proyecto['proyecto_id']?>/editar-orden-cambio/<?=$proyecto_extension['proyecto_valor_oferta_id']?>/editar-cambio/{{cambio.proyecto_valor_oferta_extension_cambio_id}}">{{cambio.lamina_arquitectonica}}</a></td>
									<td><a ng-class="{'text-danger': cambio.tipo_operacion==2}" href="<?=base_url()?>proyectos/ordenes-cambio/<?=$proyecto['proyecto_id']?>/editar-orden-cambio/<?=$proyecto_extension['proyecto_valor_oferta_id']?>/editar-cambio/{{cambio.proyecto_valor_oferta_extension_cambio_id}}">{{cambio.descripcion}}</a></td>
									<td><a ng-class="{'text-danger': cambio.tipo_operacion==2}" href="<?=base_url()?>proyectos/ordenes-cambio/<?=$proyecto['proyecto_id']?>/editar-orden-cambio/<?=$proyecto_extension['proyecto_valor_oferta_id']?>/editar-cambio/{{cambio.proyecto_valor_oferta_extension_cambio_id}}">{{(cambio.tipo_operacion==2)?'-':''}} {{cambio.total | currency}}</a></td>
									<td  class="d-none d-md-table-cell"><a href="<?=base_url()?>proyectos/ordenes-cambio/<?=$proyecto['proyecto_id'] ?>/editar-orden-cambio/<?=$proyecto_extension['proyecto_valor_oferta_id']?>/editar-cambio/{{cambio.proyecto_valor_oferta_extension_cambio_id}}" class="btn btn-sm btn-edit btn-success  mb-1"><i class="fa fa-fw fa-edit"></i></a> 
										<?php if(isset($permisos['proyecto_extensiones_cambios']['delete'])){ ?>
											<a class="btn btn-sm btn-danger  mb-1" href="#" data-toggle="modal" data-target="#deleteModal2{{cambio.proyecto_valor_oferta_extension_cambio_id}}"><i class="fa fa-fw fa-trash-o"></i></a>
											<!-- Modal -->
											<div class="modal fade" id="deleteModal2{{cambio.proyecto_valor_oferta_extension_cambio_id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="deleteModalLabel">¿Está seguro que desea eliminar este cambio?</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													Una vez eliminado el cambio, no se podrá recuperar su información. 
														<br><br>
														Ingrese la palabra <strong>"eliminar"</strong> en el siguiente campo de texto para confirmar que está seguro de esta acción:
														<br><input ng-model="confirm_delete" type="text">
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
													<button type="button" ng-disabled="confirm_delete!='eliminar'" class="btn btn-danger" ng-click="borrarRow(cambio.proyecto_valor_oferta_extension_cambio_id)"><i class="fa fa-fw fa-trash-o"></i> Eliminar</button>
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

					<div class="row">
						<div class="col-12 col-md-8"></div>
						<div class="col-12 col-md-4">
							<table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
								<tr>
									<td><strong>Subtotal:</strong></td>
									<td>{{cambios_totales.subtotal | currency}}</td>
								</tr>
								<tr>
									<td><strong>Impuestos:</strong></td>
									<td>{{cambios_totales.impuesto | currency}}</td>
								</tr>
								<tr>
									<td><strong>Total:</strong></td>
									<td>{{cambios_totales.total | currency}}</td>
								</tr>
							</table>
						</div>
					</div>
					
				</div>

				
				<p ng-if="cambios===false" class="text-center table-espaciado">No hay cambios registrados aún<br>
					<a class="btn btn-primary mt-4" href="<?=base_url()?>proyectos/ordenes-cambio/<?=$proyecto['proyecto_id']?>/editar-orden-cambio/<?=$proyecto_extension['proyecto_valor_oferta_id']?>/agregar-cambio" role="button"><i class="fa fa-fw fa-plus-circle"></i> Agregar cambio</a>
				</p>
	        </div>
	    </div>
	</form>
</div>
