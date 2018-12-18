<script src="<?=base_url()?>src/instatec_pub/js/proyecto.js"></script>
<!-- Breadcrumbs-->
<ol class="breadcrumb">
	<li class="breadcrumb-item">
	  <a href="<?=base_url()?>">Inicio</a>
	</li>
	<li class="breadcrumb-item">
	  <a href="<?=base_url()?>proyectos">Proyectos</a>
	</li>
	<li class="breadcrumb-item">
	  <a href="<?=base_url()?>proyectos/ordenes-cambio/tipos-orden-cambio">Tipos de orden de cambio</a>
	</li>
	<li class="breadcrumb-item active">Agregar tipo de orden de cambio</li>
</ol>
<h1  class="text-center"><i class="fa fa-fw fa-cog"></i> Tipos de orden de cambio</h1>
<hr>
<div class="row">
	<div class="col-12 col-md-10"><h3 class=" text-center text-md-left"><i class="fa fa-fw fa-plus-circle"></i> Agregar nuevo tipo de orden de cambio</h3></div>
	<div class="col-12 col-md-2"><a class="float-right btn btn-primary" href="<?=base_url()?>proyectos/ordenes-cambio/tipos-orden-cambio" role="button"><i class="fa fa-fw fa-arrow-left"></i> Volver</a></div>
</div>
<div class="page-content" ng-controller="agregarTipoOrdenCambioController">
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
	<form id="agregarTipoOrdenCambio" class="form-validation" method="post" name="agregarTipoOrdenCambio">
		<div class="card mb-3">
	        <div class="card-header">
	          	Información principal</div>
	        <div class="card-body">
				<div class="row">
					<div class="form-group col-12 col-md-4">
						<label for="proyecto_valor_oferta_extension_tipo">Tipo de orden de cambio *</label>
						<input type="text" name="proyecto_valor_oferta_extension_tipo" class="form-control input-required" id="proyecto_valor_oferta_extension_tipo" aria-describedby="tipoHelp" value="<?=(isset($post_data['proyecto_valor_oferta_extension_tipo']))?$post_data['proyecto_valor_oferta_extension_tipo']:''?>" >
						<small id="tipoHelp" class="form-text text-muted">Ingrese el tipo de orden de cambio.<br/>
						</small>
					</div>
					
				
				</div>
			</div>
		</div>
	    
	 	<button type="submit" class="btn btn-primary form-submit"><i class="fa fa-fw fa-save"></i> Guardar</button>
	</form>
	
</div>