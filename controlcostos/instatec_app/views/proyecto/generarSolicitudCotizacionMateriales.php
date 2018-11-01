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
		<a href="<?=base_url()?>proyectos/materiales/<?=$proyecto->proyecto_id?>/solicitudes-cotizacion-materiales">Solicitudes de cotización</a>
	</li>
	<li class="breadcrumb-item active">Cotización de materiales</li>
</ol>

<h1 class="text-center "><i class="fa fa-fw fa-wrench"></i> Materiales de proyecto</h1>
<hr>

<div class="page-content" ng-controller="proyectoCotizacionMaterialesController" ng-cloak ng-init="proyecto_id='<?=$proyecto->proyecto_id?>'; consultarMateriales();">

	<div class="listado-materiales">
        
        <h3 class="text-center mb-3">Lista inicial de materiales</h3>
		<div ng-if="materiales_iniciales_proyecto!==false" class="table-espaciado" >
			<form id="generarCotizacionMaterialesIniciales" action="" method="post">
				<div class="row">
					<div class="col-12 col-md-12">
						<button type="submit" name="generar_cotizacion_materiales_iniciales" value
						="generar_cotizacion_materiales_iniciales" class="btn btn-sm btn-success float-md-right mb-3 mr-md-3 mx-auto d-block d-md-inline-block" role="button"><i class="fa fa-fw fa-download"></i> Generar archivo</button>
						<a class="btn btn-sm btn-secondary float-md-right mb-3 mr-md-3 mx-auto d-block d-md-inline-block" href="<?=base_url()?>proyectos/materiales/<?=$proyecto->proyecto_id?>/solicitudes-cotizacion-materiales/" role="button"><i class="fa fa-fw fa-arrow-left"></i> Volver</a>
					</div>
				</div>
		        <div class="row">
		            <div class="col-12 col-md-4">
		                <div class="form-group">
		                    <label for="buscar_inicial_material">Buscar material:</label>
		                    <input ng-model="buscar_inicial_material" class="form-control" id="buscar_inicial_material" type="text" />
		                </div>
		            </div>
		            <div class="col-12 col-md-4">
		                <div class="form-group">
		                    <label for="buscar_inicial_material_codigo">Buscar material por código:</label>
		                    <input ng-model="buscar_inicial_material_codigo" class="form-control" id="buscar_inicial_material_codigo" type="text" />
		                </div>
		            </div>
		        </div>
				<div class="table-responsive">
				        <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
				            <thead class="thead-light">
						        <tr>
						        	<th></th>
									<th>Material</th>
									<th>Detalle</th>
									<th>Cantidad</th>
								</tr>
							</thead>
				            <tbody>
				            	<tr class="material-item" ng-repeat="material_inicial in materiales_iniciales_proyecto  | filter:{material: buscar_inicial_material, material_codigo: buscar_inicial_material_codigo}">
				            		<td><input type="checkbox" name="material_inicial_check[]" value="{{material_inicial.proyecto_material_id}}" /></td>
									<td>{{material_inicial.material + ' (' + material_inicial.material_codigo + ')'}}</td>
									<td>{{material_inicial.comentario}}</td>
									<td>{{material_inicial.cantidad + ' (' + material_inicial.material_unidad + ')'}}</td>
								</tr>						
								
							</tbody>
						</table>
				</div>
				<p>* Si ningún material está seleccionado, se incluirán todos los materiales en el archivo de cotización.</p>
			</form>
		</div>


		<p ng-if="materiales_iniciales_proyecto===false" class="text-center table-espaciado">No hay materiales asignados aún</p>
	</div>

	
    <div class="listado-materiales">
        <h3 class="text-center mb-3">Lista de extensiones de materiales</h3>
        <div class="table-espaciado"  ng-if="materiales_extensiones_proyecto!==false" >
        	<form id="generarCotizacionMaterialesExtensiones" action="" method="post" id="download-form-bottom">
				<div class="row">
					<div class="col-12 col-md-12">
						<button type="submit" name="generar_cotizacion_materiales_extensiones" value
						="generar_cotizacion_materiales_extensiones" class="btn btn-sm btn-success float-md-right mb-3 mr-md-3 mx-auto d-block d-md-inline-block" role="button"><i class="fa fa-fw fa-download"></i> Generar archivo</button>
						<a class="btn btn-sm btn-secondary float-md-right mb-3 mr-md-3 mx-auto d-block d-md-inline-block" href="<?=base_url()?>proyectos/materiales/<?=$proyecto->proyecto_id?>/solicitudes-cotizacion-materiales/" role="button"><i class="fa fa-fw fa-arrow-left"></i> Volver</a>
					</div>
				</div>
				<div class="row">
		            <div class="col-12 col-md-4">
		                <div class="form-group">
		                    <label for="buscar_extension_material">Buscar material:</label>
		                    <input ng-model="buscar_extension_material" class="form-control" id="buscar_extension_material" type="text" />
		                </div>
		            </div>
		            <div class="col-12 col-md-4">
		                <div class="form-group">
		                    <label for="buscar_extension_material_codigo">Buscar material por código:</label>
		                    <input ng-model="buscar_extension_material_codigo" class="form-control" id="buscar_extension_material_codigo" type="text" />
		                </div>
		            </div>
		        </div>
	            <div class="table-responsive">
	                <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
	                    <thead class="thead-light">
					        <tr>
					        	<th></th>
								<th>Material</th>
								<th>Detalle</th>
								<th>Cantidad</th>
							</tr>
						</thead>
			            <tbody>
			            	<tr class="material-item" ng-repeat="material_extension in materiales_extensiones_proyecto  | filter:{material: buscar_extension_material, material_codigo: buscar_extension_material_codigo}">
			            		<td><input type="checkbox" name="material_extension_check[]" value="{{material_extension.proyecto_material_id}}" /></td>
								<td>{{material_extension.material + ' (' + material_extension.material_codigo + ')'}}</td>
								<td>{{material_extension.comentario}}</td>
								<td>{{material_extension.cantidad + ' (' + material_extension.material_unidad + ')'}}</td>
							</tr>						
							
						</tbody>
	                </table>
	            </div>
        		<p>* Si ningún material está seleccionado, se incluirán todos los materiales en el archivo de cotización.</p>
	        </form>
        </div>

    
        <p ng-if="materiales_extensiones_proyecto===false" class="text-center table-espaciado">No hay extensiones de materiales aún</p>
    </div>

</div>