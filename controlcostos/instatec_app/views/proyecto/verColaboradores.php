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
	<li class="breadcrumb-item active">Colaboradores</li>
</ol>

<h1 class="text-center">Colaboradores de proyectos</h1>
<hr>


<div class="page-content" ng-controller="proyectoColaboradoresController" ng-cloak ng-init="proyecto_id='<?=$proyecto->proyecto_id?>'; consultarColaboradoresProyecto();">
	
	<div class="row">
		<div class="col-12 col-md-4"><h3 class=" text-center text-md-left"><i class="fa fa-fw fa-users"></i> Lista de colaboradores</h3></div>
		<div class="col-12 col-md-8">
			<?php if(isset($permisos['proyecto_colaboradores_tiempo']['edit'])){ ?>
				<a class="btn btn-sm btn-success float-md-right mb-3 mr-md-3 mx-auto d-block d-md-inline-block" href="<?=base_url()?>proyectos/colaboradores/<?=$proyecto->proyecto_id?>/registrar-tiempo-colaboradores" role="button"><i class="fa fa-fw fa-plus-circle"></i> Registrar horas laboradas</a> 
			<?php } ?>
			<?php if(isset($permisos['proyecto_colaboradores']['edit'])){ ?>
				<a class="btn btn-sm btn-primary float-md-right mb-3 mr-md-3 mx-auto d-block d-md-inline-block" href="<?=base_url()?>proyectos/colaboradores/<?=$proyecto->proyecto_id?>/editar-colaboradores" role="button"><i class="fa fa-fw fa-edit"></i> Editar lista de colaboradores</a> 
			<?php } ?>
				<a class="btn btn-sm btn-primary float-md-right mb-3 mr-md-3 mx-auto d-block d-md-inline-block" href="<?=base_url()?>proyectos/ver-proyecto/<?=$proyecto->proyecto_id?>" role="button"><i class="fa fa-fw fa-arrow-left"></i> Volver al proyecto</a></div>
	</div>

	<?php 
		
		if($this->input->get('nuevo')!=null && $this->input->get('nuevo')==1){ ?>
			<div class="alert alert-success alert-dismissable">Lista guardada con éxito.</div>
		<?php  } 


		if($this->input->get('editar')!=null && $this->input->get('editar')==1){ ?>
			<div class="alert alert-success alert-dismissable">Lista guardada con éxito.</div>
		<?php  } 

    ?>


	<div ng-if="colaboradores!==false" class="table-espaciado">

		<div class="table-responsive">
	        <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
	            <thead class="thead-light">
			        <tr>

						<th>Nombre de colaborador</th>
						<th>Puesto</th>
						<th>Teléfono</th>
						<th>Correo electrónico</th>
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
	            	<tr class="valor-oferta-item" ng-repeat="colaborador in colaboradores  | limitTo : cantidad_mostrar : currentPage*cantidad_mostrar">
	            		
						<td>{{colaborador.nombre + ' '+ colaborador.apellidos}}</td>
						<td>{{colaborador.puesto}}</td>
						<td>{{colaborador.telefono }}</td>
						<td>{{colaborador.correo_electronico}}</td>
						
					</tr>						
					
				</tbody>
			</table>
		</div>
		<p class="text-right">Mostrando de {{(currentPage*cantidad_mostrar)+1}} a {{(currentPage*cantidad_mostrar)+cantidad_mostrar}} - Total: {{total_rows}}</p>
	</div>

	
	<p ng-if="colaboradores===false" class="text-center table-espaciado">No hay colaboradores registrados aún<br>
		<a class="btn btn-primary mt-4" href="<?=base_url()?>proyectos/colaboradores/<?=$proyecto->proyecto_id?>/editar-colaboradores" role="button"><i class="fa fa-fw fa-plus-circle"></i> Editar lista de colaboradores</a>
	</p>

</div>