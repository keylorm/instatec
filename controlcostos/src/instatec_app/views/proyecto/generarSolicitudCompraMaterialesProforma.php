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
		<a href="<?=base_url()?>proyectos/materiales/<?=$proyecto['proyecto_id']?>">Materiales</a>
	</li>
	<li class="breadcrumb-item">
		<a href="<?=base_url()?>proyectos/materiales/<?=$proyecto['proyecto_id']?>/solicitudes-compra-materiales">Solicitudes de compra</a>
	</li>
	<li class="breadcrumb-item">
		<a href="<?=base_url()?>proyectos/materiales/<?=$proyecto['proyecto_id']?>/solicitudes-compra-materiales/<?=$solicitud_compra_id?>/proformas">Proformas</a>
	</li>
	<li class="breadcrumb-item active">Generar proforma</li>
</ol>

<h1 class="text-center "><i class="fa fa-fw fa-wrench"></i> Materiales de proyecto</h1>
<hr>

<div class="page-content">
	<div class="row">
		<div class="col-12 col-md-12">
			<a class="btn btn-sm btn-secondary float-md-right mb-3 mr-md-3 mx-auto d-block d-md-inline-block" href="<?=base_url()?>proyectos/materiales/<?=$proyecto['proyecto_id']?>/solicitudes-compra-materiales/<?=$solicitud_compra_id?>/proformas" role="button"><i class="fa fa-fw fa-arrow-left"></i> Volver</a>
		</div>
	</div>	
	<form id="generarProforma" action="" method="post" id="download-form-bottom">
        <?php foreach ($materiales_proforma as $kproveedor => $vproveedor) { ?>
        	<div class="card mb-3">
		        <div class="card-header anchor-class" data-toggle="collapse" data-target="#container_proveedor_<?=$kproveedor?>" aria-expanded="false" aria-controls="collapseExample">
		        	<h5><?=$vproveedor['nombre_proveedor']?> <i class="fa fa-plus-circle"></i></h5>
		        </div>
		        <div class="card-body collapse" id="container_proveedor_<?=$kproveedor?>">
					<div class="row">
						<div class="col-12 col-md-4">
							<div class="form-group">
								<label for="direccion[<?=$kproveedor?>]">Dirección de Instatec</label>
								<input type="text" class="form-control" id="direccion[<?=$kproveedor?>]" name="direccion[<?=$kproveedor?>]" />
							</div>
						</div>
						<div class="col-12 col-md-4">
							<div class="form-group">
								<label for="vigencia[<?=$kproveedor?>]">Vigencia</label>
								<input value="30 días" type="text" class="form-control" id="vigencia[<?=$kproveedor?>]" name="vigencia[<?=$kproveedor?>]" />
							</div>
						</div>
						<!--
						<div class="col-12 col-md-4">
							<div class="form-group">
								<label for="descuento[<?=$kproveedor?>]">Descuento (%)</label><br>
								<input value="0" type="text" class="input-number form-control" id="descuento[<?=$kproveedor?>]" name="descuento[<?=$kproveedor?>]" />
							</div>
						</div>
						-->
						<div class="col-12 col-md-4">
							<div class="form-group">
								<label for="notas[<?=$kproveedor?>]">Notas</label>
								<textarea type="text" class="form-control" id="notas[<?=$kproveedor?>]" name="notas[<?=$kproveedor?>]"></textarea>
							</div>
						</div>
						
					</div>
					<div class="row mt-5 mb-5">
						<div class="col-12">
							<button type="submit" name="generar_proforma" value
							="<?=$kproveedor?>" class="btn btn-sm btn-success float-md-right mb-3 mr-md-3 mx-auto d-block d-md-inline-block" role="button"><i class="fa fa-fw fa-download"></i> Generar proforma</button>
						</div>
					</div>
					<div class="mb-5 mt-5">
						<div class="card mb-3">
		       				<div class="card-header anchor-class" data-toggle="collapse" data-target="#container_materiales_<?=$kproveedor?>" aria-expanded="false" aria-controls="collapseExample">
								Lista de materiales: <i class="fa fa-plus-circle"></i>
							</div>
							<div class="card-body collapse" id="container_materiales_<?=$kproveedor?>">
								<div class="table-responsive">
								    <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
								        <thead class="thead-light">
									        <tr>
												<th>Material</th>
												<th>Detalle</th>
												<th>Cantidad</th>
											</tr>
										</thead>
								        <tbody>
								        	<?php foreach ($vproveedor['materiales'] as $kmaterial => $vmaterial) { ?>
								            	<tr class="material-item">
													<td><?=$vmaterial['material'].' ('.$vmaterial['material_codigo'].')'?></td>
													<td><?=$vmaterial['comentario']?></td>
													<td><?=$vmaterial['cantidad_compra'].' ('.$vmaterial['material_unidad'].')'?></td>
												</tr>						
								        	<?php } ?>
											
										</tbody>
								    </table>
								</div>
							</div>
						</div>
						
					</div>
					
		        	
		        </div>
		    </div>
        <?php } ?>
    </form>
</div>