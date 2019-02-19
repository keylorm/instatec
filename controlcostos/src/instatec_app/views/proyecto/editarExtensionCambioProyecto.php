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
    <li class="breadcrumb-item">
		<a href="<?=base_url()?>proyectos/ordenes-cambio/<?=$proyecto['proyecto_id']?>/editar-orden-cambio/<?=$proyecto_extension['proyecto_valor_oferta_id']?>">Ver orden de cambio</a>
	</li>
	<li class="breadcrumb-item active">Agregar orden de cambio</li>
</ol>

<h1 class="text-center">Ordenes de cambio de proyectos</h1>
<hr>

<div class="row">
	<div class="col-12 col-md-10"><h3 class=" text-center text-md-left"><i class="fa fa-fw fa-plus-circle"></i> Agregar cambio</h3></div>
	<div class="col-12 col-md-2"><a class="float-right btn btn-primary" href="<?=base_url()?>proyectos/ordenes-cambio/<?=$proyecto['proyecto_id']?>/editar-orden-cambio/<?=$proyecto_extension['proyecto_valor_oferta_id']?>" role="button"><i class="fa fa-fw fa-arrow-left"></i> Volver</a></div>
</div>


<div class="page-content" ng-cloak ng-controller="editarExtensionCambioProyecto" ng-init="<?=(isset($proyecto_extension_cambio['cantidad']))?'cantidad='.$proyecto_extension_cambio['cantidad'].';':''?> <?=(isset($proyecto_extension_cambio['precio_unitario']))?'precio_unitario='.$proyecto_extension_cambio['precio_unitario'].';':''?> <?=(isset($proyecto_extension_cambio['total']))?'total='.$proyecto_extension_cambio['total'].';':''?> <?=(isset($proyecto_extension_cambio['moneda_id']))?'moneda_id='.$proyecto_extension_cambio['moneda_id'].';':''?>">
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
	<form id="editarExtensionCambioProyecto" class="form-validation " method="post" name="editarExtensionCambioProyecto" >
		<div class="card mb-3">
	        <div class="card-header">
	          	Información de cambio</div>
	        <div class="card-body">
	        	<div class="row">
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="tipo_operacion">Operación:</label>							
							<select class="form-control select-required" name="tipo_operacion" id="tipo_operacion"  aria-describedby="tipoCambioHelp">
								<option value="1" <?=(isset($proyecto_extension_cambio['tipo_operacion']) && $proyecto_extension_cambio['tipo_operacion']==1)?'selected="selected"':''?>>Extra</option>
								<option value="2" <?=(isset($proyecto_extension_cambio['tipo_operacion']) && $proyecto_extension_cambio['tipo_operacion']==2)?'selected="selected"':''?>>Nota de crédito</option>
								
							</select>
							<small id="tipoCambioHelp" class="form-text text-muted">Ingrese la operación de cambio.<br/>
							</small>
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="proyecto_valor_oferta_extension_tipo_id">Tipo de cambio:</label>							
							
							<select class="form-control select-required" name="proyecto_valor_oferta_extension_tipo_id" id="proyecto_valor_oferta_extension_tipo_id" aria-describedby="tipoextensionHelp">
								<?php if(isset($extensiones_tipos)){
                                    foreach ($extensiones_tipos as $ktipo => $vtipo) { 
                                            $selected = '';
                                            if(isset($proyecto_extension_cambio['proyecto_valor_oferta_extension_tipo_id'])){
                                                if($proyecto_extension_cambio['proyecto_valor_oferta_extension_tipo_id'] == $vtipo['proyecto_valor_oferta_extension_tipo_id']){
                                                    $selected='selected="selected"';
                                                }
                                            } ?>
											<option value="<?=$vtipo['proyecto_valor_oferta_extension_tipo_id']?>" <?=$selected?>><?=$vtipo['proyecto_valor_oferta_extension_tipo']?></option>
								<?php 	}
									}
								?>
							</select>
							<small id="tieneImpuestoHelp" class="form-text text-muted">Ingrese el tipo de cambio.<br/>
							</small>
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="lamina_arquitectonica">Lámina arquitectónica:</label>
							<input type="text" name="lamina_arquitectonica" <?=(isset($proyecto_extension_cambio['lamina_arquitectonica']))?'value="'.$proyecto_extension_cambio['lamina_arquitectonica'].'"':''?> class="form-control" id="lamina_arquitectonica" aria-describedby="laminaHelp" >
							<small id="laminaHelp" class="form-text text-muted">Indique la lámina arquitectónica de este cambio.<br/>
							</small>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12 col-md-3">
						<div class="form-group">
							<label for="cantidad">Cantidad:</label>
							<input type="text" <?=(isset($proyecto_extension_cambio['cantidad']))?'value="'.$proyecto_extension_cambio['cantidad'].'"':'value="1"'?>  ng-model="cantidad" ng-change="calcularTotal();" name="cantidad" id="cantidad" class="form-control input-required input-number" aria-describedby="cantidadHelp">
							<small id="cantidadHelp" class="form-text text-muted">Ingrese la cantidad de este cambio.<br/>
							</small>
						
						</div>
					</div>
					<div class="col-12 col-md-3">
						<div class="form-group">
							<label for="tiene_impuesto">Unidad:</label>							
							
							<select class="form-control select-required" name="proyecto_valor_oferta_extension_unidad_id"  id="proyecto_valor_oferta_extension_unidad_id" aria-describedby="tipoextensionHelp">
								<?php if(isset($extensiones_unidades)){
										foreach ($extensiones_unidades as $kunidad => $vunidad) {  $selected = '';
                                            if(isset($proyecto_extension_cambio['proyecto_valor_oferta_extension_unidad_id'])){
                                                if($proyecto_extension_cambio['proyecto_valor_oferta_extension_unidad_id'] == $vunidad['proyecto_valor_oferta_extension_unidad_id']){
                                                    $selected='selected="selected"';
                                                }
                                            } ?>
											<option value="<?=$vunidad['proyecto_valor_oferta_extension_unidad_id']?>" <?=$selected?>><?=$vunidad['proyecto_valor_oferta_extension_unidad']?></option>
								<?php 	}
									}
								?>
							</select>
							<small id="tieneImpuestoHelp" class="form-text text-muted">Ingrese la unidad de medida del cambio.<br/>
							</small>
						</div>
					</div>
					<div class="col-12 col-md-3">
						<div class="form-group">
							<label for="moneda_id">Moneda del cambio:</label>
							<select class="form-control select-required" name="moneda_id" id="moneda_id" ng-model="moneda_id" ng-change="inputMask()" aria-describedby="monedahelp">
								<?php if(isset($monedas)){
										foreach ($monedas as $kmoneda => $vmoneda) { ?>
											<option ng-value="<?=$vmoneda['moneda_id']?>" value="<?=$vmoneda['moneda_id']?>"><?=$vmoneda['moneda']?></option>
								<?php 	}
									}
								?>
							</select>
							<small id="monedahelp" class="form-text text-muted">Indique la moneda del cambio que está registrando.<br/>
							</small>
						</div>
					</div>
					<div class="col-12 col-md-3">
						<div class="form-group">
							<label for="precio_unitario">Precio unitario:</label>
							<input  type="text"  value="0"  ng-model="precio_unitario" name="precio_unitario" id="precio_unitario" class="form-control input-required"  ng-class="{ 'input-money-mask': moneda_id==1, 'input-money-mask-colones': moneda_id==2 }" ng-change="calcularTotal();"  aria-describedby="precio_unitarioHelp">
							<small id="precio_unitarioHelp" class="form-text text-muted">Ingrese el precio unitario de este cambio<br/><br>
							</small>
							<button ng-click="calcularTotal();" class="btn btn-primary btn-sm">Calcular total</button>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label for="total">Total:</label>
							<input  type="text"  value="0" ng-model="total" name="total" id="total" class="form-control input-required"  ng-class="{ 'input-money-mask': moneda_id==1, 'input-money-mask-colones': moneda_id==2 }"  ng-change="calcularUnitario();" aria-describedby="totalHelp">
							<small id="totalHelp" class="form-text text-muted">Total de este cambio<br/><br>
							</small>
							<button ng-click="calcularUnitario();" class="btn btn-primary btn-sm">Calcular unitario</button>
						</div>
					</div>	    		
	        	</div>
	        	<div class="row">
					<div class="form-group col-12">
						<label for="descripcion">Descripción:</label>
						<textarea class="form-control" name="descripcion" id="descripcion"  rows="3" aria-describedby="descripcionHelp"><?=(isset($proyecto_extension_cambio['descripcion']))?$proyecto_extension_cambio['descripcion']:''?></textarea>
						<small id="descripcionHelp" class="form-text text-muted">Ingrese la descripción de este cambio.<br/>
						</small>
						
					</div>
	        	</div>
	        </div>
	    </div>
		<button type="submit" class="btn btn-primary form-submit"><i class="fa fa-fw fa-save"></i> Guardar</button>
  </form>
</div>