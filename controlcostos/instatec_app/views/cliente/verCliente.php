<!-- Breadcrumbs-->
<ol class="breadcrumb">
	<li class="breadcrumb-item">
	  <a href="<?=base_url()?>">Inicio</a>
	</li>
	<li class="breadcrumb-item">
	  <a href="<?=base_url()?>clientes">Clientes</a>
	</li>
	<li class="breadcrumb-item active">Ver cliente</li>
</ol>
<h1  class="text-center"><i class="fa fa-fw fa-handshake-o"></i> Clientes</h1>
<hr>

<div class="page-content">
	<div class="row">
		<div class="col-12 col-md-6"><h3 class=" text-center text-md-left"><i class="fa fa-fw fa-eye"></i> Ver cliente</h3></div>
		<div class="col-12 col-md-6">
		<?php if(isset($permisos['cliente']['edit'])){ ?>
			<a class="btn btn-primary float-md-right mb-3 mr-md-3 mx-auto d-block d-md-inline-block" href="<?=base_url()?>clientes/editar-cliente/<?=$cliente->cliente_id?>" role="button"><i class="fa fa-fw fa-edit"></i> Editar cliente</a>
		<?php } ?>
		<a class="btn btn-primary float-md-right mb-3 mr-md-3 mx-auto d-block d-md-inline-block" href="<?=base_url()?>clientes" role="button"><i class="fa fa-fw fa-arrow-left"></i> Volver al listado de clientes</a>
		</div>
	</div>
	
	<div class="card mb-3">
        <div class="card-header">
          	<i class="fa fa-handshake-o"></i> Información del cliente</div>
        <div class="card-body">
        	<div class="row">
	        	<div class="col-12 col-md-6">
		          	<p><span class="font-weight-bold">Nombre de cliente:</span> 
					<?=(isset($cliente->nombre_cliente))?$cliente->nombre_cliente:''?></p>
					
					<p><span class="font-weight-bold">Cédula del cliente:</span> 
					<?=(isset($cliente->cedula_cliente))?$cliente->cedula_cliente:''?></p>
					
				    
				    <?php if(isset($cliente_correo)){ ?> 
				   		<p><span class="font-weight-bold">Correos de contacto:</span> <br />
						<?php foreach($cliente_correo as $kcorreo => $vcorreo){ ?>
							<a href="mailto:<?=$vcorreo->correo_cliente?>"><?=$vcorreo->correo_cliente?></a> <br />		       
						<?php	
						} ?>
						</p>
				    <?php } ?>



				    <?php if(isset($cliente_telefono)){ ?>
				    	<p><span class="font-weight-bold">Teléfonos de contacto:</span> <br />
						<?php foreach($cliente_telefono as $ktelefono => $vtelefono){ ?>
							<a href="mailto:<?=$vtelefono->telefono_cliente?>"><?=$vtelefono->telefono_cliente?></a> <br />
						       
						<?php	
						} ?>
						</p>
				    <?php } ?>
	        		
	        	</div>
	        	<div class="col-12 col-md-6">	
				    <p><span class="font-weight-bold">Estado del cliente:</span> 
					<?=(isset($cliente->estado_cliente) && $cliente->estado_cliente==1)?'Activo':'Inactivo'?></p>

					<p><span class="font-weight-bold">Calificación del cliente:</span> 
					<?=(isset($cliente->cliente_calificacion))?$cliente->cliente_calificacion:''?></p>

					<p><span class="font-weight-bold">Comentarios adicionales:</span> <br />
					<?=(isset($cliente->comentario))?$cliente->comentario:''?></p>
	        	</div>
        		
        	</div>



        </div>
        
    </div>

	
	<?php if($cliente_proyectos!=false){ ?>
		<div class="card mb-3">
			<div class="card-header">
				<i class="fa fa-handshake-o"></i> Proyectos de este cliente</div>
			<div class="card-body">
				<div class="table-responsive">
			        <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
			            <thead class="thead-light">
					        <tr>
					        	<th class="d-md-none">Acciones</th>
								<th>Datos</th>
								<th>Cliente</th>
								
								<th>Estado</th>
														
								<th>Ubicación</th>						
								
								<th>Fechas reelevantes</th>
								
								<th class="d-none d-md-table-cell">Acciones</th>
							</tr>
						</thead>
			            <tbody>
							<?php foreach($cliente_proyectos['datos'] as $kproyecto => $vproyecto){ ?>
								<tr>
									<td class="d-md-none">
										<a href="<?=base_url()?>proyectos/ver-proyecto/<?=$vproyecto->proyecto_id?>" class="btn btn-edit btn-sm mb-1 btn-primary"><i class="fa fa-fw fa-eye"></i></a>
										<?php if(isset($permisos['proyecto']['edit'])){ ?>
											<a href="<?=base_url()?>proyectos/editar-proyecto/<?=$vproyecto->proyecto_id?>" class="btn btn-edit btn-sm mb-1 btn-success"><i class="fa fa-fw fa-edit"></i></a> 
										<?php } ?> 
										<?php if(isset($permisos['reporte_proyecto_especifico']['view'])){ ?>
											<a href="<?=base_url()?>reportes/proyecto-especifico/<?=$vproyecto->proyecto_id?>" class="btn btn-edit btn-sm mb-1 btn-secondary" target="_blank"><i class="fa fa-fw fa-download"></i></a>
										<?php } ?> 
									</td>
									<td><?=(isset($permisos['proyecto']['view']))?'<a href="<?=base_url()?>proyectos/ver-proyecto/<?=$vproyecto->proyecto_id?>">':''?><strong>Nombre: <?=$vproyecto->nombre_proyecto?></strong><br>N° Contrato: <?=$vproyecto->numero_contrato?><br>Orden de compra: <?=$vproyecto->orden_compra?><?=(isset($permisos['proyecto']['view']))?'</a>':''?></td>
									<td><?=(isset($permisos['proyecto']['view']))?'<a href="<?=base_url()?>proyectos/ver-proyecto/<?=$vproyecto->proyecto_id?>">':''?><?=$vproyecto->nombre_cliente?><?=(isset($permisos['proyecto']['view']))?'</a>':''?></td>
									
									<td><?=(isset($permisos['proyecto']['view']))?'<a href="<?=base_url()?>proyectos/ver-proyecto/<?=$vproyecto->proyecto_id?>">':''?><?=$vproyecto->proyecto_estado?><?=(isset($permisos['proyecto']['view']))?'</a>':''?></td>
									
									<td><?=(isset($permisos['proyecto']['view']))?'<a href="<?=base_url()?>proyectos/ver-proyecto/<?=$vproyecto->proyecto_id?>">':''?>Provincia: <?=$vproyecto->provincia?><br>Cantón: <?=$vproyecto->canton?><br>Distrito: <?=$vproyecto->distrito?><?=(isset($permisos['proyecto']['view']))?'</a>':''?></td>
									
									<td><?=(isset($permisos['proyecto']['view']))?'<a href="<?=base_url()?>proyectos/ver-proyecto/<?=$vproyecto->proyecto_id?>">':''?>Firma de contrato: <?=$vproyecto->fecha_firma_contrato?><br>Inicio: <?=$vproyecto->fecha_inicio?><br>Entrega: <?=$vproyecto->fecha_entrega_estimada?><?=(isset($permisos['proyecto']['view']))?'</a>':''?></td>
									
									<td class="d-none d-md-table-cell">
										<a href="<?=base_url()?>proyectos/ver-proyecto/<?=$vproyecto->proyecto_id?>" class="btn btn-edit btn-sm mb-1 btn-primary"><i class="fa fa-fw fa-eye"></i></a> 
										<?php if(isset($permisos['proyecto']['edit'])){ ?>
											<a href="<?=base_url()?>proyectos/editar-proyecto/<?=$vproyecto->proyecto_id?>" class="btn btn-edit btn-sm mb-1 btn-success"><i class="fa fa-fw fa-edit"></i></a> 
										<?php } ?> 
										<?php if(isset($permisos['reporte_proyecto_especifico']['view'])){ ?>
											<a href="<?=base_url()?>reportes/proyecto-especifico/<?=$vproyecto->proyecto_id?>" class="btn btn-edit btn-sm mb-1 btn-secondary" target="_blank"><i class="fa fa-fw fa-download"></i></a>
										<?php } ?> 
									</td>
								</tr>

							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>

	<?php } ?>
	
				
	
</div>