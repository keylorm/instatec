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


<div class="page-content">
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
	<form id="agregarExtensionProyecto" class="form-validation" method="post" name="agregarExtensionProyecto">
		<div class="card mb-3">
	        <div class="card-header">
	          	Información de la orden de cambio</div>
	        <div class="card-body">
	        	<div class="row">
	        		<div class="col-12 col-md-6">
	        			<div class="form-group">
							<label for="proyecto_valor_oferta_extension_tipo_id">Tipo de orden de cambio:</label>
							<select class="form-control" name="proyecto_valor_oferta_extension_tipo_id" id="proyecto_valor_oferta_extension_tipo_id" aria-describedby="tipoextensionHelp">
								<?php if(isset($extensiones_tipos)){
								 		foreach ($extensiones_tipos as $kextension => $vextension) { ?>
											<option value="<?=$vextension['proyecto_valor_oferta_extension_tipo_id']?>"><?=$vextension['proyecto_valor_oferta_extension_tipo']?></option>
								<?php 	}
									}
								?>
							</select>
							<small id="tipoextensionHelp" class="form-text text-muted">Indique el tipo de orden de cambio que está registrando.<br/>
							</small>
						</div>
	        		</div>
	        		<div class="col-12 col-md-6">
	        			<div class="form-group">
							<label for="valor_oferta">Monto de la orden de cambio ($):</label>							
							<input type="text" name="valor_oferta" class="form-control input-money-mask " id="valor_oferta"  aria-describedby="valorExtensionHelp" >
							<small id="valorExtensionHelp" class="form-text text-muted">Ingrese el valor de la orden de cambio.<br/>
							</small>
						</div>
	        		</div>
	        	</div>
	        	<div class="row">
	        		<div class="col-12">
	        			<div class="form-group">
							<label for="proyecto_valor_oferta_extension_descripcion">Descripción de la orden de cambio:</label>
							<textarea class="form-control" name="proyecto_valor_oferta_extension_descripcion" id="proyecto_valor_oferta_extension_descripcion" rows="3" aria-describedby="descripcionHelp"></textarea>
							<small id="descripcionHelp" class="form-text text-muted">Ingrese la descripción detallada de la orden de cambio.<br/>
							</small>
							
						</div>
	        		</div>	        		
	        	</div>
	        </div>
	    </div>
		<button type="submit" class="btn btn-primary form-submit"><i class="fa fa-fw fa-save"></i> Guardar</button>
	</form>
</div>
