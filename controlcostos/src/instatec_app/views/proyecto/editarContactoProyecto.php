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
		<a href="<?=base_url()?>proyectos/contactos/<?=$proyecto['proyecto_id']?>">Contactos</a>
	</li>
	<li class="breadcrumb-item active">Editar contacto</li>
</ol>

<h1 class="text-center">Contactos del proyecto</h1>
<hr>

<div class="row">
	<div class="col-12 col-md-10"><h3 class=" text-center text-md-left"><i class="fa fa-fw fa-plus-circle"></i> Editar contacto</h3></div>
	<div class="col-12 col-md-2"><a class="float-right btn btn-primary" href="<?=base_url()?>proyectos/contactos/<?=$proyecto['proyecto_id']?>" role="button"><i class="fa fa-fw fa-arrow-left"></i> Volver a gastos</a></div>
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
	<form id="agregarContactoProyecto" class="form-validation" method="post" name="agregarContactoProyecto">
		<div class="card mb-3">
	        <div class="card-header">
	          	Información del contacto</div>
	        <div class="card-body">
	        	<div class="row">
					<div class="col-12 col-md-6 col-lg-4">
						<div class="form-group">
							<label for="nombre">Nombre del contacto:</label>
							<input type="text" name="nombre_contacto" class="form-control input-required" id="nombre" aria-describedby="nombreHelp" <?=((isset($proyecto_contacto['nombre_contacto']))?'value="'.$proyecto_contacto['nombre_contacto'].'"':'')?> >
							<small id="nombreHelp" class="form-text text-muted">Ingrese el nombre del contacto.<br/>
							</small>
						</div>
					</div>
					<div class="col-12 col-md-6 col-lg-4">
						<div class="form-group">
							<label for="correo_contacto">Correo electrónico del contacto</label>
							<input type="text" name="correo_contacto" class="form-control" id="correo_contacto" aria-describedby="correoHelp"  <?=((isset($proyecto_contacto['correo_contacto']))?'value="'.$proyecto_contacto['correo_contacto'].'"':'')?> >
							<small id="correoHelp" class="form-text text-muted">Ingrese el correo electrónico.</small>
						</div>
					</div>
				</div>
				<div class="row">	
					<div class="col-12 col-md-6 col-lg-4">
						<div class="form-group">
							<label for="telefono_contacto_1">Teléfono 1</label>
							<input type="text" name="telefono_contacto_1" class="form-control" id="telefono_contacto_1" aria-describedby="telefono1Help"  <?=((isset($proyecto_contacto['telefono_contacto_1']))?'value="'.$proyecto_contacto['telefono_contacto_1'].'"':'')?>">
							<small id="telefono1Help" class="form-text text-muted">Ingrese el primer teléfono del contacto</small>
						</div>
					</div>
					<div class="col-12 col-md-6 col-lg-4">
						<div class="form-group">
							<label for="telefono_contacto_2">Teléfono 2</label>
							<input type="text" name="telefono_contacto_2" class="form-control" id="telefono_contacto_2" aria-describedby="telefono2Help"  <?=((isset($proyecto_contacto['telefono_contacto_2']))?'value="'.$proyecto_contacto['telefono_contacto_2'].'"':'')?>>
							<small id="telefono2Help" class="form-text text-muted">Ingrese el segund teléfono del contacto</small>
						</div>
					</div>
	        	</div>
	        	
	        </div>
	    </div>
		<button type="submit" class="btn btn-primary form-submit"><i class="fa fa-fw fa-save"></i> Guardar</button>
	</form>
</div>
