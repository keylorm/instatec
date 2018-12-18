<script src="<?=base_url()?>src/instatec_pub/js/reporte.js"></script>
<!-- Breadcrumbs-->
<ol class="breadcrumb">
	<li class="breadcrumb-item">
	  <a href="<?=base_url()?>">Inicio</a>
	</li>
	<li class="breadcrumb-item">
	  <a href="<?=base_url()?>reportes">Reportes</a>
	</li>
	<li class="breadcrumb-item active">Horas por Trabajador</li>
</ol>

<h1 class="text-center"><i class="fa fa-fw fa-table"></i> Reporte de horas por trabajador</h1>
<hr>


<div class="page-content" ng-controller="reporteHorasPorTrabajadorController">
	<div class="row">
		<div class="col-12"><h3 class=" text-center text-md-left"><i class="fa fa-fw fa-table"></i> Horas por trabajador</h3></div>		
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
									<option value="<?=$vpuesto['colaborador_puesto_id']?>"><?=$vpuesto['puesto']?></option>
								<?php } ?>
							</select>	
						</div>
						<div class="form-group col-12 col-md-4">
							<label>Estado del colaborador:</label>
							<div class="form-check">
								<label class="form-check-label">
									<input class="form-check-input" type="radio" name="estado" id="estado1" ng-value="1" ng-model="estado" >
									Activo
								</label>
							</div>
							<div class="form-check">
								<label class="form-check-label">
									<input class="form-check-input" type="radio" name="estado" id="estado2" ng-model="estado" ng-value="0">
									Inactivo
								</label>
							</div>
							<div class="form-check">
								<label class="form-check-label">
									<input class="form-check-input" type="radio" name="estado" id="estado3" ng-value="all" ng-model="estado" >
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
						<th>Nombre</th>
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
								<a href="<?=base_url()?>reportes/horas-por-trabajador/{{colaborador.colaborador_id}}" class="btn btn-edit btn-sm btn-success mb-1"><i class="fa fa-fw fa-list"></i></a>
							<?php } ?>
							
						</td>
						<td><a href="<?=base_url()?>reportes/horas-por-trabajador/{{colaborador.colaborador_id}}" class="">{{colaborador.nombre}} {{colaborador.apellidos}}</td>	</a>					
						<td><a href="<?=base_url()?>reportes/horas-por-trabajador/{{colaborador.colaborador_id}}" class="">{{colaborador.cedula}}</a></td>
						<td><a href="<?=base_url()?>reportes/horas-por-trabajador/{{colaborador.colaborador_id}}" class="">{{colaborador.identificador_interno}}</a></td>
						<td><a href="<?=base_url()?>reportes/horas-por-trabajador/{{colaborador.colaborador_id}}" class="">{{colaborador.puesto }}</a></td>
						<td ng-switch="colaborador.estado"><a href="<?=base_url()?>reportes/horas-por-trabajador/{{colaborador.colaborador_id}}" class=""><span ng-switch-when="1">Activo</span><span ng-switch-when="0">Inactivo</span></a></td>
						<td class="d-none d-md-table-cell">
							<?php if(isset($permisos['colaborador']['edit'])){ ?>
								<a href="<?=base_url()?>reportes/horas-por-trabajador/{{colaborador.colaborador_id}}" class="btn btn-edit btn-sm btn-success mb-1"><i class="fa fa-fw fa-list"></i></a>
							<?php } ?>
							
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		
	</div>
    <p class="text-right">Mostrando de {{(currentPage*cantidad_mostrar)+1}} a {{(currentPage*cantidad_mostrar)+cantidad_mostrar}} - Total: {{total_rows}}</p>
</div>

