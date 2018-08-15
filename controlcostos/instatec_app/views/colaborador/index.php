<script src="<?=base_url()?>instatec_pub/js/colaborador.js"></script>
<!-- Breadcrumbs-->
<ol class="breadcrumb">
	<li class="breadcrumb-item">
	  <a href="<?=base_url()?>">Inicio</a>
	</li>
	<li class="breadcrumb-item active">Colaboradores</li>
</ol>

<h1 class="text-center"><i class="fa fa-fw fa-users"></i> Colaboradores</h1>
<hr>


<div class="page-content" ng-controller="colaboradorController">
	<div class="row">
		<div class="col-12 col-md-8"><h3 class=" text-center text-md-left"><i class="fa fa-fw fa-table"></i> Lista de colaboradores</h3></div>
		<?php if(isset($permisos['colaborador']['create'])){ ?>
			<div class="col-12 col-md-2"><a class="btn btn-primary float-md-right mb-3 mr-md-3 mx-auto d-block d-md-inline-block" href="<?=base_url()?>colaboradores/agregar-colaborador" role="button"><i class="fa fa-fw fa-plus-circle"></i> Agregar colaborador</a></div>
		<?php } ?>
		<?php if(isset($permisos['colaborador_puestos']['list'])){ ?>
			<div class="col-12 col-md-2">
				<div class="dropdown">
					<button class="btn btn-secondary dropdown-toggle text-right" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-fw fa-cog"></i> Configuración </button>
					<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						<a class="dropdown-item" href="<?=base_url()?>colaboradores/puestos-trabajo">Puestos de trabajo</a>
					</div>
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
							<label for="nombre">Nombre</label>
							<input type="text" name="nombre" class="form-control" id="nombre"  ng-model="nombre">
							</small>
						</div>
						<div class="form-group col-12 col-md-4">
							<label for="apellidos">Apellidos de colaborador</label>
							<input type="text" name="apellidos" class="form-control" id="apellidos"  ng-model="apellidos">
							</small>
						</div>
						<div class="form-group col-12 col-md-4">
							<label for="alias">Alias o apodo de colaborador</label>
							<input type="text" name="alias" class="form-control" id="alias"  ng-model="alias">
							</small>
						</div>
						<div class="form-group col-12 col-md-4">
							<label for="cedula">Cédula del colaborador</label>
							<input type="text" name="cedula" class="form-control" id="cedula"  ng-model="cedula">
							</small>
						</div>
						<div class="form-group col-12 col-md-4">
							<label for="correo_electronico">Correo de colaborador</label>
							<input type="text" name="correo_electronico" class="form-control" id="correo_electronico"  ng-model="correo_electronico">
							</small>
						</div>
						<div class="form-group col-12 col-md-4">
							<label for="seguro_social">Seguro social</label>
							<input type="text" name="seguro_social" class="form-control" id="seguro_social"  ng-model="seguro_social">
							</small>
						</div>
						<div class="form-group col-12 col-md-4">
							<label for="identificador_interno">Identificador interno</label>
							<input type="text" name="identificador_interno" class="form-control" id="identificador_interno"  ng-model="identificador_interno">
							</small>
						</div>
						<div class="form-group col-12 col-md-4">
							<label>Puesto:</label>
							<select class="form-control" name="colaborador_puesto_id" id="colaborador_puesto_id" aria-describedby="roleHelp" ng-model="colaborador_puesto_id" required="required">
								<option value="all" selected="selected">Todos</option>
								<?php foreach($puestos as $kpuesto => $vpuesto){ ?>
									<option value="<?=$vpuesto->colaborador_puesto_id?>"><?=$vpuesto->puesto?></option>
								<?php } ?>
							</select>	
						</div>
						<div class="form-group col-12 col-md-4">
							<label>Estado del colaborador:</label>
							<div class="form-check">
								<label class="form-check-label">
									<input class="form-check-input" type="radio" name="estado" id="estado1" value="1" ng-value="1" ng-model="estado" >
									Activo
								</label>
							</div>
							<div class="form-check">
								<label class="form-check-label">
									<input class="form-check-input" type="radio" name="estado" id="estado2" value="0" ng-model="estado" ng-value="0">
									Inactivo
								</label>
							</div>
							<div class="form-check">
								<label class="form-check-label">
									<input class="form-check-input" type="radio" name="estado" id="estado3" value="all" ng-value="all" ng-model="estado" >
									Ambos
								</label>
							</div>
						</div>
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
						<th>ID</th>
						<th>Nombre completo</th>
						<th>Cédula</th>
						<th>Identificador interno</th>
						<th>Puesto</th>
						<th>Estado</th>
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
					<tr ng-repeat="colaborador in colaboradores | limitTo : cantidad_mostrar : currentPage*cantidad_mostrar">
						<td class="d-md-none">
							<?php if(isset($permisos['colaborador']['edit'])){ ?>									
								<a href="<?=base_url()?>colaboradores/editar-colaborador/{{colaborador.colaborador_id}}" class="btn btn-edit btn-sm btn-success mb-1"><i class="fa fa-fw fa-edit"></i></a>
							<?php } ?>
							<?php if(isset($permisos['colaborador']['delete'])){ ?>
								<a class="btn btn-sm mb-1 btn-danger" href="#" data-toggle="modal" data-target="#deleteModal1{{colaborador.colaborador_id}}"><i class="fa fa-fw fa-trash-o"></i></a>
									<!-- Modal -->
								<div class="modal fade" id="deleteModal1{{colaborador.colaborador_id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="deleteModalLabel">¿Está seguro que desea eliminar este colaborador?</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
											Se elimará toda la información relacionada a este colaborador y no podrá ser recuperada.
											<br><br>
												Ingrese la palabra <strong>"eliminar"</strong> en el siguiente campo de texto para confirmar que está seguro de esta acción:
												<br><input ng-model="confirm_delete" type="text">
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
												<button type="button" ng-disabled="confirm_delete!='eliminar'" class="btn btn-danger" ng-click="borrarRow(colaborador.colaborador_id)"><i class="fa fa-fw fa-trash-o"></i> Eliminar</button>
											</div>
										</div>
										</div>
									</div>
								</div>
							<?php } ?>
						</td>
						<td><a href="<?=base_url()?>colaboradores/editar-colaborador/{{colaborador.colaborador_id}}" class="">{{colaborador.colaborador_id}}</a></td>
						<td><a href="<?=base_url()?>colaboradores/editar-colaborador/{{colaborador.colaborador_id}}" class="">{{colaborador.nombre}} {{colaborador.apellidos}} {{colaborador.alias !== ''? '('+colaborador.alias+')':''}}</a></td>
						<td><a href="<?=base_url()?>colaboradores/editar-colaborador/{{colaborador.colaborador_id}}" class="">{{colaborador.cedula}}</a></td>
						<td><a href="<?=base_url()?>colaboradores/editar-colaborador/{{colaborador.colaborador_id}}" class="">{{colaborador.identificador_interno}}</a></td>
						<td><a href="<?=base_url()?>colaboradores/editar-colaborador/{{colaborador.colaborador_id}}" class="">{{colaborador.puesto }}</a></td>
						<td ng-switch="colaborador.estado"><span ng-switch-when="1">Activo</span><span ng-switch-when="0">Inactivo</span></td>
						<td class="d-none d-md-table-cell">
							<?php if(isset($permisos['colaborador']['edit'])){ ?>
								<a href="<?=base_url()?>colaboradores/editar-colaborador/{{colaborador.colaborador_id}}" class="btn btn-edit btn-sm btn-success mb-1"><i class="fa fa-fw fa-edit"></i></a>
							<?php } ?>
							<?php if(isset($permisos['colaborador']['delete'])){ ?>
								<a class="btn btn-sm mb-1 btn-danger" href="#" data-toggle="modal" data-target="#deleteModal2{{colaborador.colaborador_id}}"><i class="fa fa-fw fa-trash-o"></i></a>
									<!-- Modal -->
								<div class="modal fade" id="deleteModal2{{colaborador.colaborador_id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="deleteModalLabel">¿Está seguro que desea eliminar este colaborador?</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												Se elimará toda la información relacionada a este colaborador y no podrá ser recuperada.
												<br><br>
												Ingrese la palabra <strong>"eliminar"</strong> en el siguiente campo de texto para confirmar que está seguro de esta acción:
												<br><input ng-model="confirm_delete" type="text">
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
												<button type="button" ng-disabled="confirm_delete!='eliminar'" class="btn btn-danger" ng-click="borrarRow(colaborador.colaborador_id)"><i class="fa fa-fw fa-trash-o"></i> Eliminar</button>
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

