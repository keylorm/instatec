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
	<li class="breadcrumb-item active">Ver solicitud</li>
</ol>

<h1 class="text-center "><i class="fa fa-fw fa-plus-circle"></i> Solicitudes de compra de materiales</h1>
<hr>

<div class="page-content" ng-controller="proyectoVerSolicitudCompraMaterialesController" ng-cloak ng-init="proyecto_id='<?=$proyecto['proyecto_id']?>'; proyecto_material_solicitud_compra_id = '<?=$solicitud_compra_id?>'; consultarMateriales();">

	<div class="row">
		<div class="col-12 col-md-12">
			<?php if(isset($permisos['proyecto_materiales_solicitud_compra_orden_compra']['list']) && $proyecto_material_solicitud_compra['proyecto_material_solicitud_compra_estado_id'] != 1){ ?>
				<a class="btn btn-sm btn-primary float-md-right mb-3 mr-md-3 mx-auto d-block d-md-inline-block" href="<?=base_url()?>proyectos/materiales/<?=$proyecto['proyecto_id']?>/solicitudes-compra-materiales/<?=$solicitud_compra_id?>/ordenes-compra" role="button">Ordenes de Compra</a> 
			<?php } ?>
			<?php if(isset($permisos['proyecto_materiales_solicitud_compra_proforma']['list']) && $proyecto_material_solicitud_compra['proyecto_material_solicitud_compra_estado_id'] != 1){ ?>
				<a class="btn btn-sm btn-primary float-md-right mb-3 mr-md-3 mx-auto d-block d-md-inline-block" href="<?=base_url()?>proyectos/materiales/<?=$proyecto['proyecto_id']?>/solicitudes-compra-materiales/<?=$solicitud_compra_id?>/proformas" role="button">Proformas</a> 
			<?php } ?>
			<a class="btn btn-sm btn-secondary float-md-right mb-3 mr-md-3 mx-auto d-block d-md-inline-block" href="<?=base_url()?>proyectos/materiales/<?=$proyecto['proyecto_id']?>/solicitudes-compra-materiales/" role="button"><i class="fa fa-fw fa-arrow-left"></i> Volver</a>
		</div>
	</div>
	<?php if (isset($permisos['proyecto_materiales_solicitud_compra']['edit'])) { ?>
		<div class="card mb-3">
	        <div class="card-header">
	            Gestión de solicitud de cambio</div>
	        <div class="card-body">
	            <form id="editarMaterialesProyecto" class="form-validation" method="post" action="">
	                
	                <div class="row">
	                    <div class="form-group col-12 col-md-4">
	                        <div class="form-group">
	                            <label for="proyecto_material_solicitud_compra_estado_id">Estado de la solicitud:</label>							
	                            <select  class="form-control  select-required" name="proyecto_material_solicitud_compra_estado_id" id="proyecto_material_solicitud_compra_estado_id"aria-describedby="colaboradorHelp"  required="required">
	                                <option value=""></option>
	                                <?php foreach($estados_solicitud as $kestado => $vestado){ 
	                                	$selected = '';
	                                	if ($vestado['proyecto_material_solicitud_compra_estado_id'] == $proyecto_material_solicitud_compra['proyecto_material_solicitud_compra_estado_id'] ) {
	                                		$selected = 'selected="selected"';
	                                	}?>
	                                    <option value="<?=$vestado['proyecto_material_solicitud_compra_estado_id']?>" <?=$selected?>><?=@$vestado['proyecto_material_solicitud_compra_estado']?></option>
	                                <?php } ?>
	                            </select>
	                            <small id="colaboradorHelp" class="form-text text-muted">Aquí puede cambiar el estado de la solicitud.</small>
	                        </div>
	                        
	                    </div>
	                </div>
	                <div class="row">
	                    <div class="col-12 col-md-4">
	                        <button type="submit" value="guardar" class="btn btn-primary form-submit">Guardar</button>
	                    </div>
	                    
	                </div>
	                <?php if (isset($msg)) { ?>
	                    <div class="row mb-3 mt-3">
	                        <div class="col-12">
	                        	<?php foreach ($msg as $key => $value) { ?>
	                        		<div class="alert alert-<?=$value['tipo']?>"><?=$value['texto']?></div>  
	                        	<?php } ?>
	                        </div>
	                    </div>
	                <?php } ?>
	                
	            </form>
	               

	            
	        </div>
	    </div>

	<?php } ?>
    <div class="card mb-3">
    	<div class="card-header">
            Lista de materiales</div>
        <div class="card-body">
			<div class="listado-materiales">
		        
		        <h3 class="text-center mb-3">Lista inicial de materiales</h3>
				<div ng-if="materiales_iniciales_proyecto.length > 0" class="table-espaciado" >
					<div class="table-responsive">
				        <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
				            <thead class="thead-light">
						        <tr>
									<th>Material</th>
									<th>Proveedor</th>
									<th>Cantidad</th>
								</tr>
							</thead>
				            <tbody>
				            	<tr class="material-item" ng-repeat="material_inicial in materiales_iniciales_proyecto">
									<td>{{material_inicial.material + ' (' + material_inicial.material_codigo + ')'}}<br>
									{{material_inicial.comentario}}</td>
									<td>{{material_inicial.nombre_proveedor}}</td>
									<td>{{material_inicial.cantidad_compra + ' ' + material_inicial.material_unidad}}</td>
								</tr>						
								
							</tbody>
						</table>
					</div>
				</div>
			</div>

		
		    <div class="listado-materiales" ng-if="materiales_extensiones_proyecto.length > 0">
		        <h3 class="text-center mb-3">Lista de extensiones de materiales</h3>
		        <div class="table-espaciado">
					
		            <div class="table-responsive">
		                <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
		                    <thead class="thead-light">
						        <tr>
						        	<th>Material</th>
						        	<th>Proveedor</th>
									<th>Cantidad</th>
								</tr>
							</thead>
				            <tbody>
				            	<tr class="material-item" ng-repeat="material_extension in materiales_extensiones_proyecto">
				            		<td>{{material_extension.material + ' (' + material_extension.material_codigo + ')'}}<br>
									{{material_extension.comentario}}</td>
									<td>{{material_extension.nombre_proveedor}}</td>
									<td>{{material_extension.cantidad_compra + ' ' + material_extension.material_unidad}}</td>
								</tr>						
								
							</tbody>
		                </table>
		            </div>
		        </div>
		    </div>
		</div>
    	
    </div>


</div>