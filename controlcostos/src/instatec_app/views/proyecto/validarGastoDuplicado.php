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
		<a href="<?=base_url()?>proyectos/gastos/<?=$proyecto['proyecto_id']?>">Gastos</a>
	</li>
	<li class="breadcrumb-item active">Validar gasto duplicado</li>
</ol>

<h1 class="text-center">Gastos del proyecto</h1>
<hr>

<div class="row">
	<div class="col-12 col-md-10"><h3 class=" text-center text-md-left"><i class="fa fa-fw fa-edit"></i> Gasto ya existe</h3></div>
	<div class="col-12 col-md-2"><a class="float-right btn btn-secondary" href="<?=base_url()?>proyectos/gastos/<?=$proyecto['proyecto_id']?>/agregar-gasto" role="button"><i class="fa fa-fw fa-arrow-left"></i> Volver</a></div>
</div>


<div class="page-content" ng-controller="validarGastoDuplicadoController" >
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
	<form id="validarGastoDuplicadoController" class="form-validation" method="post" name="validarGastoDuplicadoController">
		<div class="card mb-3">
	        <div class="card-header">
	          	Gasto duplicado</div>
	        <div class="card-body">
                <div class="row"><div class="col-12"><p>Previamente se ingresó un gasto en este proyecto para este mismo proveedor, con el mismo número de factura y con el mismo monto. A continuación se muestra el gasto ya registrado y el gasto que está intentando registrar, para que procesa a verificar la información y confirmar si realmente desea ingresar este gasto con la información duplicada en el sistema. </p></div></div>
	        	<div class="row">
	        		<div class="col-12 col-md-6">
                        <h3>Gasto existente</h3>
                        <table class="table table-hovered table-bordered">
                            <tr>
                                <td><strong>Tipo de gasto:</strong></td>
                                <td><?=$proyecto_gasto['proyecto_gasto_tipo']?></td>
                            </tr>
                            <tr>
                                <td><strong>Proveedor:</strong></td>
                                <td><?=$proyecto_gasto['nombre_proveedor']?></td>
                            </tr>
                            <tr>
                                <td><strong># de factura:</strong></td>
                                <td><?=$proyecto_gasto['numero_factura']?></td>
                            </tr>
                            <tr>
                                <td><strong>Fecha:</strong></td>
                                <td><?=$proyecto_gasto['fecha_gasto']?></td>
                            </tr>
                            <tr>
                                <td><strong>Moneda:</strong></td>
                                <td>
                                    <?php foreach ($monedas as $kmoneda => $vmoneda) {
                                        if ($vmoneda['moneda_id'] == $proyecto_gasto['moneda_id']){
                                            echo $vmoneda['moneda'];
                                        }
                                    } ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Monto:</strong></td>
                                <td>
                                    <?=$proyecto_gasto['proyecto_gasto_monto']?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Estado:</strong></td>
                                <td>
                                    <?=$proyecto_gasto['proyecto_gasto_estado']?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Detalle:</strong></td>
                                <td>
                                    <?=$proyecto_gasto['gasto_detalle']?>
                                </td>
                            </tr>
                        </table>
	        		</div>
	        		

	        		<div class="col-12 col-md-6">
	        			<h3>Gasto nuevo</h3>
                        <table class="table table-hovered table-bordered">
                            <tr>
                                <td><strong>Tipo de gasto:</strong></td>
                                <td>
                                    <?php foreach ($gasto_tipo as $kgastotipo => $vgastotipo) {
                                        if ($vgastotipo['proyecto_gasto_tipo_id'] == $gasto_nuevo['proyecto_gasto_tipo_id']){
                                            echo $vgastotipo['proyecto_gasto_tipo'];
                                        }
                                    } ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Proveedor:</strong></td>
                                <td>
                                    <?php foreach ($proveedores as $kproveedor => $vproveedor) {
                                        if ($vproveedor['proveedor_id'] == $gasto_nuevo['proveedor_id']){
                                            echo $vproveedor['nombre_proveedor'];
                                        }
                                    } ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong># de factura:</strong></td>
                                <td>
                                    <?=$gasto_nuevo['numero_factura']?>
                                        
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Fecha:</strong></td>
                                <td>
                                    <?=$gasto_nuevo['fecha_gasto']?>
                                        
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Moneda:</strong></td>
                                <td>
                                    <?php foreach ($monedas as $kmoneda => $vmoneda) {
                                        if ($vmoneda['moneda_id'] == $gasto_nuevo['moneda_id']){
                                            echo $vmoneda['moneda'];
                                        }
                                    } ?>
                                        
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Monto:</strong></td>
                                <td>
                                    <?=$gasto_nuevo['proyecto_gasto_monto']?>
                                        
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Estado:</strong></td>
                                <td>
                                    <?php foreach ($monedas as $kmoneda => $vmoneda) {
                                        if ($vmoneda['moneda_id'] == $gasto_nuevo['moneda_id']){
                                            echo $vmoneda['moneda'];
                                        }
                                    } ?>
                                        
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Detalle:</strong></td>
                                <td>
                                    <?=$gasto_nuevo['gasto_detalle']?>
                                        
                                </td>
                            </tr>
                        </table>
                        <div class="text-right">
                            <a class="btn btn-secondary" href=""><i class="fa fa-fw fa-arrow-left"></i> Volver</a>
                            <input type="hidden" name="guardar_duplicado" value="true" />
                            <button type="submit" class="btn btn-success form-submit"><i class="fa fa-fw fa-save"></i> Continuar y Guardar</button>
                        
                        </div>
	        		</div>

	        		
	        	</div>
	        	
	        </div>
	    </div>
	    
		
	</form>
</div>
