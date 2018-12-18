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
	<li class="breadcrumb-item active">Solicitudes de cotización de materiales</li>
</ol>

<h1 class="text-center "><i class="fa fa-fw fa-wrench"></i> Materiales de proyecto</h1>
<hr>


<div class="page-content" ng-controller="proyectoSolicitudesCotizacionMaterialesController" ng-cloak ng-init="proyecto_id='<?=$proyecto['proyecto_id']?>'; consultarSolicitudes();">
	<div class="row">
		<div class="col-12 col-md-12"><h3 class=" text-center text-md-left"><i class="fa fa-fw fa-table"></i> Solicitudes de cotización de materiales</h3></div>
	</div>
	<div class="row">
		<div class="col-12 col-md-12">
			<?php if(isset($permisos['proyecto_materiales_cotizacion']['create'])){ ?>
				<a class="btn btn-sm btn-primary float-md-right mb-3 mr-md-3 mx-auto d-block d-md-inline-block" href="<?=base_url()?>proyectos/materiales/<?=$proyecto['proyecto_id']?>/solicitudes-cotizacion-materiales/generar" role="button"><i class="fa fa-fw fa-plus-circle"></i> Generar cotización</a> 
			<?php } ?>
			<a class="btn btn-sm btn-secondary float-md-right mb-3 mr-md-3 mx-auto d-block d-md-inline-block" href="<?=base_url()?>proyectos/materiales/<?=$proyecto['proyecto_id']?>" role="button"><i class="fa fa-fw fa-arrow-left"></i> Volver</a></div>
	</div>

	<?php 
		
		if($this->input->get('nuevo')!=null && $this->input->get('nuevo')==1){ ?>
			<div class="alert alert-success alert-dismissable">Lista guardada con éxito.</div>
		<?php  } 

		if($this->input->get('editar')!=null && $this->input->get('editar')==1){ ?>
			<div class="alert alert-success alert-dismissable">Lista editada con éxito.</div>
		<?php  } 

    ?>

    
	
    <div class="listado-materiales">
        
        <h3 class="text-center mb-3">Lista de solicitudes</h3>
		<div ng-if="solicitudes_cotizacion_materiales!==false" class="table-espaciado">
			<div class="table-responsive">
		        <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
		            <thead class="thead-light">
				        <tr>
							<th>ID</th>
							<th>Archivo</th>
							<th>Fecha</th>
							<th>Acciones</th>
						</tr>
					</thead>
		            <tbody>
		            	<tr class="material-item" ng-repeat="solicitud in solicitudes_cotizacion_materiales  | limitTo : cantidad_mostrar : currentPage*cantidad_mostrar">
		            		<td><a href="<?=base_url()?>{{solicitud.url_archivo}}" download>{{solicitud.proyecto_material_solicitud_cotizacion_id}}</a></td>
		            		<td><a href="<?=base_url()?>{{solicitud.url_archivo}}" download>{{solicitud.filename}}</a></td>
							<td><a href="<?=base_url()?>{{solicitud.url_archivo}}" download>{{solicitud.fecha_registro}}</a></td>
							<td><a class="btn btn-sm btn-success" href="<?=base_url()?>{{solicitud.url_archivo}}" download><i class="fa fa-fw fa-download"></i></a></td>
						</tr>						
						
					</tbody>
				</table>
			</div>
		</div>


		<p ng-if="solicitudes_cotizacion_materiales===false" class="text-center table-espaciado">No hay solicitudes de cotización generadas aún</p>
	</div>
</div>