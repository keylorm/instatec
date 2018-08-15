<script src="<?=base_url()?>instatec_pub/js/colaborador.js"></script>
<!-- Breadcrumbs-->
<ol class="breadcrumb">
	<li class="breadcrumb-item">
	  <a href="<?=base_url()?>">Inicio</a>
	</li>
	<li class="breadcrumb-item">
	  <a href="<?=base_url()?>colaboradores">Colaboradores</a>
	</li>
	<li class="breadcrumb-item">
	  <a href="<?=base_url()?>colaboradores/puestos-trabajo">Puestos de trabajo</a>
	</li>
	<li class="breadcrumb-item active">Editar puesto</li>
</ol>
<h1  class="text-center"><i class="fa fa-fw fa-users"></i> Puestos de trabajo</h1>
<hr>
<div class="row">
	<div class="col-12 col-md-10"><h3 class=" text-center text-md-left"><i class="fa fa-fw fa-plus-circle"></i> Editar puesto</h3></div>
	<div class="col-12 col-md-2"><a class="float-right btn btn-primary" href="<?=base_url()?>colaboradores/puestos-trabajo" role="button"><i class="fa fa-fw fa-arrow-left"></i> Volver a puestos</a></div>
</div>
<div class="page-content" ng-controller="editarColaboradorPuestoController">
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
	<form id="editarColaboradorPuesto" class="form-validation" method="post" name="editarColaboradorPuesto">
		<div class="card mb-3">
	        <div class="card-header">
	          	Información del puesto</div>
	        <div class="card-body">
				<div class="row">
					<div class="form-group col-12 col-md-4">
						<label for="puesto">Nombre del puesto *</label>
						<input type="text" name="puesto" class="form-control input-required" id="puesto" aria-describedby="puestoHelp" value="<?=(isset($colaborador_puesto->puesto))?$colaborador_puesto->puesto:''?>" >
						<small id="puestoHelp" class="form-text text-muted">Ingrese el nombre del puesto de trabajo.<br/>
						</small>
					</div>
					
				
				</div>
			</div>
		</div>
	    
	 	<button type="submit" class="btn btn-primary form-submit"><i class="fa fa-fw fa-save"></i> Guardar</button>
	</form>
	
</div>