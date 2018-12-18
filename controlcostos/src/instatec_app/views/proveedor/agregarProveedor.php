<!-- Breadcrumbs-->
<ol class="breadcrumb">
	<li class="breadcrumb-item">
	  <a href="<?=base_url()?>">Inicio</a>
	</li>
	<li class="breadcrumb-item">
	  <a href="<?=base_url()?>proveedores">Proveedores</a>
	</li>
	<li class="breadcrumb-item active">Agregar proveedor</li>
</ol>
<h1  class="text-center"><i class="fa fa-fw fa-handshake-o"></i> Proveedores</h1>
<hr>
<div class="row">
	<div class="col-12 col-md-10"><h3 class=" text-center text-md-left"><i class="fa fa-fw fa-plus-circle"></i> Agregar nuevo proveedor</h3></div>
	<div class="col-12 col-md-2"><a class="float-right btn btn-primary" href="<?=base_url()?>proveedores" role="button"><i class="fa fa-fw fa-arrow-left"></i> Volver a proveedores</a></div>
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
	<form id="agregar-proveedor" class="form-validation" method="post">
		<div class="form-group">
			<label for="nombre">Nombre de proveedor</label>
			<input type="text" name="nombre_proveedor" class="form-control input-required" id="nombre" aria-describedby="nombreHelp">
			<small id="nombreHelp" class="form-text text-muted">Ingrese el nombre del proveedor tal cual desea que lo ubiquen el resto de los usuarios.</small>
		</div>
		<div class="form-group">
			<label for="cedula">Cédula del proveedor</label>
			<input type="text" name="cedula_proveedor" class="form-control" id="cedula" aria-describedby="cedulaHelp">
			<small id="cedulaHelp" class="form-text text-muted">Ingrese el número de cédula, ya sea física o jurídica.</small>
		</div>
	    
	    <label class="control-label">Correos de contacto</label>
		<div class="form-group row">
			<div class="col-10 col-md-11">
	       		<input type="text" class="form-control" name="correo[]" />    
	        </div>
	        <div class="col-2 col-md-1">
	            <button type="button" class="btn btn-default addButton" data-template="correoTemplate" data-campo='correo'><i class="fa fa-plus"></i></button>
	        </div>
	    </div>

	    <!-- The option field template containing an option field and a Remove button -->
	    <div class="form-group d-none row" id="correoTemplate">
	        <div class="col-10 col-md-11">
	            <input class="form-control" type="text" name="correo[]" />
	        </div>
	        <div class="col-2 col-md-1">
	            <button type="button" class="btn btn-default removeButton" data-campo='correo'><i class="fa fa-minus"></i></button>
	        </div>
	    </div>
	    
	    <label class="control-label">Teléfonos de contacto</label>
		<div class="form-group row">
			<div class="col-10 col-md-11">
	       		<input type="text" class="form-control" name="telefono[]" />    
	        </div>
	        <div class="col-2 col-md-1">
	            <button type="button" class="btn btn-default addButton" data-template="telefonoTemplate" data-campo='telefono'><i class="fa fa-plus"></i></button>
	        </div>
	    </div>

	    <!-- The option field template containing an option field and a Remove button -->
	    <div class="form-group d-none row" id="telefonoTemplate">
	        <div class="col-10 col-md-11">
	            <input class="form-control" type="text" name="telefono[]" />
	        </div>
	        <div class="col-2 col-md-1">
	            <button type="button" class="btn btn-default removeButton" data-campo='telefono'><i class="fa fa-minus"></i></button>
	        </div>
	    </div>


	    <div class="form-group">
			<label>Estado del proveedor:</label>
			<div class="form-check">
				<label class="form-check-label">
					<input class="form-check-input" type="radio" name="estado_proveedor" id="estado1" value="1" checked>
					Activo
				</label>
			</div>
			<div class="form-check">
				<label class="form-check-label">
					<input class="form-check-input" type="radio" name="estado_proveedor" id="estado2" value="0">
					Inactivo
				</label>
			</div>
		</div>
	  <button type="submit" class="btn btn-primary form-submit"><i class="fa fa-fw fa-save"></i> Guardar</button>
	</form>
	
</div>