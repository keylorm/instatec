<script src="<?=base_url()?>instatec_pub/js/proyecto.js"></script>
<!-- Breadcrumbs-->
<ol class="breadcrumb">
	<li class="breadcrumb-item">
	  <a href="<?=base_url()?>">Inicio</a>
	</li>
	<li class="breadcrumb-item">
	  <a href="<?=base_url()?>proyectos">Proyectos</a>
	</li>
	<li class="breadcrumb-item">
		<a href="<?=base_url()?>proyectos/ver-proyecto/<?=$proyecto->proyecto_id?>">Ver proyecto</a>
	</li>
	<li class="breadcrumb-item">
		<a href="<?=base_url()?>proyectos/materiales/<?=$proyecto->proyecto_id?>">Materiales</a>
	</li>
	<li class="breadcrumb-item">
		<a href="<?=base_url()?>proyectos/materiales/<?=$proyecto->proyecto_id?>/solicitudes-compra-materiales">Solicitudes de compra</a>
	</li>
	<li class="breadcrumb-item active">Proformas</li>
</ol>

<h1 class="text-center "><i class="fa fa-fw fa-wrench"></i> Materiales de proyecto</h1>
<hr>


<div class="page-content" ng-controller="proyectoVerProformasController" ng-cloak ng-init="proyecto_id='<?=$proyecto->proyecto_id?>'; proyecto_material_solicitud_compra_id = <?=$solicitud_compra_id?>; consultarProformas();">
	<div class="row">
		<div class="col-12 col-md-12"><h3 class=" text-center text-md-left"><i class="fa fa-fw fa-table"></i> Solicitudes de compra de materiales</h3></div>
	</div>
	<div class="row">
		<div class="col-12 col-md-12">
			<?php if(isset($permisos['proyecto_materiales_solicitud_compra_proforma']['create'])){ ?>
				<a class="btn btn-sm btn-primary float-md-right mb-3 mr-md-3 mx-auto d-block d-md-inline-block" href="<?=base_url()?>proyectos/materiales/<?=$proyecto->proyecto_id?>/solicitudes-compra-materiales/<?=$solicitud_compra_id;?>/proformas/generar" role="button"><i class="fa fa-fw fa-plus-circle"></i> Generar proforma</a> 
			<?php } ?>
			<a class="btn btn-sm btn-secondary float-md-right mb-3 mr-md-3 mx-auto d-block d-md-inline-block" href="<?=base_url()?>proyectos/materiales/<?=$proyecto->proyecto_id?>/solicitudes-compra-materiales/<?=$solicitud_compra_id?>/ver" role="button"><i class="fa fa-fw fa-arrow-left"></i> Volver</a></div>
	</div>

	<?php 
		
		if($this->input->get('nuevo')!=null && $this->input->get('nuevo')==1){ ?>
			<div class="alert alert-success alert-dismissable">Proforma guardada con éxito.</div>
		<?php  } 

		if($this->input->get('editar')!=null && $this->input->get('editar')==1){ ?>
			<div class="alert alert-success alert-dismissable">Proforma editada con éxito.</div>
		<?php  } 

    ?>

    
	
    <div class="listado-materiales">
        
        <h3 class="text-center mb-3">Lista de proformas</h3>
		<div ng-if="proveedores!==false" class="table-espaciado">
			<div class="proformas-proveedores" ng-repeat="proveedor in proveedores">
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
			            	<tr class="material-item" ng-repeat="proforma in proveedor.proformas">
			            		<td class="d-md-none">
									<button ng-if="bloqueo_edicion[proforma.proveedor_id] === proforma.proyecto_material_solicitud_compra_proforma_id && editar_proforma[proforma.proyecto_material_solicitud_compra_proforma_id]===false" ng-click="habilitarEdicionProforma(proforma.proyecto_material_solicitud_compra_proforma_id)" class="btn btn-primary btn-sm mb-1">
	                                    <i class="fa fa-fw fa-edit"></i>
	                                </button>
	                                <button ng-if="bloqueo_edicion[proforma.proveedor_id] === proforma.proyecto_material_solicitud_compra_proforma_id && editar_proforma[proforma.proyecto_material_solicitud_compra_proforma_id]===true" ng-click="cambiarEstado(proforma.proyecto_material_solicitud_compra_proforma_id)" class="btn btn-success btn-sm mb-1">
	                                    <i class="fa fa-fw fa-check" ng-show="guardando[proforma.proyecto_material_solicitud_compra_proforma_id]===false"></i><i class="fa fa-fw fa-spinner" ng-show="guardando[proforma.proyecto_material_solicitud_compra_proforma_id]===true"></i>
	                                </button>
	                                <button ng-if="(bloqueo_edicion[proforma.proveedor_id] === proforma.proyecto_material_solicitud_compra_proforma_id && editar_proforma[proforma.proyecto_material_solicitud_compra_proforma_id]===true" class="btn btn-sm btn-danger mb-1">
	                                    <i class="fa fa-fw fa-ban"></i>
	                                </button>
	                                <a class="btn btn-sm btn-success" href="<?=base_url()?>{{proforma.url_archivo}}" download><i class="fa fa-fw fa-download"></i></a>
	                            </td>
			            		<td><a href="<?=base_url()?>{{proforma.url_archivo}}" download>{{proforma.proyecto_material_solicitud_compra_proforma_id}}</a></td>
								<td><a href="<?=base_url()?>{{proforma.url_archivo}}" download>{{proforma.nombre_proveedor}}</a></td>
								<td><a href="<?=base_url()?>{{proforma.url_archivo}}" download>{{proforma.fecha_registro}}</a></td>
			            		<td><a href="<?=base_url()?>{{proforma.url_archivo}}" download>{{proforma.filename}}</a></td>
			            		<td>
			            			<div class="edit-container row" ng-show="editar_proforma[proforma.proyecto_material_solicitud_compra_proforma_id]===true">
	                                    <div class="col-12">
	                                        <select class="form-control" id="proyecto_material_solicitud_compra_proforma_estado_id" ng-model="proyecto_material_solicitud_compra_proforma_estado_id[proforma.proyecto_material_solicitud_compra_proforma_id]" >
	                                            <?php foreach($proforma_estados as $kestado => $vestado){ ?>
	                                                <option value="<?=$vestado->proyecto_material_solicitud_compra_proforma_estado_id?>"><?=@$vestado->proyecto_material_solicitud_compra_proforma_estado?></option>
	                                            <?php } ?>
	                                        </select>
	                                    </div>
	                                     <div ng-show="mensaje_error[proforma.proyecto_material_solicitud_compra_proforma_id].error_estado !== undefined" class="col-12 mt-2">
	                                         <div class="alert alert-danger">
	                                             {{mensaje_error[proforma.proyecto_material_solicitud_compra_proforma_id].error_estado}}
	                                         </div>
	                                     </div>
	                                </div>
	                                {{(editar_proforma[proforma.proyecto_material_solicitud_compra_proforma_id] === false && proforma.proyecto_material_solicitud_compra_proforma_estado !== null)?proforma.proyecto_material_solicitud_compra_proforma_estado:''}}
	                            </td>
								<td  class="d-none d-md-table-cell">
									<button ng-if="bloqueo_edicion[proforma.proveedor_id] === proforma.proyecto_material_solicitud_compra_proforma_id && editar_proforma[proforma.proyecto_material_solicitud_compra_proforma_id]===false" ng-click="habilitarEdicionProforma(proforma.proyecto_material_solicitud_compra_proforma_id)" class="btn btn-primary btn-sm mb-1">
	                                    <i class="fa fa-fw fa-edit"></i>
	                                </button>
	                                <button ng-if="bloqueo_edicion[proforma.proveedor_id] === proforma.proyecto_material_solicitud_compra_proforma_id && editar_proforma[proforma.proyecto_material_solicitud_compra_proforma_id]===true" ng-click="cambiarEstado(proforma.proyecto_material_solicitud_compra_proforma_id)" class="btn btn-success btn-sm mb-1">
	                                    <i class="fa fa-fw fa-check" ng-show="guardando[proforma.proyecto_material_solicitud_compra_proforma_id]===false"></i><i class="fa fa-fw fa-spinner" ng-show="guardando[proforma.proyecto_material_solicitud_compra_proforma_id]===true"></i>
	                                </button>
	                                <button ng-if="bloqueo_edicion[proforma.proveedor_id] === proforma.proyecto_material_solicitud_compra_proforma_id && editar_proforma[proforma.proyecto_material_solicitud_compra_proforma_id]===true" ng-click="cancelarEdicionProforma(proforma.proyecto_material_solicitud_compra_proforma_id)" class="btn btn-sm btn-danger mb-1">
	                                    <i class="fa fa-fw fa-ban"></i>
	                                </button>
	                                <a class="btn btn-sm btn-success mb-1" href="<?=base_url()?>{{proforma.url_archivo}}" download><i class="fa fa-fw fa-download"></i></a>
	                            </td>
							</tr>						
							
						</tbody>
					</table>
				</div>
			</div>
		</div>


		<p ng-if="proveedores===false" class="text-center table-espaciado">No hay proformas generadas aún</p>
	</div>
</div>