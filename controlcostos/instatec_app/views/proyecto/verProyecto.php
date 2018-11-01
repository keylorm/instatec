<script src="<?=base_url()?>instatec_pub/js/proyecto.js"></script>
<!-- Breadcrumbs-->
<ol class="breadcrumb">
	<li class="breadcrumb-item">
	  <a href="<?=base_url()?>">Inicio</a>
	</li>
	<li class="breadcrumb-item">
	  <a href="<?=base_url()?>proyectos">Proyectos</a>
	</li>
	<li class="breadcrumb-item active">Ver proyecto</li>
</ol>
<h1  class="text-center"><i class="fa fa-fw fa-handshake-o"></i> Proyectos</h1>
<hr>

<?php if($rol_id!=3 && $rol_id!=4){ ?>
	<div class="page-content" ng-controller="proyectoDashboard" ng-init="proyecto_id='<?=$proyecto->proyecto_id?>'; consultarInfoProyecto();">
		<div class="row">
			<div class="col-12"><h3 class=" text-center text-md-left"><i class="fa fa-fw fa-eye"></i> Ver proyecto: <?=$proyecto->nombre_proyecto?></h3></div>
			<div class="col-12 text-right"> 
				<?php if(isset($permisos['reporte_proyecto_especifico']['view'])){ ?>
					<a class="btn btn-sm btn-secondary mb-3 mr-md-3 mx-auto d-block d-md-inline-block" href="<?=base_url()?>reporte/generarReporteProyectoEspecifico/<?=$proyecto->proyecto_id?>" role="button" target="_blank"><i class="fa fa-download"></i> Generar reporte</a> 
				<?php } ?>
				<?php if(isset($permisos['proyecto']['edit'])){ ?>
					<a class="btn btn-sm btn-primary mb-3 mr-md-3 mx-auto d-block d-md-inline-block" href="<?=base_url()?>proyectos/editar-proyecto/<?=$proyecto->proyecto_id?>" role="button"><i class="fa fa-fw fa-edit"></i> Editar proyecto</a> 
				<?php } ?>
				<?php if(isset($permisos['proyecto']['delete'])){ ?>
					<a class="btn btn-sm btn-danger mb-3 mr-md-3 mx-auto d-block d-md-inline-block" href="#" data-toggle="modal" data-target="#deleteModal{{proyecto_id}}"><i class="fa fa-fw fa-trash-o"></i> Eliminar proyecto</a>
					<!-- Modal -->
					<div class="modal fade" id="deleteModal{{proyecto_id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="deleteModalLabel">¿Está seguro que desea eliminar este proyecto?</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								Se elimará toda la información relacionada a este proyecto, como gastos, valor de la oferta, registro de horas de trabajo, ordenes de cambio de valor de la oferta, etc. Una vez eliminada esta información, no podrá ser recuperada.
								<br><br>
								Ingrese la palabra <strong>"eliminar"</strong> en el siguiente campo de texto para confirmar que está seguro de esta acción:
								<br><input ng-model="confirm_delete" type="text">
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
								<button type="button" ng-disabled="confirm_delete!='eliminar'" class="btn btn-danger" ng-click="borrarRow(proyecto_id)"><i class="fa fa-fw fa-trash-o"></i> Eliminar</button>
							</div>
						</div>
						</div>
					</div>
				<?php } ?>
				
			</div>
			<div class="col-12">
				<?php if(isset($permisos['proyecto_gastos']['list'])){ ?>
					<a class="btn btn-sm btn-success mr-md-3 mx-auto d-block d-md-inline-block mb-3" href="<?=base_url()?>proyectos/gastos/<?=$proyecto->proyecto_id?>" role="button"><i class="fa fa-fw fa-money"></i> Gastos</a>
				<?php } ?>
				<?php if(isset($permisos['proyecto_extensiones']['list'])){ ?>
					<a class="btn btn-sm btn-success mr-md-3 mx-auto d-block d-md-inline-block mb-3" href="<?=base_url()?>proyectos/extensiones/<?=$proyecto->proyecto_id?>" role="button"><i class="fa fa-fw fa-plus-circle"></i> Ordenes de cambio</a> 
				<?php } ?>
				<?php if(isset($permisos['proyecto_colaboradores']['view'])){ ?>
					<a class="btn btn-sm btn-success mr-md-3 mx-auto d-block d-md-inline-block mb-3" href="<?=base_url()?>proyectos/colaboradores/<?=$proyecto->proyecto_id?>" role="button"><i class="fa fa-fw fa-users"></i> Colaboradores</a> 
				<?php } ?>
				<?php if(isset($permisos['proyecto_materiales']['view'])){ ?>
					<a class="btn btn-sm btn-success mr-md-3 mx-auto d-block d-md-inline-block mb-3" href="<?=base_url()?>proyectos/materiales/<?=$proyecto->proyecto_id?>" role="button"><i class="fa fa-fw fa-wrench"></i> Materiales</a> 
				<?php } ?>
			</div>
		</div>


		<?php 
			
			if($this->input->get('nuevo')!=null && $this->input->get('nuevo')==1){ ?>
				<div class="alert alert-success alert-dismissable">Proyecto registrado con éxito.</div>
			<?php  } 

			?>

		<?php if(isset($permisos['proyecto']['view'])){ ?>
			<div class="card mb-3">
				<div class="card-header anchor-class" data-toggle="collapse" data-target="#card1" aria-expanded="true" aria-controls="collapseExample">
					<i class="fa fa-info"></i> Información básica del proyecto <i class="fa float-right fa-plus-circle"></i></div>
				<div class="card-body collapse show" id="card1">
					<div class="row">
						<div class="col-12 col-md-6 col-lg-3  mb-3"><strong>Cliente: </strong><br><?=(isset($proyecto->nombre_cliente))?$proyecto->nombre_cliente:''?></div>
						<div class="col-12 col-md-6 col-lg-3  mb-3"><strong>Fecha de firma de contrato: </strong><br><?=(isset($proyecto->fecha_firma_contrato))?$proyecto->fecha_firma_contrato:''?></div>
						<div class="col-12 col-md-6 col-lg-3  mb-3"><strong>Fecha de inicio: </strong><br><?=(isset($proyecto->fecha_inicio))?$proyecto->fecha_inicio:''?></div>
						<div class="col-12 col-md-6 col-lg-3  mb-3"><strong>Fecha de entrega esperada: </strong><br><?=(isset($proyecto->fecha_entrega_estimada))?$proyecto->fecha_entrega_estimada:''?></div>
					</div>
					<div class="row">
						<div class="col-12 col-md-6 col-lg-3  mb-3"><strong>Provincia: </strong><br><?=(isset($proyecto->provincia))?$proyecto->provincia:''?></div>
						<div class="col-12 col-md-6 col-lg-3  mb-3"><strong>Cantón: </strong><br><?=(isset($proyecto->canton))?$proyecto->canton:''?></div>
						<div class="col-12 col-md-6 col-lg-3  mb-3"><strong>Distrito: </strong><br><?=(isset($proyecto->distrito))?$proyecto->distrito:''?></div>
						<div class="col-12 col-md-6 col-lg-3  mb-3"><strong>Estado: </strong><br><?=(isset($proyecto->proyecto_estado))?$proyecto->proyecto_estado:''?></div>
					</div>
					<div class="row">
						<div class="col-12 col-md-6 col-lg-3  mb-3"><strong>Jefe de proyecto: </strong><br><?=(isset($proyecto->nombre))?$proyecto->nombre.' '.$proyecto->apellidos:''?></div>
					</div>
					<?php if(isset($porcentaje) && isset($dias_proyecto) && isset($dias_consumidos)){ ?>
						<p><strong>Avance de proyecto: </strong><br><?=$dias_consumidos?> días de un total de <?=$dias_proyecto?> días <?=($dias_consumidos>$dias_proyecto)?'('.($dias_consumidos-$dias_proyecto).' días de retraso)':''?></p>
						<div class="progress">
							<div class="progress-bar <?=($dias_consumidos>$dias_proyecto)?'bg-danger':'bg-success'?>" role="progressbar" style="width: <?=$porcentaje?>%;" aria-valuenow="<?=$porcentaje?>" aria-valuemin="0" aria-valuemax="100"><?=$porcentaje?>%</div>
						</div>

					<?php } ?>
				</div>
			</div>
		<?php } ?>
		<?php if($rol_id==1){ ?>
			<div class="card mb-3">
					<div class="card-header anchor-class" data-toggle="collapse" data-target="#card2" aria-expanded="true" aria-controls="collapseExample">
							<i class="fa fa-money"></i> Valor de la oferta <i class="fa float-right fa-plus-circle"></i></div>
					<div class="card-body collapse show" id="card2">
						<div class="row">
					<div class="col-12 col-md-6 mb-5">
						<h3 class="text-center">Total de la oferta</h3>
						<div class="total-oferta">
							<p class="display-4 text-center">{{total_valor_oferta | currency}}</p>
							<p class="text-center">{{total_valor_oferta_colones | currency:'₡ '}}</p>
						</div>
						<canvas class="chart chart-pie d-md-none" chart-labels="data_chart_valor_oferta.labels" chart-data="data_chart_valor_oferta.data"
												chart-options="data_chart_valor_oferta.options" chart-dataset-override="datasetOverride" width="350"
												height="500">
							</canvas>
							<canvas class="chart chart-pie d-none d-md-block d-lg-none" chart-labels="data_chart_valor_oferta.labels" chart-data="data_chart_valor_oferta.data"
												chart-options="data_chart_valor_oferta.options" chart-dataset-override="datasetOverride" width="350"
												height="350">
							</canvas>
							<canvas class="chart chart-pie d-none d-lg-block" chart-labels="data_chart_valor_oferta.labels" chart-data="data_chart_valor_oferta.data"
												chart-options="data_chart_valor_oferta.options" chart-dataset-override="datasetOverride" width="350"
												height="200">
							</canvas>
							</div>
					<div class="col-12 col-md-6">
						<h3 class="text-center">Distribución de la oferta por tipo</h3>
						<div class="desgloce-valor-oferta table-espaciado">
							<div class="table-responsive">
								<table class="table table-bordered table-hover">
									<thead class="thead-light">
										<tr>
											<th>Tipo de valor</th>
											<th>Valor</th>
										</tr>
									</thead>
									<tbody>
										<tr class="valor-oferta-item" ng-repeat="valor_oferta in data_valor_oferta">
											<td>{{valor_oferta.tipo}}</td>
											<td>{{valor_oferta.valor | currency}}</td>
										</tr>
										
									</tbody>
									
								</table>
							</div>
						</div>
						<a class=" float-md-right btn btn-success  mx-auto d-block d-md-inline-block mb-3" href="<?=base_url()?>proyectos/extensiones/<?=$proyecto->proyecto_id?>" role="button"><i class="fa fa-fw fa-eye"></i> Ver ordenes de cambio</a>
					</div>
				</div>
					</div>
			</div>

		<?php } ?>

			<div class="card mb-3">
					<div class="card-header anchor-class" data-toggle="collapse" data-target="#card3" aria-expanded="true" aria-controls="collapseExample" >
							<i class="fa fa-money"></i> Resumen de gastos <i class="fa float-right fa-plus-circle"></i></div>
					<div class="card-body collapse show" id="card3">
						<div class="row">
					<div class="col-12 col-md-6 mb-5">
						<h3 class="text-center">Total de gastos</h3>
						<div class="total-oferta">
							<p class="display-4 text-center">{{total_gastos | currency}}</p>
							<p class="text-center">{{total_gastos_colones | currency:'₡ '}}</p>
						</div>
						<canvas class="chart chart-pie d-md-none" chart-labels="data_chart_gastos.labels" chart-data="data_chart_gastos.data"
												chart-options="data_chart_gastos.options" chart-dataset-override="datasetOverride" width="350"
												height="500">
							</canvas>
							<canvas class="chart chart-pie d-none d-md-block d-lg-none" chart-labels="data_chart_gastos.labels" chart-data="data_chart_gastos.data"
												chart-options="data_chart_gastos.options" chart-dataset-override="datasetOverride" width="350"
												height="350">
							</canvas>
							<canvas class="chart chart-pie  d-none d-lg-block" chart-labels="data_chart_gastos.labels" chart-data="data_chart_gastos.data"
												chart-options="data_chart_gastos.options" chart-dataset-override="datasetOverride" width="350"
												height="200">
							</canvas>
							</div>
					<div class="col-12 col-md-6">
						<h3 class="text-center">Distribución de gastos por tipo</h3>
						<div class="desgloce-gastos table-espaciado">
							<div class="table-responsive">
								<table class="table table-bordered table-hover">
									<thead class="thead-light">
										<tr>
											<th>Tipo de gasto</th>
											<th>Valor</th>
										</tr>
									</thead>
									<tbody>
										<tr class="gasto-item" ng-repeat="gastos in data_gastos">
											<td>{{gastos.tipo}}</td>
											<td>{{gastos.valor | currency}}</td>
										</tr>
										
									</tbody>
									
								</table>
							</div>
						</div>
						<?php if($permisos['proyecto_gastos']['list']){ ?>
							<a class=" float-md-right btn btn-success mx-auto d-block d-md-inline-block mb-3" href="<?=base_url()?>proyectos/gastos/<?=$proyecto->proyecto_id?>" role="button"><i class="fa fa-fw fa-eye"></i> Ver gastos</a>

						<?php } ?>
					</div>
				</div>
					</div>
			</div>

		<?php if($rol_id==1){ ?>
			<div class="card mb-3">
					<div class="card-header anchor-class" data-toggle="collapse" data-target="#card4" aria-expanded="true" aria-controls="collapseExample" >
							<i class="fa fa-money"></i> Control de Utilidad <i class="fa float-right fa-plus-circle"></i></div>
					<div class="card-body collapse show" id="card4">
						<div class="row">
					<div class="col-12 col-md-6 mb-5">
						<h3 class="text-center">Utilidad Actual</h3>
						<div class="total-oferta">
							<p class="display-4 text-center">{{total_utilidad | currency}}</p>
							<h4 class="text-center" ng-class="{ 'text-success': total_utilidad>=data_valor_oferta[5].valor, 'text-warning': total_utilidad<data_valor_oferta[5].valor, 'text-danger': total_utilidad<0 }"><strong>Estado actual: </strong><span ng-if="total_utilidad>=data_valor_oferta[5].valor">Correcto</span> <span ng-if="total_utilidad<data_valor_oferta[5].valor && total_utilidad>0">Con pérdida de utilidad</span> <span ng-if="total_utilidad<0">Con pérdida extrema</span></h4>
						</div>
						<div class="gasto-item" ng-repeat="(kgasto, gastos) in data_gastos">
							<label>{{gastos.tipo}}</label>
							<div class="progress">
								<div class="progress-bar bg-success" ng-class="{'bg-warning':data_valor_oferta[kgasto].valor==gastos.valor, 'bg-danger':data_valor_oferta[kgasto].valor<gastos.valor}" role="progressbar" style="width: {{ (100/data_valor_oferta[kgasto].valor)*gastos.valor | number : 0 }}%;" aria-valuenow="{{ (100/data_valor_oferta[kgasto].valor)*gastos.valor | number : 0 }}" aria-valuemin="0" aria-valuemax="100">{{ (100/data_valor_oferta[kgasto].valor)*gastos.valor | number : 0 }}%</div>
							</div>						
						</div>
							</div>
					<div class="col-12 col-md-6 ">
						<h3 class="text-center">Comparación de valor cobrado y gastos</h3>
						<div class="desgloce-utilidad table-espaciado">
							<div class="table-responsive">
								<table class="table table-bordered table-hover">
									<thead class="thead-light">
										<tr>
											<th>Tipo de gasto</th>
											<th>Valor cobrado</th>
											<th>Gasto acumulado</th>
										</tr>
									</thead>
									<tbody>
										<tr class="gasto-item" ng-repeat="(kgasto, gastos) in data_gastos">
											<td>{{gastos.tipo}}</td>
											<td>{{data_valor_oferta[kgasto].valor | currency}}</td>
											<td>{{gastos.valor | currency}}</td>
										</tr>
										
									</tbody>
									
								</table>
							</div>
						</div>
						
						
					</div>
				</div>
					</div>
			</div>
		<?php } ?>

		<?php if($rol_id!=3){ ?>
			<div class="card mb-3">
				<div class="card-header anchor-class" data-toggle="collapse" data-target="#card5" aria-expanded="true" aria-controls="collapseExample" >
						<i class="fa fa-money"></i> Resumen de tiempo laborado <i class="fa float-right fa-plus-circle"></i></div>
				<div class="card-body collapse show" id="card5">
					<div class="row">
						<div class="col-xl-3 col-sm-6 mb-3">
							<div class="card text-white bg-primary o-hidden h-100">
								<div class="card-body text-center">
									<span class="display-4">{{data_tiempo_colaboradores.totales.tiempo_total}} h</span><br>
									<strong>Total de horas invertidas</strong>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-sm-6 mb-3">
							<div class="card text-white bg-warning o-hidden h-100">
								<div class="card-body text-center">
									<span class="display-4">{{data_tiempo_colaboradores.totales.tiempo_mensual}} h</span><br>
									<strong>Total de horas invertidas de este mes</strong>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-sm-6 mb-3">
							<div class="card text-white bg-success o-hidden h-100">
								<div class="card-body text-center">
									<span class="display-4">{{data_tiempo_colaboradores.totales.tiempo_semanal}} h</span><br>
									<strong>Total de horas invertidas de esta semana</strong>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-sm-6 mb-3">
							<div class="card text-white bg-danger o-hidden h-100">
								<div class="card-body text-center">
									<span class="display-4">{{data_tiempo_colaboradores.totales.tiempo_diario}} h</span><br>
									<strong>Total de horas invertidas de hoy</strong>
								</div>
							</div>
						</div>
					
					</div>
					
					<div class="desgloce-horas-colaborador" ng-if="data_tiempo_colaboradores.desgloce != undefined">
						<h3 class="text-center mt-5">Resumen de horas laboradas por colaborador</h3>
						<div class="desgloce-horas-colaborador table-espaciado">
							<div class="table-responsive">
								<table class="table table-bordered table-hover">
									<thead class="thead-light text-center">
										<tr>
											<th>Colaborador</th>
											<th>Horas totales</th>
											<th>Horas de este mes</th>
											<th>Horas de esta semana</th>
											<th>Horas de hoy</th>
										</tr>
									</thead>
									<tbody>
										<tr class="colaborador-tiempo-item" ng-repeat="colaborador in data_tiempo_colaboradores.desgloce">
											<td>{{colaborador.detalle.nombre + ' '+ colaborador.detalle.apellidos}}</td>
											<td class="text-center">{{colaborador.total}}</td>
											<td class="text-center">{{colaborador.total_mensual}}</td>
											<td class="text-center">{{colaborador.total_semanal}}</td>
											<td class="text-center">{{colaborador.total_diario}}</td>
										</tr>
										
									</tbody>
									
								</table>
							</div>
							<p>Cantidad de colaboradores: {{data_tiempo_colaboradores.totales.total_colaboradores}}</p>
						</div>
					</div>
					<a class=" float-md-right btn btn-success  mx-auto d-block d-md-inline-block mb-3" href="<?=base_url()?>proyectos/colaboradores/<?=$proyecto->proyecto_id?>/registrar-tiempo-colaboradores/" role="button"><i class="fa fa-fw fa-plus-circle"></i> Registrar tiempos</a>
				
					
				</div>
			</div>
		<?php } ?>
		




		<div class="row">
			
			<div class="col-12 text-right">
				<?php if(isset($permisos['reporte_proyecto_especifico']['view'])){ ?>
					<a class="btn btn-sm btn-secondary mb-3 mr-md-3 mx-auto d-block d-md-inline-block" href="<?=base_url()?>reporte/generarReporteProyectoEspecifico/<?=$proyecto->proyecto_id?>" role="button" target="_blank"><i class="fa fa-download"></i> Generar reporte</a> 
				<?php } ?>
				<?php if(isset($permisos['proyecto']['edit'])){ ?>
					<a class="btn btn-sm btn-primary mb-3 mr-md-3 mx-auto d-block d-md-inline-block" href="<?=base_url()?>proyectos/editar-proyecto/<?=$proyecto->proyecto_id?>" role="button"><i class="fa fa-fw fa-edit"></i> Editar proyecto</a> 
				<?php } ?>
				<?php if(isset($permisos['proyecto']['delete'])){ ?>
					<a class="btn btn-sm btn-danger mb-3 mr-md-3 mx-auto d-block d-md-inline-block" href="#" data-toggle="modal" data-target="#deleteModal2{{proyecto_id}}"><i class="fa fa-fw fa-trash-o"></i> Eliminar proyecto</a>
					<!-- Modal -->
					<div class="modal fade" id="deleteModal2{{proyecto_id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModal2Label" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="deleteModal2Label">¿Está seguro que desea eliminar este proyecto?</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								Se elimará toda la información relacionada a este proyecto, como gastos, valor de la oferta, registro de horas de trabajo, ordenes de cambio de valor de la oferta, etc. Una vez eliminada esta información, no podrá ser recuperada.
								<br><br>
								Ingrese la palabra <strong>"eliminar"</strong> en el siguiente campo de texto para confirmar que está seguro de esta acción:
								<br><input ng-model="confirm_delete" type="text">
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
								<button type="button" ng-disabled="confirm_delete!='eliminar'" class="btn btn-danger" ng-click="borrarRow(proyecto_id)"><i class="fa fa-fw fa-trash-o"></i> Eliminar</button>
							</div>
						</div>
						</div>
					</div>
				<?php } ?>
				
			</div>
			<div class="col-12">
				<?php if(isset($permisos['proyecto_gastos']['list'])){ ?>
					<a class="btn btn-sm btn-success mr-md-3 mx-auto d-block d-md-inline-block mb-3" href="<?=base_url()?>proyectos/gastos/<?=$proyecto->proyecto_id?>" role="button"><i class="fa fa-fw fa-money"></i> Gastos</a>
				<?php } ?>
				<?php if(isset($permisos['proyecto_extensiones']['list'])){ ?>
					<a class="btn btn-sm btn-success mr-md-3 mx-auto d-block d-md-inline-block mb-3" href="<?=base_url()?>proyectos/extensiones/<?=$proyecto->proyecto_id?>" role="button"><i class="fa fa-fw fa-plus-circle"></i> Ordenes de cambio</a> 
				<?php } ?>
				<?php if(isset($permisos['proyecto_colaboradores']['view'])){ ?>
					<a class="btn btn-sm btn-success mr-md-3 mx-auto d-block d-md-inline-block mb-3" href="<?=base_url()?>proyectos/colaboradores/<?=$proyecto->proyecto_id?>" role="button"><i class="fa fa-fw fa-users"></i> Colaboradores</a> 
				<?php } ?>
				<?php if(isset($permisos['proyecto_materiales']['view'])){ ?>
					<a class="btn btn-sm btn-success mr-md-3 mx-auto d-block d-md-inline-block mb-3" href="<?=base_url()?>proyectos/materiales/<?=$proyecto->proyecto_id?>" role="button"><i class="fa fa-fw fa-wrench"></i> Materiales</a> 
				<?php } ?>
			</div>
		</div>

	</div>


<?php } ?>


