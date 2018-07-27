<script src="<?=base_url()?>instatec_pub/js/inicio.js"></script>
<div class="row row-bienvenida">
	<div class="col-12">
		<h1 class="text-center"><i class="fa fa-fw fa-table"></i> Dashboard</h1>
	</div>
</div>

<div class="page-content" ng-controller="inicioController" ng-init="base_url='<?=base_url()?>'">
	<div class="card mb-3">
        <div class="card-header anchor-class" data-toggle="collapse" data-target="#card1" aria-expanded="true" aria-controls="collapseExample">
          	<i class="fa fa-info"></i> Proyectos activos recientes <i class="fa fa-plus-circle float-right"></i></div>
        <div class="card-body collapse show" id="card1">
			<div ng-if="proyectos!==false" class="table-espaciado">
				<div class="table-responsive">
			        <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
			            <thead class="thead-light">
					        <tr>
					        	<th class="d-md-none">Acciones</th>
								<th>Datos</th>
								<th>Cliente</th>
								<?php if($rol_id==1 || $rol_id==2){ ?>
									<th>Estado</th>
								<?php } ?>						
								<th>Ubicación</th>						
								<?php if($rol_id==1 || $rol_id==2){ ?>
									<th>Fechas reelevantes</th>
								<?php } ?>
								<th class="d-none d-md-table-cell">Acciones</th>
							</tr>
						</thead>

			            <tbody>
							<tr ng-repeat="proyecto in proyectos | limitTo : cantidad_mostrar : currentPage*cantidad_mostrar">
								<td class="d-md-none">
									<a href="{{base_url}}proyectos/ver-proyecto/{{proyecto.proyecto_id}}" class="btn btn-edit btn-sm mb-1 btn-primary"><i class="fa fa-fw fa-eye"></i></a>
									<?php if(isset($permisos['proyecto']['edit'])){ ?>
										<a href="{{base_url}}proyectos/editar-proyecto/{{proyecto.proyecto_id}}" class="btn btn-edit btn-sm mb-1 btn-success"><i class="fa fa-fw fa-edit"></i></a> 
									<?php } ?> 
									<?php if(isset($permisos['reporte_proyecto_especifico']['view'])){ ?>
										<a href="{{base_url}}reportes/proyecto-especifico/{{proyecto.proyecto_id}}" class="btn btn-edit btn-sm mb-1 btn-secondary" target="_blank"><i class="fa fa-fw fa-download"></i></a>
									<?php } ?> 
								</td>
								<td><?=(isset($permisos['proyecto']['view']))?'<a href="{{base_url}}proyectos/ver-proyecto/{{proyecto.proyecto_id}}">':''?><strong>Nombre: {{proyecto.nombre_proyecto}}</strong><br>N° Contrato: {{proyecto.numero_contrato}}<br>Orden de compra: {{proyecto.orden_compra}}<?=(isset($permisos['proyecto']['view']))?'</a>':''?></td>
								<td><?=(isset($permisos['proyecto']['view']))?'<a href="{{base_url}}proyectos/ver-proyecto/{{proyecto.proyecto_id}}">':''?>{{proyecto.nombre_cliente}}<?=(isset($permisos['proyecto']['view']))?'</a>':''?></td>
								<?php if($rol_id==1 || $rol_id==2){ ?>
									<td><?=(isset($permisos['proyecto']['view']))?'<a href="{{base_url}}proyectos/ver-proyecto/{{proyecto.proyecto_id}}">':''?>{{proyecto.proyecto_estado}}<?=(isset($permisos['proyecto']['view']))?'</a>':''?></td>
								<?php } ?>
									<td><?=(isset($permisos['proyecto']['view']))?'<a href="{{base_url}}proyectos/ver-proyecto/{{proyecto.proyecto_id}}">':''?>Provincia: {{proyecto.provincia}}<br>Cantón: {{proyecto.canton}}<br>Distrito: {{proyecto.distrito}}<?=(isset($permisos['proyecto']['view']))?'</a>':''?></td>
								<?php if($rol_id==1 || $rol_id==2){ ?>
									<td><?=(isset($permisos['proyecto']['view']))?'<a href="{{base_url}}proyectos/ver-proyecto/{{proyecto.proyecto_id}}">':''?>Firma de contrato: {{proyecto.fecha_firma_contrato}}<br>Inicio: {{proyecto.fecha_inicio}}<br>Entrega: {{proyecto.fecha_entrega_estimada}}<?=(isset($permisos['proyecto']['view']))?'</a>':''?></td>
								<?php } ?>
								<td class="d-none d-md-table-cell">
									<a href="{{base_url}}proyectos/ver-proyecto/{{proyecto.proyecto_id}}" class="btn btn-edit btn-sm mb-1 btn-primary"><i class="fa fa-fw fa-eye"></i></a> 
									<?php if(isset($permisos['proyecto']['edit'])){ ?>
										<a href="{{base_url}}proyectos/editar-proyecto/{{proyecto.proyecto_id}}" class="btn btn-edit btn-sm mb-1 btn-success"><i class="fa fa-fw fa-edit"></i></a> 
									<?php } ?> 
									<?php if(isset($permisos['reporte_proyecto_especifico']['view'])){ ?>
										<a href="{{base_url}}reportes/proyecto-especifico/{{proyecto.proyecto_id}}" class="btn btn-edit btn-sm mb-1 btn-secondary" target="_blank"><i class="fa fa-fw fa-download"></i></a>
									<?php } ?> 
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				
			</div>
			<p ng-if="proyectos===false" class="text-center table-espaciado">No hay proyectos registrados aún</p>

			<div class="row">
				<div class="col-12"> 
					<?php if(isset($permisos['proyecto']['create'])){ ?>
						<a class="btn btn-primary float-md-right mb-3 mr-md-3 mx-auto d-block d-md-inline-block" href="<?=base_url()?>proyectos/agregar-proyecto" role="button"><i class="fa fa-fw fa-plus-circle"></i> Agregar proyecto</a> 
					<?php } ?>
					<a class="btn btn-primary float-md-right mb-3 mr-md-3 mx-auto d-block d-md-inline-block" href="<?=base_url()?>proyectos" role="button"><i class="fa fa-fw fa-plus-circle"></i> Ver todos los proyectos</a> 
				</div>
			</div>
		</div>
	</div>
</div>