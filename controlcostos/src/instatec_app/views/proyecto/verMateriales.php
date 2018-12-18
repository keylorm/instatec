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
	<li class="breadcrumb-item active">Materiales de proyecto</li>
</ol>

<h1 class="text-center "><i class="fa fa-fw fa-wrench"></i> Materiales de proyecto</h1>
<hr>


<div class="page-content" ng-controller="proyectoMaterialesController" ng-cloak ng-init="proyecto_id='<?=$proyecto['proyecto_id']?>'; consultarMateriales();">
	<?php if(isset($permisos['material_unidad']['list'])){ ?>
		<div class="row">
			<div class="col-12 col-md-8"></div>
			<div class="col-12 col-md-4 mb-3">
				<div class="text-right dropdown">
					<button class="btn btn-sm btn-secondary dropdown-toggle float-md-right mb-3 mx-auto d-block d-md-inline-block" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-fw fa-cog"></i> Configuración </button>
					<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						<a class="dropdown-item" href="<?=base_url()?>materiales/unidades">Unidades</a>
					</div>
				</div>
				<a class="btn btn-sm btn-secondary float-md-right mb-3 mr-md-3 mx-auto d-block d-md-inline-block" href="<?=base_url()?>proyectos/ver-proyecto/<?=$proyecto['proyecto_id']?>" role="button"><i class="fa fa-fw fa-arrow-left"></i> Volver al proyecto</a>
			</div>
			
		</div>
	<?php } ?>
	<div class="row">
		<div class="col-12 col-md-12"><h3 class=" text-center text-md-left"><i class="fa fa-fw fa-table"></i> Lista de materiales</h3></div>
	</div>
	<div class="row">
		<div class="col-12 col-md-12">
			<?php if(isset($permisos['proyecto_materiales_solicitud_compra']['list'])){ ?>
				<a class="btn btn-sm btn-primary float-md-right mb-3 mr-md-3 mx-auto d-block d-md-inline-block" href="<?=base_url()?>proyectos/materiales/<?=$proyecto['proyecto_id']?>/solicitudes-compra-materiales" role="button"><i class="fa fa-fw fa-plus-circle"></i>Solicitudes de compra</a> 
			<?php } ?>
			<?php if(isset($permisos['proyecto_materiales_proveedores']['edit'])){ ?>
				<a class="btn btn-sm btn-primary float-md-right mb-3 mr-md-3 mx-auto d-block d-md-inline-block" href="<?=base_url()?>proyectos/materiales/<?=$proyecto['proyecto_id']?>/proveedores-materiales" role="button"><i class="fa fa-fw fa-dollar"></i> Proveedores</a> 
			<?php } ?>
			<?php if(isset($permisos['proyecto_materiales_cotizacion']['list'])){ ?>
				<a class="btn btn-sm btn-primary float-md-right mb-3 mr-md-3 mx-auto d-block d-md-inline-block" href="<?=base_url()?>proyectos/materiales/<?=$proyecto['proyecto_id']?>/solicitudes-cotizacion-materiales" role="button"><i class="fa fa-fw fa-dollar"></i> Cotización</a> 
			<?php } ?>
			<?php if(isset($permisos['proyecto_materiales']['edit'])){ ?>
				<a class="btn btn-sm btn-primary float-md-right mb-3 mr-md-3 mx-auto d-block d-md-inline-block" href="<?=base_url()?>proyectos/materiales/<?=$proyecto['proyecto_id']?>/editar-lista-materiales" role="button"><i class="fa fa-fw fa-edit"></i> Editar lista de materiales</a> 
			<?php } ?>
		</div>
	</div>

	<?php 
		
		if($this->input->get('nuevo')!=null && $this->input->get('nuevo')==1){ ?>
			<div class="alert alert-success alert-dismissable">Lista guardada con éxito.</div>
		<?php  } 

		if($this->input->get('editar')!=null && $this->input->get('editar')==1){ ?>
			<div class="alert alert-success alert-dismissable">Lista editada con éxito.</div>
		<?php  } 

    ?>

    
	
    <div class="listado-materiales mb-5 mt-5">
        
        <h3 class="text-center mb-3">Lista inicial de materiales</h3>
		<div ng-if="materiales_iniciales_proyecto!==false" class="table-espaciado">
			<div class="table-responsive">
		        <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
		            <thead class="thead-light">
				        <tr>
							<th>Material</th>
							<th>Cantidad</th>
							<th>Detalle</th>
							<th>Proveedor</th>
							<th>Estado</th>
						</tr>
					</thead>
		            <tbody>
		            	<tr class="material-item" ng-repeat="material_inicial in materiales_iniciales_proyecto  | limitTo : cantidad_mostrar : currentPage*cantidad_mostrar">
							<td>{{material_inicial.material + ' (' + material_inicial.material_codigo + ')'}}</td>
							<td>{{material_inicial.cantidad + ' (' + material_inicial.material_unidad + ')'}}</td>
							<td>{{material_inicial.comentario}}</td>
							<td>{{material_inicial.nombre_proveedor}}</td>
							<td>{{material_inicial.proyecto_material_estado}}</td>
						</tr>						
						
					</tbody>
				</table>
			</div>
		</div>


		<p ng-if="materiales_iniciales_proyecto===false" class="text-center table-espaciado">No hay materiales asignados aún</p>
	</div>

	
    <div class="listado-materiales mb-5 mt-5">
        <h3 class="text-center mb-3">Lista de extensiones de materiales</h3>
         <div class="table-espaciado"  ng-if="materiales_extensiones_proyecto!==false" >
            <div class="table-responsive">
                <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
				        <tr>
							<th>Material</th>
							<th>Cantidad</th>
							<th>Detalle</th>
							<th>Proveedor</th>
							<th>Estado</th>
						</tr>
					</thead>
		            <tbody>
		            	<tr class="material-item" ng-repeat="material_extension in materiales_extensiones_proyecto  | limitTo : cantidad_mostrar : currentPage*cantidad_mostrar">
							<td>{{material_extension.material + ' (' + material_extension.material_codigo + ')'}}</td>
							<td>{{material_extension.cantidad + ' (' + material_extension.material_unidad + ')'}}</td>
							<td>{{material_extension.comentario}}</td>
							<td>{{material_extension.nombre_proveedor}}</td>
							<td>{{material_extension.proyecto_material_estado}}</td>
						</tr>						
						
					</tbody>
                </table>
            </div>
            
        </div>

    
        <p ng-if="materiales_extensiones_proyecto===false" class="text-center table-espaciado">No hay extensiones de materiales aún</p>
    </div>

    <div class="row" ng-if="materiales_iniciales_proyecto!==false && materiales_extensiones_proyecto!==false">
		<div class="col-12 col-md-12">
			<?php if(isset($permisos['proyecto_materiales_solicitud_compra']['list'])){ ?>
				<a class="btn btn-sm btn-primary float-md-right mb-3 mr-md-3 mx-auto d-block d-md-inline-block" href="<?=base_url()?>proyectos/materiales/<?=$proyecto['proyecto_id']?>/solicitudes-compra-materiales" role="button"><i class="fa fa-fw fa-plus-circle"></i>Solicitudes de compra</a> 
			<?php } ?>
			<?php if(isset($permisos['proyecto_materiales_proveedores']['edit'])){ ?>
				<a class="btn btn-sm btn-primary float-md-right mb-3 mr-md-3 mx-auto d-block d-md-inline-block" href="<?=base_url()?>proyectos/materiales/<?=$proyecto['proyecto_id']?>/proveedores-materiales" role="button"><i class="fa fa-fw fa-dollar"></i> Proveedores</a> 
			<?php } ?>
			<?php if(isset($permisos['proyecto_materiales_cotizacion']['list'])){ ?>
				<a class="btn btn-sm btn-primary float-md-right mb-3 mr-md-3 mx-auto d-block d-md-inline-block" href="<?=base_url()?>proyectos/materiales/<?=$proyecto['proyecto_id']?>/solicitudes-cotizacion-materiales" role="button"><i class="fa fa-fw fa-dollar"></i> Cotización</a> 
			<?php } ?>
			<?php if(isset($permisos['proyecto_materiales']['edit'])){ ?>
				<a class="btn btn-sm btn-primary float-md-right mb-3 mr-md-3 mx-auto d-block d-md-inline-block" href="<?=base_url()?>proyectos/materiales/<?=$proyecto['proyecto_id']?>/editar-lista-materiales" role="button"><i class="fa fa-fw fa-edit"></i> Editar lista de materiales</a> 
			<?php } ?>
			<a class="btn btn-sm btn-secondary float-md-right mb-3 mr-md-3 mx-auto d-block d-md-inline-block" href="<?=base_url()?>proyectos/ver-proyecto/<?=$proyecto['proyecto_id']?>" role="button"><i class="fa fa-fw fa-arrow-left"></i> Volver al proyecto</a></div>
	</div>
        
</div>