<?php if($rol_id==3){
	if($proyecto->proyecto_estado_id==1 || $proyecto->proyecto_estado_id==2){ ?>
	<div class="page-content" ng-controller="registrarTiempoColaboradoresDashboardController" ng-cloak ng-init="proyecto_id='<?=$proyecto->proyecto_id?>'; <?=(isset($fecha_gasto))?'fecha_gasto=\''.$fecha_gasto.'\';':''?> consultarTiempos();">
		<div class="row">
			
			<div class="col-12">
				<?php if(isset($permisos['proyecto_materiales']['view'])){ ?>
					<a class="btn btn-sm btn-success mr-md-3 mx-auto d-block d-md-inline-block mb-3" href="<?=base_url()?>proyectos/materiales/<?=$proyecto->proyecto_id?>" role="button"><i class="fa fa-fw fa-wrench"></i> Materiales</a> 
				<?php } ?>
			</div>
		</div>
		<div class="row">
			<div class="col-12 col-md-10"><h3 class="text-center text-md-left"><i class="fa fa-fw fa-eye"></i> Registrar tiempos de proyecto: <?=$proyecto->nombre_proyecto?></h3></div>
			<div class="col-12 col-md-2">
				<a class="float-right btn-sm btn btn-secondary" href="<?=base_url()?>proyectos/" role="button"><i class="fa fa-fw fa-arrow-left"></i> Volver a proyectos</a>
			</div>
		</div>
		<?php 
			if(validation_errors()){ ?>
					<div class="alert alert-danger alert-dismissable"><?php echo validation_errors(); ?></div>
			<?php 
			} 

			if(isset($msg)){
				foreach ($msg as $kmsg => $vmsg) { ?>
					<div class="alert alert-<?=$vmsg['tipo']?> alert-dismissable"><?=$vmsg['texto']?></div>
				<?php
				}
			}

			?>
			<div class="card mb-3">
					<div class="card-header">
							Registro de tiempos</div>
					<div class="card-body">
							<form id="filtroColaborador">
									<div class="row">
											<div class="col-12 col-md-6 col-lg-4">
													<div class="form-group">
															<label for="colaborador_nuevo_id">Fecha:</label>							
															<input type="text" name="fecha_gasto" ng-model="fecha_gasto" class="form-control datepicker"   data-date-end-date="0d" id="fecha_gasto" aria-describedby="fechaRegistroHelp" >
															<small id="fechaRegistroHelp" class="form-text text-muted">Seleccione la fecha en la cual desea registrar o ver los tiempos laborados.</small>
													</div>
											</div>
									</div>
									<div class="row">
											<div class="col-12 col-md-6 col-lg-3">
													<button  class="btn btn-primary form-submit" ng-click="consultarTiempos()">Buscar</button>
											</div>
											
									</div>
									<div class="row mb-3 mt-3">
											<div class="col-12">
													<div class="alert alert-{{resultado_type}}" ng-if="resultado_insert!==''">{{resultado_insert}}</div>     
											</div>
									</div>
							</form>

							
					</div>
			</div>
			

			<div class="card mb-3" >
					<div class="card-header">
							Lista de colaboradores</div>
					<div class="card-body">
							<div class="loader text-center" ng-if="loader==true">
									<img src="<?=base_url()?>/instatec_pub/images/ajax-loader.gif" alt="" class="loader-ajax">
							</div>
							<div ng-if="loader===false">
									<form id="tablaColaboradorHoras" action="" method="POST">
											<input type="hidden" name="fecha_registro_gasto" value="{{fecha_gasto}}" />
											<div class="table-espaciado"  ng-if="colaboradores_proyecto!==false" >
													<div class="table-responsive">
															<table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
																	<thead class="thead-light">
																			<tr>                                
																					<th>Nombre</th>                                			
																					<th>Puesto</th>	                                	
																					<th>Horas normales</th> 
                                        											<th>Horas extra</th>                                  
																			</tr>
																	</thead>
																	
																	<tfoot>
																		<tr>
																			<td colspan="4"><button  class="float-right btn btn-primary form-submit" type="submit" >Guardar</button></td>
																		</tr>
																	</tfoot>
																	
																	<tbody>
																		<tr ng-repeat="colaborador in colaboradores_proyecto" ng-class="{'text-danger': colaborador.colaborador_costo_hora_id===null && colaborador.estado_costo===null}">
																			<td >{{colaborador.nombre + ' ' +colaborador.apellidos}} <span ng-if="colaborador.colaborador_costo_hora_id===null && colaborador.estado_costo===null">* <br>(Colaborador con datos incompletos)</span></td>                               
																			<td>{{colaborador.puesto}}</td>
																			<td> 
																			<?php if($rol_id==1 || $rol_id==2){ ?>
																				<input type="number" ng-if="colaborador.colaborador_costo_hora_id!==null && colaborador.estado_costo!==null" {{(colaborador.cantidad_horas!==undefined) ? 'value="'+colaborador.cantidad_horas+'"' : 'value="0"'}} ng-value="{{(colaborador.cantidad_horas!==undefined) ? colaborador.cantidad_horas : '0'}}" class="input-number form-control" name="horas_colaborador[{{colaborador.colaborador_id}}]">
																			<?php }else if($rol_id==3){ ?>
																				<input ng-if="today==true && colaborador.colaborador_costo_hora_id!==null && colaborador.estado_costo!==null" type="number" {{(colaborador.cantidad_horas!==undefined) ? 'value="'+colaborador.cantidad_horas+'"' : 'value="0"'}} ng-value="{{(colaborador.cantidad_horas!==undefined) ? colaborador.cantidad_horas : '0'}}" class="input-number form-control" name="horas_colaborador[{{colaborador.colaborador_id}}]">
																				<span ng-if="today==false">{{colaborador.cantidad_horas}}</span>
																			<?php } ?>
																			</td>
																			<td> 
																			<?php if($rol_id==1 || $rol_id==2){ ?>
																				<input type="number" ng-if="colaborador.colaborador_costo_hora_id!==null && colaborador.estado_costo!==null" {{(colaborador.cantidad_horas_extra!==undefined) ? 'value="'+colaborador.cantidad_horas_extra+'"' : 'value="0"'}} ng-value="{{(colaborador.cantidad_horas_extra!==undefined) ? colaborador.cantidad_horas_extra : '0'}}" class="input-number form-control" name="horas_extra_colaborador[{{colaborador.colaborador_id}}]">
																			<?php }else if($rol_id==3){ ?>
																				<input ng-if="today==true && colaborador.colaborador_costo_hora_id!==null && colaborador.estado_costo!==null" type="number" {{(colaborador.cantidad_horas_extra!==undefined) ? 'value="'+colaborador.cantidad_horas_extra : 'value="0"'}} ng-value="{{(colaborador.cantidad_horas_extra!==undefined) ? colaborador.cantidad_horas_extra : '0'}}" class="input-number form-control" name="horas_extra_colaborador[{{colaborador.colaborador_id}}]">
																				<span ng-if="today==false">{{colaborador.cantidad_horas_extra}}</span>
																			<?php } ?>
																			</td>
																		</tr>
																	</tbody>
															</table>
													</div>
													
											</div>
									</form>
							
							</div>

							
							<p ng-if="colaboradores_proyecto===false" class="text-center table-espaciado">No hay colaboradores asignados aún</p>
				</div>
			</div>
	</div>
<?php 
	}else{ ?>
		<p class="text-center">Este proyecto ya ha finalizado y no se pueden realizar más acciones sobre él</p>
	<?php
	}
} ?>

<!-- <canvas class="chart chart-pie" chart-labels="data_chart_valor_oferta.labels" chart-data="data_chart_valor_oferta.data"
					              chart-options="data_chart_valor_oferta.options" width="350"
					              height="200">
					      </canvas> -->