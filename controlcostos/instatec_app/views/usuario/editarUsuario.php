<script src="<?=base_url()?>instatec_pub/js/usuario.js"></script>
<!-- Breadcrumbs-->
<ol class="breadcrumb">
	<li class="breadcrumb-item">
	  <a href="<?=base_url()?>">Inicio</a>
	</li>
	<li class="breadcrumb-item">
	  <a href="<?=base_url()?>usuarios">Usuarios</a>
	</li>
	<li class="breadcrumb-item active">Editar usuario</li>
</ol>
<h1  class="text-center"><i class="fa fa-fw fa-users"></i> Usuarios</h1>
<hr>
<div class="row">
	<div class="col-12 col-md-10"><h3 class=" text-center text-md-left"><i class="fa fa-fw fa-plus-circle"></i> Editar usuario existente</h3></div>
	<div class="col-12 col-md-2"><a class="float-right btn btn-primary" href="<?=base_url()?>usuarios" role="button"><i class="fa fa-fw fa-arrow-left"></i> Volver a usuarios</a></div>
</div>
<div class="page-content" ng-controller="editarUsuarioController">
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
	<form id="editarUsuario" class="form-validation" method="post" name="editarUsuario">
		<div class="card mb-3">
	        <div class="card-header">
	          	Datos personales</div>
	        <div class="card-body">
				<div class="row">
					<div class="form-group col-12 col-md-4">
						<label for="nombre">Nombre del usuario</label>
						<input type="text" name="nombre" class="form-control input-required" id="nombre" value="<?=(isset($usuario->nombre)?$usuario->nombre:'')?>" aria-describedby="nombreHelp" >
						<small id="nombreHelp" class="form-text text-muted">Ingrese el nombre del usuario tal cual desea que lo ubiquen el resto de los usuarios.<br/>
						</small>
					</div>
					<div class="form-group col-12 col-md-4">
						<label for="apellidos">Apellidos del usuario</label>
						<input type="text" name="apellidos" class="form-control input-required" id="apellidos" value="<?=(isset($usuario->apellidos)?$usuario->apellidos:'')?>" aria-describedby="apellidosHelp">
						<small id="apellidosHelp" class="form-text text-muted">Ingrese el número de cédula, ya sea física o jurídica.</small>
					</div>
					<div class="form-group col-12 col-md-4">
						<label for="correo_electronico">Correo del usuario</label>
						<input type="text" name="correo_electronico" class="form-control input-required" id="correo_electronico" value="<?=(isset($usuario->correo_electronico)?$usuario->correo_electronico:'')?>" aria-describedby="correoHelp">
						<small id="correoHelp" class="form-text text-muted">Ingrese el correo electrónico.</small>
					</div>
				
				</div>
			</div>
		</div>

		<div class="card mb-3">
	        <div class="card-header">
	          	Datos para inicio de sesión</div>
	        <div class="card-body">
				<div class="row">
					<div class="form-group col-12 col-md-4">
						<label for="usuario">Usuario</label>
						<input type="text" name="usuario" class="form-control input-required" id="usuario" value="<?=(isset($usuario->usuario)?$usuario->usuario:'')?>" aria-describedby="usuarioHelp">
						<small id="usuarioHelp" class="form-text text-muted">Ingrese el usuario con el cual iniciará sesión.</small>
					</div>

					<div class="form-group col-12 col-md-4">
						<label for="password">Contraseña</label>
						<input type="password" ng-model="password" name="password" class="form-control" id="password" aria-describedby="passwordHelp">
						<small id="passwordHelp" class="form-text text-muted">Ingrese la contraseña con la cuál iniciará sesión. Debe ser mayor de 6 caractéres.</small>
						<div class="alert alert-warning" ng-if="password.length > 0 && password.length <= 6">Debe ingresar una contraseña de al menos 6 caracteres</div>
					</div>

					<div class="form-group col-12 col-md-4">
						<label for="repetir_contrasena">Repetir contraseña</label>
						<input type="password" name="repetir_contrasena" ng-model="repetir_contrasena" class="form-control" id="repetir_contrasena" aria-describedby="repetir_contrasenaHelp">
						<small id="repetir_contrasenaHelp" class="form-text text-muted">Vuelva a ingresar la contraseña nuevamente</small>
						<div class="alert alert-warning" ng-if="repetir_contrasena!==undefined && repetir_contrasena!==password">Las contraseñas no coinciden</div>
					</div>
				
				</div>
				<div class="row">

					<div class="form-group col-12 col-md-4">
						<label>Rol:</label>
						<select class="form-control select-required	" name="rol_id" id="rol_id" aria-describedby="roleHelp" ng-model="rol_id" required="required">
							<?php 
								foreach($roles as $krol => $vrol){ 
									$selected="";
									if(isset($usuario->rol_id) && ($usuario->rol_id==$vrol->rol_id)){
										$selected = 'selected="selected"';
									} 
									 if($rol_id==2){
										if($vrol->rol_id == 3){ ?>
										<option value="<?=$vrol->rol_id?>" <?=$selected?>><?=$vrol->rol_name?></option>
										<?php 
										}
									}else{ ?>
										<option value="<?=$vrol->rol_id?>" <?=$selected?>><?=$vrol->rol_name?></option>
									<?php	
									}
								} ?>
						</select>	
						<small id="roleHelp" class="form-text text-muted">Ingrese el rol de este usuario.</small>
					</div>			
				</div>
			</div>
		</div>

		<div class="card mb-3">
	        <div class="card-header">
	          	Estado de usuario</div>
	        <div class="card-body">
				<div class="row">
					<div class="form-group col-12 col-md-4">
						<label>Estado del usuario:</label>
						<div class="form-check">
							<label class="form-check-label">
								<input class="form-check-input" type="radio" name="estado_id" id="estado1" value="1" <?=(isset($usuario->estado_id) && $usuario->estado_id==1)?'checked="checked"':''?>>
								Activo
							</label>
						</div>
						<div class="form-check">
							<label class="form-check-label">
								<input class="form-check-input" type="radio" name="estado_id" id="estado2" value="0" <?=(isset($usuario->estado_id) && $usuario->estado_id==0)?'checked="checked"':''?>>
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