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
	<li class="breadcrumb-item active">Generar solicitud</li>
</ol>

<h1 class="text-center "><i class="fa fa-fw fa-plus-circle"></i> Solicitudes de compra de materiales</h1>
<hr>

<div class="page-content" ng-controller="proyectoEditarSolicitudCompraMaterialesController" ng-cloak ng-init="proyecto_id='<?=$proyecto->proyecto_id?>'; proyecto_material_solicitud_compra_id = '<?=$solicitud_compra_id?>'; consultarMateriales();">

	<div class="row">
		<div class="col-12 col-md-12">
			<a class="btn btn-sm btn-secondary float-md-right mb-3 mr-md-3 mx-auto d-block d-md-inline-block" href="<?=base_url()?>proyectos/materiales/<?=$proyecto->proyecto_id?>/solicitudes-compra-materiales/" role="button"><i class="fa fa-fw fa-arrow-left"></i> Volver</a>
		</div>
	</div>
	<form id="generarSolicitudMaterialesIniciales" action="" method="post">
		<div class="listado-materiales">
	        
	        <h3 class="text-center mb-3">Lista inicial de materiales</h3>
			<div ng-if="materiales_iniciales_proyecto!==false" class="table-espaciado" >
				<div class="table-responsive">
			        <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
			            <thead class="thead-light">
					        <tr>
					        	<th></th>
								<th>Material</th>
								<th>Cantidad</th>
							</tr>
						</thead>
			            <tbody>
			            	<tr class="material-item" ng-repeat="material_inicial in materiales_iniciales_proyecto">
			            		<td><input ng-if="material_inicial.cantidad_restante > 0" type="checkbox" name="material_check[{{material_inicial.proyecto_material_id}}]" ng-model="material_check[material_inicial.proyecto_material_id]" value="{{material_inicial.proyecto_material_id}}" /></td>
								<td>{{material_inicial.material + ' (' + material_inicial.material_codigo + ')'}}<br>
								{{material_inicial.comentario}}</td>
								<td>
									<div class="edit-container row" ng-show="material_check[material_inicial.proyecto_material_id]===true">
	                                    
	                                    <div class="col-12">
	                                        <input class="form-control" aria-describedby="cantidadHelp" type="number" value="0" min="0" step="0.05" pattern="^\d+(?:\.\d{1,2})?$" ng-value="material_cantidad[material_inicial.proyecto_material_id]" name="cantidad[{{material_inicial.proyecto_material_id}}]" max="{{material_inicial.cantidad_restante}}">
	                                        <small id="cantidadHelp" class="form-text text-muted">{{material_inicial.material_unidad}}<br/>
											</small>
	                                    </div>
	                                     <div ng-show="mensaje_error[material_inicial.proyecto_material_id].error_cantidad !== undefined" class="col-12 mt-2">
	                                         <div class="alert alert-danger">
	                                             {{mensaje_error[material_inicial.proyecto_material_id].error_cantidad}}
	                                         </div>
	                                     </div>
	                                </div>
								<span ng-show="material_check[material_inicial.proyecto_material_id]===false">{{material_inicial.cantidad_restante + ' ' + material_inicial.material_unidad + ' restante'}}
									</span>
							</tr>						
							
						</tbody>
					</table>
				</div>
				<p>* Debe seleccionar un material e ingresar una cantidad para poder generar la solicitud.</p>

			</div>


			<p ng-if="materiales_iniciales_proyecto===false" class="text-center table-espaciado">No hay materiales asignados aún</p>
		</div>

	
	    <div class="listado-materiales" ng-if="materiales_extensiones_proyecto!==false">
	        <h3 class="text-center mb-3">Lista de extensiones de materiales</h3>
	        <div class="table-espaciado">
				
	            <div class="table-responsive">
	                <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
	                    <thead class="thead-light">
					        <tr>
					        	<th></th>
								<th>Material</th>
								<th>Cantidad</th>
							</tr>
						</thead>
			            <tbody>
			            	<tr class="material-item" ng-repeat="material_extension in materiales_extensiones_proyecto">
			            		<td><input type="checkbox" name="material_check[{{material_extension.proyecto_material_id}}]" ng-model="material_check[material_extension.proyecto_material_id]" value="{{material_extension.proyecto_material_id}}" /></td>
			            		</td>
								<td>{{material_extension.material + ' (' + material_extension.material_codigo + ')'}}<br>
									{{material_extension.comentario}}</td>
								<td>
									<div class="edit-container row" ng-show="material_check[material_extension.proyecto_material_id]===true">
	                                    
	                                    <div class="col-12">
	                                        <input class="form-control" aria-describedby="cantidadHelp" type="number" value="0" min="0" step="0.05" pattern="^\d+(?:\.\d{1,2})?$" ng-value="material_cantidad[material_extension.proyecto_material_id]" name="cantidad[{{material_extension.proyecto_material_id}}]" max="{{material_extension.cantidad_restante}}">
	                                        <small id="cantidadHelp" class="form-text text-muted">{{material_extension.material_unidad}}<br/>
											</small>
	                                    </div>
	                                     <div ng-show="mensaje_error[material_extension.proyecto_material_id].error_cantidad !== undefined" class="col-12 mt-2">
	                                         <div class="alert alert-danger">
	                                             {{mensaje_error[material_extension.proyecto_material_id].error_cantidad}}
	                                         </div>
	                                     </div>
	                                </div>
									<span ng-show="material_check[material_extension.proyecto_material_id]===false">{{material_extension.cantidad_restante + ' ' + material_extension.material_unidad + ' restante'}}
									</span>
								</td>
							</tr>						
							
						</tbody>
	                </table>
	            </div>
        		<p>* Si ningún material está seleccionado, se incluirán todos los materiales en el archivo de cotización.</p>
	        </div>
	    </div>

	    <button ng-if="materiales_iniciales_proyecto!==false" type="submit" name="generar_solicitud" value
			="generar_solicitud" class="btn btn-sm btn-success float-md-right mb-3 mr-md-3 mx-auto d-block d-md-inline-block" role="button"><i class="fa fa-fw fa-save"></i> Guardar Solicitud</button>
	</form>

</div>