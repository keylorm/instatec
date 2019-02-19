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
		<a href="<?=base_url()?>proyectos/ver-proyecto/<?=$proyecto['proyecto_id']?>">Ver proyecto</a>
	</li>
	<li class="breadcrumb-item">
		<a href="<?=base_url()?>proyectos/ordenes-cambio/<?=$proyecto['proyecto_id']?>">Ordenes de cambio</a>
	</li>
	<li class="breadcrumb-item active">Agregar orden de cambio</li>
</ol>

<h1 class="text-center">Ordenes de cambio de proyectos</h1>
<hr>

<div class="row">
	<div class="col-12 col-md-10"><h3 class=" text-center text-md-left"><i class="fa fa-fw fa-plus-circle"></i> Agregar orden de cambio</h3></div>
	<div class="col-12 col-md-2"><a class="float-right btn btn-primary" href="<?=base_url()?>proyectos/ordenes-cambio/<?=$proyecto['proyecto_id']?>" role="button"><i class="fa fa-fw fa-arrow-left"></i> Volver a ordenes de cambio</a></div>
</div>


<div class="page-content" ng-cloak ng-controller="agregarExtensionProyecto">
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
	<form id="agregarExtensionProyecto" class="form-validation " method="post" name="agregarExtensionProyecto" >
		<div class="card mb-3">
	        <div class="card-header">
	          	Información de la orden de cambio</div>
	        <div class="card-body">
	        	<div class="row">
					<?php 
					if ($rol_id != 3) { ?>
						<div class="col-12 col-md-4">
							<div class="form-group">
								<label for="proyecto_valor_oferta_extension_estado_id">Estado de orden de cambio:</label>
								<select class="form-control" ng-model="proyecto_valor_oferta_extension_estado_id" name="proyecto_valor_oferta_extension_estado_id" id="proyecto_valor_oferta_extension_estado_id" aria-describedby="tipoextensionHelp">
									<?php if(isset($extensiones_estados)){
											foreach ($extensiones_estados as $kextension => $vextension) { ?>
												<option value="<?=$vextension['proyecto_valor_oferta_extension_estado_id']?>"><?=$vextension['proyecto_valor_oferta_extension_estado']?></option>
									<?php 	}
										}
									?>
								</select>
								<small id="tipoextensionHelp" class="form-text text-muted">Indique el estado de orden de cambio que está registrando.<br/>
								</small>
							</div>
						</div>
					<?php } ?>
	        		<div class="col-12 col-md-4">
	        			<div class="form-group">
							<label for="tiene_impuesto">¿Tiene impuesto?:</label>							
							<select class="form-control" name="tiene_impuesto" id="tiene_impuesto" ng-model="tiene_impuesto" aria-describedby="tieneImpuestoHelp">
								<option value="0">No</option>
								<option value="1">Si</option>
								
							</select>
							<small id="tieneImpuestoHelp" class="form-text text-muted">Ingrese el valor de la orden de cambio.<br/>
							</small>
						</div>
	        		</div>
	        		<div class="col-12 col-md-4">
	        			<div class="form-group" ng-show="tiene_impuesto==1">
							<label for="impuesto">Impuesto (%):</label>
							<input  type="number"  value="0" step="0.05" pattern="^\d+(?:\.\d{1,2})?$" name="impuesto" id="impuesto" class="form-control" ng-class="{'input-required': tiene_impuesto==1}" aria-describedby="impuestoHelp" ng-model="impuesto">
							<small id="impuestoHelp" class="form-text text-muted">Ingrese el impuesto asignado a esta orden de cambio<br/>
							</small>
							
						</div>
					</div>
					<div class="col-12" ng-if="proyecto_valor_oferta_extension_estado_id==3">
						<div class="form-group">
							
							<label for="proyecto_valor_oferta_extension_estado_id">Motivo del rechazo:</label>
							<textarea name="comentarios" id="comentarios" cols="30" rows="10" class="form-control"></textarea>
							
						</div>
					</div>      		
	        	</div>
	        	<div class="row">
					<button type="submit" class="btn btn-primary form-submit"><i class="fa fa-fw fa-save"></i> Guardar</button>
	        	</div>
	        </div>
	    </div>
	</form>
</div>
