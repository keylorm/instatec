<script src="<?=base_url()?>instatec_pub/js/colaborador.js"></script>
<!-- Breadcrumbs-->
<ol class="breadcrumb">
	<li class="breadcrumb-item">
	  <a href="<?=base_url()?>">Inicio</a>
	</li>
	<li class="breadcrumb-item">
	  <a href="<?=base_url()?>colaboradores">Colaboradores</a>
	</li>
	<li class="breadcrumb-item active">Puestos de trabajo</li>
</ol>

<h1 class="text-center"><i class="fa fa-fw fa-sitemap"></i> Puestos de Trabajo</h1>
<hr>


<div class="page-content" ng-controller="colaboradorPuestosController">
	<div class="row">
		<div class="col-12 col-md-8"><h3 class=" text-center text-md-left"><i class="fa fa-fw fa-table"></i> Lista de puestos de trabajo</h3></div>
		<div class="col-12 col-md-2"><a class="btn btn-secondary float-md-right mb-3 mr-md-3 mx-auto d-block d-md-inline-block" href="<?=base_url()?>colaboradores" role="button"><i class="fa fa-fw fa-arrow-left"></i> Volver a colaboradores</a></div>
		<?php if(isset($permisos['colaborador_puestos']['create'])){ ?>
			<div class="col-12 col-md-2"><a class="btn btn-primary float-md-right mb-3 mr-md-3 mx-auto d-block d-md-inline-block" href="<?=base_url()?>colaboradores/agregar-puesto-trabajo" role="button"><i class="fa fa-fw fa-plus-circle"></i> Agregar puesto</a></div>
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
							<label for="puesto">Puesto de trabajo</label>
							<input type="text" name="puesto" class="form-control" id="puesto"  ng-model="puesto">
							</small>
						</div>
					</div>
					<div class="row">	
						<div class="col-12 col-md-4">
							<button  class="btn btn-primary form-submit" ng-click="filtrarColaborador()">Filtrar</button>
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
						<th>Puesto de trabajo</th>
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
					<tr ng-repeat="colaborador_puesto in colaborador_puestos | limitTo : cantidad_mostrar : currentPage*cantidad_mostrar">
						<td class="d-md-none">
							<?php if(isset($permisos['colaborador_puestos']['edit'])){ ?>									
								<a href="<?=base_url()?>colaboradores/editar-puesto-trabajo/{{colaborador_puesto.colaborador_puesto_id}}" class="btn btn-edit btn-sm btn-success mb-1"><i class="fa fa-fw fa-edit"></i></a>
							<?php } ?>
							<?php if(isset($permisos['colaborador_puestos']['delete'])){ ?>
								<a ng-show="colaborador_puesto.colaborador_puesto_id!=1" class="btn btn-sm mb-1 btn-danger" href="#" data-toggle="modal" data-target="#deleteModal1{{colaborador_puesto.colaborador_puesto_id}}"><i class="fa fa-fw fa-trash-o"></i></a>
									<!-- Modal -->
								<div class="modal fade" id="deleteModal1{{colaborador_puesto.colaborador_puesto_id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="deleteModalLabel">¿Está seguro que desea eliminar este puesto de trabajo?</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
											Una vez eliminado no se podrá recuperar.
											<br><br>
												Ingrese la palabra <strong>"eliminar"</strong> en el siguiente campo de texto para confirmar que está seguro de esta acción:
												<br><input ng-model="confirm_delete" type="text">
												<br><p ng-if="error==true">{{error_message}}</p>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
												<button type="button" ng-disabled="confirm_delete!='eliminar'" class="btn btn-danger" ng-click="borrarRow(colaborador_puesto.colaborador_puesto_id)"><i class="fa fa-fw fa-trash-o"></i> Eliminar</button>
											</div>
										</div>
										</div>
									</div>
								</div>
							<?php } ?>
						</td>
						<td>{{colaborador_puesto.puesto}}</td>
						<td class="d-none d-md-table-cell">
							<?php if(isset($permisos['colaborador_puestos']['edit'])){ ?>
								<a href="<?=base_url()?>colaboradores/editar-puesto-trabajo/{{colaborador_puesto.colaborador_puesto_id}}" class="btn btn-edit btn-sm btn-success mb-1"><i class="fa fa-fw fa-edit"></i></a>
							<?php } ?>
							<?php if(isset($permisos['colaborador_puestos']['delete'])){ ?>
								<a ng-show="colaborador_puesto.colaborador_puesto_id!=1" class="btn btn-sm mb-1 btn-danger" href="#" data-toggle="modal" data-target="#deleteModal2{{colaborador_puesto.colaborador_puesto_id}}"><i class="fa fa-fw fa-trash-o"></i></a>
									<!-- Modal -->
								<div class="modal fade" id="deleteModal2{{colaborador_puesto.colaborador_puesto_id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="deleteModalLabel">¿Está seguro que desea eliminar este puesto de trabajo?</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												Una vez eliminado no se podrá recuperar.
												<br><br>
												Ingrese la palabra <strong>"eliminar"</strong> en el siguiente campo de texto para confirmar que está seguro de esta acción:
												<br><input ng-model="confirm_delete" type="text">
												<br><br><p class="text-danger" ng-if="error==true">{{error_message}}</p>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
												<button type="button" ng-disabled="confirm_delete!='eliminar'" class="btn btn-danger" ng-click="borrarRow(colaborador_puesto.colaborador_puesto_id)"><i class="fa fa-fw fa-trash-o"></i> Eliminar</button>
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

