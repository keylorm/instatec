<!-- Breadcrumbs-->
<ol class="breadcrumb">
	<li class="breadcrumb-item">
	  <a href="<?=base_url()?>">Inicio</a>
	</li>
	<li class="breadcrumb-item active">Reportes</li>
</ol>

<h1 class="text-center"><i class="fa fa-fw fa-table"></i> Reportes</h1>
<hr>


<div class="page-content">
	<div class="row">
		<div class="col-12"><h3 class=" text-center text-md-left"><i class="fa fa-fw fa-table"></i> Lista de reportes</h3></div>
		
	</div>
	<div class="row">
		<?php if(isset($permisos['reporte_proyecto_general']['view'])){ ?>
			<div class="col-12 mb-3">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title"><a href="<?=base_url()?>reportes/proyectos-general" class="card-link">Proyectos en general</a></h5>
						<!--<h6 class="card-subtitle mb-2 text-muted">Resumen de proyecto</h6>-->
						<p class="card-text">Muestra un listado de los proyectos y su estado actual.</p>
						<a href="<?=base_url()?>reportes/proyectos-general" class="card-link">Ver reporte</a>
					</div>
				</div>
			</div>
		<?php } ?>	
		<?php if(isset($permisos['reporte_proyecto_especifico']['view'])){ ?>
			<div class="col-12 mb-3">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title"><a href="<?=base_url()?>reportes/proyecto-especifico" class="card-link">Proyecto específico</a></h5>
						<!--<h6 class="card-subtitle mb-2 text-muted">Resumen de proyecto</h6>-->
						<p class="card-text">Muestra un resumen de el valor de la oferta, los gastos y la utilidad actual de un proyecto específico.</p>
						<a href="<?=base_url()?>reportes/proyecto-especifico" class="card-link">Ver reporte</a>
					</div>
				</div>
			</div>
		<?php } ?>	

		<?php if(isset($permisos['reporte_horas_por_proyecto']['view'])){ ?>
			<div class="col-12 mb-3">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title"><a href="<?=base_url()?>reportes/horas-por-proyecto" class="card-link">Horas por proyecto</a></h5>
						<!--<h6 class="card-subtitle mb-2 text-muted">Resumen de proyecto</h6>-->
						<p class="card-text">Muestra un listado de las horas laboradas por proyecto.</p>
						<a href="<?=base_url()?>reportes/horas-por-proyecto" class="card-link">Ver reporte</a>
					</div>
				</div>
			</div>
		<?php } ?>	
		<?php if(isset($permisos['reporte_horas_por_trabajador']['view'])){ ?>
			<div class="col-12 mb-3">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title"><a href="<?=base_url()?>reportes/horas-por-trabajador" class="card-link">Horas por trabajador</a></h5>
						<!--<h6 class="card-subtitle mb-2 text-muted">Resumen de proyecto</h6>-->
						<p class="card-text">Muestra un listado de las horas laboradas por trabajador.</p>
						<a href="<?=base_url()?>reportes/horas-por-trabajador" class="card-link">Ver reporte</a>
					</div>
				</div>
			</div>
		<?php } ?>	

	
		<?php if(isset($permisos['reporte_gastos_materiales_proyectos']['view'])){ ?>
			<div class="col-12 mb-3">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title"><a href="<?=base_url()?>reportes/gastos-materiales" class="card-link">Gastos en materiales por proyecto</a></h5>
						<!--<h6 class="card-subtitle mb-2 text-muted">Resumen de proyecto</h6>-->
						<p class="card-text">Muestra un reporte de los gastos en materiales por proyecto.</p>
						<a href="<?=base_url()?>reportes/gastos-materiales" class="card-link">Ver reporte</a>
					</div>
				</div>
			</div>
		<?php } ?>	
	</div>
</div>