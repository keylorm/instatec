<script src="<?=base_url()?>instatec_pub/js/material.js"></script>
<!-- Breadcrumbs-->
<ol class="breadcrumb">
	<li class="breadcrumb-item">
	  <a href="<?=base_url()?>">Inicio</a>
	</li>
	<li class="breadcrumb-item active">Materiales</li>
</ol>

<h1 class="text-center"><i class="fa fa-fw fa-wrench"></i> Materiales</h1>
<hr>


<div class="page-content" ng-controller="materialController">

	<div class="row">
		<div class="col-12 col-md-8"><h3 class=" text-center text-md-left"><i class="fa fa-fw fa-table"></i> Lista de materiales</h3></div>
		<?php if(isset($permisos['material']['create'])){ ?>
			<div class="col-12 col-md-2"><a class="btn btn-primary float-md-right mb-3 mr-md-3 mx-auto d-block d-md-inline-block" href="<?=base_url()?>materiales/agregar-material" role="button"><i class="fa fa-fw fa-plus-circle"></i> Agregar material</a></div>
		<?php } ?>
		<?php if(isset($permisos['material_unidad']['list'])){ ?>
			<div class="col-12 col-md-2 text-right dropdown  mb-3">
				<button class="btn btn-secondary dropdown-toggle float-md-right mb-3 mx-auto d-block d-md-inline-block" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-fw fa-cog"></i> Configuración </button>
				<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
					<a class="dropdown-item" href="<?=base_url()?>materiales/unidades">Unidades</a>
				</div>
			</div>
		<?php } ?>
	</div>
	<div class="card">
		<div class="card-header anchor-class" data-toggle="collapse" data-target="#filtroContainer" aria-expanded="false" aria-controls="collapseExample">
				<i class="fa fa-fw fa-filter"></i> Filtros <i class="fa float-right fa-plus-circle"></i>
        </div>
		<div class="card-body collapse" id="filtroContainer">			
			<div class="filtros">
				<form id="form-filtro">
					<div class="row">
						
						<div class="form-group col-12 col-md-4">
							<label for="material">Material</label>
							<input type="text" name="material" class="form-control" id="material"  ng-model="material">
							</small>
						</div>
						<div class="form-group col-12 col-md-4">
							<label for="material_codigo">Código de material</label>
							<input type="text" name="material_codigo" class="form-control" id="material_codigo"  ng-model="material_codigo">
							</small>
						</div>
					</div>
					<div class="row">
						<div class="col-12 col-md-4">
							<button  class="btn btn-primary form-submit" ng-click="filtrar()">Filtrar</button>
						</div>
						
					</div>
				
				</form>
			</div>
		</div>
	</div>
	<div class="table-espaciado">
		<div class="table-responsive">
	        <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
	            <thead class="thead-light">
			        <tr>
						<th class="d-md-none">Acciones</th>
						<th>Material</th>
						<th>Código</th>
						<th class="d-none d-md-table-cell">Acciones</th>
					</tr>
				</thead>
                <tfoot ng-if="total_rows > cantidad_mostrar">
                	<td colspan="5">
                	
                    	<nav aria-label="Page navigation example">
	                        <ul class="pagination pull-right">
                                <li class="page-item"><button class="page-link" ng-disabled="validarPrev()" ng-click="pagePrev()">Anterior</button></li>					
								<li class="page-item"><button class="page-link" ng-disabled="validarNext()" ng-click="pageNext()">Siguiente</button></li>

                            </ul>
	                        
	                    </nav>
                			
                		
                    </td>
				</tfoot>
	            <tbody>
					<tr ng-repeat="material in materiales | limitTo : cantidad_mostrar : currentPage*cantidad_mostrar">
						<td class="d-md-none">
							<?php if(isset($permisos['material']['edit'])){ ?>									
								<a href="<?=base_url()?>materiales/editar-material/{{material.material_id}}" class="btn btn-edit btn-sm btn-success mb-1"><i class="fa fa-fw fa-edit"></i></a>
							<?php } ?>
							<?php if(isset($permisos['material']['delete'])){ ?>
								<a class="btn btn-sm mb-1 btn-danger" href="#" data-toggle="modal" data-target="#deleteModal1{{material.material_id}}"><i class="fa fa-fw fa-trash-o"></i></a>
									<!-- Modal -->
								<div class="modal fade" id="deleteModal1{{material.material_id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="deleteModalLabel">¿Está seguro que desea eliminar este material?</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
											Se elimará toda la información relacionada a este material y no podrá ser recuperada.
											<br><br>
												Ingrese la palabra <strong>"eliminar"</strong> en el siguiente campo de texto para confirmar que está seguro de esta acción:
												<br><input ng-model="confirm_delete" type="text">
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
												<button type="button" ng-disabled="confirm_delete!='eliminar'" class="btn btn-danger" ng-click="borrarRow(material.material_id)"><i class="fa fa-fw fa-trash-o"></i> Eliminar</button>
											</div>
										</div>
										</div>
									</div>
								</div>
							<?php } ?>
						</td>
						<td><a href="<?=base_url()?>materiales/editar-material/{{material.material_id}}" class="">{{material.material}}</a></td>
						<td><a href="<?=base_url()?>materiales/editar-material/{{material.material_id}}" class="">{{material.material_codigo}}</a></td>
						<td class="d-none d-md-table-cell">
							<?php if(isset($permisos['material']['edit'])){ ?>
								<a href="<?=base_url()?>materiales/editar-material/{{material.material_id}}" class="btn btn-edit btn-sm btn-success mb-1"><i class="fa fa-fw fa-edit"></i></a>
							<?php } ?>
							<?php if(isset($permisos['material']['delete'])){ ?>
								<a class="btn btn-sm mb-1 btn-danger" href="#" data-toggle="modal" data-target="#deleteModal2{{material.material_id}}"><i class="fa fa-fw fa-trash-o"></i></a>
									<!-- Modal -->
								<div class="modal fade" id="deleteModal2{{material.material_id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="deleteModalLabel">¿Está seguro que desea eliminar este material?</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												Se elimará toda la información relacionada a este material y no podrá ser recuperada.
												<br><br>
												Ingrese la palabra <strong>"eliminar"</strong> en el siguiente campo de texto para confirmar que está seguro de esta acción:
												<br><input ng-model="confirm_delete" type="text">
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
												<button type="button" ng-disabled="confirm_delete!='eliminar'" class="btn btn-danger" ng-click="borrarRow(material.material_id)"><i class="fa fa-fw fa-trash-o"></i> Eliminar</button>
											</div>
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
    <p class="text-right">Mostrando de {{(currentPage*cantidad_mostrar)+1}} a {{(currentPage*cantidad_mostrar)+cantidad_mostrar}} - Total: {{total_rows}}</p>
</div>

