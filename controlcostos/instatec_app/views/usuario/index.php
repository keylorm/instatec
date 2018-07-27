<script src="<?=base_url()?>instatec_pub/js/usuario.js"></script>
<!-- Breadcrumbs-->
<ol class="breadcrumb">
	<li class="breadcrumb-item">
	  <a href="<?=base_url()?>">Inicio</a>
	</li>
	<li class="breadcrumb-item active">Usuarios</li>
</ol>

<h1 class="text-center"><i class="fa fa-fw fa-users"></i> Usuarios</h1>
<hr>


<div class="page-content" ng-controller="usuarioController">
	<div class="row">
		<div class="col-12 col-md-10"><h3 class=" text-center text-md-left"><i class="fa fa-fw fa-table"></i> Lista de usuarios</h3></div>
		<?php if(isset($permisos['usuario']['create'])){ ?>
			<div class="col-12 col-md-2"><a class="btn btn-primary float-md-right mb-3 mr-md-3 mx-auto d-block d-md-inline-block" href="<?=base_url()?>usuarios/agregar-usuario" role="button"><i class="fa fa-fw fa-plus-circle"></i> Agregar usuario</a></div>
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
							<label for="usuario">Usuario</label>
							<input type="text" name="usuario" class="form-control" id="usuario"  ng-model="usuario">
						</div>
						<div class="form-group col-12 col-md-4">
							<label for="nombre">Nombre</label>
							<input type="text" name="nombre" class="form-control" id="nombre"  ng-model="nombre">
							</small>
						</div>
						<div class="form-group col-12 col-md-4">
							<label for="apellidos">Apellidos de usuario</label>
							<input type="text" name="apellidos" class="form-control" id="apellidos"  ng-model="apellidos">
							</small>
						</div>
						<div class="form-group col-12 col-md-4">
							<label for="correo_electronico">Correo de usuario</label>
							<input type="text" name="correo_electronico" class="form-control" id="correo_electronico"  ng-model="correo_electronico">
							</small>
						</div>
						<div class="form-group col-12 col-md-4">
							<label>Rol:</label>
							<select class="form-control" name="rol_id" id="rol_id" aria-describedby="roleHelp" ng-model="rol_id" required="required">
								<option value="all" selected="selected">Todos</option>
								<?php foreach($roles as $krol => $vrol){ ?>
									<option value="<?=$vrol->rol_id?>"><?=$vrol->rol_name?></option>
								<?php } ?>
							</select>	
						</div>
						<div class="form-group col-12 col-md-4">
							<label>Estado del usuario:</label>
							<div class="form-check">
								<label class="form-check-label">
									<input class="form-check-input" type="radio" name="estado_id" id="estado1" ng-value="1" ng-model="estado_id" >
									Activo
								</label>
							</div>
							<div class="form-check">
								<label class="form-check-label">
									<input class="form-check-input" type="radio" name="estado_id" id="estado2" ng-model="estado_id" ng-value="0">
									Inactivo
								</label>
							</div>
							<div class="form-check">
								<label class="form-check-label">
									<input class="form-check-input" type="radio" name="estado_id" id="estado3" ng-value="all" ng-model="estado_id" >
									Ambos
								</label>
							</div>
						</div>
						<div class="col-12 col-md-4">
							<button  class="btn btn-primary form-submit" ng-click="filtrarUsuario()">Filtrar</button>
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
						<th>Usuario</th>
						<th>Nombre</th>
						<th>Apellidos</th>
						<th>Correo</th>
						<th>Rol</th>
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
					<tr ng-repeat="usuario in usuarios | limitTo : cantidad_mostrar : currentPage*cantidad_mostrar">
						<td class="d-md-none">
							<?php if(isset($permisos['usuario']['edit'])){ ?>
								<a href="<?=base_url()?>usuarios/editar-usuario/{{usuario.usuario_id}}" class="btn btn-edit btn-sm btn-success mb-1"><i class="fa fa-fw fa-edit"></i></a>
							<?php } ?>
							<?php if(isset($permisos['usuario']['delete'])){ ?>	
								<a class="btn btn-sm mb-1 btn-danger" href="#" data-toggle="modal" data-target="#deleteModal1{{usuario.usuario_id}}"><i class="fa fa-fw fa-trash-o"></i></a>
									<!-- Modal -->
								<div class="modal fade" id="deleteModal1{{usuario.usuario_id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="deleteModalLabel">¿Está seguro que desea eliminar este usuario?</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
											Se elimará toda la información relacionada a este usuario y no podrá ser recuperada.
											<br><br>
												Ingrese la palabra <strong>"eliminar"</strong> en el siguiente campo de texto para confirmar que está seguro de esta acción:
												<br><input ng-model="confirm_delete" type="text">
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
												<button type="button" ng-disabled="confirm_delete!='eliminar'" class="btn btn-danger" ng-click="borrarRow(usuario.usuario_id)"><i class="fa fa-fw fa-trash-o"></i> Eliminar</button>
											</div>
										</div>
										</div>
									</div>
								</div>
							<?php } ?>
						</td>
						<td>{{usuario.usuario}}</td>
						<td>{{usuario.nombre}}</td>
						<td>{{usuario.apellidos}}</td>
						<td>{{usuario.correo_electronico}}</td>
						<td>{{usuario.rol_name }}</td>
						<td ng-switch="usuario.estado_id"><span ng-switch-when="1">Activo</span><span ng-switch-when="0">Inactivo</span></td>
						<td class="d-none d-md-table-cell">
							<?php if(isset($permisos['usuario']['edit'])){ ?>
								<a href="<?=base_url()?>usuarios/editar-usuario/{{usuario.usuario_id}}" class="btn btn-edit btn-sm btn-success mb-1"><i class="fa fa-fw fa-edit"></i></a>
							<?php } ?>
							<?php if(isset($permisos['usuario']['delete'])){ ?>	
								<a class="btn btn-sm mb-1 btn-danger" href="#" data-toggle="modal" data-target="#deleteModal2{{usuario.usuario_id}}"><i class="fa fa-fw fa-trash-o"></i></a>
									<!-- Modal -->
								<div class="modal fade" id="deleteModal2{{usuario.usuario_id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="deleteModalLabel">¿Está seguro que desea eliminar este usuario?</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												Se elimará toda la información relacionada a este usuario y no podrá ser recuperada.
												<br><br>
												Ingrese la palabra <strong>"eliminar"</strong> en el siguiente campo de texto para confirmar que está seguro de esta acción:
												<br><input ng-model="confirm_delete" type="text">
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
												<button type="button" ng-disabled="confirm_delete!='eliminar'" class="btn btn-danger" ng-click="borrarRow(usuario.usuario_id)"><i class="fa fa-fw fa-trash-o"></i> Eliminar</button>
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

