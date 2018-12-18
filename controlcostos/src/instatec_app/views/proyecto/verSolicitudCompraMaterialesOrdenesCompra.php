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
	<li class="breadcrumb-item">
		<a href="<?=base_url()?>proyectos/materiales/<?=$proyecto['proyecto_id']?>/solicitudes-compra-materiales">Solicitudes de compra</a>
	</li>
	<li class="breadcrumb-item active">Ordenes de compra</li>
</ol>

<h1 class="text-center "><i class="fa fa-fw fa-wrench"></i> Materiales de proyecto</h1>
<hr>


<div class="page-content" ng-controller="proyectoVerOrdenesCompraController" ng-cloak ng-init="proyecto_id='<?=$proyecto['proyecto_id']?>'; proyecto_material_solicitud_compra_id = <?=$solicitud_compra_id?>; consultarOrdenesCompra();">
	<div class="row">
		<div class="col-12 col-md-12"><h3 class=" text-center text-md-left"><i class="fa fa-fw fa-table"></i> Solicitudes de compra de materiales</h3></div>
	</div>
	<div class="row">
		<div class="col-12 col-md-12">
			<?php if(isset($permisos['proyecto_materiales_solicitud_compra_orden_compra']['create'])){ ?>
				<a class="btn btn-sm btn-primary float-md-right mb-3 mr-md-3 mx-auto d-block d-md-inline-block" href="<?=base_url()?>proyectos/materiales/<?=$proyecto['proyecto_id']?>/solicitudes-compra-materiales/<?=$solicitud_compra_id;?>/ordenes-compra/generar" role="button"><i class="fa fa-fw fa-plus-circle"></i> Generar orden de compra</a> 
			<?php } ?>
			<a class="btn btn-sm btn-secondary float-md-right mb-3 mr-md-3 mx-auto d-block d-md-inline-block" href="<?=base_url()?>proyectos/materiales/<?=$proyecto['proyecto_id']?>/solicitudes-compra-materiales/<?=$solicitud_compra_id?>/ver" role="button"><i class="fa fa-fw fa-arrow-left"></i> Volver</a></div>
	</div>

	<?php 
		
		if($this->input->get('nuevo')!=null && $this->input->get('nuevo')==1){ ?>
			<div class="alert alert-success alert-dismissable">Orden de compra guardada con éxito.</div>
		<?php  } 

		if($this->input->get('editar')!=null && $this->input->get('editar')==1){ ?>
			<div class="alert alert-success alert-dismissable">Orden de compra editada con éxito.</div>
		<?php  } 

    ?>

    
	
    <div class="listado-materiales">
        
        <h3 class="text-center mb-3">Lista de ordenes de compra</h3>
		<div ng-if="proveedores!==false" class="table-espaciado">
			<div class="ordenes-proveedores" ng-repeat="proveedor in proveedores">
				<h5>{{proveedor.nombre_proveedor}}</h5>
				<div class="table-responsive">
			        <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
			            <thead class="thead-light">
					        <tr>
					        	<th class="d-md-none">Acciones</th>
								<th>ID</th>
								<th>Proveedor</th>
								<th>Fecha</th>
								<th>Archivo</th>
								<th>Estado</th>
								<th class="d-none d-md-table-cell">Acciones</th>
							</tr>
						</thead>
			            <tbody>
			            	<tr class="material-item" ng-repeat="orden_compra in proveedor.ordenes_compra">
			            		<td class="d-md-none">
									<button ng-if="bloqueo_edicion[orden_compra.proveedor_id] === orden_compra.proyecto_material_solicitud_compra_orden_compra_id && editar_orden[orden_compra.proyecto_material_solicitud_compra_orden_compra_id]===false" ng-click="habilitarEdicionOrdenCompra(orden_compra.proyecto_material_solicitud_compra_orden_compra_id)" class="btn btn-primary btn-sm mb-1">
	                                    <i class="fa fa-fw fa-edit"></i>
	                                </button>
	                                <button ng-if="bloqueo_edicion[orden_compra.proveedor_id] === orden_compra.proyecto_material_solicitud_compra_orden_compra_id  && editar_orden[orden_compra.proyecto_material_solicitud_compra_orden_compra_id]===true" ng-click="cambiarEstado(orden_compra.proyecto_material_solicitud_compra_orden_compra_id)" class="btn btn-success btn-sm mb-1">
	                                    <i class="fa fa-fw fa-check" ng-show="guardando[orden_compra.proyecto_material_solicitud_compra_orden_compra_id]===false"></i><i class="fa fa-fw fa-spinner" ng-show="guardando[orden_compra.proyecto_material_solicitud_compra_orden_compra_id]===true"></i>
	                                </button>
	                                <button ng-if="bloqueo_edicion[orden_compra.proveedor_id] === orden_compra.proyecto_material_solicitud_compra_orden_compra_id  && editar_orden[orden_compra.proyecto_material_solicitud_compra_orden_compra_id]===true" ng-click="cancelarEdicionOrdenCompra(orden_compra.proyecto_material_solicitud_compra_orden_compra_id)" class="btn btn-sm btn-danger mb-1">
	                                    <i class="fa fa-fw fa-ban"></i>
	                                </button>
	                                <a class="btn btn-sm btn-success" href="<?=base_url()?>{{orden_compra.url_archivo}}" download><i class="fa fa-fw fa-download"></i></a>
	                            </td>
			            		<td><a href="<?=base_url()?>{{orden_compra.url_archivo}}" download>{{orden_compra.proyecto_material_solicitud_compra_orden_compra_id}}</a></td>
								<td><a href="<?=base_url()?>{{orden_compra.url_archivo}}" download>{{orden_compra.nombre_proveedor}}</a></td>
								<td><a href="<?=base_url()?>{{orden_compra.url_archivo}}" download>{{orden_compra.fecha_registro}}</a></td>
			            		<td><a href="<?=base_url()?>{{orden_compra.url_archivo}}" download>{{orden_compra.filename}}</a></td>
			            		<td>
			            			<div class="edit-container row" ng-show="editar_orden[orden_compra.proyecto_material_solicitud_compra_orden_compra_id]===true">
	                                    <div class="col-12">
	                                        <select class="form-control" id="proyecto_material_solicitud_compra_orden_compra_estado_id" ng-model="proyecto_material_solicitud_compra_orden_compra_estado_id[orden_compra.proyecto_material_solicitud_compra_orden_compra_id]" >
	                                            <?php foreach($orden_compra_estados as $kestado => $vestado){ ?>
	                                                <option value="<?=$vestado['proyecto_material_solicitud_compra_orden_compra_estado_id']?>"><?=@$vestado['proyecto_material_solicitud_compra_orden_compra_estado']?></option>
	                                            <?php } ?>
	                                        </select>
	                                    </div>
	                                     <div ng-show="mensaje_error[orden_compra.proyecto_material_solicitud_compra_orden_compra_id].error_estado !== undefined" class="col-12 mt-2">
	                                         <div class="alert alert-danger">
	                                             {{mensaje_error[orden_compra.proyecto_material_solicitud_compra_orden_compra_id].error_estado}}
	                                         </div>
	                                     </div>
	                                </div>
	                                {{(editar_orden[orden_compra.proyecto_material_solicitud_compra_orden_compra_id] === false && orden_compra.proyecto_material_solicitud_compra_orden_compra_estado !== null)?orden_compra.proyecto_material_solicitud_compra_orden_compra_estado:''}}
	                            </td>
								<td  class="d-none d-md-table-cell">
									<button ng-if="bloqueo_edicion[orden_compra.proveedor_id] === orden_compra.proyecto_material_solicitud_compra_orden_compra_id  && editar_orden[orden_compra.proyecto_material_solicitud_compra_orden_compra_id]===false" ng-click="habilitarEdicionOrdenCompra(orden_compra.proyecto_material_solicitud_compra_orden_compra_id)" class="btn btn-primary btn-sm mb-1">
	                                    <i class="fa fa-fw fa-edit"></i>
	                                </button>
	                                <button ng-if="bloqueo_edicion[orden_compra.proveedor_id] === orden_compra.proyecto_material_solicitud_compra_orden_compra_id && editar_orden[orden_compra.proyecto_material_solicitud_compra_orden_compra_id]===true" ng-click="cambiarEstado(orden_compra.proyecto_material_solicitud_compra_orden_compra_id)" class="btn btn-success btn-sm mb-1">
	                                    <i class="fa fa-fw fa-check" ng-show="guardando[orden_compra.proyecto_material_solicitud_compra_orden_compra_id]===false"></i><i class="fa fa-fw fa-spinner" ng-show="guardando[orden_compra.proyecto_material_solicitud_compra_orden_compra_id]===true"></i>
	                                </button>
	                                <button ng-if="bloqueo_edicion[orden_compra.proveedor_id] === orden_compra.proyecto_material_solicitud_compra_orden_compra_id && editar_orden[orden_compra.proyecto_material_solicitud_compra_orden_compra_id]===true" ng-click="cancelarEdicionOrdenCompra(orden_compra.proyecto_material_solicitud_compra_orden_compra_id)" class="btn btn-sm btn-danger mb-1">
	                                    <i class="fa fa-fw fa-ban"></i>
	                                </button>
	                                <a class="btn btn-sm btn-success mb-1" href="<?=base_url()?>{{orden_compra.url_archivo}}" download><i class="fa fa-fw fa-download"></i></a>
	                            </td>
							</tr>						
							
						</tbody>
					</table>
				</div>
			</div>
		</div>


		<p ng-if="proveedores===false" class="text-center table-espaciado">No hay ordenes de compra generadas aún</p>
	</div>
</div>