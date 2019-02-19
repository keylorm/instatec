<script src="<?=base_url()?>src/instatec_pub/js/material.js"></script>
<!-- Breadcrumbs-->
<ol class="breadcrumb">
	<li class="breadcrumb-item">
	  <a href="<?=base_url()?>">Inicio</a>
	</li>
	<li class="breadcrumb-item">
	  <a href="<?=base_url()?>materiales">Materiales</a>
	</li>
	<li class="breadcrumb-item active">Agregar material</li>
</ol>
<h1  class="text-center"><i class="fa fa-fw fa-wrench"></i> Materiales</h1>
<hr>
<div class="row">
	<div class="col-12 col-md-10"><h3 class=" text-center text-md-left"><i class="fa fa-fw fa-plus-circle"></i> Agregar material</h3></div>
	<div class="col-12 col-md-2"><a class="float-right btn btn-primary" href="<?=base_url()?>materiales" role="button"><i class="fa fa-fw fa-arrow-left"></i> Volver a materiales</a></div>
</div>
<div class="page-content" ng-controller="agregarMaterialController">
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
	<form id="agregarMaterial" class="form-validation" method="post" name="agregarMaterial">
		<div class="card mb-3">
	        <div class="card-header">
	          	Información del material</div>
	        <div class="card-body">
				<div class="row">
					<div class="form-group col-12 col-md-4">
						<label for="material">Nombre del material *</label>
						<input type="text" name="material" class="form-control input-required" id="material" aria-describedby="materialHelp" value="<?=(isset($post_data['material']))?$post_data['material']:''?>" >
						<small id="materialHelp" class="form-text text-muted">Ingrese el nombre del material.<br/>
						</small>
					</div>
					<div class="form-group col-12 col-md-4">
						<label for="material_codigo">Código del material</label>
						<input type="text" name="material_codigo" class="form-control" id="material_codigo" aria-describedby="material_codigoHelp" value="<?=(isset($post_data['material_codigo']))?$post_data['material_codigo']:''?>" >
						<small id="material_codigoHelp" class="form-text text-muted">Ingrese el código del material.<br/>
						</small>
					</div>
					
				
				</div>
			</div>
		</div>
	    
	 	<button type="submit" class="btn btn-primary form-submit"><i class="fa fa-fw fa-save"></i> Guardar</button>
	</form>
	
</div>