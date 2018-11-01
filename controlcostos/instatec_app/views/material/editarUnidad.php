<script src="<?=base_url()?>instatec_pub/js/material.js"></script>
<!-- Breadcrumbs-->
<ol class="breadcrumb">
	<li class="breadcrumb-item">
	  <a href="<?=base_url()?>">Inicio</a>
	</li>
	<li class="breadcrumb-item">
	  <a href="<?=base_url()?>materiales">Materiales</a>
	</li>
	<li class="breadcrumb-item">
	  <a href="<?=base_url()?>materiales/unidades">Unidades</a>
	</li>
	<li class="breadcrumb-item active">Editar unidad/li>
</ol>
<h1  class="text-center"><i class="fa fa-fw fa-cog"></i> Editar unidad</h1>
<hr>
<div class="row">
	<div class="col-12 col-md-10"><h3 class=" text-center text-md-left"><i class="fa fa-fw fa-plus-circle"></i> Editar unidad</h3></div>
	<div class="col-12 col-md-2"><a class="float-right btn btn-primary" href="<?=base_url()?>materiales/unidades" role="button"><i class="fa fa-fw fa-arrow-left"></i> Volver</a></div>
</div>
<div class="page-content" ng-controller="editarUnidadController">
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
	<form id="editarUnidad" class="form-validation" method="post" name="editarUnidad">
		<div class="card mb-3">
	        <div class="card-header">
	          	Información principal</div>
	        <div class="card-body">
				<div class="row">
					<div class="form-group col-12 col-md-4">
						<label for="material_unidad">Unidad *</label>
						<input type="text" name="material_unidad" class="form-control input-required" id="material_unidad" aria-describedby="unidadHelp" value="<?=(isset($unidad->material_unidad))?$unidad->material_unidad:''?>" >
						<small id="unidadHelp" class="form-text text-muted">Ingrese el nombre de la unidad.<br/>
						</small>
					</div>
					
				
				</div>
			</div>
		</div>
	    
	 	<button type="submit" class="btn btn-primary form-submit"><i class="fa fa-fw fa-save"></i> Guardar</button>
	</form>
	
</div>