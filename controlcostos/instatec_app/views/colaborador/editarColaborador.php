<script src="<?=base_url()?>instatec_pub/js/colaborador.js"></script>
<!-- Breadcrumbs-->
<ol class="breadcrumb">
	<li class="breadcrumb-item">
	  <a href="<?=base_url()?>">Inicio</a>
	</li>
	<li class="breadcrumb-item">
	  <a href="<?=base_url()?>colaboradores">Colaboradores</a>
	</li>
	<li class="breadcrumb-item active">Editar colaborador</li>
</ol>
<h1  class="text-center"><i class="fa fa-fw fa-users"></i> Colaboradores</h1>
<hr>
<div class="row">
	<div class="col-12 col-md-10"><h3 class=" text-center text-md-left"><i class="fa fa-fw fa-plus-circle"></i> Editar colaborador: <?=(isset($colaborador->nombre ))?$colaborador->colaborador_id.' - '.$colaborador->nombre.' '.$colaborador->apellidos:''?></h3></div>
	<div class="col-12 col-md-2"><a class="float-right btn btn-primary" href="<?=base_url()?>colaboradores" role="button"><i class="fa fa-fw fa-arrow-left"></i> Volver a colaboradores</a></div>
</div>
<div class="page-content" ng-controller="editarColaboradorController" ng-init="colaborador_puesto_id=<?=$colaborador->colaborador_puesto_id?>">
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
	<form id="editarColaborador" class="form-validation" method="post" name="editarColaborador">
		<div class="card mb-3">
	        <div class="card-header">
	          	Datos personales</div>
	        <div class="card-body">
				<div class="row">
					<div class="form-group col-12 col-md-4">
						<label for="nombre">Nombre del colaborador</label>
						<input type="text" name="nombre" class="form-control input-required" id="nombre" aria-describedby="nombreHelp" value="<?=(isset($colaborador->nombre))?$colaborador->nombre:''?>" >
						<small id="nombreHelp" class="form-text text-muted">Ingrese el nombre del colaborador.<br/>
						</small>
					</div>
					<div class="form-group col-12 col-md-4">
						<label for="apellidos">Apellidos del colaborador</label>
						<input type="text" name="apellidos" class="form-control input-required" id="apellidos" aria-describedby="apellidosHelp" value="<?=(isset($colaborador->apellidos))?$colaborador->apellidos:''?>">
						<small id="apellidosHelp" class="form-text text-muted">Ingrese los apellidos del colaborador.</small>
					</div>
					<div class="form-group col-12 col-md-4">
						<label for="alias">Alias del colaborador</label>
						<input type="text" name="alias" class="form-control input-required" id="alias" aria-describedby="aliasHelp" value="<?=(isset($colaborador->alias))?$colaborador->alias:''?>">
						<small id="aliasHelp" class="form-text text-muted">Ingrese el alias o apodo del colaborador.</small>
					</div>
					<div class="form-group col-12 col-md-4">
						<label for="cedula">Cédula del colaborador</label>
						<input type="text" name="cedula" class="form-control input-required"   id="cedula" aria-describedby="correoHelp" value="<?=(isset($colaborador->cedula))?$colaborador->cedula:''?>">
						<small id="correoHelp" class="form-text text-muted">Ingrese la cédula del colaborador.</small>
					</div>
					<div class="form-group col-12 col-md-4">
						<label for="correo_electronico">Correo del colaborador</label>
						<input type="text" name="correo_electronico" class="form-control" ng-class="{'input-required': colaborador_puesto_id == 1}"  id="correo_electronico" aria-describedby="correoHelp" value="<?=(isset($colaborador->correo_electronico))?$colaborador->correo_electronico:''?>">
						<small id="correoHelp" class="form-text text-muted">Ingrese el correo electrónico.</small>
					</div>

					<div class="form-group col-12 col-md-4">
						<label for="telefono">Teléfono</label>
						<input type="text" name="telefono"  class="form-control" id="telefono" aria-describedby="telefonoHelp" value="<?=(isset($colaborador->telefono))?$colaborador->telefono:''?>">
						<small id="telefonoHelp" class="form-text text-muted">Ingrese el teléfono del colaborador</small>
					</div>
					<div class="form-group col-12 col-md-4">
						<label for="nombre">ID del colaborador</label>
						<input type="text" disabled="disabled" class="form-control input-required" aria-describedby="idColaboradorHelp" value="<?=(isset($colaborador->colaborador_id))?$colaborador->colaborador_id:''?>" >
						<small id="idColaboradorHelp" class="form-text text-muted">ID único del colaborador.<br/>
						</small>
					</div>
				</div>
			</div>
		</div>

		<div class="card mb-3">
	        <div class="card-header">
	          	Datos para manejo interno de colaborador</div>
	        <div class="card-body">
				<div class="row">
					<div class="form-group col-12 col-md-4">
						<label for="seguro_social">Seguro social</label>
						<input type="text" name="seguro_social" class="form-control input-required" id="seguro_social" aria-describedby="seguro_socialHelp" value="<?=(isset($colaborador->seguro_social))?$colaborador->seguro_social:''?>">
						<small id="seguro_socialHelp" class="form-text text-muted">Ingrese el número de seguro social del colaborador.</small>
					</div>

					<div class="form-group col-12 col-md-4">
						<label for="identificador_interno">Identificador interno</label>
						<input type="text" name="identificador_interno" class="form-control input-required" id="identificador_interno" aria-describedby="identificador_internoHelp" value="<?=(isset($colaborador->identificador_interno))?$colaborador->identificador_interno:''?>">
						<small id="identificador_internoHelp" class="form-text text-muted">Ingrese el número de identificador interno del colaborador.</small>
					</div>
					<div class="form-group col-12 col-md-4">
						<label>Puesto:</label>
						<select class="form-control select-required	" name="colaborador_puesto_id" id="colaborador_puesto_id" ng-model="colaborador_puesto_id" aria-describedby="puestoHelp" required="required">
							<?php
							 foreach($puestos as $kpuesto => $vpuesto){ 
								 $selected = '';
								 if(isset($colaborador->colaborador_puesto_id)){
									 if($colaborador->colaborador_puesto_id == $vpuesto->colaborador_puesto_id){
										 $selected = 'selected = "selected"';
									 }
								 }?>
								<option value="<?=$vpuesto->colaborador_puesto_id?>" ng-value="<?=$vpuesto->colaborador_puesto_id?>"><?=$vpuesto->puesto?></option>
							<?php } ?>
						</select>	
						<small id="puestoHelp" class="form-text text-muted">Ingrese el puesto de este usuario.</small>
					</div>
								
				</div>
				
			</div>
		</div>

		<div class="card mb-3">
	        <div class="card-header">
	          	Información salarial</div>
	        <div class="card-body">
				<div class="row">
					

					<div class="col-12 col-md-6 col-lg-4">
						<div class="form-group">
							<label for="costo_hora">Valor de la hora laboral:</label>							
							<input type="text" name="costo_hora" class="form-control input-required input-money-mask-colones"  id="costo_hora"  aria-describedby="costohoraHelp" value="<?=(isset($colaborador->costo_hora))?$colaborador->costo_hora:''?>">
							<small id="costohoraHelp" class="form-text text-muted">Ingrese el monto qie gana este colaborador por hora.<br/>
							</small>
						</div>
					</div>
				
				</div>
			</div>
		</div>


		<div class="card mb-3" ng-if="colaborador_puesto_id==1">
	        <div class="card-header">
	          	Datos para inicio de sesión del Jefe de proyecto</div>
	        <div class="card-body">
				<div class="row">
					<div class="form-group col-12 col-md-4">
						<label for="usuario">Usuario</label>
						<input disabled type="text" name="usuario" class="form-control input-required" id="usuario" aria-describedby="usuarioHelp" value="<?=(isset($colaborador->usuario))?$colaborador->usuario:''?>">
						<small id="usuarioHelp" class="form-text text-muted">Para editar el usuario debe ir directamente a la seccion de usuarios</small>
					</div>

					<div class="form-group col-12 col-md-4">
						<label for="password">Contraseña</label>
						<input type="password" ng-model="password" name="password" class="form-control" id="password" aria-describedby="passwordHelp">
						<small id="passwordHelp" class="form-text text-muted">Ingrese la contraseña con la cuál iniciará sesión. Debe ser mayor de 6 caractéres.</small>
						<div class="alert alert-warning" ng-if="password.length > 0 && password.length <= 6">Debe ingresar una contraseña de al menos 6 caracteres</div>
					</div>

					<div class="form-group col-12 col-md-4">
						<label for="repetir_contrasena">Repetir contraseña</label>
						<input type="password" name="repetir_contrasena" ng-model="repetir_contrasena" class="form-control" ng-class="{'input-required': password!==''}" id="repetir_contrasena" aria-describedby="repetir_contrasenaHelp">
						<small id="repetir_contrasenaHelp" class="form-text text-muted">Vuelva a ingresar la contraseña nuevamente</small>
						<div class="alert alert-warning" ng-if="repetir_contrasena!==undefined && repetir_contrasena!==password">Las contraseñas no coinciden</div>
					</div>
				
				</div>

			</div>
		</div>

		<div class="card mb-3">
	        <div class="card-header">
	          	Información adicional</div>
	        <div class="card-body">
				<div class="row">
					<div class="form-group col-12">
						<label for="comentario">Comentarios adicionales:</label>
						<textarea class="form-control" name="comentario" id="comentario" rows="3" aria-describedby="comentarioHelp"><?=(isset($colaborador->comentario))?$colaborador->comentario:''?></textarea>
						<small id="comentarioHelp" class="form-text text-muted">Ingrese un comentario adicional sobre este colaborador.<br/>
						</small>
						
					</div>
				
				</div>

			</div>
		</div>

		<div class="card mb-3">
	        <div class="card-header">
	          	Estado de colaborador</div>
	        <div class="card-body">
				<div class="row">
					<div class="form-group col-12 col-md-4">
						<label>Estado del colaborador:</label>
						<div class="form-check">
							<label class="form-check-label">
								<input class="form-check-input" type="radio" name="estado" id="estado1" value="1" <?=(isset($colaborador->estado) && $colaborador->estado==1)?'checked="checked"':''?>>
								Activo
							</label>
						</div>
						<div class="form-check">
							<label class="form-check-label">
								<input class="form-check-input" type="radio" name="estado" id="estado2" value="0" <?=(isset($colaborador->estado) && $colaborador->estado==0)?'checked="checked"':''?>>
								Inactivo
							</label>
						</div>
					</div>
				
				</div>

			</div>
		</div>
	    
	  <button type="submit" class="btn btn-primary form-submit"><i class="fa fa-fw fa-save"></i> Guardar</button>
	</form>
	
</div>